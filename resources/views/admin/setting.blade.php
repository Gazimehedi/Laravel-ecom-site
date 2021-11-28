@extends('admin.layout')
@section('page_title','Setting')
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
        <div class="overview-wrap">
            <h2 class="title-1">Setting</h2>
        </div>
    </div>
</div>
<div class="row mt-5">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.setting.update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="site_name" class="control-label mb-1">Site Name</label>
                                <input id="site_name" name="site_name" type="text" class="form-control" value="{{$setting->site_name}}" required>
                                @error('site_name')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="email" class="control-label mb-1">Email</label>
                                <input id="email" name="email" type="email" class="form-control" value="{{$setting->email}}" >
                                @error('email')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="mobile" class="control-label mb-1">Mobile</label>
                                <input id="mobile" name="mobile" type="text" class="form-control" value="{{$setting->mobile}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            @if (isset($setting->site_logo))
                            <div class="col-md-2">
                                <img width="200px" src="{{asset('storage/media/setting/'.$setting->site_logo)}}" alt="">
                            </div>
                            @endif
                            <div class="@if (isset($setting->site_logo)) col-md-4 @else col-md-6 @endif">
                                <label for="site_logo" class="control-label mb-1">Site Logo</label>
                                <input id="site_logo" name="site_logo" type="file" class="form-control">
                                @error('site_logo')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="footer_info" class="control-label mb-1">Footer Info</label>
                                <input id="footer_info" name="footer_info" type="text" class="form-control" value="{{$setting->footer_info}}">
                                @error('footer_info')
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
                                <label for="fb_url" class="control-label mb-1">Facebook Url</label>
                                <input id="fb_url" name="fb_url" type="text" class="form-control" value="{{$setting->fb_url}}">
                            </div>
                            <div class="col-md-6">
                                <label for="tw_url" class="control-label mb-1">Twitter Url</label>
                                <input id="tw_url" name="tw_url" type="text" class="form-control" value="{{$setting->tw_url}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="ig_url" class="control-label mb-1">Instagram Url</label>
                                <input id="ig_url" name="ig_url" type="text" class="form-control" value="{{$setting->ig_url}}">
                            </div>
                            <div class="col-md-6">
                                <label for="yt_url" class="control-label mb-1">Youtube Url</label>
                                <input id="yt_url" name="yt_url" type="text" class="form-control" value="{{$setting->yt_url}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="address" class="control-label mb-1">Address</label>
                                <textarea id="address" name="address" class="form-control" rows="4" >{{$setting->address}}</textarea>
                                @error('address')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="description" class="control-label mb-1">Site Description</label>
                                <textarea id="description" name="description" class="form-control" rows="4" >{{$setting->description}}</textarea>
                                @error('description')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
