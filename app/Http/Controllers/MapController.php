<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    private $AK = 'BW9kcaWhp7UAffh8EOSpG9fkjmLds75Z';
    public function getCoder(Request $request){
        $latitude = $request->route('latitude');
        $longitude = $request->route('longitude');
        $getCoderUrl = 'http://api.map.baidu.com/geocoder/v2/?ak='.$this->AK.'&coordtype=gcj02ll&location='.$latitude.','.$longitude.'&output=json&pois=0';
        $res = file_get_contents($getCoderUrl);
        $resArr = json_decode($res,true);
        if($resArr['status']==0){
            return self::setResponse($res,200,0);
        }else{
            return self::setResponse(null,500,-4048);
        }
    }

//    public function search(Request $request){
//    }

}