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
    public function index()
    {
        $product = Product::all();
        $seller = User::all();
        return view('home', compact('product', 'seller'))
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

        return redirect()->route('product.index')
                        ->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('product.show', compact('product'));
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

        return redirect()->route('product.index')
                        ->with('success', 'Product updated successfully');
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

        return redirect()->route('product.index')
                        ->with('success', 'Product deleted successfully');
    }
}
