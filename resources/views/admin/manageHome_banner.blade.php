@extends('admin.layout')
@section('page_title','Manage Banner')
@section('home_banner_select','active')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Manage Banner</h2>
            <a href="{{url('admin/home_banner')}}" class="au-btn au-btn-icon au-btn--blue">
                <i class="fa fa-arrow-left"></i>back</a>
        </div>
    </div>
</div>
<div class="row mt-5">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.managehome_banner_process')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title" class="control-label mb-1">Title</label>
                        <input id="title" name="title" type="text" class="form-control" value="{{$title}}">
                    </div>
                    <div class="form-group">
                        <label for="sub_title" class="control-label mb-1">Sub Title</label>
                        <input id="sub_title" name="sub_title" type="text" class="form-control" value="{{$sub_title}}">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="btn_text" class="control-label mb-1">Button Text</label>
                                <input id="btn_text" name="btn_text" type="text" class="form-control" value="{{$btn_text}}">
                            </div>
                            <div class="col-md-6">
                                <label for="btn_link" class="control-label mb-1">Button Link</label>
                                <input id="btn_link" name="btn_link" type="text" class="form-control" value="{{$btn_link}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image" class="control-label mb-1">Image</label>
                        <input id="image" name="image" type="file" class="form-control" >
                        <input name="old_image" type="hidden" value="{{$image}}" >
                        @error('image')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
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