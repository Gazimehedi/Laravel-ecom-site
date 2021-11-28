<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('page_title')</title>

    <!-- Fontfaces CSS-->
    <link href="{{asset('admin_assets/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

     {{-- <!-- Vendor CSS-->
     <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
     <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
     <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
     <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
     <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
     <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
     <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all"> --}}

    <!-- Main CSS-->
    <link href="{{asset('admin_assets/css/theme.css')}}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="{{url('admin/dashboard')}}">
                            @if (empty($setting->site_logo))
                                <h2>Dashboard</h2>
                            @else
                                <img src="{{asset('storage/media/setting/'.$setting->site_logo)}}" />
                            @endif
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"><i class="fas fa-bars"></i></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="@yield('dashboard_select')">
                            <a href="{{url('admin/dashboard')}}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li class="@yield('order_select')">
                            <a href="{{url('admin/order')}}">
                                <i class="fas fa-shopping-basket"></i>Orders</a>
                        </li>
                        <li class="@yield('product_review_select')">
                            <a href="{{url('admin/product_review')}}">
                                <i class="fas fa-star"></i>Product Review</a>
                        </li>
                        <li class="@yield('category_select')">
                            <a href="{{url('admin/category')}}">
                                <i class="fas fa-list"></i>Category</a>
                        </li>
                        <li class="@yield('coupon_select')">
                            <a href="{{url('admin/coupon')}}">
                                <i class="fas fa-tag"></i>Coupon</a>
                        </li>
                        <li class="@yield('size_select')">
                            <a href="{{url('admin/size')}}">
                                <i class="fas fa-clone"></i>Size</a>
                        </li>
                        <li class="@yield('color_select')">
                            <a href="{{url('admin/color')}}">
                                <i class="fas fa-paint-brush"></i>Color</a>
                        </li>
                        <li class="@yield('brand_select')">
                            <a href="{{url('admin/brand')}}">
                                <i class="fas fa-bold"></i>Brand</a>
                        </li>
                        <li class="@yield('product_select')">
                            <a href="{{url('admin/product')}}">
                                <i class="fab fa-product-hunt"></i>Product</a>
                        </li>
                        <li class="@yield('tax_select')">
                            <a href="{{url('admin/tax')}}">
                                <i class="fas fa-percent"></i>Tax</a>
                        </li>
                        <li class="@yield('message_select')">
                            <a href="{{url('admin/message')}}">
                                <i class="fas fa-envelope"></i>Messages</a>
                        </li>
                        <li class="@yield('customer_select')">
                            <a href="{{url('admin/customer')}}">
                                <i class="fas fa-user"></i>Customers</a>
                        </li>
                        <li class="@yield('home_banner_select')">
                            <a href="{{url('admin/home_banner')}}">
                                <i class="fas fa-images"></i>Home Banner</a>
                        </li>
                        <li class="@yield('subscription_select')">
                            <a href="{{url('admin/subscription')}}">
                                <i class="fab fa-gratipay"></i>Subscription</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="{{url('admin/dashboard')}}">
                    @if (empty($setting->site_logo))
                        <h2>Dashboard</h2>
                    @else
                        <img src="{{asset('storage/media/setting/'.$setting->site_logo)}}" />
                    @endif
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="@yield('dashboard_select')">
                            <a href="{{url('admin/dashboard')}}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li class="@yield('order_select')">
                            <a href="{{url('admin/order')}}">
                                <i class="fas fa-shopping-basket"></i>Orders</a>
                        </li>
                        <li class="@yield('product_review_select')">
                            <a href="{{url('admin/product_review')}}">
                                <i class="fas fa-star"></i>Product Review</a>
                        </li>
                        <li class="@yield('category_select')">
                            <a href="{{url('admin/category')}}">
                                <i class="fas fa-list"></i>Category</a>
                        </li>
                        <li class="@yield('coupon_select')">
                            <a href="{{url('admin/coupon')}}">
                                <i class="fas fa-tag"></i>Coupon</a>
                        </li>
                        <li class="@yield('size_select')">
                            <a href="{{url('admin/size')}}">
                                <i class="fas fa-clone"></i>Size</a>
                        </li>
                        <li class="@yield('color_select')">
                            <a href="{{url('admin/color')}}">
                                <i class="fas fa-paint-brush"></i>Color</a>
                        </li>
                        <li class="@yield('brand_select')">
                            <a href="{{url('admin/brand')}}">
                                <i class="fas fa-bold"></i>Brand</a>
                        </li>
                        <li class="@yield('product_select')">
                            <a href="{{url('admin/product')}}">
                                <i class="fab fa-product-hunt"></i>Product</a>
                        </li>
                        <li class="@yield('tax_select')">
                            <a href="{{url('admin/tax')}}">
                                <i class="fas fa-percent"></i>Tax</a>
                        </li>
                        <li class="@yield('customer_select')">
                            <a href="{{url('admin/customer')}}">
                                <i class="fas fa-user"></i>Customers</a>
                        </li>
                        <li class="@yield('message_select')">
                            <a href="{{url('admin/message')}}">
                                <i class="fas fa-envelope"></i>Messages</a>
                        </li>
                        <li class="@yield('home_banner_select')">
                            <a href="{{url('admin/home_banner')}}">
                                <i class="fas fa-images"></i>Home Banner</a>
                        </li>
                        <li class="@yield('subscription_select')">
                            <a href="{{url('admin/subscription')}}">
                                <i class="fab fa-gratipay"></i>Subscription</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">

                            </form>
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">Welcome Admin</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{route('admin.setting')}}">
                                                        <i class="fas fa-cog"></i>Setting</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="{{url('admin/logout')}}">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        @section('content')
                        @show


                        {{-- <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{asset('admin_assets/vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{asset('admin_assets/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- Vendor JS       -->
    {{-- <script src="vendor/slick/slick.min.js">
    </script> --}}
    <script src="{{asset('admin_assets/vendor/wow/wow.min.js')}}"></script>
    {{-- <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script> --}}

    <!-- Main JS-->
    <script src="{{asset('admin_assets/js/main.js')}}"></script>

</body>

</html>
<!-- end document-->
