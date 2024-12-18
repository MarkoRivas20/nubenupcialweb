<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Invitation;
use App\Models\InvitationSection;
use App\Models\Section;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InvitationController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'can:manage invitations',
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
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
        
        return view ('admin.invitations.show', compact('invitation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invitation $invitation)
    {
        return view ('admin.invitations.edit', compact('invitation'));
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

    public function imageIndex(Invitation $invitation, InvitationSection $section){

        return view('admin.invitations.images.index', compact('section','invitation'));
    }

}
