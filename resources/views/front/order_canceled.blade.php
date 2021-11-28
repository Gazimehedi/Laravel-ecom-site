@extends('front.layout')
@section('page_title','Order Cancelled')
@section('container')
   {{-- <!-- catg header banner section -->
   <section id="aa-catg-head-banner">
    <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
    <div class="aa-catg-head-banner-area">
      <div class="container">
       <div class="aa-catg-head-banner-content">
         <h2>Fashion</h2>
         <ol class="breadcrumb">
           <li><a href="index.html">Home</a></li>         
           <li class="active">Women</li>
         </ol>
       </div>
      </div>
    </div>
   </section>
   <!-- / catg header banner section --> --}}
 
   <!-- Cart view section -->
 <section id="aa-myaccount">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
       <div class="aa-myaccount-area">         
           <div class="row text-center">
             <h2>Your order has been Cancelled</h2>
             <p><a class="btn btn-info" href="/">Continue Shopping...</a></p>
           </div>          
        </div>
      </div>
    </div>
  </div>
</section>
<!-- / Cart view section -->
@php
    session()->forget('ORDER_ID');
    session()->forget('totalprice');
@endphp
@endsection