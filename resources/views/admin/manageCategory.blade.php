@extends('admin.layout')
@section('page_title','Manage Category')
@section('category_select','active')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Manage Category</h2>
            <a href="{{url('admin/category')}}" class="au-btn au-btn-icon au-btn--blue">
                <i class="fa fa-arrow-left"></i>back</a>
        </div>
    </div>
</div>
<div class="row mt-5">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.managecategory_process')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="category" class="control-label mb-1">Category Name</label>
                                <input id="category" name="category" type="text" class="form-control" value="{{$category}}" required>
                                @error('category')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="parent_category_id" class="control-label mb-1">Parent Category</label>
                                <select id="parent_category_id" name="parent_category_id" type="text" class="form-control">
                                    <option value="0">Select Parent Categories</option>
                                    @foreach ($Parent_category as $item)
                                        @if ($parent_category_id==$item->id)
                                            <option selected value="{{$item->id}}">{{$item->category}}</option>    
                                        @else 
                                            <option value="{{$item->id}}">{{$item->category}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="category_slug" class="control-label mb-1">Category Slug</label>
                                <input id="category_slug" name="category_slug" type="text" class="form-control" value="{{$category_slug}}" required>
                                @error('category_slug')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category_image" class="control-label mb-1">Category Image</label>
                        <input id="category_image" name="category_image" type="file" class="form-control" >
                        <input name="old_image" type="hidden" value="{{$category_image}}" >
                        @error('category_image')
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