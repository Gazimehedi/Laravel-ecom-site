@extends('admin.layout')
@section('page_title','Color')
@section('color_select','active')
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
            <h2 class="title-1">Color</h2>
            <a href="{{url('admin/managecolor')}}" class="au-btn au-btn-icon au-btn--blue">
                <i class="zmdi zmdi-plus"></i>add item</a>
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
                        <th>Color</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $list)
                        <tr>
                            <td>{{$list->id}}</td>
                            <td>{{$list->color}}</td>
                            <td>
                                <a class="btn btn-info btn-sm" href="{{url('admin/managecolor')}}/{{$list->id}}">Edit</a> |
                                @if($list->status==1)
                                    <a class="btn btn-success btn-sm" href="{{url('admin/color/status/0')}}/{{$list->id}}">Active</a> |
                                @elseif($list->status==0)
                                    <a class="btn btn-warning btn-sm" href="{{url('admin/color/status/1')}}/{{$list->id}}">Deactive</a> |
                                @endif
                                 <a class="btn btn-danger btn-sm" href="{{url('admin/color/delete')}}/{{$list->id}}">Delete</a></td>
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
