<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Invitation;
use App\Models\Section;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*$contenido = Section::find(1);
        $body = $contenido->body;
        $attributes = Attribute::where('section_id','1')->get();

        foreach ($attributes as $attribute) {
            $body = str_replace($attribute->key,$attribute->value,$body);
        }*/
        //return view('admin.invitations.index', compact('body','attributes'));
        
        return view('admin.invitations.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Template $template)
    {
        return view ('admin.invitations.create', compact('template'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Invitation $invitation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invitation $invitation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invitation $invitation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invitation $invitation)
    {
        //
    }
}
