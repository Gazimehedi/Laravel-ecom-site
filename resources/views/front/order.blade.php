@extends('front.layout')
@section('page_title','Order Page')
@section('container')

  <!-- catg header banner section -->
  {{-- <section id="aa-catg-head-banner">
    <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
    <div class="aa-catg-head-banner-area">
      <div class="container">
       <div class="aa-catg-head-banner-content">
         <h2>Cart Page</h2>
         <ol class="breadcrumb">
           <li><a href="index.html">Home</a></li>
           <li class="active">Cart</li>
         </ol>
       </div>
      </div>
    </div>
   </section> --}}
   <!-- / catg header banner section -->

  <!-- Cart view section -->
  <section id="cart-view">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="cart-view-area">
            <div class="cart-view-table">
              <form action="">
                <div class="table-responsive">
                   <table class="table">
                     <thead>
                       <tr>
                         <th>View</th>
                         <th>Order ID</th>
                         <th>Order Status</th>
                         <th>Payment Status</th>
                         <th>Total Amt</th>
                         <th>Payment ID</th>
                         <th>Pleced At</th>
                       </tr>
                     </thead>
                     <tbody>
                       @foreach ($orders as $data)
                        <tr>
                            <td><a style="float:none;display:inline-block;" class="aa-cart-view-btn" href="{{url('/order_detail',$data->id)}}">View</a></td>
                            <td>{{$data->id}}</td>
                            <td>{{$data->orders_status}}</td>
                            <td>{{$data->payment_status}}</td>
                            <td>{{$data->total_amt}}</td>
                            <td>{{$data->payment_id}}</td>
                            <td>{{$data->added_on}}</td>
                        </tr>
                       @endforeach
                       </tbody>
                   </table>
                 </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Cart view section -->
@endsection
