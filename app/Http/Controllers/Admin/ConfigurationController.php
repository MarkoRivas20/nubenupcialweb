<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function edit(Configuration $configuration){
        
        return view('admin.configurations.edit', compact('configuration'));
    }
}
