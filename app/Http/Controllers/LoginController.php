<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;

class LoginController extends Controller
{

    public function login(Request $request){
        if(!$request->has('open_id')||$request->open_id==''){
           return  self::setResponse(null,400,-4007);
        }
        $open_id = $request->open_id;
        //open_id与user_id都是用来区别用户的唯一字段
        if($user = User::where('open_id','=',$open_id)->first()){
            $address = Address::where('user_id','=',$user->user_id);
            $orders = Order::where('user_id','=',$user->user_id);
            $data = array(
                'user_id'=>''.$user->user_id,
                'headimg_url'=>$user->headimg_url,
                'addresses'=>$address,
                'orders'=>$orders,
                'phone'=>$user->phone,
            );
           return self::setResponse($data,200,0);
            //未注册
        }else{
            return self::setResponse(null,200,-4002);
        }
    }
}
