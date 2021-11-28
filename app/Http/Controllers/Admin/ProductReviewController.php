<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductReviewController extends Controller
{
    public function product_review(){
        $result['data'] = DB::table('reviews')
        ->leftJoin('customers', 'customers.id', '=', 'reviews.customer_id')
        ->leftJoin('products', 'products.id', '=', 'reviews.products_id')
        ->select('reviews.*','customers.name','products.name as pname','reviews.status')
        ->paginate(15);
        return view('admin.productReview',$result);
    }
    public function update_product_review_status($id,$status)
    {
        $model = Review::find($id);
        $model->status=$status;
        $model->save();;
        return redirect('admin/product_review')->with('success','Product Review status has been Changed!');
    }
}
