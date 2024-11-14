<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Platform;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $platforms = Platform::orderBy('created_at','desc')->paginate();

        return view('admin.platforms.index', compact('platforms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.platforms.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Platform $platform)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Platform $platform)
    {
        return view('admin.platforms.edit', compact('platform'));
    }

}
