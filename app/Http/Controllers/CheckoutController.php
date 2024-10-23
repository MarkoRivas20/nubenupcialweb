<?php

namespace App\Http\Controllers;

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
    public function index(){

        Cart::instance('shopping');
        $content = Cart::content()->filter(function($item){
            return $item->options['status'] == true;
        })->filter(function ($item){
            return $item->qty <= $item->options['stock'];
        });

        if ($content->count() == 0) {
            return redirect()->route('cart.index');
        }

        $subtotal = $content->sum(function($item){
            return $item->subtotal;
        });
        
        $access_token = $this->generateAccessToken();
        $session_token = $this->generateSessionToken($access_token, $subtotal);

        return view('checkout.index', compact('content','subtotal','session_token'));
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

    public function generateSessionToken($access_token, $subtotal){

        $merchant_id = config('services.niubiz.merchant_id');
        $url_api = config('services.niubiz.url_api') . "/api.ecommerce/v2/ecommerce/token/session/{$merchant_id}";
        
        $response = Http::withHeaders([
            'Authorization' => $access_token,
            'Content-Type' => 'application/json', 
        ])->post($url_api, [
            'channel' => 'web',
            'amount' => $subtotal,
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

    public function buy(){

        Cart::instance('shopping');
        $content = Cart::content()->filter(function($item){
            return $item->options['status'] == true;
        })->filter(function ($item){
            return $item->qty <= $item->options['stock'];
        });

        $subtotal = $content->sum(function($item){
            return $item->subtotal;
        });

        $this->createOrder(1, '', $subtotal);

        session()->flash('digitalWallet',[
            'response' => 'Pronto un colaborador se comunicará contigo para poder brindarte el número al cual realizar la transferencia',
        ]);

        return redirect()->route('checkout.successful');
    }

    protected function createOrder($payment_method, $payment_id, $total){
        Cart::instance('shopping');
        $content = Cart::content()->filter(function($item){
            return $item->options['status'] == true;
        })->filter(function ($item){
            return $item->qty <= $item->options['stock'];
        });

        Order::create([
            'content' => $content,
            'payment_method' => $payment_method,
            'payment_id' => $payment_id,
            'total' => $total,
            'user_id' => auth()->id()
        ]);

        foreach ($content as $item) {
            Variant::where('sku',$item->options['sku'])->decrement('stock', $item->qty);
        
            Cart::remove($item->rowId);
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

        session()->flash('niubiz',[
            'response' => $response,
            'purchaseNumber' => $request->purchaseNumber,
        ]);

        if (isset($response['dataMap']) && $response['dataMap']['ACTION_CODE'] == '000') {
            
            $this->createOrder(2, $response['dataMap']['TRANSACTION_ID'], $request->amount);

            return redirect()->route('checkout.successful');
        }
        
        return redirect()->route('checkout.index');
        
    }
}
