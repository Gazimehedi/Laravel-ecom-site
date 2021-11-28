@extends('admin.layout')
@section('page_title','Customer')
@section('customer_select','active')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Customers Informations</h2>
            <a href="{{url('admin/customer')}}" class="au-btn au-btn-icon au-btn--blue">
                <i class="fa fa-arrow-left"></i>back</a>
        </div>
    </div>
</div>
<div class="row m-t-30">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-12">
                  <h4 class="mb-0">Informations</h4>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Full Name</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{$info->name}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Email</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{$info->email}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Mobile</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{$info->mobile}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Address</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{$info->address}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">City</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{$info->city}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">State</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{$info->state}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Zip Code</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{$info->zip}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Company</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{$info->company}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">GST NO</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{$info->gstin}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Status</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    @if ($info->status==1)
                        Active
                    @else
                        Deactive
                    @endif
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Created On</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{\Carbon\Carbon::parse($info->created_at)->format('d-m-Y')}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Updated On</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{\Carbon\Carbon::parse($info->updated_at)->format('d-m-Y')}}
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection