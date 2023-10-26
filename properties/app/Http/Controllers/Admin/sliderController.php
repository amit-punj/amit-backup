<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Requirement;
use App\property_list;
use App\Property_images;
use App\User;
use App\Slider;
class sliderController extends Controller
{
	public function __construct()
	{
	     // $this->middleware(['sub_admin'],['except' => ['login']]);
	}

	public function add_slider(Request $request)
	{
         $sidebar = 'add_slider';
        $postData = $request->all();
        $slider_image = "";
        if($request->isMethod('post'))
        {
            
            $rules['slider_image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
            $validator = Validator::make($postData, $rules);
            if ($validator->fails())
            {
                 return back()->withErrors($validator);
            }
            else
            {
                $image = $request->file('slider_image');
                $destinationPath = "images/slider";
                $image->move($destinationPath,$image->getClientOriginalName());
                $slider_image = $image->getClientOriginalName();
            }
            $Slider= new Slider;
            $Slider->slider_image = $slider_image;
            $Slider->title = $request->title;
            $Slider->description = $request->description;
            $Slider->search_bar = $request->search_bar;
            $Slider->status = $request->status;
            $Slider->save();
            return redirect('admin/add/slider')->with('flash_message_success', 'Slider Image Add Successfully'); 
        }
	 	return view('admin/slider/add_slider',compact('sidebar'));
	}

    public function all_slider(Request $request )
    {
        $sidebar = 'slider';
        $slider_list = Slider::paginate(10);
        return view('admin/slider/all_slider',compact('slider_list','sidebar'));
    }

    public function update(Request $request , $id)
    {
           $sidebar = 'slider';
        $slider_detail = Slider::where('id',$id)->first();
        $postData = $request->all();
        $slider_image = $slider_detail->slider_image;
        if($request->isMethod('post'))
        {
            if($request->hasFile('slider_image'))
            {
                $rules['slider_image'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
                $validator = Validator::make($postData, $rules);
                if ($validator->fails())
                {
                     return back()->withErrors($validator);
                }
                else
                {
                    $image = $request->file('slider_image');
                    $destinationPath = "images/slider";
                    $image->move($destinationPath,$image->getClientOriginalName());
                    $slider_image = $image->getClientOriginalName();
                }
            }
            $Slider = Slider::find($id);
            $Slider->slider_image = $slider_image;
            $Slider->title = $request->title;
            $Slider->description = $request->description;
            $Slider->search_bar = $request->search_bar;
            $Slider->status = $request->status;
            $Slider->save();
            return back()->with('flash_message_success', 'Slider Image Update Successfully'); 
        }

        return view('admin/slider/update_slider',compact('slider_detail','sidebar'));
    }

    public function slider_delete($id)
    {
      Slider::where('id', $id)->delete();
      return redirect('admin/all/slider')->with('flash_message_delete','Slider Image Delete Successfully');
    }

    public function view_slider($id)
    {
           $sidebar = 'slider';
        $slider_detail = Slider::where('id',$id)->first();
        return view('admin/slider/view_slider',compact('slider_detail','sidebar'));
    }
    public function search_bar(Request $request)
    {
        $result = Slider::where('search_bar',1)->first();
        echo json_encode(array('response'=>count($result)));
        die; 
    }
}