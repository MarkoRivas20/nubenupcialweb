<?php

namespace App\Livewire;

use App\Models\Configuration;
use CodersFree\Shoppingcart\Facades\Cart;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ShoppingCart extends Component
{
    //protected $configuration;

    public function mount(){
        
        Cart::instance('shopping');

    }

    #[Computed()]
    public function subtotal(){
        return Cart::content()->filter(function($item){
            return $item->options['status'] == true;
        })->filter(function($item){
            return $item->qty <= $item->options['stock'];
        })->sum(function($item){
            return $item->subtotal;
        });
    }
/*
    #[Computed()]
    public function tax(){
        return Cart::content()->filter(function($item){
            return $item->options['status'] == true;
        })->filter(function($item){
            return $item->qty <= $item->options['stock'];
        })->sum(function($item){
            return ($item->subtotal * $this->configuration->content['tax'])/100.00;
        });
    }*/

    public function increase($rowId){
        Cart::instance('shopping');

        Cart::update($rowId, Cart::get($rowId)->qty + 1);
    
        if (auth()->check()) {
            Cart::store(auth()->id());
        }

        $this->dispatch('cartUpdated', Cart::count());
    }

    public function decrease($rowId){
        Cart::instance('shopping');

        $item = Cart::get($rowId);

        if ($item->qty > 1) {
            Cart::update($rowId, $item->qty - 1);
        }
        else{
            Cart::remove($rowId);
        }

        if (auth()->check()) {
            Cart::store(auth()->id());
        }

        $this->dispatch('cartUpdated', Cart::count());

    }

    public function remove($rowId){
        Cart::instance('shopping');

        Cart::remove($rowId);

        if (auth()->check()) {
            Cart::store(auth()->id());
        }

        $this->dispatch('cartUpdated', Cart::count());
    }

    public function destroy(){
        Cart::instance('shopping');
        Cart::destroy();

        if (auth()->check()) {
            Cart::store(auth()->id());
        }

        $this->dispatch('cartUpdated', Cart::count());
    }

    public function render()
    {
        //$this->configuration = Configuration::find(1);
        return view('livewire.shopping-cart');
    }
}
