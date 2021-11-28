@extends('front.layout')
@section('page_title','Search Page')
@section('container')
   <!-- catg header banner section -->
   <section id="aa-catg-head-banner">
    <img src="{{asset('front_assets/img/fashion/fashion-header-bg-8.jpg')}}" alt="fashion img">
    <div class="aa-catg-head-banner-area">
      <div class="container">
       <div class="aa-catg-head-banner-content">
         <h2>{{$search_str}}</h2>
         <ol class="breadcrumb">
           <li><a href="index.html">Home</a></li>
           <li class="active">Search</li>
         </ol>
       </div>
      </div>
    </div>
   </section>
   <section id="aa-product-category">
     <div class="container">
       <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-8">
           <div class="aa-product-catg-content">
             <div class="aa-product-catg-body">
               <ul class="aa-product-catg">
                @if (isset($search_product[0]))
                @foreach ($search_product as $productArr)
                <li class="search_product">
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
           </div>
         </div>
       </div>
       <div class="row">
           <div class="col-md-12 text-center" >
            {{$search_product->links()}}
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
@endsection
