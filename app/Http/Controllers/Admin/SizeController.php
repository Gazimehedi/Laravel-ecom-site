<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Size;

class SizeController extends Controller
{
    public function index()
    {
        $result['data']=Size::paginate(20);
        return view('admin.size',$result);
    }

    public function manage($id='0')
    {
        if($id>0)
        {
            $arr=Size::find($id);
            $result['size']=$arr->size;
            $result['status']=$arr->status;
            $result['id']=$arr->id;
        }else{
            $result['size']='';
            $result['status']='';
            $result['id']='0';
        }
        return view('admin.managesize',$result);
    }
    public function manage_process(Request $request)
    {
        $request->validate([
            'size'=>'required | unique:sizes,size,'.$request->id,
        ]);
        if($request->id>0)
        {
            $model = Size::find($request->id);
            $msg = "Size has been Updated";
        }else
        {
            $model = new Size;
            $msg = "Size has been Inserted";
        }

        $model->size=$request->size;
        $model->status=1;
        $model->save();
        return redirect(route('admin.size'))->with('success',$msg);

    }
    public function status($type,$id)
    {
        $model = Size::find($id);
        $model->status=$type;
        $model->save();;
        return redirect('admin/size')->with('success','Size status has been Changed!');
    }
    public function delete($id)
    {
        Size::find($id)->delete();
        return redirect('admin/size')->with('error','Size has been Deleted!');
    }
}
