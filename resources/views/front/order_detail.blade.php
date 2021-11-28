@extends('front.layout')
@section('page_title','Order Details Page')
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
      <div class="row"><br><br>
          <div class="col-md-5">
            <h3>Shipping Address</h3>
              <table class="table">
                  <tr>
                      <th width="40%">Name</th>
                      <td>:</td>
                      <td>{{$order_details[0]->name}}</td>
                  </tr>
                  <tr>
                      <th>Email</th>
                      <td>:</td>
                      <td>{{$order_details[0]->email}}</td>
                  </tr>
                  <tr>
                      <th>Phone</th>
                      <td>:</td>
                      <td>{{$order_details[0]->mobile}}</td>
                  </tr>
                  <tr>
                      <th>Address</th>
                      <td>:</td>
                      <td>{{$order_details[0]->address}}</td>
                  </tr>
                  <tr>
                      <th>City</th>
                      <td>:</td>
                      <td>{{$order_details[0]->city}}</td>
                  </tr>
                  <tr>
                      <th>State</th>
                      <td>:</td>
                      <td>{{$order_details[0]->state}}</td>
                  </tr>
                  <tr>
                      <th>Zip</th>
                      <td>:</td>
                      <td>{{$order_details[0]->zip}}</td>
                  </tr>
              </table>
          </div>
          <div class="col-md-2">&nbsp;</div>
          <div class="col-md-5">
            <h3>Payment Details</h3>
            <table class="table">
              <tr>
                  <th width="40%">Order Status</th>
                  <td>:</td>
                  <td>{{$order_details[0]->orders_status}}</td>
              </tr>
              <tr>
                  <th>Payment Status</th>
                  <td>:</td>
                  <td>{{$order_details[0]->payment_status}}</td>
              </tr>
              <tr>
                  <th>Payment Type</th>
                  <td>:</td>
                  <td>{{$order_details[0]->payment_type}}</td>
              </tr>
              @if($order_details[0]->payment_id !=null)
              <tr>
                  <th>Payment ID</th>
                  <td>:</td>
                  <td>{{$order_details[0]->payment_id}}</td>
              </tr>
              <tr>
                  <th>Txn ID</th>
                  <td>:</td>
                  <td>{{$order_details[0]->payer_id}}</td>
              </tr>
              @endif
            </table>
            <b>Track Details</b>
            <p>{{$order_details[0]->track_details}}</p>
        </div>
        <div class="col-md-12">
          <div class="cart-view-area">
            <div class="cart-view-table">
              <form action="">
                <div class="table-responsive">
                   <table class="table">
                     <thead>
                       <tr>
                         <th>Products</th>
                         <th>Image</th>
                         <th>Color</th>
                         <th>Size</th>
                         <th>Price</th>
                         <th>Qty</th>
                         <th>Total</th>
                       </tr>
                     </thead>
                     <tbody>
                        @php
                            $totalAmt = 0;
                        @endphp
                       @foreach ($order_details as $data)
                       @php
                           $totalAmt = $totalAmt+($data->price*$data->qty);
                       @endphp
                        <tr>
                            <td>{{$data->pname}}</td>
                            <td><img width="80" src="{{asset('storage/media/'.$data->attr_image)}}" alt="img"></td>
                            <td>{{$data->color}}</td>
                            <td>{{$data->size}}</td>
                            <td>${{$data->price}}</td>
                            <td>{{$data->qty}}</td>
                            <td>${{$data->price*$data->qty}}</td>
                        </tr>
                       @endforeach
                       <tr>
                           <td colspan="6" style="text-align:right">Total  </td>
                           <td > ${{$totalAmt}}</td>
                       </tr>
                       @if ($order_details[0]->coupon_value > 0)
                       <tr>
                           <td colspan="6" style="text-align:right">Coupon({{$order_details[0]->coupon_code}})  </td>
                           <td >
                                @if ($order_details[0]->coupon_value >50)
                                    - ${{$order_details[0]->coupon_value}}
                                @else
                                    (-) %{{$order_details[0]->coupon_value}}
                                @endif
                            </td>
                       </tr>
                       <tr>
                           <td colspan="6" style="text-align:right">Sub Total </td>
                           <td >
                                @if ($order_details[0]->coupon_value >50)
                                    ${{$totalAmt-$order_details[0]->coupon_value}}
                                @else
                                    %{{$totalAmt-$order_details[0]->coupon_value}}%
                                @endif
                            </td>
                       </tr>
                       @endif
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
