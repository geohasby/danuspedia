@extends('template')
 
@section('content')
    <div class="row mt-5 mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2> Show Product</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-secondary" href="{{ route('product.index') }}"> Back</a>
            </div>
        </div>
    </div>
 
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name : </strong>
                {{ $product->name }}
            </div>
        </div>
        <div class="col-md-4">
            <img src="{{ asset('img/product/' . $product->image) }}" />
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description : </strong>
                {{ $product->description }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Category : </strong>
                {{ $product->category }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Price : </strong>
                {{ $product->price }}
            </div>
        </div><div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Stock : </strong>
                {{ $product->stock }}
            </div>
        </div>
        <form method="POST" action="{{ route('order.store') }}">
            @csrf
            <input type="hidden" name="product_id" value="{{$product->id}}">
            <input type="hidden" name="customer_id" value="{{$user->id}}">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jumlah order : </strong>
                    <input type="number" name="quantity" class="form-control" placeholder="Jumlah order">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Waktu ketemuan : </strong>
                    <input type="datetime-local" name="time_taken" class="form-control" placeholder="Waktu ketemuan">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tempat ketemuan : </strong>
                    <input type="text" name="place_taken" class="form-control" placeholder="Tempat ketemuan">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Order!</button>
            </div>
        </form>
    </div>
@endsection