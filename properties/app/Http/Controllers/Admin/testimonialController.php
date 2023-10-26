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
use App\Testimonial;
class testimonialController extends Controller
{
	public function __construct()
	{
	     // $this->middleware(['sub_admin'],['except' => ['login']]);
	}

	public function add(Request $request)
	{
        $sidebar = 'add_testimonial';
        $postData = $request->all();
        $image = "";
        if($request->isMethod('post'))
        {
            $rules['name'] = 'required';
            $rules['designation'] = 'required';
            $rules['testimonial'] = 'required';
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
            $validator = Validator::make($postData, $rules);
            if ($validator->fails())
            {
                 return back()->withErrors($validator);
            }
            else
            {
                $image = $request->file('image');
                $destinationPath = "images/testimonial";
                $image->move($destinationPath,$image->getClientOriginalName());
                $image = $image->getClientOriginalName();
             
                $Testimonial= new Testimonial;
                $Testimonial->image = $image;
                $Testimonial->name = $request->name;
                $Testimonial->designation = $request->designation;
                $Testimonial->testimonial = $request->testimonial;
                $Testimonial->status = $request->status;
                $Testimonial->save();
                return redirect('admin/testimonial/add')->with('flash_message_success', 'Testimonial Add Successfully'); 
            }
        }
	 	return view('admin/testimonial/add_testimonial',compact('sidebar'));
	}

    public function all(Request $request )
    {
        $sidebar = 'testimonial';
        $testimonial_list = Testimonial::paginate(10);
        return view('admin/testimonial/all_testimonial',compact('testimonial_list','sidebar'));
    }

    public function update(Request $request , $id)
    {
        $sidebar = 'testimonial';
        $testimonial_detail = Testimonial::where('id',$id)->first();
        $postData = $request->all();
        $image = $testimonial_detail->image;
        if($request->isMethod('post'))
        {
            $rules['name'] = 'required';
            $rules['designation'] = 'required';
            $rules['testimonial'] = 'required';
            if($request->hasFile('image'))
            {
                $rules['image'] = 'image|mimes:jpeg,png,jpg|max:2048';
            }
            $validator = Validator::make($postData, $rules);
            if ($validator->fails())
            {
                 return back()->withErrors($validator);
            }
            else
            {
                $image = $request->file('image');
                $destinationPath = "images/testimonial";
                $image->move($destinationPath,$image->getClientOriginalName());
                $image = $image->getClientOriginalName();
            }
            $Testimonial = Testimonial::find($id);
            $Testimonial->image = $image;
            $Testimonial->name = $request->name;
            $Testimonial->designation = $request->designation;
            $Testimonial->testimonial = $request->testimonial;
            $Testimonial->status = $request->status;
            $Testimonial->save();
            return back()->with('flash_message_success', 'Testimonial Image Update Successfully'); 
        }

        return view('admin/testimonial/update_testimonial',compact('testimonial_detail','sidebar'));
    }

    public function delete($id)
    {
      Testimonial::where('id', $id)->delete();
      return redirect('admin/testimonial/all')->with('flash_message_delete','Testimonial Delete Successfully');
    }

    public function view($id)
    {
        $sidebar = 'testimonial';
        $testimonial_detail = Testimonial::where('id',$id)->first();
        return view('admin/testimonial/view_testimonial',compact('testimonial_detail','sidebar'));
    }
}