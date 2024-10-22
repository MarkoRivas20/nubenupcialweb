<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product){
        
        if ($product->status) {
            return view('products.show', compact('product'));
        }else{
            return redirect()->route('notfound');
        }

    }
}
