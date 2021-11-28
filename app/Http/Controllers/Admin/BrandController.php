<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function index()
    {
        $result['data']=Brand::paginate(10);
        return view('admin.brand',$result);
    }

    public function manage($id='0')
    {
        if($id>0)
        {
            $arr=Brand::find($id);
            $result['name']=$arr->name;
            $result['image']=$arr->image;
            if($arr->is_home==1){
                $result['is_home']="checked";
            }else{
                $result['is_home']='';
            }
            $result['status']=$arr->status;
            $result['id']=$arr->id;
        }else{
            $result['name']='';
            $result['image']='';
            $result['is_home']='';
            $result['status']='';
            $result['id']='0';
        }
        return view('admin.managebrand',$result);
    }
    public function manage_process(Request $request)
    {
        // echo "<pre>";
        // print_r($request->post());
        // die();
        $request->validate([
            'name'=>'required | unique:brands,name,'.$request->id,
            'image'=>'mimes:jpeg,jpg,png',
        ]);
        if($request->id>0)
        {
            $model = Brand::find($request->id);
            $msg = "Brand has been Updated";
        }else
        {
            $model = new Brand;
            $msg = "Brand has been Inserted";
        }
        $image_name = "";
        if($request->hasfile('image'))
        {
            if($request->id>0){
                $path = "/public/media/brand/".$request->old_image;
                if(Storage::exists($path)){
                    Storage::delete($path);
                }
            }
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('/public/media/brand',$image_name);
        }else{
            $image_name = $request->old_image;
        }

        $model->name=$request->name;
        $model->image=$image_name;
        $model->is_home=0;
        if($request->is_home!=null){
            $model->is_home=1;
        }
        $model->status=1;
        $model->save();
        return redirect(route('admin.brand'))->with('success',$msg);

    }
    public function status($type,$id)
    {
        $model = Brand::find($id);
        $model->status=$type;
        $model->save();;
        return redirect('admin/brand')->with('success','Brand status has been Changed!');
    }
    public function delete($id)
    {
        $image_arr=DB::table('brands')->where('id',$id)->get();
        $path = "/public/media/brand/".$image_arr[0]->image;
        Storage::delete($path);
        Brand::find($id)->delete();
        return redirect('admin/brand')->with('error','Brand has been Deleted!');
    }
}
