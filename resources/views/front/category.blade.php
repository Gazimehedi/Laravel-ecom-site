@extends('front.layout')
@section('page_title','Category Page')
@section('container')
   <!-- catg header banner section -->
   <section id="aa-catg-head-banner">
    <img src="{{asset('front_assets/img/fashion/fashion-header-bg-8.jpg')}}" alt="fashion img">
    <div class="aa-catg-head-banner-area">
      <div class="container">
       <div class="aa-catg-head-banner-content">
         <h2>{{$catgory[0]->category}}</h2>
         <ol class="breadcrumb">
           <li><a href="{{url('/')}}">Home</a></li>
           <li class="active">Category</li>
         </ol>
       </div>
      </div>
    </div>
   </section>
   <!-- / catg header banner section -->

   <!-- product category -->
   <section id="aa-product-category">
     <div class="container">
       <div class="row">
         <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
           <div class="aa-product-catg-content">
             <div class="aa-product-catg-head">
               <div class="aa-product-catg-head-left">
                 <form action="" class="aa-sort-form">
                   <label for="">Sort by</label>
                  @php
                      $name = '';
                      if($sort=='name'){
                        $name = "selected";
                      }
                      $price_desc = '';
                      if($sort=='price_desc'){
                        $price_desc = "selected";
                      }
                      $price_asc = '';
                      if($sort=='price_asc'){
                        $price_asc = "selected";
                      }
                      $date = '';
                      if($sort=='date'){
                        $date = "selected";
                      }
                  @endphp
                   <select name="sort_by_value" id="sort_by_value" onchange="sortBy()">
                     <option value="">Default</option>
                     <option value="name" {{$name}}>Name</option>
                     <option value="price_desc" {{$price_desc}}>Price Desc</option>
                     <option value="price_asc" {{$price_asc}}>Price Asc</option>
                     <option value="date" {{$date}}>Date</option>
                   </select>
                 </form>
                 <form action="" class="aa-show-form">
                   <label for="">Show</label>
                   <select name="">
                     <option value="1" selected="12">12</option>
                     <option value="2">24</option>
                     <option value="3">36</option>
                   </select>
                 </form>
               </div>
               <div class="aa-product-catg-head-right">
                 <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                 <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
               </div>
             </div>
             <div class="aa-product-catg-body">
               <ul class="aa-product-catg">
                @if (isset($category_product[0]))
                @foreach ($category_product as $productArr)
                <li>
                  <figure>
                    <a class="aa-product-img" href="{{url('product/'.$productArr->slug)}}"><img src="{{asset('storage/media/'.$productArr->image)}}" alt="{{$productArr->name}}"></a>
                    <a class="aa-add-card-btn" href="javascript:void(0)" onclick="home_add_to_cart('{{$productArr->id}}','{{$product_attr[$productArr->id][0]->size}}','{{$product_attr[$productArr->id][0]->color}}')"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                      <figcaption>
                      <h4 class="aa-product-title"><a href="{{url('product/'.$productArr->slug)}}">{{$productArr->name}}</a></h4>
                      <span class="aa-product-price">$ {{$product_attr[$productArr->id][0]->price}}</span><span class="aa-product-price"><del>$ {{$product_attr[$productArr->id][0]->mrp}}</del></span>
                    </figcaption>
                  </figure>
                </li>
                @endforeach
                @else
                <li>
                  <figure>
                    No data found
                  </figure>
                </li>
                @endif
         </ul>

             </div>
             <div class="aa-product-catg-pagination">
                 <nav>
                 {{$category_product->links()}}
               </nav>
             </div>
           </div>
         </div>
         <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
           <aside class="aa-sidebar">
             <!-- single sidebar -->
             <div class="aa-sidebar-widget">
               <h3>Category</h3>
               <ul class="aa-catg-nav">
                 @foreach ($left_categories as $category)
                  @if ($cat_slug==$category->category_slug)
                    <li><a href="{{url('category/'.$category->category_slug)}}" class="cat_active">{{$category->category}}</a></li>
                  @else
                    <li><a href="{{url('category/'.$category->category_slug)}}">{{$category->category}}</a></li>
                  @endif
                 @endforeach
               </ul>
             </div>
             <!-- single sidebar -->
             {{-- <div class="aa-sidebar-widget">
               <h3>Tags</h3>
               <div class="tag-cloud">
                 <a href="#">Fashion</a>
                 <a href="#">Ecommerce</a>
                 <a href="#">Shop</a>
                 <a href="#">Hand Bag</a>
                 <a href="#">Laptop</a>
                 <a href="#">Head Phone</a>
                 <a href="#">Pen Drive</a>
               </div>
             </div> --}}
             <!-- single sidebar -->
             <div class="aa-sidebar-widget">
               <h3>Shop By Price</h3>
               <!-- price range -->
               <div class="aa-sidebar-price-range">
                <form action="">
                   <div id="skipstep" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                   </div>
                   <span id="skip-value-lower" class="example-val">30.00</span>
                  <span id="skip-value-upper" class="example-val">100.00</span>
                  <button class="aa-filter-btn" type="button" onclick="sort_price_filter()">Filter</button>
                </form>
               </div>

             </div>
             <!-- single sidebar -->
             <div class="aa-sidebar-widget">
               <h3>Shop By Color</h3>
               <div class="aa-color-tag">
                 @foreach ($colors as $color)
                  @if (in_array($color->id,$colorArr))
                    <a class="aa-color-{{strtolower($color->color)}} active_color" href="javascript:void(0)" onclick="set_color('{{$color->id}}','1')"></a>
                  @else
                    <a class="aa-color-{{strtolower($color->color)}}" href="javascript:void(0)" onclick="set_color('{{$color->id}}')"></a>
                  @endif
                 @endforeach
               </div>
             </div>
           </aside>
         </div>

       </div>
     </div>
   </section>
   <!-- / product category -->
   <input type="hidden" id="qty" name="qty" value="1">
   <form id="frmAddToCart">
     <input type="hidden" id="color_id" name="color_id">
     <input type="hidden" id="size_id" name="size_id">
     <input type="hidden" id="product_id" name="product_id">
     <input type="hidden" id="pqty" name="pqty">
     @csrf
    </form>
    <form id="sort_by_form">
      <input type="hidden" id="sort_by" name="sort_by" value="{{$sort}}">
      <input type="hidden" id="price_filter_start" name="price_filter_start" value="{{$price_filter_start}}">
      <input type="hidden" id="price_filter_end" name="price_filter_end" value="{{$price_filter_end}}">
      <input type="hidden" id="color_filter" name="color_filter" value="{{$color_filter}}">
     </form>
@endsection
