@extends('admin.layout')
@section('page_title','Orders Page')
@section('order_select','active')
@section('content')
<div class="row m-t-30">
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                      <th>View</th>
                      <th>Order ID</th>
                      <th>Customer Details</th>
                      <th>Amt</th>
                      <th>Order Status</th>
                      <th>Payment Status</th>
                      <th>Payment Type</th>
                      <th>Order At</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($orders as $data)
                     <tr>
                         <td><a style="" class="btn btn-info" href="{{url('/admin/order_detail',$data->id)}}">View</a></td>
                         <td>{{$data->id}}</td>
                         <td>
                             {{$data->name}} <br>
                             {{$data->email}} <br>
                             {{$data->mobile}} <br>
                             {{$data->address}}, {{$data->city}}, {{$data->state}}, {{$data->zip}}
                        </td>
                         <td>${{$data->total_amt}}</td>
                         <td>{{$data->orders_status}}</td>
                         <td>{{$data->payment_status}}</td>
                         <td>{{$data->payment_type}}</td>
                         <td>{{$data->added_on}}</td>
                     </tr>
                    @endforeach
                    </tbody>
            </table>
            <div style="margin-top:8px;">
                {{$orders->links()}}
            </div>
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>
@endsection
