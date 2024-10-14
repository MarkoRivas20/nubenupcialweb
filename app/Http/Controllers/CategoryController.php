<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Option;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category){

        return view('categories.show', compact('category'));
    }
}
