<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Template;
use Illuminate\Http\Request;

class SectionController extends Controller
{
   
    /**
     * Show the form for creating a new resource.
     */
    public function create(Template $template)
    {
        return view('admin.sections.create', compact('template'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Template $template)
    {
        $request->validate([
            'name' => 'required',
            'type_background' => 'required|in:1,2',
            'background' => 'required',
            'body' => 'required',
        ]);

        $section = $template->sections()->create($request->all());

        return redirect()->route('admin.sections.edit',[$template,$section])->with('swal', [
            'icon' => 'success',
            'title' => '¡Bien Hecho!',
            'text' => 'Sección creada correctamente.'

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Template $template, Section $section)
    {
        return view('admin.sections.edit', compact('template','section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Template $template, Section $section)
    {
        $request->validate([
            'name' => 'required',
            'type_background' => 'required|in:1,2',
            'background' => 'required',
            'body' => 'required',
        ]);

        $section->update($request->all());

        return redirect()->route('admin.sections.edit',[$template,$section])->with('swal', [
            'icon' => 'success',
            'title' => '¡Bien Hecho!',
            'text' => 'Sección actualizada correctamente.'

        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Template $template, Section $section)
    {
        $section->delete();

        return redirect()->route('admin.templates.edit',$template)->with('swal', [
            'icon' => 'success',
            'title' => '¡Bien Hecho!',
            'text' => 'Sección eliminada correctamente.'

        ]);
    }
}
