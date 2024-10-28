<?php

namespace App\Livewire\Coupons;

use App\Models\Coupon;
use Livewire\Component;

class CouponCheck extends Component
{
    public $code = '';
    public $showError = false;

    public function validateCoupon(){
        $coupon = Coupon::where('code', $this->code)
        ->where('status', true)
        ->where('stock', '>', 0)
        ->whereDate('start_at', '<=', now())
        ->where(function($query){
            $query->whereDate('end_at', '>=', now())
                ->orWhereNull('end_at');
        })->first();

        if ($coupon) {
            $this->showError = false;

            return redirect()->route('checkout.index',$coupon->code);

        }else{
            $this->showError = true;
        }
    }

    public function render()
    {
        return view('livewire.coupons.coupon-check');
    }
}
