<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductEdit extends Component
{
    use WithFileUploads;

    public $product;
    public $productEdit = [];
    public $categories;
    public $image;

    public function mount($product){

        $this->productEdit = $product->only('sku','name','description', 'image_path','price','stock','status', 'category_id');
    
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

    #[On('variant-generated')]
    public function updateProduct(){
        $this->product = $this->product->fresh();
    }

    public function store(){
        $this->validate([
            'image' => 'nullable|image|max:1024',
            'productEdit.sku' => 'required|unique:products,sku,'.$this->product->id,
            'productEdit.name' => 'required|max:255',
            'productEdit.description' => 'required',
            'productEdit.price' => 'required|numeric|min:0',
            'productEdit.category_id' => 'required|exists:categories,id',
            'productEdit.status' => 'required|boolean'
        ]);

        if ($this->image) {

            Storage::delete($this->productEdit['image_path']);
            $this->productEdit['image_path'] = $this->image->store('products');
        }


        $this->product->update($this->productEdit);

        return redirect()->route('admin.products.edit', $this->product)->with('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Producto actualizado correctamente.'

        ]);

    }

    public function render()
    {
        return view('livewire.admin.products.product-edit');
    }
}
