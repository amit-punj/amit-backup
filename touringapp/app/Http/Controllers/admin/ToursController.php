<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\admin\Tours;
use App\admin\Users;
use App\admin\Variations;
use App\admin\Poi;
use App\admin\Poicontent;
use App\admin\Passwords;
use File;
use Carbon\Carbon;
use Auth;
use DB;

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
            ->select('tours.id as tour_id','tours.password as tour_password','tours.created_at as tour_create','tours.*', 'users.*', \DB::raw('(select COUNT(*) from variations WHERE variations.tour_id = `tours`.`id`) as total_variation'))
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
            $rules = array(
                'tour_name'             => 'required',
                'tour_owner'            => 'required',
                'set_password'          => 'required',
                'top'                   => 'required',
                'right'                 => 'required',
                'bottom'                => 'required',
                'left'                  => 'required',
            );
            $validator = Validator::make($postData, $rules);
            if ($validator->fails()){
                return back()->withInput()->withErrors($validator);
            }else{  

                $tour_data = array(
                    'tour_name'       => $postData['tour_name'],
                    'tour_owner'      => $postData['tour_owner'],
                    'top'             => $postData['top'],
                    'right'           => $postData['right'],
                    'bottom'          => $postData['bottom'],
                    'left'            => $postData['left'],
                    'minimum_zoom'    => $postData['minimum_zoom'],
                    'maximum_zoom'    => $postData['maximum_zoom'],
                    'set_password'    => $postData['set_password'],
                    'password_type'  => ($postData['set_password'] == 'temporary') ? $postData['password_type'] : '' ,
                );
                if($create = Tours::create($tour_data))
                {
                    $tour_id = $create['id'];
                    if($postData['set_password'] == 'temporary')
                    {
                        $i = 0;
                        foreach ($postData['password'] as $key => $value) {
                            $password_data = array(
                                'tour_id'  => $tour_id,
                                'password' => $value,
                                'set_password' => $postData['set_password'],
                            );
                            $password_data['password_type'] = $postData['password_type'];
                            if($i == 0)
                            {
                                $password_data['status'] = 1;
                                if($create_password = Passwords::create($password_data))
                                {
                                    $pass_update = array(
                                        'current_password' => $value,
                                    );
                                    $tour_update = Tours::where(['id'=>$tour_id])->update($pass_update);
                                }
                            }
                            else
                            {
                                // $tour_details = Passwords::where('password','=',$value)->get();
                                $tour_details = Passwords::where(\DB::raw('BINARY `password`'), $value)->get();
                                if(count($tour_details) > 0){
                                }
                                else
                                {
                                    $create_password = Passwords::create($password_data);
                                }
                            }
                            $i++;
                        }
                        return redirect('admin/tours')->with('flash_message_success','Tour created successfully');
                    }
                    else
                    {
                        $password_data = array(
                            'tour_id'  => $tour_id,
                            // 'current_password' => $postData['password'][0],
                            'password' => $postData['password'][0],
                            'set_password' => $postData['set_password'],
                            'status' => 1,
                        );
                        $password_data['password_type'] = "";
                        if($create_password = Passwords::create($password_data))
                        {
                            $pass_update = array(
                                'current_password' => $postData['password'][0],
                            );
                            $tour_update = Tours::where(['id'=>$tour_id])->update($pass_update);
                            return redirect('admin/tours')->with('flash_message_success','Tour created successfully');
                        }
                    }
                }
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
        $password_details = Passwords::where('tour_id','=',$tour->id)->get();
        if($request->isMethod('post'))
        {
            $postData = Input::all();
            $rules = array(
                'tour_name'             => 'required',
            );
            $validator = Validator::make($postData, $rules);
            if ($validator->fails()){
                return redirect('/admin/tours/'.$tour->id.'/update')->withInput()->withErrors($validator);
            }else{
                
                $update_data = array(
                    'tour_name'     => $postData['tour_name'],
                    'tour_owner'    => $postData['tour_owner'],
                    'set_password'  => $postData['set_password'],
                    'password_type'  => ($postData['set_password'] == 'temporary') ? $postData['password_type'] : '' ,
                    'tour_control'   => $postData['tour_control'],
                    'top'               => $postData['top'],
                    'right'             => $postData['right'],
                    'bottom'             => $postData['bottom'],
                    'left'               => $postData['left'],
                    'minimum_zoom'        => $postData['minimum_zoom'],
                    'maximum_zoom'        => $postData['maximum_zoom'],
                );
                if($update = Tours::where(['id'=>$tour->id])->update($update_data))
                {
                    $tour_id = $tour->id;
                    if($postData['set_password'] == 'temporary')
                    {
                        $i = 0;
                        foreach ($postData['password'] as $key => $value) 
                        {
                            if(isset($postData['p_id'][$key]))
                            {
                                $p_id = $postData['p_id'][$key];
                                $password_data = array(
                                    'tour_id'  => $tour_id,
                                    // 'current_password' => $value,
                                    'password' => $value,
                                    'set_password' => $postData['set_password'],
                                );
                                $password_data['password_type'] = $postData['password_type'];

                                // $tour_details = Passwords::where('password','=',$value)->get();
                                $tour_details = Passwords::where(\DB::raw('BINARY `password`'), $value)->get();
                                if(count($tour_details) > 0){
                                }
                                else
                                {
                                    // $create_password = Passwords::create($password_data);
                                    $update_pass = Passwords::where(['id'=>$p_id])->update($password_data);
                                }
                            }
                            else
                            {
                                $password_data = array(
                                    'tour_id'  => $tour_id,
                                    // 'current_password' => $value,
                                    'password' => $value,
                                    'set_password' => $postData['set_password'],
                                );
                                $password_data['password_type'] = $postData['password_type'];
                                if($i == 0)
                                {
                                    Passwords::where(['tour_id'=>$tour_id])->delete();
                                    $pass_update = array(
                                        'current_password' => $value,
                                    );
                                    $tour_update = Tours::where(['id'=>$tour->id])->update($pass_update);
                                    $create_password = Passwords::create($password_data);
                                }
                                else
                                {
                                    // $tour_details = Passwords::where('password','=',$value)->get();
                                    $tour_details = Passwords::where(\DB::raw('BINARY `password`'), $value)->get();
                                    if(count($tour_details) > 0){
                                    }
                                    else
                                    {
                                        $create_password = Passwords::create($password_data);
                                    }
                                }
                            }
                            $i++;
                        }
                        return redirect('admin/tours')->with('flash_message_success','Tour created successfully');
                    }
                    else
                    {
                        if(isset($postData['p_id'][0]))
                        {
                            $p_id = $postData['p_id'][0];
                            $password_data = array(
                                'tour_id'  => $tour_id,
                                // 'current_password' => $value,
                                'password' => $postData['password'][0],
                                'set_password' => $postData['set_password'],
                            );
                            $password_data['password_type'] = "";
                            $update_pass = Passwords::where(['id'=>$p_id])->update($password_data);
                            $pass_update = array(
                                    'current_password' => $postData['password'][0],
                                );
                            $tour_update = Tours::where(['id'=>$tour->id])->update($pass_update);
                            return redirect('admin/tours')->with('flash_message_success','Tour updated successfully');
                        }
                        else
                        {
                            $password_data = array(
                                'tour_id'  => $tour_id,
                                // 'current_password' => $value,
                                // 'password' => $value,
                                'password' => $postData['password'][0],
                                'set_password' => $postData['set_password'],
                            );
                            $password_data['password_type'] = "";
                            Passwords::where(['tour_id'=>$tour_id])->delete();
                            if($create_password = Passwords::create($password_data))
                            {
                                $pass_update = array(
                                    'current_password' => $postData['password'][0],
                                );
                                $tour_update = Tours::where(['id'=>$tour->id])->update($pass_update);
                                return redirect('admin/tours')->with('flash_message_success','Tour updated successfully');
                            }
                        }
                    }
                }
                return redirect('admin/tours')->with('flash_message_success','Tour updated successfully');
            }
        }
        return view('admin.tours.update',compact('tour', 'variation_details','poi_details','users','password_details'));
    }

    public function delete(Request $request,Tours $tour)
    {
        if($tour->id != "")
        {
            if( $data = Tours::where(['id'=>$tour->id])->delete())
            {
                Passwords::where('tour_id','=',$tour->id)->delete();
            }
            return back()->with('flash_message_success','Tour deleted successfully !');
        }
    }

    public function variation_list(Request $request,Tours $tour)
    {
        $variation_details = Variations::where('tour_id','=',$tour->id)->orderBy('id', 'DESC')->get();
        return view('admin.tours.variation_list',compact('variation_details','tour'));        
    }

    public function add_variation(Request $request, Tours $tour)
    {
        $variation_details = Variations::where('tour_id','=',$tour->id)->orderBy('id', 'DESC')->get();
        if($request->isMethod('post'))
        {
            $postData = $request->all();
            $rules = array(
                'variation_name'             => 'required|string',
            );
            $validator = Validator::make($postData, $rules);
            if ($validator->fails()){
                return redirect('/admin/tours/'.$tour->id.'/add_variation')->withInput()->withErrors($validator);
            }
            else
            {
                $url = $postData['url'];
                $variation = Variations::create($postData);
                return redirect($url)->with('flash_message_success','Variation created successfully');
            }

        }
        return view('admin.tours.add_variation',compact('variation_details','tour'));
    }

    public function edit_variation(Request $request, Variations $variation)
    {
        $variation_details = Variations::where('id','=',$variation->id)->first();
        if($request->isMethod('post'))
        {
            $postData = $request->all();
            $rules = array(
                'variation_name'             => 'required|string',
            );
            $validator = Validator::make($postData, $rules);
            if ($validator->fails()){
                return redirect('/admin/tours/'.$variation->id.'/edit_variation')->withInput()->withErrors($validator);
            }
            else
            {
                $update_data = array(
                    'variation_name'     => $postData['variation_name'],
                    'tour_id'            => $postData['tour_id'],
                );
                $url = $postData['url'];
                $variation = Variations::where('id','=',$variation->id)->update($update_data);
                // return redirect('/admin/tours/'.$postData['tour_id'].'/add_variation')->with('flash_message_success','Variation updated successfully');
                return redirect($url)->with('flash_message_success','Variation updated successfully');
            }
        }
        return view('admin.tours.edit_variation',compact('variation_details'));
    }

    public function delete_variation(Request $request, Variations $variation)
    {
        Variations::where('id','=',$variation->id)->delete();
        return back()->with('flash_message_success','Variation deleted successfully');
    }

    public function poi_list(Request $request,Tours $tour)
    {
        $poi_details = Poi::where('tour_id','=',$tour->id)->orderBy('id', 'DESC')->get();
        return view('admin.tours.poi_list',compact('poi_details','tour'));        
    }
    public function add_poi(Request $request, Tours $tour)
    {
        $variation_details = Variations::where('tour_id','=',$tour->id)->get();
        if($request->isMethod('post'))
        {
            $postData = $request->all();
            if(isset($postData['variation_id']))
            {
                foreach ($postData['variation_id'] as $key => $value) 
                {
                    $files = $request->file('pic_'.$value);
                    if ($postData['content_type'] == 'image' && $request->hasFile('pic_'.$value)) 
                    {
                        $file = $files[0];
                        $allowedfileExtension=['png','webp'];
                        $filename = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        $check=in_array($extension,$allowedfileExtension);
                        if (!$check)
                        {
                            $error1 =  '<strong>Warning!</strong> Sorry Only Upload png and webp format';
                            return back()->with('flash_message_error',$error1);
                        }
                    }    
                }
            }  
            $rules = array(
                'poi_name'             => 'required|string',
            );
            $validator = Validator::make($postData, $rules);
            if ($validator->fails()){
                return redirect('/admin/tours/'.$tour->id.'/add_poi')->withInput()->withErrors($validator);
            }
            else
            {
                $insert_data = array(
                    'tour_id'           =>$postData['tour_id'],
                    'poi_name'          =>$postData['poi_name'], 
                    'icon_type'         =>$postData['icon_type'], 
                    'content_type'      =>$postData['content_type'], 
                    'lat'               =>$postData['lat'], 
                    'long'              =>$postData['long'], 
                );
                if($variation = Poi::create($insert_data))
                {
                    $poi_id = $variation->id;
                    foreach ($postData['variation_id'] as $key => $value) 
                    {
                        $pic     = "";
                        $content = "";
                        if ($postData['content_type'] == 'image' && $request->hasFile('pic_'.$value)) 
                        {
                            $files = $request->file('pic_'.$value);
                            $file = $files[0];
                            $allowedfileExtension=['png','webp'];
                            $filename = $file->getClientOriginalName();
                            $extension = $file->getClientOriginalExtension();
                            $check=in_array($extension,$allowedfileExtension);
                            if($check)
                            {
                                // $path = public_path(). '/images/';
                                $path = 'images';
                                if (!file_exists($path)) 
                                {
                                    File::makeDirectory($path, $mode = 0777, true, true);
                                }   
                                // File::delete('images/' . $poi_details->image); 
                                $file->move($path, $file->getClientOriginalName());
                                $pic = $file->getClientOriginalName();
                            }
                            
                            $poi_content = array(
                                'tour_id'           =>$postData['tour_id'],
                                'variation_id'      =>$value,
                                'poi_id'            =>$poi_id,
                                'image'             =>$pic,
                            );
                            $poicontent = Poicontent::create($poi_content);
                        }    
                        else if ($postData['content_type'] == 'video' ) 
                        {
                            $poi_content = array(
                                'tour_id'           =>$postData['tour_id'],
                                'variation_id'      =>$value,
                                'poi_id'            =>$poi_id,
                                'image'             =>$postData['video_'.$value]
                            );
                            $poicontent = Poicontent::create($poi_content);
                        } 
                        else if ($postData['content_type'] == 'text' ) 
                        {
                            $content = $postData['editor_'.$value];
                            $poi_content = array(
                                'tour_id'           =>$postData['tour_id'],
                                'variation_id'      =>$value,
                                'poi_id'            =>$poi_id,
                                'content'           =>$content,
                            );
                            $poicontent = Poicontent::create($poi_content);
                        }
                    }
                }
                else
                {
                    return back()->with('flash_message_error','Poi not created');
                }
                // return back()->with('flash_message_success','Poi created successfully');
                 $url = $postData['url'];
                return redirect($url)->with('flash_message_success','Poi created successfully');
            }
        }
        return view('admin.tours.add_poi',compact('variation_details','tour')); 
    }

    public function edit_poi(Request $request, Poi $poi)
    {
        $tour = Tours::where('id','=',$poi->tour_id)->first();
        $poi_details = Poi::where(['tour_id'=>$poi->tour_id,'id' => $poi->id])->first();
        $variation_details = Variations::where('tour_id','=',$poi->tour_id)->get();
        if(count($variation_details) > 0)
        {
            foreach ($variation_details as $key => $value) {
                if($poicontent = Poicontent::where(['variation_id'=>$value->id,'poi_id' => $poi->id])->first())
                {
                    $value['content_id'] = $poicontent->id;
                    $value['content'] = $poicontent->content;
                    $value['image'] = $poicontent->image;
                }
            }
        }

        if($request->isMethod('post'))
        {
            $postData = $request->all();
            $url = $postData['url'];
            if(isset($postData['variation_id']))
            {
                foreach ($postData['variation_id'] as $key => $value) 
                {
                    if ($postData['content_type'] == 'image' && $request->hasFile('pic_'.$value)) 
                    {
                        $files = $request->file('pic_'.$value);
                        $file = $files[0];
                        $allowedfileExtension=['png','webp'];
                        $filename = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        $check=in_array($extension,$allowedfileExtension);
                        if (!$check)
                        {
                            $error1 =  '<strong>Warning!</strong> Sorry Only Upload png and webp format';
                            return back()->with('flash_message_error',$error1);
                        }
                    }    
                    // else if ($postData['content_type'] == 'video' && $request->hasFile('pic_'.$value)) 
                    // {
                    //     $files = $request->file('pic_'.$value);
                    //     $file = $files[0];
                    //     $allowedfileExtension=['mp4'];
                    //     $filename = $file->getClientOriginalName();
                    //     $extension = $file->getClientOriginalExtension();
                    //     $check=in_array($extension,$allowedfileExtension);
                    //     if (!$check)
                    //     {
                    //         $error =  '<strong>Warning!</strong> Sorry Only Upload mp4';
                    //         return back()->with('flash_message_error',$error);
                    //     }
                    // }              
                }
            }  
            $rules = array(
                'poi_name'             => 'required|string',
            );
            $validator = Validator::make($postData, $rules);
            if ($validator->fails()){
                return redirect('/admin/tours/'.$poi->id.'/edit_poi')->withInput()->withErrors($validator);
            }
            else
            {
                $update_data = array(
                    'tour_id'           =>$postData['tour_id'],
                    'poi_name'          =>$postData['poi_name'], 
                    'icon_type'         =>$postData['icon_type'], 
                    'content_type'      =>$postData['content_type'], 
                    'lat'               =>$postData['lat'], 
                    'long'              =>$postData['long'], 
                );
                if($variation =  Poi::where(['id'=>$poi->id])->update($update_data))
                {
                    $poi_id = $poi->id;
                    foreach ($postData['variation_id'] as $key => $value) 
                    {
                        $pic     = "";
                        $content = "";
                        if ($postData['content_type'] == 'image' && $request->hasFile('pic_'.$value)) 
                        {
                            $files = $request->file('pic_'.$value);
                            $file = $files[0];
                            $allowedfileExtension=['png','webp'];
                            $filename = $file->getClientOriginalName();
                            $extension = $file->getClientOriginalExtension();
                            $check=in_array($extension,$allowedfileExtension);
                            if($check)
                            {
                                // $path = public_path(). '/images/';
                                $path = 'images';
                                if (!file_exists($path)) 
                                {
                                    File::makeDirectory($path, $mode = 0777, true, true);
                                }   
                                // File::delete('images/' . $poi_details->image); 
                                $file->move($path, $file->getClientOriginalName());
                                $pic = $file->getClientOriginalName();
                            }
                            
                            $poi_content = array(
                                'tour_id'           =>$postData['tour_id'],
                                'variation_id'      =>$value,
                                'poi_id'            =>$poi_id,
                                'image'             =>$pic,
                                'content'           =>"",
                            );
                            if($id = Poicontent::where(['id'=>$postData['content_id'][$key],'variation_id' => $value])->first())
                            {
                                $poicontent = Poicontent::where(['id'=>$postData['content_id'][$key]])->update($poi_content);
                            }
                            else
                            {
                                $poicontent = Poicontent::create($poi_content);
                            }
                        }    
                        else if ($postData['content_type'] == 'video' && !empty($postData['video_'.$value])) 
                        {
                            // $files = $request->file('pic_'.$value);
                            // $file = $files[0];
                            // $allowedfileExtension=['mp4'];
                            // $filename = $file->getClientOriginalName();
                            // $extension = $file->getClientOriginalExtension();
                            // $check=in_array($extension,$allowedfileExtension);
                            // if($check)
                            // {
                            //     $path = public_path(). '/videos/';
                            //     if (!file_exists($path)) 
                            //     {
                            //         File::makeDirectory($path, $mode = 0777, true, true);
                            //     }   
                            //     // File::delete('images/' . $poi_details->image); 
                            //     $file->move($path, $file->getClientOriginalName());
                            //     $pic = $file->getClientOriginalName();
                            // }

                            $poi_content = array(
                                'tour_id'           =>$postData['tour_id'],
                                'variation_id'      =>$value,
                                'poi_id'            =>$poi_id,
                                'image'             =>$postData['video_'.$value],
                                'content'           =>"",
                            );
                            if($id = Poicontent::where(['id'=>$postData['content_id'][$key],'variation_id' => $value])->first())
                            {
                                $poicontent = Poicontent::where(['id'=>$postData['content_id'][$key]])->update($poi_content);
                            }
                            else
                            {
                                $poicontent = Poicontent::create($poi_content);
                            }
                        } 
                        elseif ( $postData['content_type'] == 'image'  && !isset($postData['pic_'.$value]) ) 
                        {

                        }
                        else if ($postData['content_type'] == 'text' ) 
                        {
                            $content = $postData['editor_'.$value];
                            $poi_content = array(
                                'tour_id'           =>$postData['tour_id'],
                                'variation_id'      =>$value,
                                'poi_id'            =>$poi_id,
                                'content'           =>$content,
                                'image'             =>'',
                            );
                            if($id = Poicontent::where(['id'=>$postData['content_id'][$key],'variation_id' => $value])->first())
                            {
                                $poicontent = Poicontent::where(['id'=>$postData['content_id'][$key]])->update($poi_content);
                            }
                            else
                            {
                                $poicontent = Poicontent::create($poi_content);
                            }
                        }
                    }
                }
                else
                {
                    return back()->with('flash_message_error','Poi not updated');
                }
                return redirect($url)->with('flash_message_success','Poi updated successfully');
            }
        }
        return view('admin.tours.edit_poi',compact('poi_details','variation_details','tour'));
    }

    public function delete_poi(Request $request, Poi $poi)
    {
        Poi::where('id','=',$poi->id)->delete();
        Poicontent::where('poi_id','=',$poi->id)->delete();
        return back()->with('flash_message_success','Poi deleted successfully');
    }

    public function update_default_poi(Request $request)
    {
        $postData = Input::all();
        $update_data = array(
            'default_poi' =>  $postData['status']
        );
        if($postData['status'] == 1)
        {
            $poi = Poi::where(['tour_id'=>$postData['tour_id']])->update(['default_poi' => 0]);
        }
        $poi_update = Poi::where(['id'=>$postData['id']])->update($update_data);
        echo json_encode(array('response'=>$poi_update));
        die; 
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
                            $where = array('tour_id'=>$tour->id,'status'=>0);
                            $password_details = Passwords::where($where)->first();
                            if(!empty($password_details))
                            {
                                $current_password =  $password_details->password;
                                $p_id =  $password_details->id;
                                $update_data = array(
                                    'current_password'   => $current_password,
                                    'updated_at'         => date('Y-m-d H:i:s')
                                );
                                $password_data = array(
                                        'status' => 1,
                                    );
                                Tours::where(['id'=>$tour->id])->update($update_data);
                                $update_pass = Passwords::where(['id'=>$p_id])->update($password_data);
                            }
                            else
                            {
                                $password_data = array(
                                        'status' => 0,
                                    );
                                $update_pass = Passwords::where(['tour_id'=>$tour->id])->update($password_data);

                                $where = array('tour_id'=>$tour->id,'status'=>0);
                                $password_details = Passwords::where($where)->first();
                                if(!empty($password_details))
                                {
                                    $current_password =  $password_details->password;
                                    $p_id =  $password_details->id;
                                    $update_data = array(
                                        'current_password'   => $current_password,
                                        'updated_at'         => date('Y-m-d H:i:s')
                                    );
                                    $password_data = array(
                                            'status' => 1,
                                        );
                                    Tours::where(['id'=>$tour->id])->update($update_data);
                                    $update_pass = Passwords::where(['id'=>$p_id])->update($password_data);
                                }
                            }
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
                            $where = array('tour_id'=>$tour->id,'status'=>0);
                            $password_details = Passwords::where($where)->first();
                            if(!empty($password_details))
                            {
                                $current_password =  $password_details->password;
                                $p_id =  $password_details->id;
                                $update_data = array(
                                    'current_password'   => $current_password,
                                    'updated_at'         => date('Y-m-d H:i:s')
                                );
                                $password_data = array(
                                        'status' => 1,
                                    );
                                Tours::where(['id'=>$tour->id])->update($update_data);
                                $update_pass = Passwords::where(['id'=>$p_id])->update($password_data);
                            }
                            else
                            {
                                $password_data = array(
                                        'status' => 0,
                                    );
                                $update_pass = Passwords::where(['tour_id'=>$tour->id])->update($password_data);

                                $where = array('tour_id'=>$tour->id,'status'=>0);
                                $password_details = Passwords::where($where)->first();
                                if(!empty($password_details))
                                {
                                    $current_password =  $password_details->password;
                                    $p_id =  $password_details->id;
                                    $update_data = array(
                                        'current_password'   => $current_password,
                                        'updated_at'         => date('Y-m-d H:i:s')
                                    );
                                    $password_data = array(
                                            'status' => 1,
                                        );
                                    Tours::where(['id'=>$tour->id])->update($update_data);
                                    $update_pass = Passwords::where(['id'=>$p_id])->update($password_data);
                                }
                            }

                            // $current_password =  $this->randomPassword();
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
                            // $current_password =  uniqid();

                            $where = array('tour_id'=>$tour->id,'status'=>0);
                            $password_details = Passwords::where($where)->first();
                            if(!empty($password_details))
                            {
                                $current_password =  $password_details->password;
                                $p_id =  $password_details->id;
                                $update_data = array(
                                    'current_password'   => $current_password,
                                    'updated_at'         => date('Y-m-d H:i:s')
                                );
                                $password_data = array(
                                        'status' => 1,
                                    );
                                Tours::where(['id'=>$tour->id])->update($update_data);
                                $update_pass = Passwords::where(['id'=>$p_id])->update($password_data);
                            }
                            else
                            {
                                $password_data = array(
                                        'status' => 0,
                                    );
                                $update_pass = Passwords::where(['tour_id'=>$tour->id])->update($password_data);

                                $where = array('tour_id'=>$tour->id,'status'=>0);
                                $password_details = Passwords::where($where)->first();
                                if(!empty($password_details))
                                {
                                    $current_password =  $password_details->password;
                                    $p_id =  $password_details->id;
                                    $update_data = array(
                                        'current_password'   => $current_password,
                                        'updated_at'         => date('Y-m-d H:i:s')
                                    );
                                    $password_data = array(
                                            'status' => 1,
                                        );
                                    Tours::where(['id'=>$tour->id])->update($update_data);
                                    $update_pass = Passwords::where(['id'=>$p_id])->update($password_data);
                                }
                            }
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
        echo "done";
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
            // $tour_details = Tours::where(DB::raw('BINARY `current_password`'), $postData['code'])->get();
            $tour_details = Passwords::where(\DB::raw('BINARY `password`'), $password)->get();
        	// $tour_details = Passwords::where('password','=',$password)->get();
        	if(count($tour_details) > 0)
	        {
	        	if($tour_details[0]->tour_id == $postData['tour_id']){
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
        	$tour_details = Passwords::where(\DB::raw('BINARY `password`'), $password)->get();
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

    public function password()
    {
        $tour_owner = Auth::user()->id;
        if(Auth::user()->role == '10' )
            $where = array('tour_owner'=>$tour_owner);
        else
            $where = array();

        // $tours = Tours::get();
        $tours = \DB::table('tours')
            ->Join('users', 'users.id', '=', 'tours.tour_owner')
            ->select('tours.id as tour_id','tours.password as tour_password','tours.created_at as tour_create','tours.*', 'users.*', \DB::raw('(select COUNT(*) from variations WHERE variations.tour_id = `tours`.`id`) as total_variation'))
            ->where($where)
            ->orderBy('tour_id', 'DESC')
            ->get();        
        return view('admin.tours.password',compact('tours'));
    }

    public function password_list(Request $request,Tours $tour)
    {
        $password_details = Passwords::where('tour_id','=',$tour->id)->orderBy('id', 'DESC')->get();
        return view('admin.tours.password_list',compact('password_details','tour'));        
    }

    public function add_password(Request $request, Tours $tour)
    {
        $variation_details = Passwords::where('tour_id','=',$tour->id)->orderBy('id', 'DESC')->get();
        if($request->isMethod('post'))
        {
            $postData = $request->all();
            $rules = array(
                'set_password'          => 'required|string',
                'password'              => 'required|string|unique:tours,current_password'
            );
            $messages = array(
                    'password.unique' => 'This password is already in use, please choose another one.'
                    );
            $validator = Validator::make($postData, $rules, $messages);
            if ($validator->fails()){
                return redirect('/admin/tours/'.$tour->id.'/add_password')->withInput()->withErrors($validator);
            }
            else
            {
                $password_data = array(
                    'tour_id'  => $tour->id,
                    'current_password' => $postData['password'],
                    'password' => $postData['password'],
                    'set_password' => $postData['set_password'],
                );
                if($postData['set_password'] == 'temporary')
                {
                    $password_data['password_type'] = $postData['password_type'];
                }
                else
                {
                    $password_data['password_type'] = "";
                }
                if($variation = Passwords::create($password_data))
                {
                    $update_data = array(                        
                        'current_password' => $postData['password'],
                    );
                    $update = Passwords::where(['tour_id'=>$tour->id])->update($update_data);
                    return redirect('/admin/tours/'.$tour->id.'/password_list')->with('flash_message_success','Password created successfully');
                }
            }
        }
        return view('admin.tours.add_password',compact('variation_details','tour'));
    }

    public function edit_password(Request $request, Passwords $password)
    {
        $password_details = Passwords::where('id','=',$password->id)->first();
        if($request->isMethod('post'))
        {
            $postData = $request->all();
            $rules = array(
                'set_password'          => 'required|string',
                'password'              => 'required|string|unique:tours,current_password'
            );
            $messages = array(
                    'password.unique' => 'This password is already in use, please choose another one.'
                    );
            $validator = Validator::make($postData, $rules, $messages);
            if ($validator->fails()){
                return redirect('/admin/tours/'.$password->id.'/edit_password')->withInput()->withErrors($validator);
            }
            else
            {
                $password_data = array(
                    'tour_id'  => $postData['tour_id'],
                    'current_password' => $postData['password'],
                    'password' => $postData['password'],
                    'set_password' => $postData['set_password'],
                );
                if($postData['set_password'] == 'temporary')
                {
                    $password_data['password_type'] = $postData['password_type'];
                }
                else
                {
                    $password_data['password_type'] = "";
                }

                if($password = Passwords::where('id','=',$password->id)->update($password_data))
                {
                    $update_data = array(                        
                        'current_password' => $postData['password'],
                    );
                    $update = Passwords::where(['tour_id'=>$postData['tour_id']])->update($update_data);
                    // return redirect('/admin/tours/'.$postData['tour_id'].'/add_variation')->with('flash_message_success','Variation updated successfully');
                    return redirect('/admin/tours/'.$postData['tour_id'].'/password_list')->with('flash_message_success','Password updated successfully');
                }


            }
        }
        return view('admin.tours.edit_password',compact('password_details'));
    }

    public function delete_password(Request $request)
    {
        $postData = $request->all();
        Passwords::where('id','=',$postData['id'])->delete();
        // return back()->with('flash_message_success','Password deleted successfully');
        return response()->json(['success'=>'Password deleted successfully.']);
    }



   
}
