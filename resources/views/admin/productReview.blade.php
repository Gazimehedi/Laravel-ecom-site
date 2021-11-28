@extends('admin.layout')
@section('page_title','Product Review')
@section('product_review_select','active')
@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{session('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="overview-wrap">
            <h2 class="title-1">Product Review</h2>
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
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Product Name</th>
                        <th>Rating</th>
                        <th>Review</th>
                        <th>Added On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $list)
                        <tr>
                            <td>{{$list->id}}</td>
                            <td>{{$list->name}}</td>
                            <td>{{$list->pname}}</td>
                            <td>{{$list->rating}} Star</td>
                            <td>{{$list->review}}</td>
                            <td>{{$list->created_at}}</td>
                            <td>
                                @if($list->status==1)
                                    <a class="btn btn-success btn-sm" href="{{url('admin/update_product_review_status/'.$list->id.'/0')}}">Active</a>
                                @elseif($list->status==0)
                                    <a class="btn btn-warning btn-sm" href="{{url('admin/update_product_review_status/'.$list->id.'/1')}}">Deactive</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="margin-top:8px;">
                {{$data->links()}}
            </div>
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>
@endsection
