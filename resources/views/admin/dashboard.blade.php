@extends('admin.layout')
@section('page_title','Dashboard')
@section('dashboard_select','active')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Dashboard</h2>
        </div>
    </div>
</div>
<div class="row m-t-25">
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c1">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="zmdi zmdi-account-o"></i>
                    </div>
                    <div class="text">
                        <h2>{{$customers}}</h2>
                        <span>Customers</span>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c2">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                    <div class="text">
                        <h2>{{$order}}</h2>
                        <span>Orders</span>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c3">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="fab fa-product-hunt"></i>
                    </div>
                    <div class="text">
                        <h2>{{$products}}</h2>
                        <span>Products</span>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c4">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="zmdi zmdi-star"></i>
                    </div>
                    <div class="text">
                        <h2>{{$reviews}}</h2>
                        <span>total Reviews</span>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Resent Orders</h2>
        </div>
    </div>
</div>
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
