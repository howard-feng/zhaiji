<?php

namespace App\Http\Controllers;

use http\Env\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function setResponse($data, $status, $errcode)
    {
        $body = array(
            'errcode' => $errcode,
            'status' => $status,
            'errmsg' => self::__getErrMsg($errcode),
            'data' => $data
        );
        $response = new Response($body);
        return $response->setStatusCode($status);
    }

    // 解析路由路径中的参数
    public function route_parameter($name, $default = null)
    {
        $routeInfo = app('request')->route();
        return array_get($routeInfo[2], $name, $default);
    }


    // errcode 对应的 errmsg
    protected static function __getErrMsg($errcode)
    {
        $msgForCode = [
            // 通用部分
            0 => '请求成功',
            -4001 => '缺失参数',
            -4002 => '用户未注册',
            -4003 => '手机号已注册',
            -4004 => '微信号已注册',
            -4005 => '注册失败',
            -4006 => '修改失败',
            -4007 => 'open_id参数错误',
            -4008 => 'user_id参数错误',
            -4009 => 'address_id参数错误',
            -4010 => 'express_id参数错误',
            -4011 => 'package_id参数错误',
            -4012 => 'insurance参数错误',
            -4013 => 'package_size参数错误',
            -4014 => 'status参数错误',
            -4015 => 'phone参数错误',
            -4016 => 'province参数错误',
            -4017 => 'city参数错误',
            -4018 => 'town参数错误',
            -4019 => 'address_detail参数错误',
            -4020 => '添加失败',
            -4021 => '删除失败',
            -4021 => '删除失败',

        ];
        return $msgForCode[$errcode];
    }

    //判断请求参数是否合格 有一个不合格就返回
    public function checkParam(\Illuminate\Http\Request $request,$paramArr,$msgCodeArr){
        foreach ($paramArr as $k => $value){
            if(!$request->has($value)||$request->$value==''){
                return array(false,$msgCodeArr[$k]);
            }
        }
        return array(true,null);
    }

}
