@extends('admin.layout')
@section('page_title','Manage Product')
@section('product_select','active')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Manage Product</h2>
            <a href="{{url('admin/product')}}" class="au-btn au-btn-icon au-btn--blue">
                <i class="fa fa-arrow-left"></i>back</a>
        </div>
    </div>
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <div class="col-md-12">
        @if(session('sku_error'))
            <div class="alert alert-danger">
                {{session('sku_error')}}
            </div>
        @endif
        @error('attr_image.*')
        <div class="alert alert-danger" role="alert">
            {{$message}}
        </div>
        @enderror
    </div>
</div>
<div class="row mt-5">
    <form action="{{route('admin.manage_process')}}" method="post" enctype="multipart/form-data">
        <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="control-label mb-1">Title</label>
                                <input type="hidden" name="id" value="{{$id}}" />
                                <input id="name" name="name" type="text" class="form-control" value="{{$name}}" required>
                                @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="slug" class="control-label mb-1">Slug</label>
                                        <input id="slug" name="slug" type="text" class="form-control" value="{{$slug}}" required>
                                        @error('slug')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="category" class="control-label mb-1">Category</label>
                                        <select id="category" name="category_id" type="text" class="form-control">
                                            <option value="0">Select Categories</option>
                                            @foreach ($category as $item)
                                                @if ($category_id==$item->id)
                                                    <option selected value="{{$item->id}}">{{$item->category}}</option>
                                                @else
                                                    <option value="{{$item->id}}">{{$item->category}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="barnd_id" class="control-label mb-1">Brand</label>
                                        <select id="barnd_id" name="brand_id" class="form-control">
                                            <option value="0">Select Brand</option>
                                            @foreach ($brand as $item)
                                                @if ($brand_id==$item->id)
                                                    <option selected value="{{$item->id}}">{{$item->name}}</option>
                                                @else
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="model" class="control-label mb-1">Model</label>
                                        <input id="model" name="model" type="text" class="form-control" value="{{$model}}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="image" class="control-label mb-1">Image</label>
                                        <input id="image" name="image" type="file" class="form-control">
                                        <input name="old_image" type="hidden" value="{{$image}}">
                                        @error('image')
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
                                        <label for="short_desc" class="control-label mb-1">Short Description</label>
                                        <textarea id="short_desc" name="short_desc" type="text" class="form-control" cols="30" rows="3">{{$short_desc}}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="keywords" class="control-label mb-1">Keywords</label>
                                        <textarea id="keywords" name="keywords" type="text" class="form-control" cols="30" rows="3">{{$keywords}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="control-label mb-1">Description</label>
                                <textarea id="description" name="description" type="text" class="form-control" rows="10">{{$description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="tecnical_specification" class="control-label mb-1">Tecnical Specification</label>
                                <textarea id="tecnical_specification" name="tecnical_specification" type="text" class="form-control" cols="30" rows="3">{{$tecnical_specification}}</textarea>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="uses" class="control-label mb-1">Uses</label>
                                        <textarea id="uses" name="uses" type="text" class="form-control" cols="30" rows="3">{{$uses}}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="warranty" class="control-label mb-1">Warranty</label>
                                        <textarea id="warranty" name="warranty" type="text" class="form-control" cols="30" rows="3">{{$warranty}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="lead_time" class="control-label mb-1">Lead Time</label>
                                        <input id="lead_time" name="lead_time" type="text" class="form-control" value="{{$lead_time}}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="tax_id" class="control-label mb-1">Tax</label>
                                        <select id="tax_id" name="tax_id" class="form-control">
                                            <option value="0">Select Tax</option>
                                            @foreach ($tax as $item)
                                                @if ($tax_id==$item->id)
                                                    <option selected value="{{$item->id}}">{{$item->tax_desc}}</option>
                                                @else
                                                    <option value="{{$item->id}}">{{$item->tax_desc}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="is_promo" class="control-label mb-1">IS Promo</label>
                                        <select name="is_promo" id="is_promo" class="form-control">
                                            @if($is_promo==1)
                                                <option value="1" selected>Yes</option>
                                                <option value="0" >No</option>
                                            @else
                                                <option value="1" >Yes</option>
                                                <option value="0" selected>No</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="is_featured" class="control-label mb-1">IS Featured</label>
                                        <select name="is_featured" id="is_featured" class="form-control">
                                            @if($is_featured==1)
                                                <option value="1" selected>Yes</option>
                                                <option value="0" >No</option>
                                            @else
                                                <option value="1" >Yes</option>
                                                <option value="0" selected>No</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="is_discounted" class="control-label mb-1">IS Discounted</label>
                                        <select name="is_discounted" id="is_discounted" class="form-control">
                                            @if($is_discounted==1)
                                                <option value="1" selected>Yes</option>
                                                <option value="0" >No</option>
                                            @else
                                                <option value="1" >Yes</option>
                                                <option value="0" selected>No</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="is_tranding" class="control-label mb-1">IS Tranding</label>
                                        <select name="is_tranding" id="is_tranding" class="form-control">
                                            @if($is_tranding==1)
                                                <option value="1" selected>Yes</option>
                                                <option value="0" >No</option>
                                            @else
                                                <option value="1" >Yes</option>
                                                <option value="0" selected>No</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
        </div>
        <h2 class="mb-3 ml-3">Product Images</h2>
        <div class="col-lg-12">
            @php
                $loop_num_count = 1;
            @endphp
            <div class="card" >
                <div class="card-body">
                    <div class="form-group">
                        <div class="row" id="product_images_box">
                            @foreach ($productImagesArr as $key=>$val)
                                @php
                                    $pIArr = (array)$val;
                                @endphp
                            <div class="col-md-6" id="product_images_{{$loop_num_count++}}">
                                <div class="row">
                                    @if($pIArr['image']!='')
                                    <div class="col-md-2">
                                        <br>
                                        <img width="80px" src="{{asset('storage/media/'.$pIArr['image'])}}">
                                    </div>
                                    @endif
                                    <div class="col-md-6">
                                        <label for="images" class="control-label mb-1">Images</label>
                                        <input name="piid[]" type="hidden" value="{{$pIArr['id']}}">
                                        <input id="images" name="images[]" type="file" class="form-control">
                                        <input name="old_images[]" type="hidden" value="{{$pIArr['image']}}" >
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label mb-1">&nbsp; &nbsp; &nbsp; &nbsp;</label>
                                        @if ($loop_num_count==2)
                                            <a href="javascript:void(0)" onclick="add_images_more()" class="btn btn-info btn-lg"><i class="fas fa-plus"></i> Add</a>
                                        @else
                                            <a href="{{url('admin/product/productimagesdelete/'.$id.'/'.$pIArr['id'])}}" class="btn btn-danger btn-lg"><i class="fas fa-minus"></i> Remove</a>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h2 class="mb-3 ml-3">Product Attributes</h2>
        <div class="col-lg-12" id="product_attr_box">
            @php
                $loop_num_count = 1;
            @endphp
            @foreach ($productAttrArr as $key=>$val)
            @php
                $pAArr = (array)$val;
            @endphp
            <div class="card" id="product_attr_{{$loop_num_count++}}">
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="sku" class="control-label mb-1">SKU</label>
                                <input id="sku" name="sku[]" type="text" class="form-control" value="{{$pAArr['sku']}}" required>
                                <input name="paid[]" type="hidden" value="{{$pAArr['id']}}">
                            </div>
                            <div class="col-md-2">
                                <label for="mrp" class="control-label mb-1">MRP</label>
                                <input id="mrp" name="mrp[]" type="number" class="form-control" value="{{$pAArr['mrp']}}" required>
                            </div>
                            <div class="col-md-2">
                                <label for="price" class="control-label mb-1">Price</label>
                                <input id="price" name="price[]" type="number" class="form-control" value="{{$pAArr['price']}}" required>
                            </div>
                            <div class="col-md-2">
                                <label for="qty" class="control-label mb-1">Quantity</label>
                                <input id="qty" name="qty[]" type="number" class="form-control" value="{{$pAArr['qty']}}" required>
                            </div>
                            <div class="col-md-2">
                                <label for="size_id" class="control-label mb-1">Size</label>
                                <select id="size_id" name="size_id[]" type="text" class="form-control">
                                    <option value="0">Select</option>
                                    @foreach ($size as $item)
                                            @if ($pAArr['size_id']==$item->id)
                                                <option selected value="{{$item->id}}">{{$item->size}}</option>
                                            @else
                                                <option value="{{$item->id}}">{{$item->size}}</option>
                                            @endif
                                        @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="color_id" class="control-label mb-1">Color</label>
                                <select id="color_id" name="color_id[]" type="text" class="form-control">
                                    <option value="0">Select</option>
                                    @foreach ($color as $item)
                                            @if ($pAArr['color_id']==$item->id)
                                                <option selected value="{{$item->id}}">{{$item->color}}</option>
                                            @else
                                                <option value="{{$item->id}}">{{$item->color}}</option>
                                            @endif
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            @if($pAArr['attr_image']!='')
                            <div class="col-md-2">
                                <br>
                                <img width="80px" src="{{asset('storage/media/'.$pAArr['attr_image'])}}">
                            </div>
                            @endif
                            <div class="col-md-4">
                                <label for="attr_image" class="control-label mb-1">Attribute Image</label>
                                <input id="attr_image" name="attr_image[]" type="file" class="form-control">
                                <input name="old_attr_image[]" type="hidden" value="{{$pAArr['attr_image']}}" >
                            </div>
                            <div class="col-md-2">
                                <label class="control-label mb-1">&nbsp; &nbsp; &nbsp; &nbsp;</label>
                                @if ($loop_num_count==2)
                                    <a href="javascript:void(0)" onclick="add_more()" class="btn btn-info btn-lg"><i class="fas fa-plus"></i> Add</a>
                                @else
                                    <a href="{{url('admin/product/productattrdelete/'.$id.'/'.$pAArr['id'])}}" class="btn btn-danger btn-lg"><i class="fas fa-minus"></i> Remove</a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-lg-12">
            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                Submit
            </button>
        </div>
    </form>
</div>
<script>
    var loop_count = 111;
    function add_more(){
        loop_count++;
        var html = '<div class="card" id="product_attr_'+loop_count+'"><div class="card-body"><div class="form-group"><div class="row">';
        html +=  '<div class="col-md-2"><label for="sku" class="control-label mb-1">SKU</label><input id="sku" name="sku[]" type="text" class="form-control" required><input name="paid[]" type="hidden" value=""></div>';
        html += '<div class="col-md-2"><label for="mrp" class="control-label mb-1">MRP</label><input id="mrp" name="mrp[]" type="text" class="form-control" ></div>';
        html += '<div class="col-md-2"><label for="price" class="control-label mb-1">Price</label><input id="price" name="price[]" type="text" class="form-control" required></div>';
        html += '<div class="col-md-2"><label for="qty" class="control-label mb-1">Quantity</label><input id="qty" name="qty[]" type="text" class="form-control" required></div>';
        var size_id_html = jQuery('#size_id').html();
        size_id_html = size_id_html.replace('selected','');
        html += '<div class="col-md-2"><label for="size_id" class="control-label mb-1">Size</label><select id="size_id" name="size_id[]" type="text" class="form-control">'+size_id_html+'</select></div>';
        var color_id_html = jQuery('#color_id').html();
        color_id_html = color_id_html.replace('selected','');
        html += '<div class="col-md-2"><label for="color_id" class="control-label mb-1">Color</label><select id="color_id" name="color_id[]" type="text" class="form-control">'+color_id_html+'</select></div>';
        html += '</div>';
        html += '<div class="row">';
        html += '<div class="col-md-4"><label for="attr_image" class="control-label mb-1">Attribute Image</label><input id="attr_image" name="attr_image[]" type="file" class="form-control" required></div>';

        html += '<div class="col-md-2"><label class="control-label mb-1">&nbsp; &nbsp; &nbsp; &nbsp;</label><a href="javascript:void(0)" onclick=remove_more("'+loop_count+'") class="btn btn-danger btn-lg"><i class="fas fa-minus"></i> Remove</a></div>';

        html += '</div></div></div></div>';

        jQuery('#product_attr_box').append(html);
    }

    function remove_more(loop_count){
        jQuery('#product_attr_'+loop_count).remove();
    }
    var loop_count = 111;
    function add_images_more(){
        loop_count++;
        var html = '<div class="col-md-6" id="product_images_'+loop_count+'"><div class="row">';
        html += '<div class="col-md-8"><label for="images" class="control-label mb-1">Attribute Image</label><input name="piid[]" type="hidden" value=""><input id="images" name="images[]" type="file" class="form-control" required></div>';

        html += '<div class="col-md-4"><label class="control-label mb-1">&nbsp; &nbsp; &nbsp; &nbsp;</label><a href="javascript:void(0)" onclick=remove_images_more("'+loop_count+'") class="btn btn-danger btn-lg"><i class="fas fa-minus"></i> Remove</a></div>';
        html += '</div></div>';

        jQuery('#product_images_box').append(html);
    }
    function remove_images_more(loop_count){
        jQuery('#product_images_'+loop_count).remove();
    }


    ClassicEditor
		.create( document.querySelector( '#short_desc' ), {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		} )
		.then( editor => {
			window.editor = editor;
		} )
    ClassicEditor
        .create( document.querySelector( '#description' ), {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		} )
		.then( description => {
			window.description = description;
		} )
    ClassicEditor
        .create( document.querySelector( '#tecnical_specification' ), {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		} )
		.then( description => {
			window.tecnical_specification = tecnical_specification;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
</script>
@endsection

