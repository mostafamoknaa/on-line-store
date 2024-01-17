@extends('layouts.master')
@section('title')
    Carts     
@endsection
@section("content")
<div class="custom-product">
     <div class="col-sm-10">
        <div class="trending-wrapper">
            <h4>Result for Products</h4>
            <a class="btn btn-success" href="/orders">Order Now</a> <br> <br>
            @foreach($carts as $cart)
            <div class=" row searched-item cart-list-devider">
             <div class="col-sm-3">
                <a href="detail/{{$cart->id}}">
                    <img class="trending-image" src="{{asset('images/products/'.$cart->product->image)}}">
                  </a>
             </div>
             <div class="col-sm-4">
                    <div class="">
                      <h2>{{$cart->product->price}}</h2>
                      <h5>{{$cart->product->section->section_name}}</h5>
                    </div>
             </div>
             <div class="col-sm-3">
              <form action="{{route('carts.destroy',$cart->id)}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Remove from Cart</button>
              </form>
             </div>
            </div>
            @endforeach
            <br><br>
          
          </div>
          

     </div>
</div>
@endsection 