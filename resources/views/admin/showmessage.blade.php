@extends('admin.layout')
@section('page_title','Message Details')
@section('message_select','active')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Message Details</h2>
        </div>
    </div>
</div>
<div class="row m-t-30">
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-bordered card">
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td>{{$message->name}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{$message->email}}</td>
                    </tr>
                    <tr>
                        <td>Subject</td>
                        <td>{{$message->subject}}</td>
                    </tr>
                    <tr>
                        <td>Message</td>
                        <td>{{$message->message}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>
@endsection
