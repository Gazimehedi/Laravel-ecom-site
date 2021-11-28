<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('page_title')</title>

    <link href="{{asset('front_assets/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('front_assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('front_assets/css/jquery.smartmenus.bootstrap.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('front_assets/css/jquery.simpleLens.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front_assets/css/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front_assets/css/nouislider.css')}}">
    <link id="switcher" href="{{asset('front_assets/css/theme-color/default-theme.css')}}" rel="stylesheet">
    <!-- <link id="switcher" href="css/theme-color/bridge-theme.css" rel="stylesheet"> -->
    <!-- Top Slider CSS -->
    <link href="{{asset('front_assets/css/sequence-theme.modern-slide-in.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('front_assets/css/style.css')}}" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>
      var imagePath = "{{asset('storage/media')}}";
      var sitePath = "{{url('/')}}";
    </script>
  </head>
  <body class="productPage">
   <!-- wpf loader Two -->
    {{-- <div id="wpf-loader-two">
      <div class="wpf-loader-two-inner">
        <span>Loading</span>
      </div>
    </div>  --}}
    <!-- / wpf loader Two -->
  <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->


  <!-- Start header section -->
  <header id="aa-header">
    <!-- start header top  -->
    <div class="aa-header-top">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-top-area">
              <!-- start header top left -->
              <div class="aa-header-top-left">
                <!-- start language -->
                <div class="aa-language">
                  <div class="dropdown">
                    <a class="btn dropdown-toggle" href="javascript:void(0)" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      <img src="{{asset('front_assets/img/flag/english.jpg')}}" alt="english flag">ENGLISH
                      {{-- <span class="caret"></span> --}}
                    </a>
                    {{-- <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                      <li><a href="javascript:void(0)"><img src="{{asset('front_assets/img/flag/french.jpg')}}" alt="">FRENCH</a></li>
                      <li><a href="javascript:void(0)"><img src="{{asset('front_assets/img/flag/english.jpg')}}" alt="">ENGLISH</a></li>
                    </ul> --}}
                  </div>
                </div>
                <!-- / language -->

                <!-- start currency -->
                <div class="aa-currency">
                  <div class="dropdown">
                    <a class="btn dropdown-toggle" href="#" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      <i class="fa fa-usd"></i>USD
                      {{-- <span class="caret"></span> --}}
                    </a>
                    {{-- <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                      <li><a href="javascript:void(0)"><i class="fa fa-euro"></i>EURO</a></li>
                      <li><a href="javascript:void(0)"><i class="fa fa-jpy"></i>YEN</a></li>
                    </ul> --}}
                  </div>
                </div>
                <!-- / currency -->
                <!-- start cellphone -->
                <div class="cellphone hidden-xs">
                  <p><span class="fa fa-phone"></span>@if (isset($setting->mobile)) {{$setting->mobile}} @else +1 212-982-4589 @endif</p>
                </div>
                <!-- / cellphone -->
              </div>
              <!-- / header top left -->
              <div class="aa-header-top-right">
                <ul class="aa-head-top-nav-right">
                  <li class="hidden-xs"><a href="{{url('cart')}}">My Cart</a></li>
                  @if (session()->has('FRONT_USER_LOGIN'))
                    <li><a href="{{url('/order')}}">My Order</a></li>
                    <li><a href="{{url('/logout')}}" >Logout</a></li>
                  @else
                    <li><a href="javascript:void(0)" data-toggle="modal" data-target="#login-modal">Login</a></li>
                  @endif
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header top  -->

    <!-- start header bottom  -->
    <div class="aa-header-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-bottom-area">
              <!-- logo  -->
              <div class="aa-logo">
                <!-- Text based logo -->
                <a href="{{url('/')}}">
                    @if (!empty($setting->site_logo))
                        <img src="{{asset('storage/media/setting/'.$setting->site_logo)}}" alt="{{$setting->site_name}}">
                    @else
                    <span class="fa fa-shopping-cart"></span>
                    <p>ozuaz<strong>Shop</strong> <span>Your Shopping Partner</span></p>
                    @endif
                </a>
                <!-- img based logo -->
                <!-- <a href="index.html"><img src="img/logo.jpg" alt="logo img"></a> -->
              </div>
              <!-- / logo  -->
               <!-- cart box -->
               @php
                  if(!isset($search_str)){
                    $search_str = '';
                  }
                   $cart_total = cartTotal();
                   $total_price = 0;
               @endphp
              <div class="aa-cartbox">
                <a class="aa-cart-link" href="#">
                  <span class="fa fa-shopping-basket"></span>
                  <span class="aa-cart-title">SHOPPING CART</span>
                  <span class="aa-cart-notify">{{count($cart_total)}}</span>
                </a>
                <div class="aa-cartbox-summary">
                @if (count($cart_total)!=0)
                  <ul>
                    @foreach ($cart_total as $cartItem)
                    @php
                        $total_price = $total_price+($cartItem->qty*$cartItem->price);
                    @endphp
                    <li>
                      <a class="aa-cartbox-img" href="{{url('product/'.$cartItem->slug)}}"><img src="{{asset('storage/media/'.$cartItem->image)}}" alt="img"></a>
                      <div class="aa-cartbox-info">
                        <h4><a href="{{url('product/'.$cartItem->slug)}}">{{$cartItem->name}}</a></h4>
                        <p>{{$cartItem->qty}} x $ {{$cartItem->price}}</p>
                      </div>
                    </li>
                    @endforeach
                    <li>
                      <span class="aa-cartbox-total-title">
                        Total
                      </span>
                      <span class="aa-cartbox-total-price">
                        $ {{$total_price}}
                      </span>
                    </li>
                  </ul>
                  <a class="aa-cartbox-checkout aa-primary-btn" href="{{url('cart')}}">Cart</a>
                  @else
                  cart empty
                @endif
              </div>
              </div>
              <!-- / cart box -->
              <!-- search box -->
              <div class="aa-search-box">
                  <input type="text" name="str" id="str" placeholder="Search here ex. 'man' " value="{{$search_str}}">
                  <button onclick="fun_search()"><span class="fa fa-search"></span></button>
              </div>
              <!-- / search box -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header bottom  -->
  </header>
  <!-- / header section -->
  <!-- menu -->
  <section id="menu">
    <div class="container">
      <div class="menu-area">
        <!-- Navbar -->
        <div class="navbar navbar-default" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="navbar-collapse collapse">
            <!-- Left nav -->
            {!! getTopNavCat() !!}
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
  </section>
  <!-- / menu -->
  @section('container')
  @show
  <!-- footer -->
  <footer id="aa-footer">
    <!-- footer bottom -->
    <div class="aa-footer-top">
     <div class="container">
        <div class="row">
        <div class="col-md-12">
          <div class="aa-footer-top-area">
            <div class="row">
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <h3>Main Menu</h3>
                  <ul class="aa-footer-nav">
                    <li><a href="#">Home</a></li>
                    <li><a href="{{route('about')}}">About Us</a></li>
                    <li><a href="{{route('contact')}}">Contact Us</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>Knowledge Base</h3>
                    <ul class="aa-footer-nav">
                      <li><a href="#">Delivery</a></li>
                      <li><a href="#">Returns</a></li>
                      <li><a href="#">Services</a></li>
                      <li><a href="#">Discount</a></li>
                      <li><a href="#">Special Offer</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>Useful Links</h3>
                    <ul class="aa-footer-nav">
                      <li><a href="#">Site Map</a></li>
                      <li><a href="#">Search</a></li>
                      <li><a href="#">Advanced Search</a></li>
                      <li><a href="#">Suppliers</a></li>
                      <li><a href="#">FAQ</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>Contact Us</h3>
                    <address>
                      <p>@if (empty($setting->address)) 25 Astor Pl, NY 10003, USA @else {{$setting->address}} @endif </p>
                      <p><span class="fa fa-phone"></span>@if (empty($setting->mobile)) +1 212-982-4589 @else {{$setting->mobile}} @endif</p>
                      <p><span class="fa fa-envelope"></span>@if (empty($setting->email)) support@gmail.com @else {{$setting->email}} @endif</p>
                    </address>
                    <div class="aa-footer-social">
                      <a href="{{$setting->fb_url}}"><span class="fa fa-facebook"></span></a>
                      <a href="{{$setting->tw_url}}"><span class="fa fa-twitter"></span></a>
                      <a href="{{$setting->ig_url}}"><span class="fa fa-instagram"></span></a>
                      <a href="{{$setting->yt_url}}"><span class="fa fa-youtube"></span></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     </div>
    </div>
    <!-- footer-bottom -->
    <div class="aa-footer-bottom">
      <div class="container">
        <div class="row">
        <div class="col-md-12">
          <div class="aa-footer-bottom-area">
            <p>{{$setting->footer_info}}</p>
            <div class="aa-footer-payment">
              <span class="fa fa-cc-mastercard"></span>
              <span class="fa fa-cc-visa"></span>
              <span class="fa fa-paypal"></span>
              <span class="fa fa-cc-discover"></span>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </footer>
  <!-- / footer -->

  <!-- Login Modal -->
  <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          @php
              if(isset($_COOKIE['LOGIN_EMAIL']) && isset($_COOKIE['LOGIN_PASSWORD'])){
                $rmbr_email = $_COOKIE['LOGIN_EMAIL'];
                $rmbr_password = $_COOKIE['LOGIN_PASSWORD'];
                $rmbr_check = "checked='checked'";
              }else{
                $rmbr_email = '';
                $rmbr_password = '';
                $rmbr_check = '';
              }
          @endphp
          <div id="login_popup">
            <h4>Login or Register</h4>
            <form class="aa-login-form" id="loginFrm">
              @csrf
              <label for="">Email address<span>*</span></label>
              <input type="email" name="login_email" id="login_email" placeholder="email" value="{{$rmbr_email}}" autocomplete="off">
              <label for="">Password<span>*</span></label>
              <input type="password" name="login_password" id="login_password" placeholder="Password" value="{{$rmbr_password}}" autocomplete="new-password">
              <button class="aa-browse-btn" id="loginBtn" type="submit">Login</button>
              <label for="rememberme" class="rememberme"><input type="checkbox" id="rememberme" name="rememberme" {{$rmbr_check}}> Remember me </label>
              <div style="clear:both" id="login_error" class="error_msg"></div>
              <p class="aa-lost-password"><a style="color:#FF6666" href="javascript:void(0)" onclick="show_forgot_popup()">Lost your password?</a></p>
              <div class="aa-register-now">
                Don't have an account?<a href="{{url('registration')}}">Register now!</a>
              </div>
            </form>
          </div>
          <div id="forgot_popup" style="display:none">
            <h4>Forgot Password</h4>
            <form class="aa-login-form" id="forgotFrm">
              @csrf
              <label for="">Email address<span>*</span></label>
              <input type="email" name="forgot_email" id="forgot_email" placeholder="email" autocomplete="off">
              <button class="aa-browse-btn" id="forgotBtn" type="submit">Submit</button>
              <div style="clear:both" id="forgot_error" class="error_msg"></div>
              <div class="aa-register-now">
                You have an account?<a href="javascript:void(0)" onclick="show_login_popup()">Login now!</a>
              </div>
            </form>
          </div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="{{asset('front_assets/js/bootstrap.js')}}"></script>
  <script type="text/javascript" src="{{asset('front_assets/js/jquery.smartmenus.js')}}"></script>
  <script type="text/javascript" src="{{asset('front_assets/js/jquery.smartmenus.bootstrap.js')}}"></script>
  <script src="{{asset('front_assets/js/sequence.js')}}"></script>
  <script src="{{asset('front_assets/js/sequence-theme.modern-slide-in.js')}}"></script>
  <script type="text/javascript" src="{{asset('front_assets/js/jquery.simpleGallery.js')}}"></script>
  <script type="text/javascript" src="{{asset('front_assets/js/jquery.simpleLens.js')}}"></script>
  <script type="text/javascript" src="{{asset('front_assets/js/slick.js')}}"></script>
  <script type="text/javascript" src="{{asset('front_assets/js/nouislider.js')}}"></script>
  <script src="{{asset('front_assets/js/custom.js')}}"></script>

  </body>
</html>
