@extends('admin.layout')
@section('page_title','Manage Tax')
@section('tax_select','active')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Manage Tax</h2>
            <a href="{{url('admin/tax')}}" class="au-btn au-btn-icon au-btn--blue">
                <i class="fa fa-arrow-left"></i>back</a>
        </div>
    </div>
</div>
<div class="row mt-5">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.managetax_process')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="tax_desc" class="control-label mb-1">Tax Desc</label>
                        <input id="tax_desc" name="tax_desc" type="text" class="form-control" value="{{$tax_desc}}" required>
                        @error('tax_desc')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tax_value" class="control-label mb-1">Tax Value</label>
                        <input id="tax_value" name="tax_value" type="text" class="form-control" value="{{$tax_value}}" required>
                        @error('tax_value')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
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