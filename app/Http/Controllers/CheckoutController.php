<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Variant;
use CodersFree\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }
    public function index($coupon = null){

        $couponInfo  = [
            'code' => '',
            'type'=> '',
            'value' => ''
        ];
        $showError = false;

        $content = $this->getContent();
        $configuration = Configuration::find(1)->first()->content;

        if ($content->count() == 0) {
            return redirect()->route('cart.index');
        }

        $subtotal = $content->sum(function($item){
            return $item->subtotal;
        });

        $total = $subtotal;
        $discount = 0.00;
        
        if ($coupon && $configuration['couponStatus'] == 1) {
            $couponValidate = $this->validateCoupon($coupon);
            if ($couponValidate) {
                
                $couponInfo = [
                    'code' => $couponValidate->code,
                    'type'=> $couponValidate->type,
                    'value' => $couponValidate->value
                ];

                $discount = $this->getDiscount($couponInfo['type'], $couponInfo['value'], $subtotal);
                $total = round( $subtotal - $discount, 2);

            }else{
                $showError = true;
            }
        }

        $access_token = $this->generateAccessToken();
        $session_token = $this->generateSessionToken($access_token, $total);

        return view('checkout.index', compact('content','subtotal','total','discount','session_token','couponInfo', 'showError','configuration'));
    }

    public function generateAccessToken(){

        $url_api = config('services.niubiz.url_api') . "/api.security/v1/security";
        $user = config('services.niubiz.user');
        $password = config('services.niubiz.password');

        $auth = base64_encode($user.":".$password);

        return Http::withHeaders([
            'Authorization' => 'Basic '.$auth,
        ])->get($url_api)->body();

    }

    public function generateSessionToken($access_token, $total){

        $merchant_id = config('services.niubiz.merchant_id');
        $url_api = config('services.niubiz.url_api') . "/api.ecommerce/v2/ecommerce/token/session/{$merchant_id}";

        $response = Http::withHeaders([
            'Authorization' => $access_token,
            'Content-Type' => 'application/json', 
        ])->post($url_api, [
            'channel' => 'web',
            'amount' => $total,
            'antifraud' => [
                'client_ip' => request()->ip(),
                'merchantDefineData' => [
                    "MDD4"=> "integraciones@niubiz.com.pe",
                    "MDD32"=> "JD1892639123",
                    "MDD75"=> "Registrado",
                    "MDD77"=> 458
                ]
            ]
        ])->json();

        return $response['sessionKey'];
    }

    public function validateCoupon($code){
        $coupon = Coupon::where('code', $code)
        ->where('status', true)
        ->where('stock', '>', 0)
        ->whereDate('start_at', '<=', now())
        ->where(function($query){
            $query->whereDate('end_at', '>=', now())
                ->orWhereNull('end_at');
        })->first();

        if ($coupon) {
            return $coupon;
        }else{
            return null;
        }
    }

    public function buy($coupon = null){

        $content = $this->getContent();

        $total = $content->sum(function($item){
            return $item->subtotal;
        });

        $discount = 0.00;

        if ($coupon) {
            $couponValidate = $this->validateCoupon($coupon);
            $discount = $this->getDiscount($couponValidate->type, $couponValidate->value, $total);
            $total = round( $total - $discount, 2);
        }

        $this->createOrder(1, '', $total, $couponValidate->code, $discount);

        return redirect()->route('checkout.successful')->with('digitalWallet',[
            'response' => 'Pronto un colaborador se comunicará contigo para poder brindarte el número al cual realizar la transferencia',
        ]);
    }

    protected function getDiscount($couponType, $couponValue, $mount){
        switch ($couponType) {
            case 1:
                return round((($mount * $couponValue)/100),2);
                break;
            case 2:
                return $couponValue;
                break;
            default:
                return 0.00;
                break;
        }
    }

    protected function getContent(){
        Cart::instance('shopping');
        return Cart::content()->filter(function($item){
            return $item->options['status'] == true;
        })->filter(function ($item){
            return $item->qty <= $item->options['stock'];
        });
    }

    protected function createOrder($payment_method, $payment_id, $subtotal, $couponCode, $couponDiscount){
        
        $content = $this->getContent();

        $configuration = Configuration::find(1);
        $tax = (($subtotal * $configuration->content['tax']) /100.00);

        switch ($payment_method) {
            case 1:
                $status = 1;
                break;
            case 2:
                $status = 2;
                break;
            
            default:
                $status = 1;
                break;
        }

        Order::create([
            'content' => $content,
            'payment_method' => $payment_method,
            'payment_id' => $payment_id,
            'total' => $subtotal,
            'discount' => $couponDiscount,
            'promo_code' => $couponCode,
            'tax' => $tax,
            'status' => $status,
            'user_id' => auth()->id()
        ]);

        foreach ($content as $item) {
            Variant::where('sku',$item->options['sku'])->decrement('stock', $item->qty);
            
            Cart::remove($item->rowId);
        }

        if($couponCode){
            Coupon::where('code',$couponCode)->decrement('stock', 1);
        }

        Cart::destroy();

    }

    public function paid(Request $request){

        $access_token = $this->generateAccessToken();
        $merchant_id = config('services.niubiz.merchant_id');
        $url_api = config('services.niubiz.url_api') . "/api.authorization/v3/authorization/ecommerce/{$merchant_id}";

        $response = Http::withHeaders([
            'Authorization' => $access_token,
            'Content-Type' => 'application/json',
        ])->post($url_api, [
            "channel" => "web",
            "captureType" => "manual",
            "countable" => true,
            "order" => [
                "tokenId" => $request->transactionToken,
                "purchaseNumber" => $request->purchaseNumber,
                "amount" => $request->amount,
                "currency" => "PEN"
            ]
        ])->json();

        if (isset($response['dataMap']) && $response['dataMap']['ACTION_CODE'] == '000') {
            
            $this->createOrder(2, $response['dataMap']['TRANSACTION_ID'], $request->amount,$request->couponcode,$request->coupondiscount);

            return redirect()->route('checkout.successful')->with('niubiz',[
                'response' => $response,
                'purchaseNumber' => $request->purchaseNumber,
            ]);
        }
        
        return redirect()->route('checkout.index');
        
    }
}
