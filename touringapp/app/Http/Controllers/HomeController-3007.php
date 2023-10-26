<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\admin\Tours;
use App\admin\Variations;
use App\admin\Poi;
use App\admin\Poicontent;
use Auth;

class HomeController extends Controller
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
        return view('welcome');
    }

    public function start_tour(Request $request)
    {
        $postData = Input::all();
        if($request->isMethod('post'))
        {
            $tour_details = Tours::where('current_password','=',$postData['code'])->get();
            if(count($tour_details) > 0)
            {
                $tour_id = $tour_details[0]->id;
                $variation_details = Variations::where('tour_id','=',$tour_id)->get();  
                setcookie('current_password', $tour_details[0]->current_password, time() + (86400 * 30), "/"); // 86400 = 1 day    
                return view('tour',compact('tour_details','variation_details'));
            }
            else
            {
                $error = "Not found";    
                return back()->withErrors(['flash_message_error', $error]);
            }
        }
        return back();
    }
    public function get_poi(Request $request, $tour_id = NULL, $variation_id = NULL )
    {
        $postData = $request->all();
        // $poi_details = Poi::where(['variation_id' => $postData['id'] ])->get();
    	$tour_details = Tours::where('id', $tour_id)->first();
        $where = array('poi_content.variation_id' => $variation_id);
        $where['poi_content.tour_id']  = $tour_id;
        if($tour_details->tour_control == 'yes'){
            $where['poi.content_type']  = 'text';
        }  
        // $poi_details = Poi::where($where)->get();
        // $poi_details = Poi::where('tour_id', $tour_id)->first();
        // $poi_content = Poicontent::where('tour_id', $tour_id)->get();
        $poi_details = \DB::table('poi')
            ->Join('poi_content', 'poi_content.poi_id', '=', 'poi.id')
            ->select('poi_content.id as content_id','poi_content.content as contentData','poi_content.image as imageData','poi_content.*','poi.id as poi_id','poi.*')
            ->where($where)
            ->get();
        return view('get_tour_map',compact('poi_details','tour_details'));
    }

    public function check_password(Request $request)
    {
        $postData = $request->all();
        $tour_details = Tours::where('id','=',$postData['tour_id'])->first();
        if(!isset($_COOKIE['current_password'])) {
             return response()->json(['status' => 'failed', 'message' =>'Password not matched']); 
        } 
        else 
        {
            if($_COOKIE['current_password'] == $tour_details->current_password) {
                return response()->json(['status' => 'success', 'message'=>'Password matched.']);
            } else {
                return response()->json(['status' => 'failed', 'message' =>'Password not matched']);   
            }
        }
        die('dddd');
    }
}
