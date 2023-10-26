<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cmspage extends Model
{
    function textEditorData($data){
    	$dom = new \DomDocument();
        $dom->loadHtml($data, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        $images = $dom->getElementsByTagName('img');
        foreach($images as $k => $img){
            $data = $img->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $image_name= "/images/cmsimages/cmsimages" . time().$k.'.png';
            $path = public_path() . $image_name;
            file_put_contents($path, $data);
            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }
       	return $dom->saveHTML();
    }
}
