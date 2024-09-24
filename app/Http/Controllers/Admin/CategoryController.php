<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id','desc')->paginate();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Category::create($request->all());

        return redirect()->route('admin.categories.index')->with('swal', [
            'icon' => 'success',
            'title' => '¡Bien Hecho!',
            'text' => 'Categoría creada correctamente.'

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $category->update($request->all());

        return redirect()->route('admin.categories.edit', $category)->with('swal', [
            'icon' => 'success',
            'title' => '¡Bien Hecho!',
            'text' => 'Categoría actualizada correctamente.'

        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        if($category->products->count() > 0){

            return redirect()->route('admin.categories.edit', $category)->with('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => 'No se puede eliminar la categoria porque tiene productos asociados.'
    
            ]);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('swal', [
            'icon' => 'success',
            'title' => 'Bien hecho!',
            'text' => 'Categoría eliminada correctamente.'

        ]);
    }
}
