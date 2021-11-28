@extends('admin.layout')
@section('page_title','Manage Coupon')
@section('coupon_select','active')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Manage Coupon</h2>
            <a href="{{url('admin/coupon')}}" class="au-btn au-btn-icon au-btn--blue">
                <i class="fa fa-arrow-left"></i>back</a>
        </div>
    </div>
</div>
<div class="row mt-5">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.managecoupon_process')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="title" class="control-label mb-1">Title</label>
                                <input id="title" name="title" type="text" class="form-control" value="{{$title}}" required>
                                @error('title')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="code" class="control-label mb-1">Code</label>
                                <input id="code" name="code" type="text" class="form-control" value="{{$code}}" required>
                                @error('code')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="value" class="control-label mb-1">Value</label>
                                <input id="value" name="value" type="number" class="form-control" value="{{$value}}" required>
                                @error('value')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="value" class="control-label mb-1">Type</label>
                                <select name="type" id="type" class="form-control">
                                    @if($type=="per")
                                        <option value="Per" selected>Per</option>
                                        <option value="Value">Value</option>
                                    @else 
                                        <option value="Per">Per</option>
                                        <option value="Value" selected>Value</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="min_order_amt" class="control-label mb-1">Min Order Amt</label>
                                <input id="min_order_amt" name="min_order_amt" type="number" class="form-control" value="{{$min_order_amt}}"d>
                            </div>
                            <div class="col-md-6">
                                <label for="is_one_time" class="control-label mb-1">IS One Time</label>
                                <select name="is_one_time" id="is_one_time" class="form-control">
                                    @if($is_one_time==1)
                                        <option value="0" >NO</option>
                                        <option value="1" selected>Yes</option>
                                    @else 
                                    <option value="0" selected>NO</option>
                                    <option value="1" >Yes</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{$id}}" />
                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection