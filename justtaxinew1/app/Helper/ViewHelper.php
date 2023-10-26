<?php

use App\PromocodeUsage;
use App\ServiceType;
use App\Document;


function pr($string, $die = false)
{
    echo "<pre>";
    print_r($string);
    echo "</pre>";
    if( $die ) die;
}

function currency($value = '')
{
	if($value == ""){
		return Setting::get('currency')."0.00";
	} else {
		return Setting::get('currency').$value;
	}
}

function distance($value = '')
{
    if($value == ""){
        return "0".Setting::get('distance', 'mile');
    }else{
        return $value.Setting::get('distance', 'mile');
    }
}

function img($img){
	if($img == ""){
		return asset('main/avatar.jpg');
	}else if (strpos($img, 'http') !== false) {
        return $img;
    }else{
        // return $img;
    	return url('uploads/'.$img);
        $url  = env('APP_URL', 'http://localhost/');
        return $url.'/storage/app/public/'.$img;
        return asset('storage/app/public/'.$img);
        return URL::to('storage/app/public/'.$img);
        return url('/storage/app/public/'.$img);
	}
}

function storageImg($img){
    if($img == ""){
        return asset('main/avatar.jpg');
    }else if (strpos($img, 'http') !== false) {
        return $img;
    }else{
        // return $img;
        $url  = env('APP_URL', 'http://localhost/');
        return $url.'/storage/app/public/'.$img;
    }
}

function image($img){
	if($img == ""){
		return asset('main/avatar.jpg');
	}else{
		return asset($img);
	}
}

function promo_used_count($promo_id)
{
	return PromocodeUsage::where('status','ADDED')->where('promocode_id',$promo_id)->count();
}

function curl($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $return = curl_exec($ch);
    curl_close ($ch);
    return $return;
}

function get_all_service_types()
{
	return ServiceType::all();
}

function demo_mode(){
    if(\Setting::get('demo_mode', 0) == 1) {
        return back()->with('flash_error', 'Disabled for demo purposes! Please contact us at info@appdupe.com');
    }
}
function count_VehicleDocuments(){
    return Document::vehicle()->count();
}
function count_DriverDocuments(){
    return Document::driver()->count();
}
