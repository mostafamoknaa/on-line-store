
@extends('layouts.master')
@section('title')
   product details     
@endsection
@section("content")
<div class="container">
   <div class="row">
    @foreach ($products as $product)
        

       <div class="col-sm-6">
       <img class="detail-img" src="{{asset('images/products/'.$product->image)}}" alt="">
       </div>
       <div class="col-sm-6">
           
       <h2>{{$product->product_name}}</h2>
       <h3>Price : {{$product->price}}</h3>
       <h4>category: {{$product->section->section_name}}</h4>
       <br><br>
       <form action="{{route('carts.store')}}" method="POST">
           @csrf
           <input type="hidden" name="product_id" value={{$product['id']}}>
       <button class="btn btn-primary">Add to Cart</button>
       </form>
       <br><br>
    </div>
    @endforeach
   </div>
</div>
@endsection