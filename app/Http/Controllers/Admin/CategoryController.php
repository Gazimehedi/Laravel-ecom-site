<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

    public function index()
    {
        $result['data']=Category::paginate(10);
        return view('admin.category',$result);
    }

    public function manage($id='0')
    {
        if($id>0)
        {
            $arr=Category::find($id);
            $result['category']=$arr->category;
            $result['category_slug']=$arr->category_slug;
            $result['parent_category_id']=$arr->parent_category_id;
            $result['category_image']=$arr->category_image;
            if($arr->is_home==1){
                $result['is_home']="checked";
            }else{
                $result['is_home']='';
            }
            $result['status']=$arr->status;
            $result['id']=$arr->id;

        }else{
            $result['category']='';
            $result['category_slug']='';
            $result['parent_category_id']='';
            $result['category_image']='';
            $result['is_home']='';
            $result['status']='';
            $result['id']='0';
        }
        $result['Parent_category']=DB::table('categories')->where('status','1')->where('id','!=',$id)->get();
        return view('admin.managecategory',$result);
    }
    public function manage_process(Request $request)
    {
        $request->validate([
            'category'=>'required',
            'category_slug'=>'required|unique:categories,category_slug,'.$request->id,
            'category_image'=>'mimes:jpeg,jpg,png',
        ]);
        if($request->id>0)
        {
            $model = Category::find($request->id);
            $msg = "Category has been Updated";
        }else
        {
            $model = new Category;
            $msg = "Category has been Inserted";
        }

        if($request->hasfile('category_image'))
        {
            if($request->id>0){
                $path = "/public/media/category/".$request->old_image;
                if(Storage::exists($path)){
                    Storage::delete($path);
                }
            }
            $category_image = $request->file('category_image');
            $ext = $category_image->extension();
            $image_name = time().'.'.$ext;
            $category_image->storeAs('/public/media/category',$image_name);
        }else{
            $image_name = $request->old_image;
        }
        $model->category=$request->category;
        $model->category_slug=$request->category_slug;
        $model->parent_category_id=$request->parent_category_id;
        $model->category_image=$image_name;
        $model->is_home=0;
        if($request->is_home!=null){
            $model->is_home=1;
        }
        $model->status=1;
        $model->save();
        return redirect(route('admin.category'))->with('success',$msg);

    }
    public function status($type,$id)
    {
        $model = Category::find($id);
        $model->status=$type;
        $model->save();;
        return redirect('admin/category')->with('success','Category status has been Changed!');
    }
    public function delete($id)
    {
        $image_arr=DB::table('categories')->where('id',$id)->get();
        // return $image_arr[0]->category_image;
        // die();
        $path = "/public/media/category/".$image_arr[0]->category_image;
        Storage::delete($path);
        Category::find($id)->delete();
        return redirect('admin/category')->with('error','Category has been Deleted!');
    }
}
