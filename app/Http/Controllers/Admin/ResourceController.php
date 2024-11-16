<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class ResourceController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'can:manage resources',
        ];
    }
    public function index(){
        $resources = Resource::all();

        return view('admin.resources.index', compact('resources'));
    }
    
    public function edit(Resource $resource){

        return view('admin.resources.edit', compact('resource'));
    }
}
