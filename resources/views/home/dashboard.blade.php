
 @extends('layouts.master')
 @section('title')
    Home     
 @endsection
 
 @section("content")
 
 <div class="custom-product">

       <div class="trending-wrapper">
         <h3>All sections</h3>
            @foreach ($cats as $cat)
                
          
         <div class="trening-item">
           <a href="{{route('sections.show',$cat->id)}}">
           <img class="" src="{{asset($cat->image)}}" width="200" height="200">
           <div class="">
             <h3>{{$cat->section_name}}</h3>
             
           </div>
         </a>
         </div>
         @endforeach
       </div>
       </div>
 </div>
 @endsection

