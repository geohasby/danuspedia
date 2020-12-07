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
        Order::find($id)->update(['status' => 'Pesanan selesai']);
        return redirect()->route('seller.home')
                        ->with('success', 'Pesanan telah diselesaikan');
    }

    public function cancel($id){
        $order = Order::find($id);
        $product = Product::find($order->product_id);
        $order->update(['status' => 'Pesanan dibatalkan']);
        $product->update(['stock' => $product->stock + $order->quantity]);
        return redirect()->route('seller.home')
                        ->with('error', 'Order telah dibatalkan');
    }
}
