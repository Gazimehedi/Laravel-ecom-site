<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $result['data']=Customer::paginate(15);
        return view('admin.customer',$result);
    }

    public function show($id)
    {
        $result['info']=Customer::find($id);
        return view('admin.customer_info',$result);
    }
    public function status($type,$id)
    {
        $model = Customer::find($id);
        $model->status=$type;
        $model->save();;
        return redirect('admin/customer')->with('success','Customer status has been Changed!');
    }

    /*
    public function delete($id)
    {
        Size::find($id)->delete();
        return redirect('admin/size')->with('error','Size has been Deleted!');
    }
    */
}
