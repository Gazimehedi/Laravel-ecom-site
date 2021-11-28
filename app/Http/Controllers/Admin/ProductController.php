<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function index()
    {
        $result['data'] = Product::paginate(20);
        return view('admin/product',$result);
    }

    public function manage($id='0')
    {
        $result['category']=DB::table('categories')->where('status','1')->get();
        $result['brand']=DB::table('brands')->where('status','1')->get();
        $result['color']=DB::table('colors')->where('status','1')->get();
        $result['size']=DB::table('sizes')->where('status','1')->get();
        $result['tax']=DB::table('taxes')->where('status','1')->get();
        if($id>0)
        {
            $model = Product::find($id);
            $result['name']=$model->name;
            $result['slug']=$model->slug;
            $result['image']=$model->image;
            $result['category_id']=$model->category_id;
            $result['brand_id']=$model->brand_id;
            $result['model']=$model->model;
            $result['short_desc']=$model->short_desc;
            $result['description']=$model->description;
            $result['keywords']=$model->keywords;
            $result['tecnical_specification']=$model->tecnical_specification;
            $result['uses']=$model->uses;
            $result['warranty']=$model->warranty;
            $result['lead_time']=$model->lead_time;
            $result['tax_id']=$model->tax_id;
            $result['is_promo']=$model->is_promo;
            $result['is_featured']=$model->is_featured;
            $result['is_discounted']=$model->is_discounted;
            $result['is_tranding']=$model->is_tranding;
            $result['id']=$model->id;
            $result['size_id']=$model->size_id;
            $result['attr_image']='';
            $result['color_id']=$model->color_id;
            $result['productAttrArr']= DB::table('products_attr')->where('product_id',$id)->get();
            $productImagesArr= DB::table('product_images')->where('product_id',$id)->get();

            if(!isset($productImagesArr[0])){
                $result['productImagesArr'][0]['id']='';
                $result['productImagesArr'][0]['image']='';
            }else{
                $result['productImagesArr'] = $productImagesArr;
            }
        //     echo '<pre>';
        // print_r($result['productAttrArr']);
        // die();
        }else{
            $result['name']='';
            $result['slug']='';
            $result['image']='';
            $result['category_id']='';
            $result['brand_id']='';
            $result['model']='';
            $result['short_desc']='';
            $result['description']='';
            $result['keywords']='';
            $result['tecnical_specification']='';
            $result['uses']='';
            $result['warranty']='';
            $result['lead_time']='';
            $result['tax_id']='';
            $result['is_promo']='';
            $result['is_featured']='';
            $result['is_discounted']='';
            $result['is_tranding']='';
            $result['id']='';

            $result['productAttrArr'][0]['id']='';
            $result['productAttrArr'][0]['sku']='';
            $result['productAttrArr'][0]['mrp']='';
            $result['productAttrArr'][0]['price']='';
            $result['productAttrArr'][0]['qty']='';
            $result['productAttrArr'][0]['attr_image']='';
            $result['productAttrArr'][0]['size_id']='';
            $result['productAttrArr'][0]['color_id']='';

            $result['productImagesArr'][0]['id']='';
            $result['productImagesArr'][0]['image']='';
        //     echo '<pre>';
        // print_r($result['productAttrArr']);
        // die();
        }
        return view('admin/manageProduct',$result);
    }
    public function manage_process(Request $request){
        // echo '<pre>';
        // print_r($request->post());
        // die();
        if($request->id>0)
        {
            $image_validate = "";
        }else{
            $image_validate = 'required |';
        }
        $request->validate([
            'name'=>'required',
            'slug'=>'required|unique:products,slug,'.$request->id,
            'image'=>$image_validate.'mimes:jpeg,jpg,png',
            'attr_image.*'=>'mimes:jpeg,jpg,png',
            'images.*'=>'mimes:jpeg,jpg,png',
        ]);

        $paidArr = $request->paid;
        $skuarr = $request->sku;
        $mrparr = $request->mrp;
        $pricearr = $request->price;
        $qtyarr = $request->qty;
        $size_idarr = $request->size_id;
        $color_idarr = $request->color_id;
        $old_attr_image = $request->old_attr_image;
        foreach($skuarr as $key=>$value){
            $check = DB::table('products_attr')
            ->where('sku','=',$skuarr[$key])
            ->where('id','!=',$paidArr[$key])
            ->get();
            if(isset($check[0])){
                return redirect(request()->headers->get('referer'))->with('sku_error',$skuarr[$key].' Already taken!');
            }
        }

        if($request->id>0)
        {
            $model = Product::find($request->id);
            $msg = "Product has been Updated";
        }else{
            $model = new Product;
            $msg = "Product has been Inserted";
        }
        $image_name = "";
        if($request->hasfile('image'))
        {
            if($request->id>0){
                $path = "/public/media/".$request->old_image;
                if(Storage::exists($path)){
                    Storage::delete($path);
                }
            }
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('/public/media',$image_name);
        }else{
            $image_name = $request->old_image;
        }
        $model->category_id=$request->category_id;
        $model->name=$request->name;
        $model->slug=$request->slug;
        $model->image=$image_name;
        $model->brand_id=$request->brand_id;
        $model->model=$request->model;
        $model->short_desc=$request->short_desc;
        $model->description=$request->description;
        $model->keywords=$request->keywords;
        $model->tecnical_specification=$request->tecnical_specification;
        $model->uses=$request->uses;
        $model->warranty=$request->warranty;
        $model->lead_time=$request->lead_time;
        $model->tax_id=$request->tax_id;
        $model->is_promo=$request->is_promo;
        $model->is_featured=$request->is_featured;
        $model->is_discounted=$request->is_discounted;
        $model->is_tranding=$request->is_tranding;
        $model->status=1;
        $model->save();
        $pid = $model->id;

        /*Product Attr Start*/

        foreach($skuarr as $key=>$value){
            $productattrarr['product_id']=$pid;
            $productattrarr['sku']=$value;
            $productattrarr['mrp']=$mrparr[$key];
            $productattrarr['price']=$pricearr[$key];
            $productattrarr['qty']=$qtyarr[$key];
            $productattrarr['size_id']=$size_idarr[$key];
            $productattrarr['color_id']=$color_idarr[$key];
            $productattrarr['attr_image'] = "";
            if($request->hasfile("attr_image.$key")){
                if($paidArr[$key]!=''){
                    $path = "/public/media/".$old_attr_image[$key];
                    if(Storage::exists($path)){
                        Storage::delete($path);
                    }
                }
                $attrImage = $request->file("attr_image.$key");
                $ext = $attrImage->extension();
                $attrImage_name = rand('111111111','999999999').'.'.$ext;
                $attrImage->storeAs('/public/media',$attrImage_name);
                $productattrarr['attr_image']=$attrImage_name;
            }else{
                $productattrarr['attr_image']=$old_attr_image[$key];
            }
            if($paidArr[$key]!=''){
                DB::table('products_attr')->where(['id'=>$paidArr[$key]])->update($productattrarr);
            }else{
                DB::table('products_attr')->insert($productattrarr);
            }


        }
        /*Product Attr End*/
        /*Product Images End*/
        $PIIArr = $request->piid;
        $POldIArr = $request->old_images;
        $PImagesArr['product_id']=$pid;
        foreach($PIIArr as $key=>$value){
            if($request->hasfile("images.$key")){
                if($PIIArr[$key]!=''){
                    $path = "/public/media/".$POldIArr[$key];
                    if(Storage::exists($path)){
                        Storage::delete($path);
                    }
                }

                $Images = $request->file("images.$key");
                $ext = $Images->extension();
                $Images_name = rand('111111111','999999999').'.'.$ext;
                $Images->storeAs('/public/media',$Images_name);
                $PImagesArr['image']=$Images_name;
                $PImagesArr['status']= 1;
                if($PIIArr[$key]!=''){
                    DB::table('product_images')->where(['id'=>$PIIArr[$key]])->update($PImagesArr);
                }else{
                    DB::table('product_images')->insert($PImagesArr);
                }
            }
        }

        /*Product Images End*/

        return redirect(route('admin.product'))->with('success',$msg);
    }
    public function status($type,$id)
    {
        $model = Product::find($id);
        $model->status=$type;
        $model->save();
        DB::table('products_attr')->where('product_id',$id)->delete();
        return redirect(route('admin.product'))->with('success',"Status has been Changed!");
    }
    public function productattrdelete($pid,$id)
    {
        $image_arr=DB::table('products_attr')->where('id',$id)->get();
        $path = "/public/media/".$image_arr[0]->attr_image;
        Storage::delete($path);
        DB::table('products_attr')->where('id',$id)->delete();
        return redirect(url('admin/manageproduct/'.$pid));
    }
    public function productimagesdelete($pid,$id)
    {
        $image_arr=DB::table('product_images')->where('id',$id)->get();
        $path = "/public/media/".$image_arr[0]->image;
        Storage::delete($path);
        DB::table('product_images')->where('id',$id)->delete();
        return redirect(url('admin/manageproduct/'.$pid));
    }
    public function delete($id)
    {
        $image_arr=DB::table('products')->where('id',$id)->get();
        $path = "/public/media/".$image_arr[0]->image;
        Storage::delete($path);
        Product::find($id)->delete();
        return redirect(route('admin.product'))->with('success','Product has been Deleted!');
    }
}
