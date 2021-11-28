<?php

namespace App\Http\Controllers\Front;

use Auth;

use Illuminate\Http\Request;
use App\Models\Admin\Message;
use App\Models\Admin\Subscription;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{
    public function index()
    {
        $result['home_categories'] =
            DB::table('categories')
            ->where(['status' => 1, 'is_home' => 1])
            ->get();
        $result['home_cat'] =
            DB::table('categories')
            ->where(['status' => 1, 'is_home' => 1])
            ->get();
        $result['categoryFirst'] = $result['home_cat']->splice(0,1);
        $result['categoryFour'] = $result['home_cat']->splice(0,4);
        foreach ($result['home_categories'] as $list) {
            $result['home_categories_product'][$list->id] =
                DB::table('products')
                ->where(['status' => 1, 'category_id' => $list->id])
                ->get();
            foreach ($result['home_categories_product'][$list->id] as $list1) {
                $result['home_product_attr'][$list1->id] =
                    DB::table('products_attr')
                    ->leftJoin('sizes', 'sizes.id', '=', 'products_attr.size_id')
                    ->leftJoin('colors', 'colors.id', '=', 'products_attr.color_id')
                    ->where(['products_attr.product_id' => $list1->id])
                    ->get();
            }
        }
        $result['home_brand'] =
            DB::table('brands')
            ->where(['status' => 1, 'is_home' => 1])
            ->get();

        $result['home_featured_product'][$list->id] =
            DB::table('products')
            ->where(['status' => 1, 'is_featured' => 1])
            ->get();
        foreach ($result['home_featured_product'][$list->id] as $list1) {
            $result['home_featured_attr'][$list1->id] =
                DB::table('products_attr')
                ->leftJoin('sizes', 'sizes.id', '=', 'products_attr.size_id')
                ->leftJoin('colors', 'colors.id', '=', 'products_attr.color_id')
                ->where(['products_attr.product_id' => $list1->id])
                ->get();
        }
        $result['home_tranding_product'][$list->id] =
            DB::table('products')
            ->where(['status' => 1, 'is_tranding' => 1])
            ->get();
        foreach ($result['home_tranding_product'][$list->id] as $list1) {
            $result['home_tranding_attr'][$list1->id] =
                DB::table('products_attr')
                ->leftJoin('sizes', 'sizes.id', '=', 'products_attr.size_id')
                ->leftJoin('colors', 'colors.id', '=', 'products_attr.color_id')
                ->where(['products_attr.product_id' => $list1->id])
                ->get();
        }
        $result['home_discounted_product'][$list->id] =
            DB::table('products')
            ->where(['status' => 1, 'is_discounted' => 1])
            ->get();
        foreach ($result['home_discounted_product'][$list->id] as $list1) {
            $result['home_discounted_attr'][$list1->id] =
                DB::table('products_attr')
                ->leftJoin('sizes', 'sizes.id', '=', 'products_attr.size_id')
                ->leftJoin('colors', 'colors.id', '=', 'products_attr.color_id')
                ->where(['products_attr.product_id' => $list1->id])
                ->get();
        }
        $result['home_banner'] =
            DB::table('home_banners')
            ->where(['status' => 1])
            ->get();
        // echo '<pre>';
        // print_r($result);
        // die();
        return view('front.index', $result);
    }
    public function product($slug)
    {
        $result['home_product'] =
            DB::table('products')
            ->where(['slug' => $slug, 'status' => 1])
            ->get();
        foreach ($result['home_product'] as $list1) {
            $result['product_attr'] =
                DB::table('products_attr')
                ->leftJoin('sizes', 'sizes.id', '=', 'products_attr.size_id')
                ->leftJoin('colors', 'colors.id', '=', 'products_attr.color_id')
                ->where(['products_attr.product_id' => $list1->id])
                ->get();
        }
        foreach ($result['home_product'] as $list1) {
            $result['product_images'] =
                DB::table('product_images')
                ->where(['product_images.product_id' => $list1->id])
                ->get();
        }

        $result['home_related_product'] =
            DB::table('products')
            ->where('id', '!=', $list1->id)
            ->where(['category_id' => $list1->category_id, 'status' => 1])
            ->get();
        foreach ($result['home_related_product'] as $list1) {
            $result['related_product_attr'] =
                DB::table('products_attr')
                ->leftJoin('sizes', 'sizes.id', '=', 'products_attr.size_id')
                ->leftJoin('colors', 'colors.id', '=', 'products_attr.color_id')
                ->where(['products_attr.product_id' => $list1->id])
                ->get();
        }
        $result['reviews'] = DB::table('reviews')
        ->where('reviews.status',1)
        ->where('reviews.products_id',$result['home_product'][0]->id)
        ->leftJoin('customers', 'customers.id', '=', 'reviews.customer_id')
        ->leftJoin('products', 'products.id', '=', 'reviews.products_id')
        ->select('reviews.*','customers.name','products.name as pname')
        ->get();
        return view('front.product', $result);
    }
    public function add_to_cart(Request $request)
    {
        if ($request->session()->has('FRONT_USER_LOGIN')) {
            $uid = $request->session()->get('FRONT_USER_ID');
            $user_type = "Reg";
        } else {
            $uid = getUserTempId();
            $user_type = "Not-Reg";
        }
        $product_id = $request->product_id;
        $qty = $request->pqty;
        $size = $request->size_id;
        $color = $request->color_id;
        $result =  DB::table('products_attr')
            ->select('products_attr.id', 'products_attr.product_id')
            ->leftJoin('sizes', 'sizes.id', '=', 'products_attr.size_id')
            ->leftJoin('colors', 'colors.id', '=', 'products_attr.color_id')
            ->where(['products_attr.product_id' => $product_id])
            ->where(['sizes.size' => $size])
            ->where(['colors.color' => $color])
            ->get();
        $product_attr_id = $result[0]->id;
        $check = DB::table('cart')
            ->where([
                'user_id' => $uid,
                'user_type' => $user_type,
                'product_id' => $product_id,
                'product_attr_id' => $product_attr_id
            ])
            ->get();
        if (isset($check[0])) {
            $cart_id = $check[0]->id;
            if ($qty != 0) {
                DB::table('cart')
                    ->where(['id' => $cart_id])
                    ->update(['qty' => $qty]);
                $msg = "updated";
            } else {
                DB::table('cart')
                    ->where(['id' => $cart_id])
                    ->delete();
                $msg = "deleted";
            }
        } else {
            DB::table('cart')->insertGetId([
                'user_id' => $uid,
                'user_type' => $user_type,
                'qty' => $qty,
                'product_id' => $product_id,
                'product_attr_id' => $product_attr_id,
                'added_on' => date('Y-m-d h:i:s')
            ]);
            $msg = "added";
        }
        $result = DB::table('cart')
            ->leftJoin('products', 'products.id', '=', 'cart.product_id')
            ->leftJoin('products_attr', 'products_attr.id', '=', 'cart.product_attr_id')
            ->leftJoin('sizes', 'sizes.id', '=', 'products_attr.size_id')
            ->leftJoin('colors', 'colors.id', '=', 'products_attr.color_id', 'sizes.size')
            ->where(['user_id' => $uid])
            ->select(['cart.qty', 'products.id', 'products.name', 'products.slug', 'products.image', 'sizes.size', 'colors.color', 'products_attr.id as attr_id', 'products_attr.price'])
            ->get();
        return response()->json(['msg' => $msg, 'data' => $result, 'totalCart' => count($result)]);
    }
    public function cart(Request $request)
    {
        if ($request->session()->has('FRONT_USER_LOGIN')) {
            $uid = $request->session()->get('FRONT_USER_ID');
            $user_type = "Reg";
        } else {
            $uid = getUserTempId();
            $user_type = "Not-Reg";
        }
        $result['carts'] = DB::table('cart')
            ->leftJoin('products', 'products.id', '=', 'cart.product_id')
            ->leftJoin('products_attr', 'products_attr.id', '=', 'cart.product_attr_id')
            ->leftJoin('sizes', 'sizes.id', '=', 'products_attr.size_id')
            ->leftJoin('colors', 'colors.id', '=', 'products_attr.color_id', 'sizes.size')
            ->where(['user_id' => $uid])
            ->select(['cart.qty', 'products.id', 'products.name', 'products.slug', 'products.image', 'sizes.size', 'colors.color', 'products_attr.id as attr_id', 'products_attr.price'])
            ->get();
        return view('front.cart', $result);
    }
    public function category(Request $request, $slug)
    {
        $sort_by = '';
        $sort = '';
        $sort_txt = '';
        if ($request->sort_by !== null) {
            $sort_by = $request->sort_by;
        }
        $price_filter_start = '';
        $price_filter_end = '';
        $color_filter = '';
        $colorArr = [];
        $query = DB::table('products');
        $query = $query->leftJoin('categories', 'categories.id', '=', 'products.category_id');
        $query = $query->leftJoin('products_attr', 'products_attr.product_id', '=', 'products.id');
        $query = $query->where(['products.status' => 1, 'categories.category_slug' => $slug]);
        if ($price_filter_start !== null && $price_filter_end !== null) {
            $price_filter_start = $request->price_filter_start;
            $price_filter_end = $request->price_filter_end;
            if ($price_filter_start > 0 && $price_filter_end > 0) {
                $query = $query->whereBetween('products_attr.price', [$price_filter_start, $price_filter_end]);
            }
        }
        if ($request->color_filter !== null) {
            $color_filter = $request->color_filter;
            $colorArr = explode(':', $color_filter);
            $colorArr = array_filter($colorArr);
            $query = $query->where(['products_attr.color_id' => $color_filter]);
        }
        $query = $query->distinct()->select(['products.id', 'products.name', 'products.slug', 'products.image']);
        if ($sort_by == 'name') {
            $query = $query->orderBy('products.name', 'asc');
            $sort = 'name';
            $sort_txt = 'Product Name';
        }
        if ($sort_by == 'date') {
            $query = $query->orderBy('products.id', 'desc');
            $sort = 'date';
            $sort_txt = 'Date';
        }
        if ($sort_by == 'price_desc') {
            $query = $query->orderBy('products_attr.price', 'desc');
            $sort = 'price_desc';
            $sort_txt = 'Date - DESC';
        }
        if ($sort_by == 'price_asc') {
            $query = $query->orderBy('products_attr.price', 'asc');
            $sort = 'price_asc';
            $sort_txt = 'Date - ASC';
        }
        $query = $query->paginate(9);
        $result['category_product'] = $query;
        foreach ($result['category_product'] as $list1) {
            $result['product_attr'][$list1->id] =
                DB::table('products_attr')
                ->leftJoin('sizes', 'sizes.id', '=', 'products_attr.size_id')
                ->leftJoin('colors', 'colors.id', '=', 'products_attr.color_id')
                ->where(['products_attr.product_id' => $list1->id])
                ->get();
        }
        $result['colors'] = DB::table('colors')->where(['status' => 1])->get();
        $result['left_categories'] = DB::table('categories')->where(['status' => 1])->get();
        $result['sort'] = $sort;
        $result['sort_txt'] = $sort_txt;
        $result['price_filter_start'] = $price_filter_start;
        $result['price_filter_end'] = $price_filter_end;
        $result['color_filter'] = $color_filter;
        $result['colorArr'] = $colorArr;
        $result['cat_slug'] = $slug;
        $result['catgory'] = DB::table('categories')->where(['category_slug' => $slug])->get();

        return view('front.category', $result);
    }

    public function search(Request $request, $str)
    {
        $query = DB::table('products');
        $query = $query->where(['status' => 1]);
        $query = $query->where('name', 'like', "%$str%");
        $query = $query->orwhere('model', 'like', "%$str%");
        $query = $query->orwhere('short_desc', 'like', "%$str%");
        $query = $query->orwhere('description', 'like', "%$str%");
        $query = $query->orwhere('keywords', 'like', "%$str%");
        $query = $query->orwhere('tecnical_specification', 'like', "%$str%");
        $query = $query->distinct()->select(['products.*']);
        $query = $query->paginate(12);
        $result['search_product'] = $query;
        foreach ($result['search_product'] as $list1) {
            $result['product_attr'][$list1->id] =
                DB::table('products_attr')
                ->leftJoin('sizes', 'sizes.id', '=', 'products_attr.size_id')
                ->leftJoin('colors', 'colors.id', '=', 'products_attr.color_id')
                ->where(['products_attr.product_id' => $list1->id])
                ->get();
        }
        $result['search_str'] = $str;
        return view('front.search', $result);
    }

    public function registration()
    {
        if (session()->has('FRONT_USER_LOGIN')) {
            return redirect('/');
        }
        return view('front.registration');
    }
    public function registration_proccess(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required',
            'mobile' => 'required|numeric|digits:11'
        ]);
        if (!$valid->passes()) {
            return response()->json(['status' => 'error', 'error' => $valid->errors()]);
        } else {
            $rand_id = rand(111111111, 999999999);
            $arr = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Crypt::encrypt($request->password),
                'mobile' => $request->mobile,
                'status' => 1,
                'rand_id' => $rand_id,
                'is_verify' => 0,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ];
            $query = DB::table('customers')->insert($arr);
            if ($query) {
                $info = DB::table('customers')->where(['rand_id' => $rand_id])->get();
                $data = ['name' => $info[0]->name, 'rand_id' => $info[0]->rand_id];
                $user['to'] = $info[0]->email;
                Mail::send('front/mail', $data, function ($message) use ($user) {
                    $message->to($user['to']);
                    $message->subject('Email Verification');
                });

                return response()->json(['status' => 'success', 'msg' => 'Registration Successfully. Please check your email for verification']);
            }
        }
    }

    public function login_proccess(Request $request)
    {
        $query = DB::table('customers')->where(['email' => $request->login_email])->get();
        if (isset($query[0])) {
            $db_pwd = Crypt::decrypt($query[0]->password);
            $status = $query[0]->status;
            $is_verify = $query[0]->is_verify;
            if ($status == 0) {
                return response()->json(['status' => 'error', 'msg' => 'Your account has been deactivated']);
            }
            if ($is_verify == 0) {
                return response()->json(['status' => 'error', 'msg' => 'Please verify your email id']);
            }
            if ($db_pwd == $request->login_password) {
                if ($request->rememberme == null) {
                    setcookie('LOGIN_EMAIL', $request->login_email, 100);
                    setcookie('LOGIN_PASSWORD', $request->login_password, 100);
                } else {
                    setcookie('LOGIN_EMAIL', $request->login_email, time() + 60 * 60 * 24 * 100);
                    setcookie('LOGIN_PASSWORD', $request->login_password, time() + 60 * 60 * 24 * 100);
                }
                $request->session()->put('FRONT_USER_LOGIN', true);
                $request->session()->put('FRONT_USER_ID', $query[0]->id);
                $request->session()->put('FRONT_USER_NAME', $query[0]->name);
                $status = 'success';
                $msg = 'Login successfully';
                $temp_id = getUserTempId();
                DB::table('cart')
                    ->where(['user_id' => $temp_id, 'user_type' => 'Not-Reg'])
                    ->update(['user_id' => $query[0]->id, 'user_type' => 'Reg']);
            } else {
                $status = 'error';
                $msg = 'Please enter correct password!';
            }
        } else {
            $status = 'error';
            $msg = 'Please enter valid email!';
        }
        return response()->json(['status' => $status, 'msg' => $msg]);
    }
    public function mail_verification(Request $request, $rand_id)
    {
        $query = DB::table('customers')->where(['rand_id' => $rand_id])->get();
        if (isset($query[0])) {
            DB::table('customers')
                ->where(['id' => $query[0]->id])
                ->update(['rand_id' => rand(111111111, 999999999), 'is_verify' => 1]);
            return view('front.verification');
        } else {
            return redirect('/');
        }
    }
    public function forgot_proccess(Request $request)
    {
        $rand_id = rand(111111111, 999999999);
        $result = DB::table('customers')->where(['email' => $request->forgot_email])->get();
        if (isset($result[0])) {
            $query = DB::table('customers')
                ->where(['email' => $result[0]->email])
                ->update(['rand_id' => $rand_id, 'is_forgot_req' => 1]);
            $data = ['name' => $result[0]->name, 'rand_id' => $rand_id];
            $user['to'] = $result[0]->email;
            $send = Mail::send('front/forgot_mail', $data, function ($message) use ($user) {
                $message->to($user['to']);
                $message->subject('Forgot Password');
            });
            return response()->json(['status' => 'success', 'msg' => 'Check your email for reset password']);
        } else {
            $status = 'error';
            $msg = 'Email id not register!';
        }
        return response()->json(['status' => $status, 'msg' => $msg]);
    }

    public function reset_password(Request $request, $rand_id)
    {
        $result = DB::table('customers')->where(['rand_id' => $rand_id, 'is_forgot_req' => 1])->get();
        if (isset($result[0])) {
            $request->session()->put('RESET_USER_ID', $result[0]->id);
            return view('front.reset_password');
        } else {
            return redirect('/');
        }
    }
    public function reset_password_proccess(Request $request)
    {
        $id = $request->session()->get('RESET_USER_ID');
        DB::table('customers')
            ->where(['id' => $id])
            ->update(['password' => Crypt::encrypt($request->password), 'rand_id' => 0, 'is_forgot_req' => 0]);
        return response()->json(['status' => 'success', 'msg' => 'Password changed']);
    }
    public function checkout(Request $request)
    {
        $result['cart_data'] = cartTotal();
        if ($request->session()->has('FRONT_USER_LOGIN')) {
            $uid = $request->session()->get('FRONT_USER_ID');
            $customer_info = DB::table('customers')->where(['id' => $uid])->get();
            $result['customer']['name'] = $customer_info[0]->name;
            $result['customer']['email'] = $customer_info[0]->email;
            $result['customer']['mobile'] = $customer_info[0]->mobile;
            $result['customer']['address'] = $customer_info[0]->address;
            $result['customer']['city'] = $customer_info[0]->city;
            $result['customer']['state'] = $customer_info[0]->state;
            $result['customer']['zip'] = $customer_info[0]->zip;
        } else {
            $result['customer']['name'] = '';
            $result['customer']['email'] = '';
            $result['customer']['mobile'] = '';
            $result['customer']['address'] = '';
            $result['customer']['city'] = '';
            $result['customer']['state'] = '';
            $result['customer']['zip'] = '';
        }
        if (isset($result['cart_data'][0])) {
            return view('front.checkout', $result);
        } else {
            return redirect('/');
        }
    }

    public function applyCouponCode(Request $request)
    {
        $arr = applyCouponCode($request->coupon_code);
        $arr = json_decode($arr, true);
        return response()->json(['status' => $arr['status'], 'msg' => $arr['msg'], 'totalprice' => $arr['totalprice']]);
    }

    public function remove_coupon_code(Request $request)
    {
        $query = DB::table('coupons')->where(['code' => $request->coupon_code])->get();
        $totalPrice = 0;
        $cartTotal = cartTotal();
        foreach ($cartTotal as $list) {
            $totalPrice = $totalPrice + ($list->price * $list->qty);
        }

        return response()->json(['status' => 'success', 'msg' => 'Coupon Code removed', 'totalprice' => $totalPrice]);
    }

    public function place_order(Request $request)
    {

        $payment_url = '';
        if ($request->session()->has('FRONT_USER_LOGIN')) {
        } else {
            $valid = Validator::make($request->all(), [
                'email' => 'required|email|unique:customers,email'
            ]);
            if (!$valid->passes()) {
                return response()->json(['status' => 'error', 'msg' => "Please Login"]);
            } else {
                $rand_id = rand(111111111, 999999999);
                $arr = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip' => $request->zip,
                    'password' => Crypt::encrypt($rand_id),
                    'mobile' => $request->mobile,
                    'status' => 1,
                    'rand_id' => 0,
                    'is_verify' => 1,
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s'),
                    'is_forgot_req' => '0'
                ];
                $user_id = DB::table('customers')->insertGetId($arr);
                $request->session()->put('FRONT_USER_LOGIN', true);
                $request->session()->put('FRONT_USER_ID', $user_id);
                $request->session()->put('FRONT_USER_NAME', $request->name);
                $temp_id = getUserTempId();
                DB::table('cart')
                    ->where(['user_id' => $temp_id, 'user_type' => 'Not-Reg'])
                    ->update(['user_id' => $user_id, 'user_type' => 'Reg']);
            }
        }
        $uid = $request->session()->get('FRONT_USER_ID');
        $totalPrice = 0;
        $cartTotal = cartTotal();
        foreach ($cartTotal as $list) {
            $totalPrice = $totalPrice + ($list->price * $list->qty);
        }
        $coupon_code = '';
        $coupon_value = 0;
        if ($request->coupon_code != '') {
            $arr = applyCouponCode($request->coupon_code);
            $arr = json_decode($arr, true);
            if ($arr['status'] == 'success') {
                $totalPrice = $arr['totalprice'];
                $coupon_value = $arr['coupon_code_value'];
                $request->session()->put('totalprice', $totalPrice);
            } else {
                return response()->json(['status' => 'error', 'msg' => $arr['msg']]);
            }
        } else {
            $request->session()->put('totalprice', $totalPrice);
        }
        $arr = [
            'customers_id' => $uid,
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'coupon_code' => $request->coupon_code,
            'coupon_value' => $coupon_value,
            'order_status' => 1,
            'payment_type' => $request->payment_type,
            'payment_status' => 'pending',
            'payment_id' => 0,
            'total_amt' => $totalPrice,
            'added_on' => date('Y-m-d h:i:s')
        ];
        $order_id = DB::table('orders')->insertGetId($arr);
        if ($request->payment_type == 'Gateway') {
            $payment_url = '/paypal/checkout';
        }
        if ($request->payment_type == 'COD') {
            $payment_url = '/order_placed';
        }
        if ($order_id > 0) {
            foreach ($cartTotal as $list) {
                $order_detail_arr = [
                    'orders_id' => $order_id,
                    'product_id' => $list->id,
                    'products_attr_id' => $list->attr_id,
                    'price' => $list->price,
                    'qty' => $list->qty,
                ];
                DB::table('orders_details')->insert($order_detail_arr);
            }
            DB::table('cart')->where(['user_id' => $uid, 'user_type' => 'Reg'])->delete();
            $status = "success";
            $msg = "Order placed";
            $request->session()->put('ORDER_ID', $order_id);
        } else {
            $status = "error";
            $msg = "Please try agin sometime latter";
        }

        return response()->json(['status' => $status, 'msg' => $msg, 'payment_url' => $payment_url]);
    }

    public function order_placed(Request $request)
    {
        if ($request->session()->has('ORDER_ID')) {
            return view('front.order_placed');
        } else {
            return redirect('/');
        }
    }
    public function order()
    {
        $result['orders'] = DB::table('orders')
                            ->leftJoin('orders_status','orders_status.id','=','orders.order_status')
                            ->where('customers_id',session('FRONT_USER_ID'))
                            ->select('orders.*','orders_status.orders_status')
                            ->get();
                            //prx($result['orders']);
        return view('front.order',$result);
    }
    public function order_detail($id)
    {
        $result['order_details'] = DB::table('orders_details')
                            ->leftJoin('orders','orders.id','=','orders_details.orders_id')
                            ->leftJoin('orders_status','orders_status.id','=','orders.order_status')
                            ->leftJoin('products','products.id','=','orders_details.product_id')
                            ->leftJoin('products_attr','products_attr.id','=','orders_details.products_attr_id')
                            ->leftJoin('sizes', 'sizes.id', '=', 'products_attr.size_id')
                            ->leftJoin('colors', 'colors.id', '=', 'products_attr.color_id')
                            ->where('orders_details.orders_id',$id)
                            ->where('orders.customers_id',session('FRONT_USER_ID'))
                            ->select('orders_details.price','orders_details.qty','orders.*','orders_status.orders_status','products.name as pname','products_attr.attr_image','sizes.size','colors.color')
                            ->get();
                            if(!isset($result['order_details'][0])){
                                return redirect('/');
                            }
        return view('front.order_detail',$result);
    }
    public function product_review_proccess(Request $request)
    {
        // $date = date('Y-m-d h:i:s');
        // return $date;
        if ($request->session()->has('FRONT_USER_LOGIN')) {
            $uid = $request->session()->get('FRONT_USER_ID');
            DB::table('reviews')->insert([
                'customer_id'=>$uid,
                'products_id'=>$request->products_id,
                'rating'=>$request->rating,
                'review'=>$request->review,
                'created_at'=>date('Y-m-d h:i:s')
            ]);
            $status = "success";
            $msg = 'Review send successful';
        } else {
            $status = "error";
            $msg = "Please login to send review";
        }
        return response()->json(['status' => $status, 'msg' => $msg]);
    }
    public function contact()
    {
       return view('front.contact');
    }
    public function send_message(Request $request)
    {
        $request->validate([
            'name'=>'required|max:50',
            'email'=>'required|max:50',
            'subject'=>'required|max:250',
            'message'=>'required|min:100',
        ]);
        Message::create($request->all());
       return redirect()->route('contact')->with('success','Message send successfully');
    }
    public function about()
    {
       return view('front.about');
    }
    public function subscription(Request $request)
    {
        $request->validate([
            'email'=>'required|max:50'
        ]);
        Subscription::create($request->all());
       return redirect('/')->with('success','Subscription send successfully');
    }



    // if($request->session()->has('ORDER_ID')){
    //     $result['order'] = DB::table('orders')
    //         ->leftJoin('orders_details','orders_details.orders_id','=','orders.id')
    //         ->where(['orders.id'=>$request->session()->has('ORDER_ID')])
    //         ->select('orders.*','orders_details.price','orders_details.qty')
    //         ->get();
    // }

}
