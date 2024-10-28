<?php

namespace App\Http\Middleware;

use App\Models\Variant;
use Closure;
use CodersFree\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyStock
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Cart::instance('shopping');

        foreach (Cart::content() as $item) {
            $options = $item->options;
            $variant = Variant::where('sku',$options['sku'])->first();
    
            if ($variant) {
                
                $options['stock'] = $variant->stock;
                $options['status'] = $variant->product->status;
                
                Cart::update($item->rowId, [
                    'options' => $options
                ]);

            }else{

                Cart::remove($item->rowId);
            }

        }
        return $next($request);
    }
}
