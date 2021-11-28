<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $result['data']=Subscription::paginate(20);
        return view('admin.subscription',$result);
    }
    public function delete($id)
    {
        Subscription::find($id)->delete();
        return redirect('admin/subscription')->with('error','Subscription has been Deleted!');
    }
}
