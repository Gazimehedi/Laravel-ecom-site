<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Coupon;

class CouponController extends Controller
{

    public function index()
    {
        $result['data']=Coupon::paginate(15);
        return view('admin.coupon',$result);
    }

    public function manage($id='0')
    {
        if($id>0)
        {
            $arr=Coupon::find($id);
            $result['title']=$arr->title;
            $result['code']=$arr->code;
            $result['value']=$arr->value;
            $result['type']=$arr->type;
            $result['min_order_amt']=$arr->min_order_amt;
            $result['is_one_time']=$arr->is_one_time;
            $result['status']=$arr->status;
            $result['id']=$arr->id;
        }else{
            $result['title']='';
            $result['code']='';
            $result['value']='';
            $result['type']='';
            $result['min_order_amt']='';
            $result['is_one_time']='';
            $result['status']='';
            $result['id']='0';
        }
        return view('admin.managecoupon',$result);
    }
    public function manage_process(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'code'=>'required | unique:coupons,code,'.$request->id,
            'value'=>'required',
        ]);
        if($request->id>0)
        {
            $model = Coupon::find($request->id);
            $msg = "Coupon has been Updated";
        }else
        {
            $model = new Coupon;
            $msg = "Coupon has been Inserted";
        }

        $model->title=$request->title;
        $model->code=$request->code;
        $model->value=$request->value;
        $model->type=$request->type;
        $model->min_order_amt=$request->min_order_amt;
        $model->is_one_time=$request->is_one_time;
        $model->status=1;
        $model->save();
        return redirect(route('admin.coupon'))->with('success',$msg);

    }
    public function status($type,$id)
    {
        $model = Coupon::find($id);
        $model->status=$type;
        $model->save();;
        return redirect('admin/coupon')->with('success','Coupon status has been Changed!');
    }
    public function delete($id)
    {
        Coupon::find($id)->delete();
        return redirect('admin/coupon')->with('error','Coupon has been Deleted!');
    }
}
