@extends('front.layout')
@section('page_title','About Page')
@section('container')
 <!-- catg header banner section -->
 <section id="aa-catg-head-banner">
    <img src="{{asset('front_assets/img/fashion/fashion-header-bg-8.jpg')}}" alt="fashion img">
    <div class="aa-catg-head-banner-area">
      <div class="container">
       <div class="aa-catg-head-banner-content">
         <h2>About US</h2>
         <ol class="breadcrumb">
           <li><a href="{{url('/')}}">Home</a></li>
           <li class="active">About</li>
         </ol>
       </div>
      </div>
    </div>
   </section>
   <!-- / catg header banner section -->
 <!-- start contact section -->
  <section id="aa-contact">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-contact-area">
            <div class="aa-contact-top">
              <h2>Our Shop About</h2>
              <p style="font-size: 18px;line-height:1.5;margin-top:10px;font-weight:semi-bold">{{ $setting->description }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

   <!-- Subscribe section -->
@endsection
