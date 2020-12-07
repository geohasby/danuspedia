<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
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

    public function history(Request $request)
    {
        $user = User::all();
        $product = Product::all();

        if($request->user()->seller == '0')
            $order = Order::where('customer_id', $request->user()->id)->get();
        else $order = DB::table('products')
                        ->join('orders', 'products.id', '=', 'orders.product_id')
                        ->where('products.seller_id', $request->user()->id)
                        ->where('status', '!=', 'Pesanan sedang diproses')
                        ->get();

        if($order->first() == null)
            $order = null;

        return view('history', compact('user', 'product', 'order'), ['this_user' => $request->user()]);
    }
}
