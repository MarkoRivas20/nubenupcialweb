<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class OptionController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'can:manage options',
        ];
    }
    public function index(){
        return view('admin.options.index');
    }
}
