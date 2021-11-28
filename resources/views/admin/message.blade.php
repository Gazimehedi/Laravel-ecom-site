@extends('admin.layout')
@section('page_title','Message')
@section('message_select','active')
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
            <h2 class="title-1">Message</h2>
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
                        <th>Name</th>
                        <th>Subject</th>
                        <th width="30%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($message as $list)
                        <tr>
                            <td>{{$list->id}}</td>
                            <td>{{$list->name}}</td>
                            <td>{{$list->subject}}</td>
                            <td>
                                 <a class="btn btn-info btn-sm" href="{{url('admin/message/view/'.$list->id)}}">View</a> |
                                 <a class="btn btn-danger btn-sm" href="{{url('admin/message/delete')}}/{{$list->id}}">Delete</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{$message->links()}}
    </div>
</div>
@endsection
