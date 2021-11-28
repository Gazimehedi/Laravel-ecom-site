<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\HomeBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class HomeBannerController extends Controller
{
    
    public function index()
    {
        $result['data']=HomeBanner::all();
        return view('admin.home_banner',$result);
    }
    
    public function manage($id='0')
    {
        if($id>0)
        {
            $arr=HomeBanner::find($id);
            $result['title']=$arr->title;
            $result['sub_title']=$arr->sub_title;
            $result['btn_text']=$arr->btn_text;
            $result['btn_link']=$arr->btn_link;
            $result['image']=$arr->image;
            $result['status']=$arr->status;
            $result['id']=$arr->id;
            
        }else{
            $result['title']='';
            $result['sub_title']='';
            $result['btn_text']='';
            $result['btn_link']='';
            $result['image']='';
            $result['status']='';
            $result['id']=0;
        }
        return view('admin.managehome_banner',$result);
    }
    public function manage_process(Request $request)
    {
        $request->validate([
            'image'=>'mimes:jpeg,jpg,png',
        ]);
        if($request->id>0)
        {
            $model = HomeBanner::find($request->id);
            $msg = "Banner has been Updated";
        }else
        {
            $model = new HomeBanner;
            $msg = "Banner has been Inserted";
        }
        
        if($request->hasfile('image'))
        {
            if($request->id>0){
                $path = "/public/media/banner/".$request->old_image;
                if(Storage::exists($path)){
                    Storage::delete($path);
                }
            }
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('/public/media/banner',$image_name);
        }else{
            $image_name = $request->old_image;
        }
        $model->image=$image_name;
        $model->title=$request->title;
        $model->sub_title=$request->sub_title;
        $model->btn_text=$request->btn_text;
        $model->btn_link=$request->btn_link;
        $model->status=1;
        $model->save();
        return redirect(route('admin.home_banner'))->with('success',$msg);

    }
    public function status($type,$id)
    {
        $model = HomeBanner::find($id);
        $model->status=$type;
        $model->save();;
        return redirect('admin/home_banner')->with('success','Banner status has been Changed!');
    }
    public function delete($id)
    {
        $image_arr=DB::table('home_banners')->where('id',$id)->get();
        // return $image_arr[0]->category_image;
        // die();
        $path = "/public/media/category/".$image_arr[0]->image;
        Storage::delete($path);
        HomeBanner::find($id)->delete();
        return redirect('admin/home_banner')->with('error','Banner has been Deleted!');
    }
}
