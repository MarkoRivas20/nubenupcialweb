<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class ConfigurationController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'can:manage configurations',
        ];
    }
    public function edit(Configuration $configuration){
        
        return view('admin.configurations.edit', compact('configuration'));
    }
}
