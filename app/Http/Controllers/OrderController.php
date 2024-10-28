<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){

        $orders = Order::where('user_id', auth()->id())->orderBy('created_at', 'desc')->paginate();
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order){
        return view('orders.show', compact('order'));
    }
}
