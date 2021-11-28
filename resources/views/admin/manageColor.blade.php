@extends('admin.layout')
@section('page_title','Manage Color')
@section('color_select','active')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Manage Color</h2>
            <a href="{{url('admin/color')}}" class="au-btn au-btn-icon au-btn--blue">
                <i class="fa fa-arrow-left"></i>back</a>
        </div>
    </div>
</div>
<div class="row mt-5">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.managecolor_process')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="color" class="control-label mb-1">Size</label>
                        <input id="color" name="color" type="text" class="form-control" value="{{$color}}" required>
                        @error('color')
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