<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Admin;
use App\Models\Admin\Review;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Customer;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session()->has('Admin_login'))
         {
             return redirect(route('admin.dashboard'));
         }
        return view('admin/login');
    }

    function auth(Request $request)
    {
        $email=$request->email;
        // $result=Admin::where(['email'=>$email,'password'=>$password])->get();
        $result=Admin::where(['email'=>$email])->first();
        if($result)
         {
             if(Hash::check($request->password,$result->password))
             {
                $request->session()->put('Admin_login',true);
                $request->session()->put('Admin_id',$result->id);
                return redirect(route('admin.dashboard'));
             }else{
                $request->session()->flash('error','Please enter valid password!');
                return redirect(route('admin'));
             }

         }else
         {
             $request->session()->flash('error','Your email or password is wrong!');
             return redirect(route('admin'));
         }
    }

    function dashboard()
    {
        $result['customers'] = Customer::count();
        $result['products'] = Product::count();
        $result['order'] = DB::table('orders')->count();
        $result['reviews'] = Review::count();
        $result['orders'] = DB::table('orders')
        ->leftJoin('orders_status','orders_status.id','=','orders.order_status')
        ->select('orders.*','orders_status.orders_status')
        ->paginate(15);
        return view('admin.dashboard',$result);
    }
    function update()
    {
        $result = Admin::find(1);
        $result->password=Hash::make("admin");
        $result->save();
        return "<h2 style='color:green;margin-top:100px;text-align:center'>Admin Password Reset Successfully</h2><br><a style='display:block;font-size:18px;font-weight:bold;text-align:center;' href='/admin'>Login</a>";
    }

}
