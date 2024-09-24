<?php

namespace App\Http\Controllers;

use App\Models\Cover;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(){

        $covers = Cover::where('status', true)
        ->whereDate('start_at', '<=', now())
        ->where(function($query){
            $query->whereDate('end_at', '>=', now())
                ->orWhereNull('end_at');
        })
        ->get();

        return view('store', compact('covers'));
    }
}
