
@extends('layouts.master')
@section('title')
   product     
@endsection

@section("content")
<div class="custom-product">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      </div>
      <div class="trending-wrapper">
        <h3>All Product</h3>
           @foreach ($products as $product)
               
         
        <div class="trening-item">
          <a href="{{route('products.show',$product->id)}}">
          <img class="slider-img" src="{{asset('images/products/'.$product->image)}}" width="200" height="200">
          <div class="">
            <h3>price : {{$product->price}}</h3>
            <h3>Section : {{$product->section->section_name}}</h3>
          </div>
        </a>
        </div>
        @endforeach
      </div>
      </div>
</div>
@endsection

