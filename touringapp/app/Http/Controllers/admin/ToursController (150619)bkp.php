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
        // $tours = Tours::get();
        $tours = \DB::table('tours')
            ->leftJoin('users', 'users.id', '=', 'tours.tour_owner')
            ->get();
        return view('admin.tours.index',compact('tours'));
    }
    public function create(Request $request)
    {
        $users = Users::get();
        if($request->isMethod('post'))
        {
            $postData = Input::all();
            $rules = array(
                'tour_name'             => 'required',
                'tour_owner'            => 'required',
                'set_password'          => 'required',
                'password'              => 'required|string|unique:tours'
            );
            $messages = array(
                    'password.unique' => 'This password is already in use, please choose another one.'
                    );
            $validator = Validator::make($postData, $rules, $messages);
            if ($validator->fails()){
                return back()->withInput()->withErrors($validator);
            }else{    
                $postData['current_password'] = $postData['password'];       
                $create = Tours::create($postData);
                return back()->with('flash_message_success','Tour created successfully');
                // return view('admin.tours.index')->with('flash_message_success','Tour created successfully');
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
            'language'=>$postData['language'], 
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
        if($postData['poi_name'] == "" ){
            return response()->json(['status' => 'failed', 'message' =>'POI cannot be empty.']);
        }
        if (!empty($postData) && $postData['content_type'] == 'image' && $request->hasFile('image')) 
        {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
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
            $rules['image'] = 'required|mimetypes:video/avi,video/mpeg,video/mp4,video/MOV|max:10000';
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
        $poi_details = Poi::where(['id' => $postData['id'] , 'tour_id' => $postData['tour_id'] ])->get();
        if($postData['poi_name'] == "" ){
            return response()->json(['status' => 'failed', 'message' =>'POI cannot be empty.']);
        }
        if (!empty($postData) && $postData['content_type'] == 'image' && $request->hasFile('image')) 
        {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
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
                    );
                    Poi::where(['id'=>$postData['id'],'tour_id'=>$postData['tour_id']])->update($update_data);
                }
            }
        }
        elseif (!empty($postData) && $postData['content_type'] == 'video' && $request->hasFile('image')) 
        {
            $rules['image'] = 'required|mimetypes:video/avi,video/mpeg,video/mp4,video/MOV|max:10000';
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
                    );
                    Poi::where(['id'=>$postData['id'],'tour_id'=>$postData['tour_id']])->update($update_data);
                }
            }
        }
        else
        {
            $update_data = array(
                'variation_id'      =>$postData['variation_id'], 
                'poi_name'          =>$postData['poi_name'], 
                'icon_type'         =>$postData['icon_type'], 
                'content_type'      =>$postData['content_type'], 
                'content'           =>$postData['content'], 
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
                        $updated_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $tour->updated_at)->format('Y-m-d H:i:s');
                        $updated_date = strtotime($updated_date);
                        $next_update = date("Y-m-d", strtotime("+1 month", $updated_date));
                        // echo $current_date."/".$next_update;
                        if($current_date == $next_update)
                        {
                            $current_password =  $this->randomPassword();
                            $update_data = array(
                                'current_password'   => $current_password,
                                'updated_at'          => date('Y-m-d H:i:s')
                            );
                            Tours::where(['id'=>$tour->id])->update($update_data);
                        }
                    }
                    elseif($tour->password_type == 'week')
                    {
                        $current_date = date("Y-m-d");
                        $updated_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $tour->updated_at)->format('Y-m-d H:i:s');
                        $updated_date = strtotime($updated_date);
                        $next_update = date("Y-m-d", strtotime("+1 week", $updated_date));
                        // echo $current_date."/".$next_update;
                        if($current_date == $next_update)
                        {
                            $current_password =  $this->randomPassword();
                            $update_data = array(
                                'current_password'   => $current_password,
                                'updated_at'          => date('Y-m-d H:i:s')
                            );
                            Tours::where(['id'=>$tour->id])->update($update_data);
                        }
                    }
                    elseif($tour->password_type == 'day')
                    {
                        $current_date = date("Y-m-d");
                        $updated_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $tour->updated_at)->format('Y-m-d H:i:s');
                        $updated_date = strtotime($updated_date);
                        $next_update = date("Y-m-d", strtotime("+1 day", $updated_date));
                        // echo $current_date."/".$next_update;
                        if($current_date == $next_update)
                        {
                            $current_password =  $this->randomPassword();
                            $update_data = array(
                                'current_password'   => $current_password,
                                'updated_at'         => date('Y-m-d H:i:s')
                            );
                            Tours::where(['id'=>$tour->id])->update($update_data);
                        }
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

   
}
