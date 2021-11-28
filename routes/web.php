<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Front\PayPalController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\HomeBannerController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\ProductReviewController;

Route::get('/',[FrontController::class,'index'])->name('home');
Route::get('/product/{slug}',[FrontController::class,'product'])->name('product');
Route::get('/category/{slug}',[FrontController::class,'category'])->name('category');
Route::post('add_to_cart',[FrontController::class,'add_to_cart'])->name('add_to_cart');
Route::get('/cart',[FrontController::class,'cart'])->name('cart');
Route::get('/checkout',[FrontController::class,'checkout'])->name('checkout');
Route::post('/apply_coupon_code',[FrontController::class,'applyCouponCode'])->name('applyCouponCode');
Route::post('/remove_coupon_code',[FrontController::class,'remove_coupon_code'])->name('remove_coupon_code');
Route::post('/place_order',[FrontController::class,'place_order'])->name('place_order');
Route::get('/paypal',[FrontController::class,'paypal'])->name('paypal');
Route::get('/order_placed',[FrontController::class,'order_placed'])->name('order_placed');

Route::get('/order',[FrontController::class,'order'])->name('order');
Route::get('/order_detail/{id}',[FrontController::class,'order_detail'])->name('order_detail');

Route::get('/search/{str}',[FrontController::class,'search'])->name('search');
Route::get('/registration',[FrontController::class,'registration'])->name('registration');
Route::post('/registration_proccess',[FrontController::class,'registration_proccess'])->name('registration_proccess');
Route::get('/mail_verification/{rand_id}',[FrontController::class,'mail_verification'])->name('mail_verification');
Route::post('/login_proccess',[FrontController::class,'login_proccess'])->name('login_proccess');
Route::post('/forgot_proccess',[FrontController::class,'forgot_proccess'])->name('forgot_proccess');
Route::get('/reset_password/{rand_id}',[FrontController::class,'reset_password'])->name('reset_password');
Route::post('/reset_password_proccess',[FrontController::class,'reset_password_proccess'])->name('reset_password_proccess');
Route::post('/product_review_proccess',[FrontController::class,'product_review_proccess']);
Route::get('/contact',[FrontController::class,'contact'])->name('contact');
Route::get('/about',[FrontController::class,'about'])->name('about');
Route::post('/send_message',[FrontController::class,'send_message'])->name('send_message');
Route::post('/subscription',[FrontController::class,'subscription'])->name('subscription');
Route::get('/logout', function () {
    session()->forget('FRONT_USER_LOGIN');
    session()->forget('FRONT_USER_ID');
    session()->forget('FRONT_USER_NAME');
    session()->forget('USER_TEMP_ID');
    return redirect('/');
})->name('logout');

