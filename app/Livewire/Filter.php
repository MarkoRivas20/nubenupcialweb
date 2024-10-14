<?php

namespace App\Livewire;

use App\Models\Option;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Filter extends Component
{
    use WithPagination;

    public $category_id;

    public $options;

    public $selected_features = [];

    public $orderBy = 1;

    public $search;

    public function mount(){

        $this->options = Option::whereHas('products', function($query){

            $query->where('category_id', $this->category_id);

        })->with([
            'features' => function($query){
                $query->whereHas('variants.product', function($query) {

                    $query->where('category_id', $this->category_id);
        
                });
            }
        ])->get()->toArray();
    }

    #[On('search')]
    public function search($search){

        $this->search = $search;
    }

    public function render()
    {
        $products = Product::where('category_id', $this->category_id)
        ->customOrder($this->orderBy)
        ->when($this->selected_features, function($query){
            $query->whereHas('variants.features', function($query){
                $query->whereIn('features.id', $this->selected_features);
            });
        })
        ->when($this->search, function($query){
            $query->where('name','like','%'.$this->search.'%');
        })
        ->paginate(12);
        return view('livewire.filter', compact('products'));
    }
}
