<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function index(){
        $resources = Resource::all();

        return view('admin.resources.index', compact('resources'));
    }
    
    public function edit(Resource $resource){

        return view('admin.resources.edit', compact('resource'));
    }
}
