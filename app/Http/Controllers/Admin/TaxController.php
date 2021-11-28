<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Tax;

class TaxController extends Controller
{
    //
    public function index()
    {
        $result['data']=Tax::all();
        return view('admin.tax',$result);
    }
    
    public function manage($id='0')
    {
        if($id>0)
        {
            $arr=Tax::find($id);
            $result['tax_value']=$arr->tax_value;
            $result['tax_desc']=$arr->tax_desc;
            $result['status']=$arr->status;
            $result['id']=$arr->id;
        }else{
            $result['tax_value']='';
            $result['tax_desc']='';
            $result['status']='';
            $result['id']='0';
        }
        return view('admin.managetax',$result);
    }
    public function manage_process(Request $request)
    {
        $request->validate([
            'tax_value'=>'required',
            'tax_desc'=>'required | unique:taxes,tax_desc,'.$request->id,
        ]);
        if($request->id>0)
        {
            $model = Tax::find($request->id);
            $msg = "Tax has been Updated";
        }else
        {
            $model = new Tax;
            $msg = "Tax has been Inserted";
        }
        
        $model->tax_value=$request->tax_value;
        $model->tax_desc=$request->tax_desc;
        $model->status=1;
        $model->save();
        return redirect(route('admin.tax'))->with('success',$msg);

    }
    public function status($type,$id)
    {
        $model = Tax::find($id);
        $model->status=$type;
        $model->save();;
        return redirect('admin/tax')->with('success','Tax status has been Changed!');
    }
    public function delete($id)
    {
        Tax::find($id)->delete();
        return redirect('admin/tax')->with('error','Tax has been Deleted!');
    }
}
