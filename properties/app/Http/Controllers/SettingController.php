<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;
use App\general_setting;
use Hash;
use File;
use Auth;


class SetingController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['is_admin'], ['except' => ['login']]);
    }
    public function editAdminprofile(Request $request)
    {
        $sidebar = 'dashboard';
        // echo "<pre>";
        // echo $sidebar;
        // die('ffffffffffffffffff');
        $id = Auth::id();
        $getData = DB::table('users')->where(['id'=>$id])->first();
    	if($request->isMethod('post'))
    	{
    		$data = $request->all();
            $postData = Input::all();
            if($data['password'] != '')
            {
                if(Hash::check($data['password'], $getData->password))
                {
                    if($data['email'] != $getData->email)
                    {
                        $rules = array(
                            'email' => 'required|string|email|max:255|unique:users',
                            'new_password' => 'required|string|min:6',
                            'confirm_password' => 'required|string|min:6|same:new_password'
                        );
                    }
                    else
                    {
                        $rules = array(
                           // 'email' => 'required|string|email|max:255|unique:users',
                            'new_password' => 'required|string|min:6',
                            'confirm_password' => 'required|string|min:6|same:new_password'
                        );
                    }
                    $messages = array(
                    'confirm_password.same' => 'password and confirm password not match'
                    );

                    $validator = Validator::make($postData, $rules, $messages);
                    if ($validator->fails())
                    {
                        return redirect('/admin/edit-profile')->withInput()->withErrors($validator);
                    }
                    else
                    {
                        $psswd = bcrypt($data['new_password']);
                        User::where(['id'=>$getData->id])->update(['name'=>$getData->name,'email'=>$data['email'],'password'=>$psswd]);
                        return redirect('/admin/edit-profile')->with('flash_message_success','Profile update successfully');
                    }
                }
                else
                {
                    return redirect('/admin/edit-profile')->with('flash_message_error','Incorrect old password');
                }
            }
            else
            {
                if($data['email'] != $getData->email)
                {
                    $rules = array(
                        'email' => 'required|string|email|max:255|unique:users',
                    );
                    $validator = Validator::make($postData, $rules);
                    return redirect('/admin/edit-profile')->withInput()->withErrors($validator);
                }
                else
                {
                    if($data['new_password'] == '')
                    {
                        $psswd = $getData->password;
                    }
                    else
                    {
                        $psswd = bcrypt($data['new_password']);
                    }
                    User::where(['id'=>$getData->id])->update(['name'=>$getData->name,'email'=>$data['email'],'password'=>$psswd]);
                    return redirect('/admin/edit-profile')->with('flash_message_success','Profile update successfully');
                }
            }
        }
    	$AdminDetails = User::where(['id'=>$getData->id])->first();
    	return view('admin.setting.edit-profile')->with(compact('AdminDetails','sidebar'));
    }

    public function generalSetting(Request $request)
    {
         $sidebar = 'dashboard';
        $getData = DB::table('general_settings')->first();
        $Genral = new general_setting;
        $countries = DB::table("countries")->get();
        if($request->isMethod('post') && isset($_POST['siteSave']))
        {
            $postData = Input::all();
            if($getData)
            {
                $rules = array(
                        'site_title' => 'required|string',
                    );
                if ($request->hasFile('file_image')) 
                {
                    $rules['file_image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
                }
                else
                {
                    $filename = $getData->logo;
                }
                if ($request->hasFile('site_video')) 
                {
                    $rules['site_video'] = 'required|mimetypes:video/mp4|max:10000';
                }
                else
                {
                    $site_video = $getData->site_video;
                }
                $validator = Validator::make($postData, $rules);

                if ($validator->fails())
                {
                    return redirect('/admin/general')->withInput()->withErrors($validator);
                }
                else
                {
                    if ($request->hasFile('file_image')) 
                    {
                        File::delete('images/' . $getData->logo);
                        $image = $request->file('file_image');
                        $path = public_path(). '/images/';
                        if (!file_exists($path)) 
                        {
                            File::makeDirectory($path, $mode = 0777, true, true);
                        }   
                        $filename = time() . '.' . $image->getClientOriginalExtension();
                        $image->move($path, $filename);
                    }
                    if ($request->hasFile('site_video')) 
                    {
                        File::delete('video/' . $getData->site_video);
                        $image = $request->file('site_video');
                        $path = public_path(). '/video/';
                        if (!file_exists($path)) 
                        {
                            File::makeDirectory($path, $mode = 0777, true, true);
                        }   
                        $site_video = time() . '.' . $image->getClientOriginalExtension();
                        $image->move($path, $site_video);
                    }
                    general_setting::where(['id'=>$getData->id])->update([
                        'title'=>$_POST['site_title'],
                        'logo'=>$filename,
                        'site_video'=>$site_video,
                        'facebook'=>$_POST['facebook'],
                        'instagram'=>$_POST['instagram'],
                        'twitter'=>$_POST['twitter'],
                        'admin_email'=>$getData->admin_email,
                        'address_line_1'=>$getData->address_line_1,
                        'address_line_2'=>$getData->address_line_2,
                        'city'=>$getData->city,
                        'country'=>$getData->country,
                        'state'=>$getData->state,
                        'postcode'=>$getData->postcode,
                        'smtp_host' => $getData->smtp_host,
                        'smtp_port' => $getData->smtp_port,
                        'smtp_protocol' => $getData->smtp_protocol,
                        'smtp_username' => $getData->smtp_username,
                        'smtp_password' => $getData->smtp_password,
                        'fb_appID' => $getData->fb_appID,
                        'fd_secretKey' => $getData->fd_secretKey,
                        'stripe_appID'=> $getData->stripe_appID,
                        'stripe_secretKey' => $getData->stripe_secretKey
                    ]);
                    return redirect('/admin/general')->with('flash_message_success','Site Data update successfully');
                }       
            }
            else
            {
                $Genral->admin_email = '';
                $Genral->address_line_1 = '';
                $Genral->address_line_2 = '';
                $Genral->city = '';
                $Genral->country = '';
                $Genral->state = '';
                $Genral->postcode = '';


                $Genral->smtp_host = '';
                $Genral->smtp_port = '';
                $Genral->smtp_protocol = '';
                $Genral->smtp_username = '';
                $Genral->smtp_password = '';
                

                $Genral->fb_appID = '';
                $Genral->fd_secretKey = '';
                $Genral->stripe_appID = '';
                $Genral->stripe_secretKey = '';

                $rules = array(
                    'site_title' => 'required|string',
                    'file_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                );
                $validator = Validator::make($postData, $rules);

                if ($validator->fails())
                {
                    return redirect('/admin/general')->withInput()->withErrors($validator);
                }
                else
                {
                    
                    //echo "<pre>";print_r($postData);die('jj');
                    if ($request->hasFile('file_image')) 
                    {
                        $image = $request->file('file_image');
                        $path = public_path(). '/images/';
                        if (!file_exists($path)) 
                        {
                            File::makeDirectory($path, $mode = 0777, true, true);
                        }  
                        $filename = time() . '.' . $image->getClientOriginalExtension();
                        $image->move($path, $filename);

                        $Genral->logo = $filename;
                    }     
                    $Genral->title = $request->get('site_title');
                    $Genral->save();
                    return back()->with('flash_message_success','Site Detail Save successfully');
                }
            }
        }
        if($request->isMethod('post') && isset($_POST['adminSave']))
        {
            $postData = Input::all();
            if($getData)
            {
                $rules = array(
                    'admin_email' => 'required|string|email',
                    'address_line1' => 'required',
                    'address_line2' => 'required',
                    'city' => 'required',
                    'country' => 'required',
                    'state' => 'required',
                    'postcode' => 'required',
                );
                $validator = Validator::make($postData, $rules);

                if ($validator->fails())
                {
                    return redirect('/admin/general')->withInput()->withErrors($validator);
                }
                else
                {
                    general_setting::where(['id'=>$getData->id])->update([
                        'title'=>$getData->title,
                        'logo'=>$getData->logo,
                        'admin_email'=>$_POST['admin_email'],
                        'address_line_1'=>$_POST['address_line1'],
                        'address_line_2'=>$_POST['address_line2'],
                        'city'=>$_POST['city'],
                        'country'=>$_POST['country'],
                        'state'=>$_POST['state'],
                        'postcode'=>$_POST['country'],
                        'smtp_host' => $getData->smtp_host,
                        'smtp_port' => $getData->smtp_port,
                        'smtp_protocol' => $getData->smtp_protocol,
                        'smtp_username' => $getData->smtp_username,
                        'smtp_password' => $getData->smtp_password,
                        'fb_appID' => $getData->fb_appID,
                        'fd_secretKey' => $getData->fd_secretKey,
                        'stripe_appID'=> $getData->stripe_appID,
                        'stripe_secretKey' => $getData->stripe_secretKey
                    ]);

                    return redirect('/admin/general')->with('flash_message_success','Update Admin Data successfully');
                }
            }
            else
            {
                $Genral->logo = '';
                $Genral->title = '';

                $Genral->admin_email = $_POST['admin_email'];
                $Genral->address_line_1 = $_POST['address_line1'];
                $Genral->address_line_2 = $_POST['address_line2'];
                $Genral->city = $_POST['city'];
                $Genral->country = $_POST['country'];
                $Genral->state = $_POST['state'];
                $Genral->postcode = $_POST['postcode'];


                $Genral->smtp_host = '';
                $Genral->smtp_port = '';
                $Genral->smtp_protocol = '';
                $Genral->smtp_username = '';
                $Genral->smtp_password = '';
                

                $Genral->fb_appID = '';
                $Genral->fd_secretKey = '';
                $Genral->stripe_appID = '';
                $Genral->stripe_secretKey = '';

                $rules = array(
                    'admin_email' => 'required|string|email',
                    'address_line1' => 'required',
                    'address_line2' => 'required',
                    'city' => 'required',
                    'country' => 'required',
                    'state' => 'required',
                    'postcode' => 'required',
                );
                $validator = Validator::make($postData, $rules);

                if ($validator->fails())
                {
                    return redirect('/admin/general')->withInput()->withErrors($validator);
                }
                else
                {
                    $Genral->save();
                    return back()->with('flash_message_success','Admin Detail Save successfully');
                }
            }
        }
        if($request->isMethod('post') && isset($_POST['smtpSave']))
        {
            $postData = Input::all();
            if($getData)
            {
                $rules = array(
                    'smtp_host' => 'required',
                    'smtp_port' => 'required',
                    'smtp_protocol' => 'required',
                    'smtp_username' => 'required',
                    'smtp_password' => 'required',
                );
                $validator = Validator::make($postData, $rules);

                if ($validator->fails())
                {
                    return redirect('/admin/general')->withInput()->withErrors($validator);
                }
                else
                {
                    general_setting::where(['id'=>$getData->id])->update([
                        'title'=>$getData->title,
                        'logo'=>$getData->logo,
                        'admin_email'=>$getData->admin_email,
                        'address_line_1'=>$getData->address_line_1,
                        'address_line_2'=>$getData->address_line_2,
                        'city'=>$getData->city,
                        'country'=>$getData->country,
                        'state'=>$getData->state,
                        'postcode'=>$getData->country,
                        'smtp_host' => $_POST['smtp_host'],
                        'smtp_port' => $_POST['smtp_port'],
                        'smtp_protocol' => $_POST['smtp_protocol'],
                        'smtp_username' => $_POST['smtp_username'],
                        'smtp_password' => $_POST['smtp_password'],
                        'fb_appID' => $getData->fb_appID,
                        'fd_secretKey' => $getData->fd_secretKey,
                        'stripe_appID'=> $getData->stripe_appID,
                        'stripe_secretKey' => $getData->stripe_secretKey
                    ]);

                    return redirect('/admin/general')->with('flash_message_success','SMTP Data successfully');
                }
            }
            else
            {
                $Genral->logo = '';
                $Genral->title = '';

                $Genral->admin_email = '';
                $Genral->address_line_1 = '';
                $Genral->address_line_2 = '';
                $Genral->city = '';
                $Genral->country = '';
                $Genral->state = '';
                $Genral->postcode = '';


                $Genral->smtp_host = $_POST['smtp_host'];
                $Genral->smtp_port = $_POST['smtp_port'];
                $Genral->smtp_protocol = $_POST['smtp_protocol'];
                $Genral->smtp_username = $_POST['smtp_username'];
                $Genral->smtp_password = $_POST['smtp_password'];
                

                $Genral->fb_appID = '';
                $Genral->fd_secretKey = '';
                $Genral->stripe_appID = '';
                $Genral->stripe_secretKey = '';

                $rules = array(
                    'smtp_host' => 'required',
                    'smtp_port' => 'required',
                    'smtp_protocol' => 'required',
                    'smtp_username' => 'required',
                    'smtp_password' => 'required',
                );
                $validator = Validator::make($postData, $rules);

                if ($validator->fails())
                {
                    return redirect('/admin/general')->withInput()->withErrors($validator);
                }
                else
                {
                    $Genral->save();
                    return back()->with('flash_message_success','Socail Detail Save successfully');
                }
            }
        }
        if($request->isMethod('post') && isset($_POST['socialSave']))
        {
            $postData = Input::all();
            if($getData)
            {
                if($_POST['fb_app_id'] != '' || $_POST['fb_secret_key'])
                {
                    $rules = array(
                        'fb_app_id' => 'required',
                        'fb_secret_key' => 'required',
                    );
                }
                else if($_POST['st_app_id'] != '' || $_POST['st_secret_key'])
                {
                    $rules = array(
                        'st_app_id' => 'required',
                        'st_secret_key' => 'required',
                    );
                }
                else
                {
                    $rules = array(
                        'fb_app_id' => 'required',
                        'fb_secret_key' => 'required',
                        'st_app_id' => 'required',
                        'st_secret_key' => 'required',
                    );
                }
                
                $validator = Validator::make($postData, $rules);

                if ($validator->fails())
                {
                    return redirect('/admin/general')->withInput()->withErrors($validator);
                }
                else
                {
                    general_setting::where(['id'=>$getData->id])->update([
                        'title'=>$getData->title,
                        'email' => $_POST['email'],
                        'logo'=>$getData->logo,
                        'admin_email'=>$getData->admin_email,
                        'address_line_1'=>$getData->address_line_1,
                        'address_line_2'=>$getData->address_line_2,
                        'city'=>$getData->city,
                        'country'=>$getData->country,
                        'state'=>$getData->state,
                        'postcode'=>$getData->country,
                        'smtp_host' => $getData->smtp_host,
                        'smtp_port' => $getData->smtp_port,
                        'smtp_protocol' => $getData->smtp_protocol,
                        'smtp_username' => $getData->smtp_username,
                        'smtp_password' => $getData->smtp_password,
                        'fb_appID' => $_POST['fb_app_id'],
                        'fd_secretKey' => $_POST['fb_secret_key'],
                        'stripe_appID'=> $_POST['st_app_id'],
                        'stripe_secretKey' => $_POST['st_secret_key'],
                    ]);

                    return redirect('/admin/general')->with('flash_message_success','SMTP Data successfully');
                }
            }
            else
            {
                $Genral->logo = '';
                $Genral->title = '';

                $Genral->admin_email = '';
                $Genral->address_line_1 = '';
                $Genral->address_line_2 = '';
                $Genral->city = '';
                $Genral->country = '';
                $Genral->state = '';
                $Genral->postcode = '';


                $Genral->smtp_host = '';
                $Genral->smtp_port = '';
                $Genral->smtp_protocol = '';
                $Genral->smtp_username = '';
                $Genral->smtp_password = '';
                

                $Genral->fb_appID = $_POST['fb_app_id'];
                $Genral->fd_secretKey = $_POST['fb_secret_key'];
                $Genral->stripe_appID = $_POST['st_app_id'];
                $Genral->stripe_secretKey = $_POST['st_secret_key'];

                if($_POST['fb_app_id'] != '' || $_POST['fb_secret_key'])
                {
                    $rules = array(
                        'fb_app_id' => 'required',
                        'fb_secret_key' => 'required',
                    );
                }
                else if($_POST['st_app_id'] != '' || $_POST['st_secret_key'])
                {
                    $rules = array(
                        'st_app_id' => 'required',
                        'st_secret_key' => 'required',
                    );
                }
                else
                {
                    $rules = array(
                        'fb_app_id' => 'required',
                        'fb_secret_key' => 'required',
                        'st_app_id' => 'required',
                        'st_secret_key' => 'required',
                    );
                }
                $validator = Validator::make($postData, $rules);

                if ($validator->fails())
                {
                    return redirect('/admin/general')->withInput()->withErrors($validator);
                }
                else
                {
                    $Genral->save();
                    return back()->with('flash_message_success','Socail Detail Save successfully');
                }
            }
        }
        if($getData)
        {
            return view('admin.setting.general')->with(compact('getData','countries','sidebar'));
        }
        else
        {
            return view('admin.setting.general')->with(compact('countries','sidebar'));
        }      
    }

    
}
