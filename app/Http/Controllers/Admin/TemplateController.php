<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $templates = Template::orderBy('created_at','desc')->paginate(10);
        return view('admin.templates.index', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.templates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Template::create($request->all());

        return redirect()->route('admin.templates.index')->with('swal', [
            'icon' => 'success',
            'title' => '¡Bien Hecho!',
            'text' => 'Plantilla creada correctamente.'

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Template $template)
    {
        return view('admin.templates.edit', compact('template'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Template $template)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required|boolean'
        ]);

        $template->update($request->all());

        return redirect()->route('admin.templates.edit', $template)->with('swal', [
            'icon' => 'success',
            'title' => '¡Bien Hecho!',
            'text' => 'Plantilla actualizada correctamente.'

        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Template $template)
    {
        //
    }

    public function disabled(Request $request, Template $template)
    {
        $data = $request->all();
        $data['status'] = false;
        
        $template->update($data);

        return redirect()->route('admin.templates.index')->with('swal', [
            'icon' => 'success',
            'title' => 'Bien hecho!',
            'text' => 'Plantilla eliminado correctamente.'

        ]);
    }
}
