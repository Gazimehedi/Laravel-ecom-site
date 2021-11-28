<?php
use Illuminate\Support\Facades\DB;

function prx($arr){
    echo "<pre>";
    print_r($arr);
    die();
}

function getTopNavCat(){
    $result=DB::table('categories')
            ->where(['status'=>1])
            ->get();
            $arr=[];
    foreach($result as $row){
        $arr[$row->id]['city']=$row->category;
        $arr[$row->id]['parent_id']=$row->parent_category_id;
        $arr[$row->id]['category_slug']=$row->category_slug;
    }
    $str=buildTreeView($arr,0);
    return $str;
}

$html='';
function buildTreeView($arr,$parent,$level=0,$prelevel= -1){
	global $html;
	foreach($arr as $id=>$data){
		if($parent==$data['parent_id']){
			if($level>$prelevel){
				if($html==''){
					$html.='<ul class="nav navbar-nav"><li><a href="/">Home</a></li>';
				}else{
					$html.='<ul class="dropdown-menu">';
				}

			}
			if($level==$prelevel){
				$html.='</li>';
			}
			$html.='<li><a href="http://localhost:8000/category/'.$data['category_slug'].'">'.$data['city'].'<span class="caret"></span></a>';
			if($level>$prelevel){
				$prelevel=$level;
			}
			$level++;
			buildTreeView($arr,$id,$level,$prelevel);
			$level--;
		}
	}
	if($level==$prelevel){
		$html.='</li></ul>';
	}
	return $html;
}

function getUserTempId(){
	if(session()->has('USER_TEMP_ID')==null){
		$rand = rand(111111111,999999999);
		session()->put('USER_TEMP_ID',$rand);
		return $rand;
	}else{
		return session()->get('USER_TEMP_ID');
	}
}

function cartTotal(){
	if(session()->has('FRONT_USER_LOGIN')){
		$uid = session()->get('FRONT_USER_ID');
		$user_type = "Reg";
	}else{
		$uid = getUserTempId();
		$user_type = "Not-Reg";
	}
	$result = DB::table('cart')
				->leftJoin('products','products.id','=','cart.product_id')
				->leftJoin('products_attr','products_attr.id','=','cart.product_attr_id')
				->leftJoin('sizes','sizes.id','=','products_attr.size_id')
				->leftJoin('colors','colors.id','=','products_attr.color_id','sizes.size')
				->where(['user_id'=> $uid])
				->select(['cart.qty','products.id','products.name','products.slug','products.image','sizes.size','colors.color','products_attr.id as attr_id','products_attr.price'])
				->get();
	return $result;
}

function applyCouponCode($CouponCode){
	$query = DB::table('coupons')->where(['code'=>$CouponCode])->get();
        $totalPrice = 0;
        $value = 0;
        if(isset($query[0])){
            $value = $query[0]->value;
            $type = $query[0]->type;
            if($query[0]->status==1){
                if($query[0]->is_one_time==1){
                    $status = 'error';
                    $msg = 'Coupon Code allready used';
                }else{
                    $minmum_amt = $query[0]->min_order_amt;
                    if($minmum_amt>0){
                        $cartTotal = cartTotal();
                        foreach($cartTotal as $list){
                            $totalPrice=$totalPrice+($list->price*$list->qty);
                        }
                        if($minmum_amt<$totalPrice){
                            $status = 'success';
                            $msg = 'Coupon Code applied!';
                        }else{
                            $status = 'error';
                            $msg = 'Cart ammount must be grater then '.$minmum_amt;
                        }
                    }else{
                        $status = 'success';
                        $msg = 'Coupon Code applied!';
                    }
                }
            }else{
                $status = 'error';
                $msg = 'Coupon Code deactivated!';
            }
        }else{
            $status = 'error';
            $msg = 'Please enter valid Coupon Code!';
        }
        if($status=='success'){
            if($type=='value'){
                $totalPrice = $totalPrice-$value;
            }
            if($type=='per'){
                $perPrice = ($value/100)*$totalPrice;
                $totalPrice = round($totalPrice-$perPrice);
            }
        }
        return json_encode(['status'=>$status,'msg'=>$msg,'totalprice'=>$totalPrice,'coupon_code_value'=>$value]);
}
?>