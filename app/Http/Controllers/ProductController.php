<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product = Product::where('stock', '>', 0)->get();
        $seller = User::all();
        //IF PRODUCT / SELLER NULL
        return view('home', compact('product', 'seller'), ['user' => $request->user()])
                    ->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('product.create', ['user' => $request->user()]);
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
            'name' => 'required|string|max:255',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'max:255',
            'category' => 'required|string',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
            'seller_id' => 'required'
        ]);

        $image = $request->file('img');
        $imageName = $request->name . '-' . $request->user()->name . '.' . $image->extension();
        $imageName = str_replace(' ', '_', $imageName);

        $destinationPath = public_path('img/product');
        $img = Image::make($image->path());
        $img->orientate();
        $img->resize(600, 600, function($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($destinationPath . '/' . $imageName);

        $request->merge(['image' => $imageName]);
        
        Product::create($request->all());

        return redirect()->route('home')
                        ->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $product = Product::find($id);
        return view('product.show', compact('product'), ['user' => $request->user()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $product = Product::find($id);
        return view('product.edit', compact('product'), ['user' => $request->user()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'max:255',
            'category' => 'required|string',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
            'seller_id' => 'required'
        ]);

        $image = $request->file('img');
        $imageName = $request->name . ' - ' . $request->user()->name . '.' . $image->extension();
        $imageName = str_replace(' ', '_', $imageName);

        $destinationPath = public_path('img/product');
        $img = Image::make($image->path());
        $img->orientate();
        $img->resize(600, 600, function($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($destinationPath . '/' . $imageName);

        $request->merge(['image' => $imageName]);

        Product::find($id)->update($request->all());

        return redirect()->route('home')
                        ->with('success', 'Product updated successfully');
    }


    // SEARCHING
    public function search(Request $request, $mode, $keyword=null)
    {
        if ($mode == 'search') {
            $seller = User::all();
            $keyword = $request->keyword;
            $product = Product::where('name', 'like', "%".$keyword."%")->get();
            if($product->first() == null){
                $product = null;
            }
        }
        elseif ($mode == 'category') {
            $seller = User::all();
            $product = Product::where('category', $keyword)->get();
        }
        elseif ($mode == 'organisasi') {
            $seller = User::all();
            $seller_id = $seller->where('name', $keyword)->first();
            
            if(isset($seller_id)){
                $seller_id = $seller_id->id;
                $product = Product::where('seller_id', $seller_id)->get();
            }
            else{
                $product = null;
            }
        }
        else {
            return abort('404');
        }

        //IF PRODUCT NULL
        return view('home', compact('product', 'seller', 'mode', 'keyword'))
                    ->with('i');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();

        return redirect()->route('home')
                        ->with('success', 'Product deleted successfully');
    }
}
