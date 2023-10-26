<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\admin\Tours;
use App\admin\Users;
use App\admin\Variations;
use App\admin\Poi;
use File;
use Carbon\Carbon;
use Auth;

class ToursController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tour_owner = Auth::user()->id;
        if(Auth::user()->role == '10' )
            $where = array('tour_owner'=>$tour_owner);
        else
            $where = array();

        // $tours = Tours::get();
        $tours = \DB::table('tours')
            ->Join('users', 'users.id', '=', 'tours.tour_owner')
            ->select('tours.id as tour_id','tours.password as tour_password','tours.created_at as tour_create','tours.*', 'users.*')
            ->where($where)
            ->orderBy('tour_id', 'DESC')
            ->get();
        return view('admin.tours.index',compact('tours'));
    }
    public function create(Request $request)
    {
        $users = Users::get();
        if($request->isMethod('post'))
        {
            $postData = Input::all();
            echo "<pre>";
            print_r($postData);
            die('ddd');
            if(!empty($postData['variation_type']) && isset($postData['variation_type']))
            {
                foreach ($postData['variation_type'] as $key => $value) 
                {
                    $files = $request->file('pic');
                    if ($postData['content_type'][$key] == 'image' && $request->hasFile('pic')) 
                    {
                        $file = $files[$key];
                        $allowedfileExtension=['png'];
                        $filename = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        $check=in_array($extension,$allowedfileExtension);
                        if (!$check)
                        {
                            $error1 =  '<strong>Warning!</strong> Sorry Only Upload png';
                            return back()->with('flash_message_error',$error1);
                        }
                    }    
                    else if ($postData['content_type'][$key] == 'video' && $request->hasFile('pic')) 
                    {
                        $file = $files[$key];
                        $allowedfileExtension=['mp4'];
                        $filename = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        $check=in_array($extension,$allowedfileExtension);
                        if (!$check)
                        {
                            $error =  '<strong>Warning!</strong> Sorry Only Upload mp4, avi';
                            return back()->with('flash_message_error',$error);
                        }
                    }              
                }
            }   
            $rules = array(
                'tour_name'             => 'required',
                'tour_owner'            => 'required',
                'set_password'          => 'required',
                'password'              => 'required|string|unique:tours,current_password'
                // 'password'              => 'required|string|unique:tours,current_password,'.$tour->id
            );
            $messages = array(
                    'password.unique' => 'This password is already in use, please choose another one.'
                    );
            $validator = Validator::make($postData, $rules, $messages);
            if ($validator->fails()){
                return back()->withInput()->withErrors($validator);
            }else{    
                $postData['current_password'] = $postData['password'];       
                if($create = Tours::create($postData))
                {
                    $tour_id = $create->id;
                    if(!empty($postData['variations']) && isset($postData['variations']))
                    {
                        foreach ($postData['variations'] as $v_key => $v_value) 
                        {
                            $variation_data = array(
                                'tour_id'           => $tour_id,
                                'variation_name'    => $v_value,
                                // 'language'          => $postData['language'][$v_key]
                            );
                            if($variations = Variations::create($variation_data))
                            {
                                $variation_id = $variations->id;
                                if(!empty($postData['variation_type']) && isset($postData['variation_type']))
                                {
                                    foreach ($postData['variation_type'] as $key => $value) 
                                    {
                                        $pic     = "";
                                        $content = "";
                                        if($value == $v_key)
                                        {
                                            if ($postData['content_type'][$key] == 'image' && $request->hasFile('pic')) 
                                                {       
                                                    $files = $request->file('pic');
                                                    $file = $files[$key];
                                                    $allowedfileExtension=['png'];
                                                    $filename = $file->getClientOriginalName();
                                                    $extension = $file->getClientOriginalExtension();
                                                    $check=in_array($extension,$allowedfileExtension);
                                                    if($check)
                                                    {
                                                        $path = public_path(). '/images/';
                                                        if (!file_exists($path)) 
                                                        {
                                                            File::makeDirectory($path, $mode = 0777, true, true);
                                                        }   
                                                        // File::delete('images/' . $poi_details->image); 
                                                        $file->move($path, $file->getClientOriginalName());
                                                        $pic = $file->getClientOriginalName();
                                                    }
                                                }
                                            else if ($postData['content_type'][$key] == 'video' && $request->hasFile('pic'))
                                                {
                                                    $files = $request->file('pic');
                                                    $file = $files[$key];
                                                    $allowedfileExtension=['mp4'];
                                                    $filename = $file->getClientOriginalName();
                                                    $extension = $file->getClientOriginalExtension();
                                                    $check=in_array($extension,$allowedfileExtension);
                                                    if($check)
                                                    {
                                                        $path = public_path(). '/videos/';
                                                        if (!file_exists($path)) 
                                                        {
                                                            File::makeDirectory($path, $mode = 0777, true, true);
                                                        }   
                                                        // File::delete('images/' . $poi_details->image); 
                                                        $file->move($path, $file->getClientOriginalName());
                                                        $pic = $file->getClientOriginalName();
                                                    }
                                                }
                                            else if($postData['content_type'][$key] == 'text')
                                                {
                                                    $content = $postData['editor'][$key];
                                                }

                                            $poi_data = array(
                                                'tour_id'        => $tour_id,
                                                'variation_id'   => $variation_id,
                                                'poi_name'       => $postData['poi_name'][$key],
                                                'lat'            => $postData['lat'][$key],
                                                'long'           => $postData['long'][$key],
                                                'icon_type'      => $postData['icon_type'][$key],
                                                'content_type'   => $postData['content_type'][$key],
                                                'content'        => $content,
                                                'image'          => $pic,
                                            );
                                            $poi = Poi::create($poi_data);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                return back()->with('flash_message_success','Tour created successfully');
            }
        }
        return view('admin.tours.create',compact('users'));
    }

    public function update(Request $request, Tours $tour)
    {
        $tour_details = Tours::where('id','=',$tour->id)->get();
        $users = Users::get();
        $variation_details = Variations::where('tour_id','=',$tour->id)->get();
        $poi_details = Poi::where('tour_id','=',$tour->id)->get();
        if($request->isMethod('post'))
        {
            $postData = Input::all();
        // echo "<pre>";
        // print_r($postData);die("ddd");
            $rules = array(
                'tour_name'             => 'required',
                'password'              => 'required|string|unique:tours,current_password,'.$tour->id
            );
            $messages = array(
                    'password.unique' => 'This password is already in use, please choose another one.'
                    );
            $validator = Validator::make($postData, $rules, $messages);
            if ($validator->fails()){
                return redirect('/admin/tours/'.$tour->id.'/update')->withInput()->withErrors($validator);
            }else{
                
                $update_data = array(
                    'tour_name'     => $postData['tour_name'],
                    'tour_owner'    => $postData['tour_owner'],
                    'set_password'  => $postData['set_password'],
                    'password_type'  => ($postData['set_password'] == 'temporary') ? $postData['password_type'] : '' ,
                    'password'       => $postData['password'],
                    'tour_control'   => $postData['tour_control'],
                    'current_password'   => $postData['password'],
                    // 'center_lattitude'   => $postData['center_lattitude'],
                    // 'center_longitude'   => $postData['center_longitude'],
                    'top'               => $postData['top'],
                    'right'             => $postData['right'],
                    'bottom'             => $postData['bottom'],
                    'left'               => $postData['left'],
                    'minimum_zoom'        => $postData['minimum_zoom'],
                    'maximum_zoom'        => $postData['maximum_zoom'],
                );
                
                Tours::where(['id'=>$tour->id])->update($update_data);
                return back()->with('flash_message_success','Tour updated successfully');
            }
        }
        return view('admin.tours.update',compact('tour', 'variation_details','poi_details','users'));
    }

    public function delete(Request $request,Tours $tour)
    {
        if($tour->id != "")
        {
            Tours::where(['id'=>$tour->id])->delete();
            return back()->with('flash_message_success','Tour deleted successfully !');
        }
    }

    public function add_variation(Request $request)
    {
        $postData = $request->all();
        if($postData['variation_name'] == "" ){
            return response()->json(['status' => 'failed', 'message' =>'Variation Name cannot be empty.']);
        }
        $users = Variations::create($postData);
            return response()->json(['status' => 'success','name' =>$users['variation_name'], 'id' =>$users['id'], 'message' =>'Add Successfully.']);
    }

    public function edit_variation(Request $request)
    {
        $postData = $request->all();
        if($postData['variation_name'] == "" ){
            return response()->json(['status' => 'failed', 'message' =>'Variation Name cannot be empty.']);
        }
        $update_data = array(
            'variation_name'=>$postData['variation_name'], 
            // 'language'=>$postData['language'], 
            );
        $users = Variations::where(['id'=>$postData['id'],'tour_id'=>$postData['tour_id']])->update($postData);
        return response()->json(['status' => 'success', 'message' =>'Update Successfully.']);
    }

    public function delete_variation(Request $request)
    {
        $Data = $request->all();
        Variations::where($Data)->delete();
        return response()->json(['success'=>'Delete Successfully.']);
    }

    public function add_poi(Request $request)
    {
        $postData = $request->all();
        if($postData['variation_id'] == "null" || $postData['variation_id'] == "" || is_null($postData['variation_id']) ){
            return response()->json(['status' => 'failed', 'message' =>'Please add atleast 1 variation.']);
        }
        if($postData['poi_name'] == "" ){
            return response()->json(['status' => 'failed', 'message' =>'POI cannot be empty.']);
        }
        if (!empty($postData) && $postData['content_type'] == 'image' && $request->hasFile('image')) 
        {
            $rules['image'] = 'required|image|mimes:png|max:2048';
            $validator = Validator::make($postData, $rules);
            if ($validator->fails())
            {
                $error = $validator->messages()->all('<li>:message</li>');
                $error =  implode(" ",$error);
                $error =  str_replace('</li>', "<li>", $error);
                $error = explode("<li>",$error);
                $error = implode('', $error);
                return response()->json(['status' => 'failed', 'message' =>$error]);       
            }
            else
            {
                if ($request->hasFile('image')) 
                {
                    $image = $request->file('image');
                    $path = public_path(). '/images/';
                    if (!file_exists($path)) 
                    {
                        File::makeDirectory($path, $mode = 0777, true, true);
                    }   
                    $image->move($path, $image->getClientOriginalName());
                    unset($postData['image']);
                    $postData['image'] = $image->getClientOriginalName();
                    $users = Poi::create($postData);
                }
            }
        }
        elseif (!empty($postData) && $postData['content_type'] == 'video' && $request->hasFile('image')) 
        {
            $rules['image'] = 'required|mimetypes:video/mp4|max:10000';
            $validator = Validator::make($postData, $rules);
            if ($validator->fails())
            {
                $video_error = $validator->messages()->all('<li>:message</li>');
                $video_error =  implode(" ",$video_error);
                $video_error =  str_replace('</li>', "<li>", $video_error);
                $video_error = explode("<li>",$video_error);
                $video_error = implode('', $video_error);
                return response()->json(['status' => 'failed', 'message' =>$video_error]); 
            }
            else
            {
                if ($request->hasFile('image')) 
                {
                    $image = $request->file('image');
                    $path = public_path(). '/videos/';
                    if (!file_exists($path)) 
                    {
                        File::makeDirectory($path, $mode = 0777, true, true);
                    }   
                    $image->move($path, $image->getClientOriginalName());
                    unset($postData['image']);
                    $postData['image'] = $image->getClientOriginalName();
                    $users = Poi::create($postData);
                }
            }
        }
        else
        {
            $users = Poi::create($postData);
        }
        return response()->json(['status' => 'success', 'message'=>'Add Successfully.']);
    }

    public function edit_poi(Request $request)
    {
        $postData = $request->all();
        // echo "<pre>"; print_r($postData);die('ddd');
        $poi_details = Poi::where(['id' => $postData['id'] , 'tour_id' => $postData['tour_id'] ])->get();
        if($postData['poi_name'] == "" ){
            return response()->json(['status' => 'failed', 'message' =>'POI cannot be empty.']);
        }
        if (!empty($postData) && $postData['content_type'] == 'image' && $request->hasFile('image')) 
        {
            $rules['image'] = 'required|image|mimes:png|max:2048';
            $validator = Validator::make($postData, $rules);
            if ($validator->fails())
            {
                $error = $validator->messages()->all('<li>:message</li>');
                $error =  implode(" ",$error);
                $error =  str_replace('</li>', "<li>", $error);
                $error = explode("<li>",$error);
                $error = implode('', $error);
                return response()->json(['status' => 'failed', 'message' =>$error]);     
            }
            else
            {
                if ($request->hasFile('image')) 
                {
                    $image = $request->file('image');
                    $path = public_path(). '/images/';
                    if (!file_exists($path)) 
                    {
                        File::makeDirectory($path, $mode = 0777, true, true);
                    }   
                    // File::delete('images/' . $poi_details->image); 
                    $image->move($path, $image->getClientOriginalName());
                    unset($postData['image']);
                    $postData['image'] = $image->getClientOriginalName();

                    $update_data = array(
                        'variation_id'      =>$postData['variation_id'], 
                        'poi_name'          =>$postData['poi_name'], 
                        'icon_type'         =>$postData['icon_type'], 
                        'content_type'      =>$postData['content_type'], 
                        'image'             =>$postData['image'], 
                        'lat'               =>$postData['lat'], 
                        'long'              =>$postData['long'], 
                    );
                    Poi::where(['id'=>$postData['id'],'tour_id'=>$postData['tour_id']])->update($update_data);
                }
            }
        }
        elseif (!empty($postData) && $postData['content_type'] == 'video' && $request->hasFile('image')) 
        {
            $rules['image'] = 'required|mimetypes:video/mp4|max:10000';
            $messages = array(
                    'image.mimetypes' => 'The Video must be a file of type mp4.'
                    );
            $validator = Validator::make($postData, $rules, $messages);
            if ($validator->fails())
            {
                $video_error = $validator->messages()->all('<li>:message</li>');
                $video_error =  implode(" ",$video_error);
                $video_error =  str_replace('</li>', "<li>", $video_error);
                $video_error = explode("<li>",$video_error);
                $video_error = implode('', $video_error);
                return response()->json(['status' => 'failed', 'message' =>$video_error]); 
            }
            else
            {
                if ($request->hasFile('image')) 
                {
                    $image = $request->file('image');
                    $path = public_path(). '/videos/';
                    if (!file_exists($path)) 
                    {
                        File::makeDirectory($path, $mode = 0777, true, true);
                    }  
                    // File::delete('videos/' . $poi_details->image); 
                    $image->move($path, $image->getClientOriginalName());
                    unset($postData['image']);
                    $postData['image'] = $image->getClientOriginalName();

                    $update_data = array(
                        'variation_id'      =>$postData['variation_id'], 
                        'poi_name'          =>$postData['poi_name'], 
                        'icon_type'         =>$postData['icon_type'], 
                        'content_type'      =>$postData['content_type'], 
                        'image'             =>$postData['image'], 
                        'lat'               =>$postData['lat'], 
                        'long'              =>$postData['long'], 
                    );
                    Poi::where(['id'=>$postData['id'],'tour_id'=>$postData['tour_id']])->update($update_data);
                }
            }
        }
        elseif (!empty($postData) && ($postData['content_type'] == 'video' || $postData['content_type'] == 'image' ) && $postData['image'] == '') 
        {
             $update_data = array(
                        'variation_id'      =>$postData['variation_id'], 
                        'poi_name'          =>$postData['poi_name'], 
                        'icon_type'         =>$postData['icon_type'], 
                        'content_type'      =>$postData['content_type'], 
                        // 'image'             =>$postData['image'], 
                        'lat'               =>$postData['lat'], 
                        'long'              =>$postData['long'], 
                    );
                    Poi::where(['id'=>$postData['id'],'tour_id'=>$postData['tour_id']])->update($update_data);
        }
        else
        {
            $update_data = array(
                'variation_id'      =>$postData['variation_id'], 
                'poi_name'          =>$postData['poi_name'], 
                'icon_type'         =>$postData['icon_type'], 
                'content_type'      =>$postData['content_type'], 
                'content'           =>$postData['content'], 
                'lat'               =>$postData['lat'], 
                'long'              =>$postData['long'], 
            );
            Poi::where(['id'=>$postData['id'],'tour_id'=>$postData['tour_id']])->update($update_data);
        }
        return response()->json(['status' => 'success', 'message'=>'Update Successfully.']);
    }
    public function delete_poi(Request $request)
    {
        $Data = $request->all();
        Poi::where($Data)->delete();
        return response()->json(['success'=>'Delete Successfully.']);
    }

    public function update_password(Request $request)
    {
        $tours = Tours::get();
        if(count($tours))
        {
            foreach ($tours as $key => $tour) 
            {
                if(!empty($tour->set_password) && $tour->set_password == 'temporary')
                {
                    if($tour->password_type == 'month')
                    {
                        $current_date = date("Y-m-d");
                        $first_day_every_month = date('Y-m-01'); 
                        // $updated_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $tour->updated_at)->format('Y-m-d H:i:s');
                        // $updated_date = strtotime($updated_date);
                        // $next_update = date("Y-m-d", strtotime("+1 month", $updated_date));
                        // echo $current_date."/".$next_update;
                        if($current_date == $first_day_every_month)
                        {
                            // $current_password =  $this->randomPassword();
                            $current_password =  uniqid();
                            $update_data = array(
                                'current_password'   => $current_password,
                                'updated_at'          => date('Y-m-d H:i:s')
                            );
                            Tours::where(['id'=>$tour->id])->update($update_data);
                        }
                    }
                    elseif($tour->password_type == 'week')
                    {
                        // $current_date = date("Y-m-d");
                        // $updated_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $tour->updated_at)->format('Y-m-d H:i:s');
                        // $updated_date = strtotime($updated_date);
                        // $next_update = date("Y-m-d", strtotime("+1 week", $updated_date));
                        // echo $current_date."/".$next_update;
                        if(date('N') == 1)
                        {
                            // $current_password =  $this->randomPassword();
                            $current_password =  uniqid();
                            $update_data = array(
                                'current_password'   => $current_password,
                                'updated_at'          => date('Y-m-d H:i:s')
                            );
                            Tours::where(['id'=>$tour->id])->update($update_data);
                        }
                    }
                    elseif($tour->password_type == 'day')
                    {
                        // $current_date = date("Y-m-d");
                        // $updated_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $tour->updated_at)->format('Y-m-d H:i:s');
                        // $updated_date = strtotime($updated_date);
                        // $next_update = date("Y-m-d", strtotime("+1 day", $updated_date));
                        // // echo $current_date."/".$next_update;
                        // if($current_date == $next_update)
                        // {
                            // $current_password =  $this->randomPassword();
                            $current_password =  uniqid();
                            $update_data = array(
                                'current_password'   => $current_password,
                                'updated_at'         => date('Y-m-d H:i:s')
                            );
                            Tours::where(['id'=>$tour->id])->update($update_data);
                        // }
                    }
                    // elseif($tour->password_type == 'timezone')
                    // {
                    //     $current_date = date("Y-m-d H:i:s");
                    //     $updated_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $tour->updated_at)->format('Y-m-d H:i:s');
                    //     $updated_date = strtotime($updated_date);
                    //     $next_update = date("Y-m-d H:i:s", strtotime("+1 minute", $updated_date));
                    //     echo $current_date."/".$next_update;
                    //     if($current_date >= $next_update)
                    //     {
                    //         $current_password =  $this->randomPassword();
                    //         $update_data = array(
                    //             'current_password'   => $current_password,
                    //             'updated_at'          => date('Y-m-d H:i:s')
                    //         );
                    //         Tours::where(['id'=>$tour->id])->update($update_data);
                    //         echo 'done';
                    //     }
                    // }
                }
            }
        }
        else
        {
            die("end");
        }
    }
    
    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 6; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    function unique_password(Request $request) 
    {
        $postData = $request->all();
        $password = $postData['password'];
        if($postData['type']  == 'update')
        {
        	$tour_details = Tours::where('current_password','=',$password)->get();
        	if(count($tour_details) > 0)
	        {
	        	if($tour_details[0]->id == $postData['tour_id']){
	        		return 'true';
	        	}
	        	else{
	            	return 'false';
	        	}
	        }
	        else
	        {
	            return 'true';
	        }
        }
        else
        {
        	$tour_details = Tours::where('current_password','=',$password)->get();
        	if(count($tour_details) > 0)
	        {
	            return 'false';
	        }
	        else
	        {
	            return 'true';
	        }
        }        
    }

   
}
