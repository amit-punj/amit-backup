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
use App\Client;
class clientController extends Controller
{
	public function __construct()
	{
	     // $this->middleware(['sub_admin'],['except' => ['login']]);
	}

	public function add_client_admin(Request $request)
	{
        $sidebar = 'client_create';
        if($request->isMethod('post'))
        {
            $postData = $request->all();
            $rules1 = array(
            'fname' => 'required',
            'lname' => 'required',
            'mobile' => 'nullable|numeric',
            'email' => 'nullable|email',
            );
                $validator = Validator::make($postData, $rules1);
                if ($validator->fails())
                {
                   return back()->withErrors($validator); 
                }
                if(isset($request->user_id) && !empty($request->user_id))
                {     
                        if($request->email !="")
                        {
                                $user_email = Client::where('user_id',$request->user_id)
                                ->where('email',$request->email)
                                ->get();
                                if(count($user_email))
                                {
                                return back()->withInput()->with('flash_message_error','email already has been taken');
                                }
                        } 
                        $Slider = new Client;
                        $Slider->fname = $request->fname;
                        $Slider->lname = $request->lname;
                        $Slider->email = $request->email;
                        $Slider->mobile = $request->mobile;
                        $Slider->user_id = $request->user_id;
                        $Slider->save();

                        return redirect('user/client/view/'.$request->user_id)->with('flash_message_success', 'Client Add Successfully');
                }       
        }
	}
    public function all_client(Request $request)
    {
        $sidebar = 'allclient';
        $slider_list = Client::paginate(10);
        return view('admin/client/all_client',compact('slider_list','sidebar'));
    }
    public function adduser_client($id)
    {
        if($id)
        {
          $sidebar = 'all_user';
        return view('admin/client/add_client',compact('sidebar','id'));   
        }
    }
    public function view_user_client($id)
    {
        $sidebar = 'allclient';
        $slider_list = Client::where('user_id',$id)->orderBy('id','DESC')->paginate(10);
       return view('admin/client/all_client',compact('slider_list','sidebar'));
    }
    public function update(Request $request , $id)
    {
        $sidebar = 'allclient';
        $slider_detail = Client::where('id',$id)->first();
        $postData = $request->all();
        if($request->isMethod('post'))
        {
            $Slider = Client::find($id);
            $Slider->fname = $request->fname;
            $Slider->lname = $request->lname;
            $Slider->email = $request->email;
            $Slider->mobile = $request->mobile;
            $Slider->save();
            return back()->with('flash_message_success', 'Slider Image Update Successfully'); 
        }

        return view('admin/client/update_client',compact('slider_detail','sidebar'));
    }
    public function client_delete($id)
    {
      Client::where('id', $id)->delete();
      return back()->with('flash_message_delete','Client delete successfully');
    }
    public function view_client($id)
    {
        $sidebar = 'allclient';
        $slider_detail = Client::where('id',$id)->first();
        return view('admin/client/view_client',compact('slider_detail','sidebar'));
    }
    public function search_bar(Request $request)
    {
        $result = Slider::where('search_bar',1)->first();
        echo json_encode(array('response'=>count($result)));
        die; 
    }
}