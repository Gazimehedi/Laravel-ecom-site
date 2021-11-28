<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $result['orders'] = DB::table('orders')
                            ->leftJoin('orders_status','orders_status.id','=','orders.order_status')
                            ->select('orders.*','orders_status.orders_status')
                            ->paginate(15);
        return view('admin.orders',$result);
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
                            ->select('orders_details.price','orders_details.qty','orders.*','orders_status.orders_status','products.name as pname','products_attr.attr_image','sizes.size','colors.color')
                            ->get();
        $result['order_status'] = DB::table('orders_status')->get();
        $result['payment_status'] = ['pending','success','fail'];
        return view('admin.order_detail',$result);
    }
    public function update_payment_status($id,$status)
    {
        $result['order_details'] = DB::table('orders')
                            ->where('id',$id)
                            ->update(['payment_status'=>$status]);
        return redirect("admin/order_detail/".$id);
    }
    public function update_order_status($id,$status)
    {
        $result['order_details'] = DB::table('orders')
                            ->where('id',$id)
                            ->update(['order_status'=>$status]);
        return redirect("admin/order_detail/".$id);
    }
    public function update_track_detail(Request $request,$id)
    {
        $track_details = $request->track_details;
        $result['order_details'] = DB::table('orders')
                            ->where('id',$id)
                            ->update(['track_details'=>$track_details]);
        return redirect("admin/order_detail/".$id);
    }
}
