<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
       return view('admin.setting',compact('setting'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'site_name'=>'required|max:50',
            'site_logo'=>'mimes:jpg,png,jpeg',
            'footer_info'=>'required|max:250',
        ]);
        $setting = Setting::first();
        if($request->hasfile('site_logo'))
        {
            $path = "/public/media/setting/".$setting->site_logo;
            if(Storage::exists($path)){
                Storage::delete($path);
            }
            $image = $request->file('site_logo');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('/public/media/setting/',$image_name);
            $setting->site_logo = $image_name;
        }
        $setting->site_name = $request->site_name;
        $setting->email = $request->email;
        $setting->mobile = $request->mobile;
        $setting->address = $request->address;
        $setting->description = $request->description;
        $setting->fb_url = $request->fb_url;
        $setting->ig_url = $request->ig_url;
        $setting->tw_url = $request->tw_url;
        $setting->yt_url = $request->yt_url;
        $setting->footer_info = $request->footer_info;
        $setting->save();
        return redirect()->route('admin.setting')->with('success','Setting updated successfully');
    }
}
