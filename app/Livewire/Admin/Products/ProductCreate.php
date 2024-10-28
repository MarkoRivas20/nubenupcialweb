<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Configuration;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductCreate extends Component
{
    use WithFileUploads;

    public $categories;
    public $image;

    public $product = [
        'sku' => '',
        'name' => '',
        'description' => '',
        'image_path' => '',
        'price' => '',
        'category_id' => ''
    ];

    public function mount(){
        $this->categories = Category::all();
    }

    public function boot(){
        $this->withValidator(function ($validator){
            if($validator->fails()){
                $this->dispatch('swal', [
                    'icon' => 'error',
                    'title' => '¡Error!',
                    'text' => 'El formulario contiene errores.'
                ]);
            }
        });
    }

    public function store(){
        $this->validate([
            'image' => 'required|image|max:1024',
            'product.sku' => 'required|unique:products,sku',
            'product.name' => 'required|max:255',
            'product.description' => 'required',
            'product.price' => 'required|numeric|min:0',
            'product.category_id' => 'required|exists:categories,id'
        ]);

        $this->product['image_path'] = $this->image->store('products');

        $product = Product::create($this->product);

        return redirect()->route('admin.products.edit', $product)->with('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Producto creado correctamente.'

        ]);

    }

    public function render()
    {
        return view('livewire.admin.products.product-create');
    }
}
