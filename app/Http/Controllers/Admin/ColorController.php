<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Color;

class ColorController extends Controller
{
    public function index()
    {
        $result['data']=Color::paginate(15);
        return view('admin.color',$result);
    }

    public function manage($id='0')
    {
        if($id>0)
        {
            $arr=Color::find($id);
            $result['color']=$arr->color;
            $result['status']=$arr->status;
            $result['id']=$arr->id;
        }else{
            $result['color']='';
            $result['status']='';
            $result['id']='0';
        }
        return view('admin.managecolor',$result);
    }
    public function manage_process(Request $request)
    {
        $request->validate([
            'color'=>'required | unique:colors,color,'.$request->id,
        ]);
        if($request->id>0)
        {
            $model = Color::find($request->id);
            $msg = "Color has been Updated";
        }else
        {
            $model = new Color;
            $msg = "Color has been Inserted";
        }

        $model->color=$request->color;
        $model->status=1;
        $model->save();
        return redirect(route('admin.color'))->with('success',$msg);

    }
    public function status($type,$id)
    {
        $model = Color::find($id);
        $model->status=$type;
        $model->save();;
        return redirect('admin/color')->with('success','Color status has been Changed!');
    }
    public function delete($id)
    {
        Color::find($id)->delete();
        return redirect('admin/color')->with('error','Color has been Deleted!');
    }
}
