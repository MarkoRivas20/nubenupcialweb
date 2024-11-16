<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class CouponController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'can:manage coupons',
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::orderBy('created_at','desc')->paginate();
        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code'=> 'required|unique:coupons|string|max:255',
            'type'=> 'required|numeric|in:1,2',
            'value'=> 'required|numeric',
            'stock'=> 'required|numeric|min:0',
            'start_at'=> 'required|date',
            'end_at'=> 'nullable|date|after_or_equal:start_at',
            'status' => 'required|boolean'
        ]);

        $coupon = Coupon::create($request->all());

        return redirect()->route('admin.coupons.edit', $coupon)->with('swal', [
            'icon' => 'success',
            'title' => 'Bien hecho!',
            'text' => 'Cupón creado correctamente.'

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'code'=> 'required|string|max:255|unique:coupons,code,'.$coupon->id,
            'type'=> 'required|numeric|in:1,2',
            'value'=> 'required|numeric',
            'stock'=> 'required|numeric|min:0',
            'start_at'=> 'required|date',
            'end_at'=> 'nullable|date|after_or_equal:start_at',
            'status' => 'required|boolean'
        ]);

        $coupon->update($request->all());

        return redirect()->route('admin.coupons.edit', $coupon)->with('swal', [
            'icon' => 'success',
            'title' => 'Cupón actualizado!',
            'text' => 'Cupón actualizado correctamente.'

        ]);
    }

}
