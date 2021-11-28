@extends('front.layout')
@section('page_title', $home_product[0]->name)
@section('container')
 <!-- catg header banner section -->
 {{-- <section id="aa-catg-head-banner">
  <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
  <div class="aa-catg-head-banner-area">
    <div class="container">
     <div class="aa-catg-head-banner-content">
       <h2>T-Shirt</h2>
       <ol class="breadcrumb">
         <li><a href="index.html">Home</a></li>
         <li><a href="#">Product</a></li>
         <li class="active">T-shirt</li>
       </ol>
     </div>
    </div>
  </div>
 </section> --}}
 <!-- / catg header banner section -->

 <!-- product category -->
 <section id="aa-product-details">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="aa-product-details-area">
           <div class="aa-product-details-content">
             <div class="row">
               <!-- Modal view slider -->
               <div class="col-md-5 col-sm-5 col-xs-12">
                 <div class="aa-product-view-slider">
                   <div id="demo-1" class="simpleLens-gallery-container">
                     <div class="simpleLens-container">
                       <div class="simpleLens-big-image-container"><a data-lens-image="{{asset('front_assets/img/view-slider/large/polo-shirt-1.png')}}" class="simpleLens-lens-image"><img src="{{asset('storage/media/'.$home_product[0]->image)}}" class="simpleLens-big-image"></a></div>
                     </div>
                     <div class="simpleLens-thumbnails-container">
                         <a data-big-image="{{asset('storage/media/'.$home_product[0]->image)}}" data-lens-image="{{asset('storage/media/'.$home_product[0]->image)}}" class="simpleLens-thumbnail-wrapper" href="#">
                           <img width="50px" src="{{asset('storage/media/'.$home_product[0]->image)}}">
                         </a>

                         @if (isset($product_images[0]))
                             @foreach ($product_images as $item)
                             <a data-big-image="{{asset('storage/media/'.$item->image)}}" data-lens-image="{{asset('storage/media/'.$item->image)}}" class="simpleLens-thumbnail-wrapper" href="#">
                              <img width="50px" src="{{asset('storage/media/'.$item->image)}}">
                            </a>
                             @endforeach
                         @endif
                     </div>
                   </div>
                 </div>
               </div>
               <!-- Modal view content -->
               <div class="col-md-7 col-sm-7 col-xs-12">
                 <div class="aa-product-view-content">
                   <h3>{{$home_product[0]->name}}</h3>
                   <div class="aa-price-block">
                     <span class="aa-product-view-price"><del>$ {{$product_attr[0]->mrp}}</del></span>&nbsp;&nbsp;
                     <span class="aa-product-view-price">$ {{$product_attr[0]->price}}</span>
                     <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                     <p class="lead_time">Delivery In: <span>{{$home_product[0]->lead_time}}</span></p>
                   </div>
                   <p>{!!$home_product[0]->short_desc!!}</p>
                   @if ($product_attr[0]->size_id!=0)
                   <h4>Size</h4>
                   <div class="aa-prod-view-size">
                     @php
                         $sizeArr=[];
                         foreach ($product_attr as $attr) {
                          if ($attr->size_id!=0){
                            $sizeArr[] = $attr->size;
                          }
                         }
                         $sizeArr = array_unique($sizeArr);
                     @endphp
                     @foreach ($sizeArr as $attr)
                        <a class="size_link" id="size_{{$attr}}" onclick="size_color('{{$attr}}')" href="javascript:void(0)">{{$attr}}</a>
                     @endforeach
                   </div>
                   @endif
                   @if ($product_attr[0]->color_id!=0)
                   <h4>Color</h4>
                   <div class="aa-color-tag">
                    @foreach ($product_attr as $attr)
                    @if ($attr->color_id!=0)
                      <a href="javascript:void(0)" onclick="image_change('{{asset('storage/media/'.$attr->attr_image)}}','{{$attr->color}}')" class="aa-color-{{strToLower($attr->color)}} color_hide size_{{$attr->size}}"></a>
                    @endif
                   @endforeach

                     {{-- <a href="#" class="aa-color-yellow"></a>
                     <a href="#" class="aa-color-pink"></a>
                     <a href="#" class="aa-color-black"></a>
                     <a href="#" class="aa-color-white"></a>                       --}}
                   </div>
                   @endif
                   <div class="aa-prod-quantity">
                     <form action="">
                       <select id="qty" name="qty">
                         @for ($i = 1; $i < 11; $i++)
                          <option value="{{$i}}">{{$i}}</option>
                         @endfor
                       </select>
                     </form>
                     <p class="aa-prod-category">
                       Model: <a href="#">{{$home_product[0]->model}}</a>
                     </p>
                   </div>
                   <div class="aa-prod-view-bottom">
                     <a class="aa-add-to-cart-btn" onclick="add_to_cart('{{$home_product[0]->id}}','{{$product_attr[0]->size_id}}','{{$product_attr[0]->color_id}}')" href="javascript:void(0)">Add To Cart</a>
                   </div>
                   <br>
                   <div id="cart_msg"></div>
                 </div>
               </div>
             </div>
           </div>
           <div class="aa-product-details-bottom">
             <ul class="nav nav-tabs" id="myTab2">
               <li><a href="#description" data-toggle="tab">Description</a></li>
               <li><a href="#tecnical_specification" data-toggle="tab">Tecnical Specification</a></li>
               <li><a href="#uses" data-toggle="tab">Uses</a></li>
               <li><a href="#review" data-toggle="tab">Reviews</a></li>
             </ul>

             <!-- Tab panes -->
             <div class="tab-content">
               <div class="tab-pane fade in active" id="description">
                {!!$home_product[0]->description!!}
               </div>
               <div class="tab-pane fade " id="tecnical_specification">
                {!!$home_product[0]->tecnical_specification!!}
               </div>
               <div class="tab-pane fade " id="uses">
                {!!$home_product[0]->uses!!}
               </div>
               <div class="tab-pane fade " id="review">
                <div class="aa-product-review-area">
                @if(count($reviews)!=0)
                  <h4>{{count($reviews)}} Reviews for {{$home_product[0]->name}}</h4>
                  <ul class="aa-review-nav">
                    @foreach($reviews as $review)
                    <li>
                       <div class="media">
                         <div class="media-body">
                           <h4 class="media-heading"><strong>{{$review->name}}</strong> - <span>{{\Carbon\Carbon::parse($review->created_at)->format('d-M Y')}}</span></h4>
                           <div class="aa-product-rating">
                            @for ($i=1;$i<=$review->rating;$i++)
                            <span class="fa fa-star"></span>
                            @endfor
                            @for ($i=1;$i<=5-$review->rating;$i++)
                            <span class="fa fa-star-o"></span>
                            @endfor
                           </div>
                           <p>{{$review->review}}</p>
                         </div>
                       </div>
                     </li>
                     @endforeach
                  </ul>
                  @endif
                  <h4>Add a review</h4>
                  <div class="aa-your-rating">
                    <p>Your Rating</p>
                    <a onclick="rating_oparetion(1)" href="javascript:void(0)"><span id="rating1" class="fa fa-star-o"></span></a>
                    <a onclick="rating_oparetion(2)" href="javascript:void(0)"><span id="rating2" class="fa fa-star-o"></span></a>
                    <a onclick="rating_oparetion(3)" href="javascript:void(0)"><span id="rating3" class="fa fa-star-o"></span></a>
                    <a onclick="rating_oparetion(4)" href="javascript:void(0)"><span id="rating4" class="fa fa-star-o"></span></a>
                    <a onclick="rating_oparetion(5)" href="javascript:void(0)"><span id="rating5" class="fa fa-star-o"></span></a>
                  </div>
                  <!-- review form -->
                  <form id="reviewFrm" class="aa-review-form" method="POST">
                     <div class="form-group">
                       <label for="message">Your Review</label>
                       <textarea class="form-control" name="review" rows="3" id="message"></textarea>
                     </div>
                     <input type="hidden" name="products_id" value="{{$home_product[0]->id}}">
                     <input type="hidden" name="rating" id="rating" value="1">
                     @csrf
                     <button type="submit" class="btn btn-default aa-review-submit">Submit</button>
                     <p id="review_error"></p>
                  </form>
                </div>
               </div>
             </div>
           </div>
           <!-- Related product -->
           <div class="aa-product-related-item">
             <h3>Related Products</h3>
             <ul class="aa-product-catg aa-related-item-slider">
               <!-- start single product item -->
               @if (isset($home_related_product[0]))
                  @foreach ($home_related_product as $productarr)
                  <li>
                    <figure>
                      <a class="aa-product-img" href="{{url('product/'.$productarr->slug)}}"><img src="{{asset('storage/media/'.$productarr->image)}}" alt="{{$productarr->name}}"></a>
                      <a class="aa-add-card-btn"href="{{url('product/'.$productarr->slug)}}"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                        <figcaption>
                        <h4 class="aa-product-title"><a href="{{url('product/'.$productarr->slug)}}">{{$productarr->name}}</a></h4>
                        <span class="aa-product-price">$ {{$related_product_attr[0]->price}}</span><span class="aa-product-price"><del>$ {{$related_product_attr[0]->mrp}}</del></span>
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
   </div>
 </section>
 <form id="frmAddToCart">
  <input type="hidden" id="color_id" name="color_id">
  <input type="hidden" id="size_id" name="size_id">
  <input type="hidden" id="product_id" name="product_id">
  <input type="hidden" id="pqty" name="pqty">
  @csrf
 </form>
 <!-- / product category -->

@endsection
