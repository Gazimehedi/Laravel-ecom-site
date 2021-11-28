@extends('front.layout')
@section('page_title','Ozuaz Shop | Home')
@section('container')
    <!-- Start slider -->
  <section id="aa-slider">
    <div class="aa-slider-area">
      <div id="sequence" class="seq">
        <div class="seq-screen">
          <ul class="seq-canvas">
            <!-- single slide item -->
            @foreach ($home_banner as $banner)
            <li>
              <div class="seq-model">
                <img data-seq src="{{asset('storage/media/banner/'.$banner->image)}}" />
              </div>
              <div class="seq-title">
               <span data-seq>Save Up to 75% Off</span>
                <h2 data-seq>
                @if ($banner->title!='')
                {{$banner->title}}
                @endif
                </h2>
                <p data-seq>
                  @if ($banner->sub_title!='')
                  {{$banner->sub_title}}
                  @endif
                </p>
                @if ($banner->btn_text!='')
                  <a data-seq href="{{$banner->btn_link}}" class="aa-shop-now-btn aa-secondary-btn">{{$banner->btn_text}}</a>
                  @endif
              </div>
            </li>
             @endforeach
          </ul>
        </div>
        <!-- slider navigation btn -->
        <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
          <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
          <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
        </fieldset>
      </div>
    </div>
  </section>
  <!-- / slider -->
  <!-- Start Promo section -->
  <section id="aa-promo">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-promo-area">
            <div class="row">
                <div class="col-md-5 no-padding">
                    @foreach ($categoryFirst as $cat1)
                    <div class="aa-promo-left">
                      <div class="aa-promo-banner"><img src="{{asset('storage/media/category/'.$cat1->category_image)}}" alt="{{$cat1->category}}">
                        <div class="aa-prom-content"><span>Exclusive Item</span>
                          <h4><a href="{{url('category/'.$cat1->category_slug)}}">{{$cat1->category}}</a></h4>
                        </div>
                      </div>
                    </div>
                    @endforeach
                </div>
                <div class="col-md-7 no-padding">
                  <div class="aa-promo-right">
                      @foreach ($categoryFour as $cat4)
                      <div class="aa-single-promo-right">
                        <div class="aa-promo-banner"><img src="{{asset('storage/media/category/'.$cat4->category_image)}}" alt="{{$cat4->category}}">
                          <div class="aa-prom-content"><span>Exclusive Item</span>
                            <h4><a href="{{url('category/'.$cat4->category_slug)}}">{{$cat4->category}}</a></h4>
                          </div>
                        </div>
                      </div>
                      @endforeach

                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Promo section -->
  <!-- Products section -->
  <section id="aa-product">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-product-area">
              <div class="aa-product-inner">
                <!-- start prduct navigation -->
                 <ul class="nav nav-tabs aa-products-tab">
                  @foreach ($home_categories as $item)
                    <li class=""><a href="#cat{{$item->id}}" data-toggle="tab">{{$item->category}}</a></li>
                  @endforeach
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                    @php
                        $loop_count=1;
                    @endphp
                    @foreach ($home_categories as $item)
                    @php
                    $cat_class = "";
                    if($loop_count==1){
                      $cat_class = "in active";
                      $loop_count++;
                    }
                    @endphp
                    <div class="tab-pane fade {{$cat_class}}" id="cat{{$item->id}}">
                      <ul class="aa-product-catg">
                        @if (isset($home_categories_product[$item->id][0]))
                        @foreach ($home_categories_product[$item->id] as $productarr)
                        <li>
                          <figure>
                            <a class="aa-product-img" href="{{url('product/'.$productarr->slug)}}"><img src="{{asset('storage/media/'.$productarr->image)}}" alt="{{$productarr->name}}"></a>
                            <a class="aa-add-card-btn" href="javascript:void(0)" onclick="home_add_to_cart('{{$productarr->id}}','{{$home_product_attr[$productarr->id][0]->size}}','{{$home_product_attr[$productarr->id][0]->color}}')"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                              <figcaption>
                              <h4 class="aa-product-title"><a href="{{url('product/'.$productarr->slug)}}">{{$productarr->name}}</a></h4>
                              <span class="aa-product-price">$ {{$home_product_attr[$productarr->id][0]->price}}</span><span class="aa-product-price"><del>$ {{$home_product_attr[$productarr->id][0]->mrp}}</del></span>
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
                    @endforeach
                  </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Products section -->
  <!-- banner section -->
  <section id="aa-banner">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-banner-area">
            <a href="#"><img src="{{asset('front_assets/img/fashion-banner.jpg')}}" alt="fashion banner img"></a>
          </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- popular section -->
  <section id="aa-popular-category">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-popular-category-area">
              <!-- start prduct navigation -->
             <ul class="nav nav-tabs aa-products-tab">
                <li class="active"><a href="#featured" data-toggle="tab">Featured</a></li>
                <li><a href="#tranding" data-toggle="tab">Tranding</a></li>
                <li><a href="#discounted" data-toggle="tab">Discounted</a></li>
              </ul>
              <!-- Tab panes -->
              <div class="tab-content">
                <!-- Start men featured category -->
                <div class="tab-pane fade in active" id="featured">
                  <ul class="aa-product-catg aa-popular-slider">
                    <!-- start single product item -->
                    @if (isset($home_featured_product[$item->id][0]))
                        @foreach ($home_featured_product[$item->id] as $featured)
                        <li>
                          <figure>
                            <a class="aa-product-img" href="{{url('product/'.$featured->slug)}}"><img src="{{asset('storage/media/'.$featured->image)}}" alt="{{$featured->name}}"></a>
                            <a class="aa-add-card-btn" href="javascript:void(0)" onclick="home_add_to_cart('{{$featured->id}}','{{$home_featured_attr[$featured->id][0]->size}}','{{$home_featured_attr[$featured->id][0]->color}}')"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                              <figcaption>
                              <h4 class="aa-product-title"><a href="{{url('product/'.$featured->slug)}}">{{$featured->name}}</a></h4>
                              <span class="aa-product-price">$ {{$home_featured_attr[$featured->id][0]->price}}</span><span class="aa-product-price"><del>$ {{$home_featured_attr[$featured->id][0]->mrp}}</del></span>
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
                <!-- / popular product category -->

                <!-- start tranding product category -->
                <div class="tab-pane fade" id="tranding">
                 <ul class="aa-product-catg aa-featured-slider">
                    <!-- start single product item -->
                    @if (isset($home_tranding_product[$item->id][0]))
                        @foreach ($home_tranding_product[$item->id] as $tranding)
                        <li>
                          <figure>
                            <a class="aa-product-img" href="{{url('product/'.$tranding->slug)}}"><img src="{{asset('storage/media/'.$tranding->image)}}" alt="{{$tranding->name}}"></a>
                            <a class="aa-add-card-btn" href="javascript:void(0)" onclick="home_add_to_cart('{{$tranding->id}}','{{$home_tranding_attr[$tranding->id][0]->size}}','{{$home_tranding_attr[$tranding->id][0]->color}}')"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                              <figcaption>
                              <h4 class="aa-product-title"><a href="{{url('product/'.$tranding->slug)}}">{{$tranding->name}}</a></h4>
                              <span class="aa-product-price">$ {{$home_tranding_attr[$tranding->id][0]->price}}</span><span class="aa-product-price"><del>$ {{$home_tranding_attr[$tranding->id][0]->mrp}}</del></span>
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
                <!-- / featured product category -->

                <!-- start discounted product category -->
                <div class="tab-pane fade" id="discounted">
                  <ul class="aa-product-catg aa-latest-slider">
                    <!-- start single product item -->
                    @if (isset($home_discounted_product[$item->id][0]))
                        @foreach ($home_discounted_product[$item->id] as $discounted)
                        <li>
                          <figure>
                            <a class="aa-product-img" href="{{url('product/'.$discounted->slug)}}"><img src="{{asset('storage/media/'.$discounted->image)}}" alt="{{$discounted->name}}"></a>
                            <a class="aa-add-card-btn" href="javascript:void(0)" onclick="home_add_to_cart('{{$discounted->id}}','{{$home_discounted_attr[$discounted->id][0]->size}}','{{$home_discounted_attr[$discounted->id][0]->color}}')"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                              <figcaption>
                              <h4 class="aa-product-title"><a href="{{url('product/'.$discounted->slug)}}">{{$discounted->name}}</a></h4>
                              <span class="aa-product-price">$ {{$home_discounted_attr[$discounted->id][0]->price}}</span><span class="aa-product-price"><del>$ {{$home_discounted_attr[$discounted->id][0]->mrp}}</del></span>
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
                <!-- / latest product category -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / popular section -->
  <!-- Support section -->
  <section id="aa-support">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-support-area">
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-truck"></span>
                <h4>FREE SHIPPING</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-clock-o"></span>
                <h4>30 DAYS MONEY BACK</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-phone"></span>
                <h4>SUPPORT 24/7</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  {{-- <!-- / Support section -->
  <!-- Testimonial -->
  <section id="aa-testimonial">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-testimonial-area">
            <ul class="aa-testimonial-slider">
              <!-- single slide -->
              <li>
                <div class="aa-testimonial-single">
                <img class="aa-testimonial-img" src="{{asset('front_assets/img/testimonial-img-2.jpg')}}" alt="testimonial img">
                  <span class="fa fa-quote-left aa-testimonial-quote"></span>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui!consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui.</p>
                  <div class="aa-testimonial-info">
                    <p>Allison</p>
                    <span>Designer</span>
                    <a href="#">Dribble.com</a>
                  </div>
                </div>
              </li>
              <!-- single slide -->
              <li>
                <div class="aa-testimonial-single">
                <img class="aa-testimonial-img" src="{{asset('front_assets/img/testimonial-img-1.jpg')}}" alt="testimonial img">
                  <span class="fa fa-quote-left aa-testimonial-quote"></span>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui!consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui.</p>
                  <div class="aa-testimonial-info">
                    <p>KEVIN MEYER</p>
                    <span>CEO</span>
                    <a href="#">Alphabet</a>
                  </div>
                </div>
              </li>
               <!-- single slide -->
              <li>
                <div class="aa-testimonial-single">
                <img class="aa-testimonial-img" src="{{asset('front_assets/img/testimonial-img-3.jpg')}}" alt="testimonial img">
                  <span class="fa fa-quote-left aa-testimonial-quote"></span>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui!consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui.</p>
                  <div class="aa-testimonial-info">
                    <p>Luner</p>
                    <span>COO</span>
                    <a href="#">Kinatic Solution</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Testimonial -->

  <!-- Client Brand -->
  <section id="aa-client-brand">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-client-brand-area">
            <ul class="aa-client-brand-slider">
              @foreach ($home_brand as $brand)
                <li><a href="#"><img src="{{asset('storage/media/brand/'.$brand->image)}}" alt="java img"></a></li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Client Brand --> --}}

  <!-- Subscribe section -->
  <section id="aa-subscribe">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-subscribe-area">
            <h3>Subscribe our newsletter </h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, velit!</p>
            <form action="{{route('subscription')}}" method="post" class="aa-subscribe-form">@csrf
              <input type="email" name="email" id="email" placeholder="Enter your Email">
              <input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Subscribe section -->
  <input type="hidden" id="qty" name="qty" value="1">
  <form id="frmAddToCart">
    <input type="hidden" id="color_id" name="color_id">
    <input type="hidden" id="size_id" name="size_id">
    <input type="hidden" id="product_id" name="product_id">
    <input type="hidden" id="pqty" name="pqty">
    @csrf
   </form>
@endsection
