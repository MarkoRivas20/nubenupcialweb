<?php

namespace App\Livewire\Products;

use App\Models\Feature;
use CodersFree\Shoppingcart\Facades\Cart;
use Livewire\Attributes\Computed;
use Livewire\Component;

class AddToCart extends Component
{
    public $product;
    public $variant;
    public $stock;
    public $price;
    public $qty = 1;

    public $selectedFeatures = [];

    public function mount(){
        
        $this->selectedFeatures = $this->product->variants->first()->features->pluck('id','option_id')->toArray();
        
        $this->getVariant();
    }

    public function add_to_cart(){
        Cart::instance('shopping');
        
        $item = Cart::search(function($item, $rowId){
            return $item->options->sku === $this->variant->sku;
        })->first();
        
        if ($item) {
            $stock = $this->stock - $item->qty;

            if ($stock < $this->qty) {
                $this->dispatch('swal',[
                    'icon' => 'error',
                    'title' => 'No hay stock suficiente',
                    'text' => 'No se puede agregar la cantidad indicada'
                ]);

                return;
            }
        }

        Cart::add([
            'id' => $this->product->id,
            'name' => $this->product->name,
            'qty' => $this->qty,
            'price' => $this->variant->price,
            'options' => [
                'image' => $this->product->image,
                'sku' => $this->variant->sku,
                'stock' => $this->variant->stock,
                'status' => $this->product->status,
                'features' => Feature::whereIn('id', $this->selectedFeatures)->pluck('description','id')->toArray()
            ]
        ]);

        if (auth()->check()) {
            Cart::store(auth()->id());
        }

        $this->dispatch('cartUpdated', Cart::count());

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => '¡Bien Hecho!',
            'text' => 'El producto de ha añadido al carrito de compras'
        ]);
    }

    public function updatedSelectedFeatures(){
        $this->getVariant();
    }

    public function getVariant(){
        $this->variant = $this->product->variants->filter(function($variant){
            return !array_diff($variant->features->pluck('id')->toArray(),$this->selectedFeatures);
        })->first();

        $this->stock = $this->variant->stock;
        $this->price = $this->variant->price;
        $this->qty = 1;
    }

    public function render()
    {
        return view('livewire.products.add-to-cart');
    }
}
