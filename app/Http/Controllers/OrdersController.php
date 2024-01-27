<?php

namespace App\Http\Controllers;

use App\Models\orders;
use App\Models\carts;
use App\Models\User;
use App\Notifications\OnDeleivryNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $us=Auth::id();
        $carts=carts::get()->where('user_id',$us);
        $total=
        carts::join('products','carts.product_id','=','products.id')
        ->where('carts.user_id',$us)
        ->sum('products.price');
        
        return view('products.order',compact('total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $us=Auth::id();
        $carts=carts::get()->where('user_id',$us);
        $total=carts::join('products','carts.product_id','=','products.id')
        ->where('carts.user_id',$us)
        ->sum('products.price');

        orders::create([
            'total'=>$total,
            'Address'=>$request->address,
        ]);
        Notification::send(Auth::user(),new OnDeleivryNotification());
        carts::where('user_id',$us)->delete();
        return redirect('/sections');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(orders $orders)
    {
        //
    }
}
