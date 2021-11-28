@extends('admin.layout')
@section('page_title','Manage Brand')
@section('brand_select','active')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Manage Brand</h2>
            <a href="{{url('admin/brand')}}" class="au-btn au-btn-icon au-btn--blue">
                <i class="fa fa-arrow-left"></i>back</a>
        </div>
    </div>
</div>
<div class="row mt-5">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.managebrand_process')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="control-label mb-1">Name</label>
                        <input id="name" name="name" type="text" class="form-control" value="{{$name}}" required>
                        @error('name')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image" class="control-label mb-1">Image</label>
                        <input id="image" name="image" type="file" class="form-control">
                        <input name="old_image" type="hidden" value="{{$image}}">
                        @error('image')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="is_home" id="is_home" {{$is_home}}>
                        <label class="form-check-label" for="is_home">Show Home Page</label>
                    </div>
                    <br>
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