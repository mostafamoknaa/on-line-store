@extends('layouts.master')
@section("content")
<div class="custom-product">
     <div class="col-sm-10">
        <table class="table">
         
            <tbody>
              <tr>
                <td>Amount</td>
                <td>$ {{$total}}</td>
              </tr>
              <tr>
                <td>Tax</td>
                <td>$ 0</td>
              </tr>
              <tr>
                <td>Delivery </td>
                <td>$ 10</td>
              </tr>
              <tr>
                <td>Delivery Amount</td>
              <td>$ {{$total+10}}</td>
              </tr>
              <tr>
                <td>Visa Amount</td>
              <td>$ {{$total+5}}</td>
              </tr>
            </tbody>
          </table>
          <div>
            <form action="{{route('orders.store')}}" method="POST" >
              @csrf
                <div class="form-group">
                  <textarea name="address" placeholder="enter your address" class="form-control" ></textarea>
                </div>
                <div class="form-group">
                  <label for="pwd">Payment Method</label> <br> <br>
                  <button class="btn btn-success" type="submit" value="cash">Pay on Delivery {{$total+10}} EUR </button>
                  <a class="btn btn-success" href="/checkout">Pay By Visa {{$total+5}} EUR </a>
                </div>

              </form>
          </div>
     </div>
</div>
@endsection 