//payapl route
Route::get('/paypal/checkout',[PayPalController::class, 'index'])->name('paypal_call');
Route::get('/paypal/return',[PayPalController::class, 'paypalReturn'])->name('paypal_return');
Route::get('/paypal/cancel',[PayPalController::class, 'paypalCancel'])->name('paypal_cancel');
//admin route
Route::get('admin',[AdminController::class,'index'])->name('admin');
Route::post('admin/auth',[AdminController::class,'auth'])->name('admin.auth');
Route::get('admin/ozuazresetpassword',[AdminController::class,'update'])->name('admin.upassword');
Route::group(['middleware'=>'admin_auth'], function(){
    Route::get('admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', function () {
        session()->forget('Admin_login');
        session()->forget('Admin_id');
        return redirect('admin')->with('error','Logout success');
    })->name('admin.logout');

    Route::get('admin/category',[CategoryController::class,'index'])->name('admin.category');
    Route::get('admin/managecategory/{id?}',[CategoryController::class,'manage'])->name('admin.managecategory');
    Route::post('admin/managecategory_process',[CategoryController::class,'manage_process'])->name('admin.managecategory_process');
    Route::get('admin/category/status/{type}/{id}',[CategoryController::class,'status'])->name('admin.category.status');
    Route::get('admin/category/delete/{id}',[CategoryController::class,'delete'])->name('admin.category.delete');

    Route::get('admin/coupon',[CouponController::class,'index'])->name('admin.coupon');
    Route::get('admin/managecoupon/{id?}',[CouponController::class,'manage'])->name('admin.managecoupon');
    Route::post('admin/managecoupon_process',[CouponController::class,'manage_process'])->name('admin.managecoupon_process');
    Route::get('admin/coupon/status/{type}/{id}',[CouponController::class,'status'])->name('admin.coupon.status');
    Route::get('admin/coupon/delete/{id}',[CouponController::class,'delete'])->name('admin.coupon.delete');

    Route::get('admin/size',[SizeController::class,'index'])->name('admin.size');
    Route::get('admin/managesize/{id?}',[SizeController::class,'manage'])->name('admin.managesize');
    Route::post('admin/managesize_process',[SizeController::class,'manage_process'])->name('admin.managesize_process');
    Route::get('admin/size/status/{type}/{id}',[SizeController::class,'status'])->name('admin.size.status');
    Route::get('admin/size/delete/{id}',[SizeController::class,'delete'])->name('admin.size.delete');

    Route::get('admin/color',[ColorController::class,'index'])->name('admin.color');
    Route::get('admin/managecolor/{id?}',[ColorController::class,'manage'])->name('admin.managecolor');
    Route::post('admin/managecolor_process',[ColorController::class,'manage_process'])->name('admin.managecolor_process');
    Route::get('admin/color/status/{type}/{id}',[ColorController::class,'status'])->name('admin.color.status');
    Route::get('admin/color/delete/{id}',[ColorController::class,'delete'])->name('admin.color.delete');

    Route::get('admin/brand',[BrandController::class,'index'])->name('admin.brand');
    Route::get('admin/managebrand/{id?}',[BrandController::class,'manage'])->name('admin.managebrand');
    Route::post('admin/managebrand_process',[BrandController::class,'manage_process'])->name('admin.managebrand_process');
    Route::get('admin/brand/status/{type}/{id}',[BrandController::class,'status'])->name('admin.brand.status');
    Route::get('admin/brand/delete/{id}',[BrandController::class,'delete'])->name('admin.brand.delete');

    Route::get('admin/product',[ProductController::class,'index'])->name('admin.product');
    Route::get('admin/manageproduct/{id?}',[ProductController::class,'manage'])->name('admin.manageproduct');
    Route::post('admin/manageproduct_process',[ProductController::class,'manage_process'])->name('admin.manage_process');
    Route::get('admin/product/status/{type}/{id}',[ProductController::class,'status'])->name('admin.product.status');
    Route::get('admin/product/delete/{id}',[ProductController::class,'delete'])->name('admin.product.delete');
    Route::get('admin/product/productattrdelete/{pid}/{id}',[ProductController::class,'productattrdelete'])->name('admin.product.productattrdelete');
    Route::get('admin/product/productimagesdelete/{pid}/{id}',[ProductController::class,'productimagesdelete'])->name('admin.product.productimagesdelete');

    Route::get('admin/tax',[TaxController::class,'index'])->name('admin.tax');
    Route::get('admin/managetax/{id?}',[TaxController::class,'manage'])->name('admin.managetax');
    Route::post('admin/managetax_process',[TaxController::class,'manage_process'])->name('admin.managetax_process');
    Route::get('admin/tax/status/{type}/{id}',[TaxController::class,'status'])->name('admin.tax.status');
    Route::get('admin/tax/delete/{id}',[TaxController::class,'delete'])->name('admin.tax.delete');

    Route::get('admin/customer',[CustomerController::class,'index'])->name('admin.customer');
    Route::get('admin/customer/show/{id}',[CustomerController::class,'show'])->name('admin.customer.show');
    Route::get('admin/customer/status/{type}/{id}',[CustomerController::class,'status'])->name('admin.customer.status');

    Route::get('admin/order',[OrderController::class,'index'])->name('admin.order');
    Route::get('admin/home_banner',[HomeBannerController::class,'index'])->name('admin.home_banner');
    Route::get('admin/managehome_banner/{id?}',[HomeBannerController::class,'manage'])->name('admin.managehome_banner');
    Route::post('admin/managehome_banner_process',[HomeBannerController::class,'manage_process'])->name('admin.managehome_banner_process');
    Route::get('admin/home_banner/status/{type}/{id}',[HomeBannerController::class,'status'])->name('admin.home_banner.status');
    Route::get('admin/home_banner/delete/{id}',[HomeBannerController::class,'delete'])->name('admin.home_banner.delete');

    Route::get('admin/order',[OrderController::class,'index'])->name('admin.order');
    Route::get('admin/order_detail/{id}',[OrderController::class,'order_detail'])->name('admin.order_detail');
    Route::post('admin/order_detail/{id}',[OrderController::class,'update_track_detail']);
    Route::get('admin/update_payment_status/{id}/{status}',[OrderController::class,'update_payment_status']);
    Route::get('admin/update_order_status/{id}/{status}',[OrderController::class,'update_order_status']);

    Route::get('admin/product_review',[ProductReviewController::class,'product_review']);
    Route::get('admin/update_product_review_status/{id}/{status}',[ProductReviewController::class,'update_product_review_status']);
    Route::get('admin/setting',[SettingController::class,'index'])->name('admin.setting');
    Route::put('admin/setting/update',[SettingController::class,'update'])->name('admin.setting.update');
    Route::get('admin/message',[MessageController::class,'index'])->name('admin.message');
    Route::get('admin/message/view/{id}',[MessageController::class,'view'])->name('admin.message.view');
    Route::get('admin/message/delete/{id}',[MessageController::class,'delete'])->name('admin.message.delete');
    Route::get('admin/subscription',[SubscriptionController::class,'index'])->name('admin.subscription');
    Route::get('admin/subscription/delete/{id}',[SubscriptionController::class,'delete'])->name('admin.subscription.delete');
});

