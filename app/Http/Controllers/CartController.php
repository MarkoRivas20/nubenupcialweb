<?php

namespace App\Http\Controllers;

use App\Http\Middleware\VerifyStock;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class CartController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            VerifyStock::class,
        ];
    }
    public function index(){

        return view('cart.index');
    }
}
