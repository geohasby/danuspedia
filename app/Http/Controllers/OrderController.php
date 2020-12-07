<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_order(Request $request, $job)
    {
        $order = Order::where($job . '_id', $request->user()->id)->get();
        //IF ORDER NULL
        return view('belumtaumaukemana', compact('order'))
                    ->with('i');
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
        $request->validate([
            'quantity' => 'required|numeric|min:1',
            'time_taken' => 'required|after:now',
            'place_taken' => 'required|string'
        ]);
        
        $stock = Product::find($request->product_id)->stock;
        
        if($stock >= $request->quantity){
            $stock -= $request->quantity;
            Product::find($request->product_id)->update(['stock' => $stock]);
            Order::create($request->all());
            return redirect()->route('home')
                            ->with('success', 'Order created successfully');
        }
        else{
            return redirect()->route('home')
                            ->with('error', 'Sorry, out of stock');
        }
    }

    public function konfirmasi_penjual($id){
        Order::find($id)->update(['status' => 'menunggu dikirim']);
        return redirect()->route('seller.home')
                        ->with('success', 'Order telah dikonfirmasi');
    }

    public function cancel_by_seller($id){
        $order = Order::find($id);
        $product = Product::find($order->product_id);
        $order->update(['status' => 'dibatalkan oleh penjual']);
        $product->update(['stock' => $product->stock + $order->quantity]);
        return redirect()->route('seller.home')
                        ->with('error', 'Order telah dibatalkan');
    }

    public function order_diterima(Request $request){
        Order::find($request->id)->update(['status' => 'order sudah selesai']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::find($id)->delete();

        return redirect()->route('seller/home')
                        ->with('success', 'Order deleted successfully');
    }
}
