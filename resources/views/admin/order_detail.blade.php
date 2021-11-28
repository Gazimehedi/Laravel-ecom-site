@extends('admin.layout')
@section('page_title','Order Detail Page')
@section('order_select','active')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h3>Update Order Status Oparation</h3>
        <br>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label for="order_status"><b>Update Order Status</b></label>
                    <select onchange="up_order_status({{$order_details[0]->id}})" id="order_status" class="form-control">
                        @foreach($order_status as $status)
                        @if ($status->orders_status == $order_details[0]->orders_status)
                            <option value="{{$status->id}}" selected>{{$status->orders_status}}</option>
                        @else
                            <option value="{{$status->id}}">{{$status->orders_status}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="order_status"><b>Update Payment Status</b></label>
                    <select onchange="up_payment_status({{$order_details[0]->id}})" id="payment_status" class="form-control">
                        @foreach($payment_status as $status)
                        @if ($status == $order_details[0]->payment_status)
                            <option value="{{$status}}" selected>{{$status}}</option>
                        @else
                            <option value="{{$status}}">{{$status}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <form method="POST">@csrf
        <div class="form-group">
            <label for="track_details"><b>Track Details</b></label>
            <textarea name="track_details" cols="30" rows="3" class="form-control" required>{{$order_details[0]->track_details}}</textarea>
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-success">Update</button>
        </div>
        </form>
        <br>
    </div>
</div>
<div class="row m-t-10 p-t-30 bg-white">
    <div class="col-md-5">
        <h3 class="p-b-20">Shipping Address</h3>
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
      <div class="col-md-1">&nbsp;</div>
      <div class="col-md-6">
        <h3 class="p-b-20">Payment Details</h3>
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
    </div>
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
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
        <!-- END DATA TABLE-->
    </div>
</div>
@endsection
