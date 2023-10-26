<?php

namespace App\Http\Controllers;
use Session;
use App\User;
use App\Property_images;
use App\Requirement;
use App\property_list;
use App\property_views;
use App\requirement_views;
use App\Client;
use App\Building_features;
use App\Subscription;
use App\Invoice;
use App\Search_data;
use App\agent_connect;
use App\messages;
use App\delete_conversation;
use App\msg_list;
use Mail;
use Auth;
use DB;
use File;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

use App\Imports\PropertyImport;
use App\Exports\PropertyExport;
use Maatwebsite\Excel\Facades\Excel;

class agentController extends Controller
{
	public function __construct()
	{
	    $this->middleware(['is_agent'], ['except' => ['login','signup']]);
	}

    public function signup(Request $request){
   			if($request->isMethod('post')){
		   			$postData = Input::all();
					$rules = array(
						'fname' => 'required',
						'lname' => 'required',
						'email' => 'required|email|unique:users',
						'password' => 'required|min:8',
						'city_name' => 'required',
						'state' => 'required',
						'state_licence_id' => 'required',
						'realestate_firm' =>'required',
					);
				$validator = Validator::make($postData, $rules);
				if ($validator->fails()){
						return redirect('agent/signup')->withInput()->withErrors($validator);
					}else{
		           $user = new User;
		           $user->fname = $request->fname;
		           $user->lname = $request->lname;
		           $user->email = $request->email;
		           $user->password = bcrypt($request->password);
		           $user->state = $request->state;
		           $user->city_name =$request->city_name;
		           $user->zipcode =$request->zipcode;
		           $user->state_licence_id = $request->state_licence_id;
		           $user->realestate_firm = $request->realestate_firm;
		           // $user->agent_profile_url = $request->agent_profile_url;
		           $user->role = "0";
		           $user->save();
		          $data = $request->input();
				   if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
						return redirect('membership')->with('flash_message_error','You do not have active membership!');
				   	// return redirect('signuppre')->with('flash_message_error','You do not have active membership!');
					}
				 }
    }
   	return view('signup');
   }
   public function login(Request $request){
	   	if($request->isMethod('post'))
	   	{
	   	   $postData = Input::all();
			$rules = array(
				'email' => 'required|email',
				'password' => 'required',
			);
           	$validator = Validator::make($postData, $rules);

			if ($validator->fails())
			{
				return redirect('agent/login')->withInput()->withErrors($validator);
			}
			else
			{
				$data = $request->input();
				$users = User::where('email',$data['email'])->first();
				if(isset($users) )
				{
					if($users->role == 0)
					{
						if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) 
					    {
							return redirect('membership')->with('flash_message_error','You do not have active membership!');

						}
					}
					else
					{
						if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'],'role' => '3'])) {
							return redirect('agent-dashboard');
						}else{
							return redirect('agent/login')->withInput()->with('flash_message_error','Invalid Email or Password');
						}
					}
				}
				else
				{
					return redirect('agent/login')->with('flash_message_error','Invalid Email');
				}
   	       }
   	    }
   	    return view('login');
    }
    public function dashboard(){
    	return redirect('/');
    }
    public function logout()
    {
		Auth::logout();
		return redirect('agent/login')->with('flash_message_success','Logged out Successfully');
    }
    public function add_property(Request $request)
    {
    	$sidebar = 'add_property';
    	$uid= Auth::user()->id;
        $property_images= Property_images::where('created_by', $uid)->where('property_id',0)->get();
        foreach ($property_images as $key => $value) {
        	if(file_exists(public_path().'/images/'.$value->image_name))
	    	{
	    	   unlink(public_path().'/images/'.$value->image_name);
	    	}
	    	else{
	    	   	// echo"file not found";
	    	}
        }
        $del_property_images = Property_images::where('created_by', $uid)->where('property_id',0)->delete();
    	$amenities = DB::table('amenities')->get();
    	$clients = DB::table('client')->where('user_id',Auth::user()->id)->get();
    	$building = Building_features::get();
    	return view('agent/add_property',compact('amenities','clients','sidebar','building'));  
    }
    public function add_requirement(Request $request)
    {
    	$sidebar = 'add_requirement';
    	$amenities = DB::table('amenities')->get();
    	$clients = DB::table('client')->where('user_id',Auth::user()->id)->get();
    	$building = Building_features::get();
    	return view('agent/add_requirement',compact('amenities','clients','sidebar','building'));
    }
	public function store_requirement(Request $request){
   	if($request->isMethod('post'))
	    {
	      	$sidebar = 'add_requirement';
	       	$store = Input::all();
	       	$min_price = $store['min_price'];
	       	$min_price = str_replace(',','', $min_price);
	       	$max_price = $store['max_price'];
	       	$max_price = str_replace(',','', $max_price);
	       	if($min_price > 100000000)
	       	{
	       		return back()->withInput()->with('flash_message_error','You can not add min price more than $100,000,000');
	       	}
	       	if($max_price > 100000000)
	       	{
	       		return back()->withInput()->with('flash_message_error','You can not add max price more than $100,000,000');
	       	}
	       	if($min_price > $max_price)
	       	{
	       		return back()->withInput()->with('flash_message_error','The max price must be greater than min price');
	       	}

	       	$rules = array(
				'title' => 'required|max:255',
				// 'email' => 'required|email',
				'city_name' => 'required|string',
				'local_area' => 'required',
				'property_type' => 'required',
				'discription' => 'required',
				'min_room' => 'required|integer|min:1',
				'max_room' => 'required|integer|min:'. (int)$request->min_room .'',
				// 'min_bathroom' => 'integer|min:1',
				// 'max_bathroom' => 'integer|min:'. (int)$request->min_bathroom .'',
          	);
          	$messages = array(
                'max_room.min' => 'The Max-Bedrooms must be greater than Min-Bedrooms',
                'max_bathroom.min' => 'The Max-Bathrooms must be greater than Min-Bathrooms',
                'discription.required' => 'The description field is required',
            );
            
           	$validator = Validator::make($store, $rules, $messages);
	        if ($validator->fails()){
	          return back()->withInput()->withErrors($validator);
	        }
	        if($request->amenities !="")
	        {
		        $amenity =  implode($store['amenities'], ',');
		        $store['amenity'] = $amenity;
	       	}
	        $amenities = DB::table('amenities')->get();
	       
	        if($request->building_features !="")
	        {
		        $building =  implode($store['building_features'], ',');
		        $store['building'] = $building;
		        $building_features = Building_features::get();

	       	}  	
	        if($store['client'] == 0){
	        	$store['client_name'] = Auth::user()->name;
	        }
	        else{
		        $client = Client::where(['id' => $store['client']])->first();
		        $store['client_name'] = $client['fname'];
	        }
	        return view('agent/preview_requirement',compact('store','amenities','sidebar','building_features'));
	      
	    }
    }
    public function update_requirement(Request $request, $id = null)
    {
   		if($request->isMethod('post'))
	    {
	      	$sidebar = 'add_requirement';
	       	$store = Input::all();
	       	$min_price = $store['min_price'];
	       	$min_price = str_replace(',','', $min_price);
	       	$min_price = str_replace('$','', $min_price);

	       	$max_price = $store['max_price'];
	       	$max_price = str_replace(',','', $max_price);
	       	$max_price = str_replace('$','', $max_price);
	       	if($min_price > 100000000)
	       	{
	       		return back()->with('flash_message_error','You can not add min price more than $100,000,000');
	       	}
	       	if($max_price > 100000000)
	       	{
	       		return back()->with('flash_message_error','You can not add max price more than $100,000,000');
	       	}

	       	$rules = array(
				'title' => 'required|max:255',
				'city_name' => 'required|string',
				'local_area' => 'required',
				'property_type' => 'required',
				'discription' => 'required',
				'min_price' => 'required',
				'max_price' => 'required',
				'min_room' => 'required|integer|min:1',
				'max_room' => 'required|integer|min:'. (int)$request->min_room .'',
          	);
          	$messages = array(
                'max_room.min' => 'The Max-Bedrooms must be greater than Min-Bedrooms',
            );
           	$validator = Validator::make($store, $rules, $messages);
	        if ($validator->fails()){
	          return back()->withInput()->withErrors($validator);
	        }
	        $amenity = ($request->amenities !="") ? implode($store['amenities'], ',') : "";
	        $building_features =($request->building_features !="") ? implode($store['building_features'], ',') : "";
	       	unset($store['_token']);
	       	unset($store['amenities']);
	       	unset($store['building_features']);
	       	$store['building_features'] = $building_features;
	       	$store['amenities'] = $amenity;
	       	$store['min_price'] = $min_price;
	       	$store['max_price'] = $max_price;
	       	$requirement = Requirement::where(['id' =>$id ])->update($store);
	        return redirect('myview/require/'.$id)->with('flash_message_update','update successfully');
	    }
    }
    public function delete_requirement($id)
    {
      	Requirement::where('id',$id)->delete();
        return redirect('agent/requirement/list');
    }
    public function update_property(Request $request, $id = null)
    {
   		if($request->isMethod('post'))
	    {
	    	$price = $request->price;
	       	$price = str_replace(',','', $price);
	       	if($price > 100000000)
	       	{
	       		return back()->withInput()->with('flash_message_error','You can not add price more than $100,000,000');
	       	}
	      	$sidebar = 'add_property';
	       	$store = Input::all();
	       	$rules = array(
				'title' => 'required|max:20',
    			'cross_streets' => 'required',
				'city_name' => 'required',
				'local_area' => 'required',
				'rooms' => 'required|numeric|max:50',
				'bathroom' => 'required|numeric|max:50',
				'price' => 'required',
				'size' => 'required|numeric|min:1',
				'property_type' => 'required',
          	);
           	$validator = Validator::make($store, $rules);
	        if ($validator->fails()){
	          return back()->withInput()->withErrors($validator);
	        }
	        
	        $amenity = ($request->amenities !="") ? implode($store['amenities'], ',') : "";
	        $building =($request->building_features) ? implode($store['building_features'], ',') : "";
	        $exposure =($request->exposure) ? implode($store['exposure'], ',') : "";
            
	       	unset($store['_token']);
	       	unset($store['amenities']);
	       	unset($store['building_features']);
	       	unset($store['exposure']);
	       	$store['building_features'] = $building;
	       	$store['exposure'] = $exposure;
	       	$store['amenities'] = $amenity;
	       	$store['price'] = $price;

	       	$uid =Auth::user()->id;
	       	$property_images= Property_images::where('created_by', $uid)
	       						->where('property_id',0)
	       						->update(['property_id' =>$id]);

	       	$requirement = property_list::where(['id' =>$id ])->update($store);
	        return redirect('property/detail/'.$id)->with('flash_message_update','update successfully');
	    }
    }
    public function delete_property($id)
    {
    	$property_images = Property_images::where('property_id',$id)->get();
    	 foreach ($property_images as $property_image) {
    	  if(file_exists(public_path().'/images/'.$property_image->image_name))
    	  {
    	   unlink(public_path().'/images/'.$property_image->image_name);
    	   }
    	   else{
    	   	echo"file not found";
    	   }
    	 }
      	 property_list::where('id',$id)->delete();
        return redirect('myproperty/list');
    }
    public function store_preview_requirement(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    	$store = Input::all();
    	$store = new Requirement;
              $store->title = $request->title;
              $store->client = $request->client;
              $min_price = str_replace(',', '', $request->min_price);
              $max_price = str_replace(',', '', $request->max_price);
              $store->min_price = $min_price;
              $store->max_price = $max_price;
              $store->min_bathroom = $request->min_bathroom;
              $store->max_bathroom = $request->max_bathroom;
              $store->all_cash = $request->all_cash;
              $store->exchange = $request->exchange;
              $store->property_type = $request->property_type;
              $store->min_room = $request->min_room;
              $store->max_room = $request->max_room;
              $store->amenities = $request->amenities;
              $store->building_features = $request->building_features;
              $store->purpose = $request->purpose;
              $store->discription = $request->discription;
              $store->city_name = $request->city_name;
              $store->longitude = $request->longitude;
              $store->latitude = $request->latitude;
              $store->local_area = $request->local_area;
              $store->pre_approved = $request->pre_approved;
              $store->investment_buyer = $request->investment_buyer;
              $store->status = $request->status;
              $store->max_size = $request->max_size;
              $store->userid = Auth::user()->id;
              $store->save();
              return redirect('agent/requirement/list')->with('flash_message_success','Requirement successfully added');
        }
    }
   	public function dragdrop(Request $request)
    {
		$postData = $request->all();
		$file = $request->file('file');
		$file_name = uniqid().'_'.time().'_'.Auth::user()->id.'.'.$file->getClientOriginalExtension();
		if($request->hasFile('file'))
        {
            $destinationPath = "images";
            $file->move($destinationPath,$file_name);
            $target_file = $file_name;
            $property_images = new Property_images;
            $property_images->image_name = $target_file;
            $property_images->property_id = 0;
            $property_images->created_by = Auth::user()->id;
            $property_images->save();
            return response()->json(['status' => 'success', 'target_file' => $target_file]);
        }
    }
    public function property_list()
    {
    	return view('agent.property_list');
    }


    public function search_req(Request $request)
    {
    	$postData = Input::all();
    	$latitude = 0;
		$longitude = 0;
		if (isset($_GET['latitude'])) {
            $latitude =$postData['latitude'];
			$longitude =$postData['longitude'];
			$city_prefil = $request->search;
        } 
		if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 3;
        $offset = ($pageno-1) * $no_of_records_per_page;

        $page = $pageno;
        $limit = $no_of_records_per_page;
       
        if(!empty($postData['search_by']) && $postData['search_by'] == 'requirement')
        {
            if(!empty($postData['search']) && $latitude == 0)
        	  {
        	  	  return view('agent/requirement_search');
        	  }
        	if(!isset($latitude) && $latitude == 0)
        	{ 
                $total_property = \DB::table('requirement')
	            ->select('*')
	  			->where('status','active')
	  			->orderBy('id','DESC')       	
	            ->get();
	            $total_rows = count($total_property);
	            $total_pages = ceil($total_rows / $no_of_records_per_page);
	             $property_list = \DB::table('requirement')
	            ->select('*')      	
	  			->limit($no_of_records_per_page)
	  			->offset($offset)
	  			->where('status','active')
	  			->orderBy('id','DESC')
	            ->get();  
        	}	
        	else{
              $total_property = \DB::table('requirement')
	            ->select('*',\DB::raw('( 
				    3959 * acos (
				      cos ( radians('.$latitude.') )
				      * cos( radians( latitude ) )
				      * cos( radians( longitude ) - radians('.$longitude.') )
				      + sin ( radians('.$latitude.') )
				      * sin( radians( latitude ) )
				    )
				  ) as distance') )   
	  			->having('distance','<',15)
	  			->where('status','active')
	  			->orderBy('id','DESC')       	
	            ->get();
	            $property_list = \DB::table('requirement')
	            ->select('*',\DB::raw('( 
				    3959 * acos (
				      cos ( radians('.$latitude.') )
				      * cos( radians( latitude ) )
				      * cos( radians( longitude ) - radians('.$longitude.') )
				      + sin ( radians('.$latitude.') )
				      * sin( radians( latitude ) )
				    )
				  ) as distance') )   
	  			->having('distance','<',15)       	
	  			->limit($no_of_records_per_page)
	  			->offset($offset)
	  			->where('status','active')
	  			->orderBy('id','DESC')
	            ->get();
        	}
	 	    $total_rows = count($total_property);
	        $total_pages = ceil($total_rows / $no_of_records_per_page);
	    	return view('agent/requirement_search',compact('property_list','page','total_pages','limit','longitude','latitude','city_prefil'));
        }
        else
        {
        	if(!empty($postData['search']) && $latitude == 0)
        	  {
        	  	  return view('agent/property_list');
        	  }
        	if(!isset($latitude) && $latitude == 0)
        	{
        		$total_property = \DB::table('property_list')
	            ->select('*')
	  			->where('status','active')
	  			->orderBy('id','DESC')       	
	            ->get();
	        $total_rows = count($total_property);
	        $total_pages = ceil($total_rows / $no_of_records_per_page);
             $property_list = \DB::table('property_list')
	            ->select('*')     	
	  			->limit($no_of_records_per_page)
	  			->offset($offset)
	  			->where('status','active')
	  			->orderBy('id','DESC') 
	            ->get();
        	}
        	else{
              $total_property = \DB::table('property_list')
	            ->select('*',\DB::raw('( 
				    3959 * acos (
				      cos ( radians('.$latitude.') )
				      * cos( radians( latitude ) )
				      * cos( radians( longitude ) - radians('.$longitude.') )
				      + sin ( radians('.$latitude.') )
				      * sin( radians( latitude ) )
				    )
				  ) as distance') )   
	  			->having('distance','<',15)
	  			->where('status','active')
	  			->orderBy('id','DESC')       	
	            ->get();
	 	    $total_rows = count($total_property);
	        $total_pages = ceil($total_rows / $no_of_records_per_page);

	        $property_list = \DB::table('property_list')
	            ->select('*',\DB::raw('( 
				    3959 * acos (
				      cos ( radians('.$latitude.') )
				      * cos( radians( latitude ) )
				      * cos( radians( longitude ) - radians('.$longitude.') )
				      + sin ( radians('.$latitude.') )
				      * sin( radians( latitude ) )
				    )
				  ) as distance') )   
	  			->having('distance','<',15)       	
	  			->limit($no_of_records_per_page)
	  			->offset($offset)
	  			->where('status','active')
	  			->orderBy('id','DESC') 
	            ->get();
        	}
	    	return view('agent/property_list',compact('property_list','page','total_pages','limit','longitude','latitude','city_prefil'));
        }

        
    }
    public function advance_search(Request $request)
    {
    	$sidebar = 'search_property';
    	$postData = Input::all();
    	$where = array();
		if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 3;
        $offset = ($pageno-1) * $no_of_records_per_page;
		$query = \DB::table('property_list')
    	           ->select('*');
    	if (isset($_GET['latitude']) && $_GET['latitude'] !="" ) {
            $latitude =$postData['latitude'];
			$longitude =$postData['longitude'];
        } 
        if (isset($_GET['property_type']) && $_GET['property_type'] !="") {
            $where['property_type'] = $postData['property_type'];
        } 
        if (isset($_GET['purpose']) && $_GET['purpose'] !="") {
            $where['type'] = $postData['purpose'];
        }
        if(isset($_GET['purpose1']) && $_GET['purpose1'] !=""){
        	$where['purpose'] = $postData['purpose1'];
        }
        if(isset($_GET['all_cash']) && $_GET['all_cash'] !="")
        {
        	$where['all_cash'] = $postData['all_cash'];
        }
        if(isset($_GET['exchange']) && $_GET['exchange'] !="")
        {
        	$where['exchange'] = $postData['exchange'];
        }
        if(isset($_GET['zipcode']) && $_GET['zipcode'] !="")
        {
        	$where['zipcode'] = $postData['zipcode'];
        } 
          

			$query = $query->where($where);
			if(isset($_GET['min_price']) && isset($_GET['max_price']))
	        {
	           if($_GET['min_price'] !="" && $_GET['max_price'] !="")
	           {
	             $min_price = $_GET['min_price'];
	             $max_price = $_GET['max_price'];	
	          	 $query = $query->whereBetween('price', [$min_price, $max_price]);
	           }
	        }
	        if(isset($_GET['min_price']) && $_GET['min_price'] !="")
	        {
	        	$min_price = $_GET['min_price'];
	        	
	        	$query = $query->where('price','>=', $min_price);
	        }
	        if(isset($_GET['max_price']) && $_GET['max_price'] !="")
	        {
				$max_price = $_GET['max_price'];
				$query = $query->where('price', '<=', $max_price);
	        }
	        if(isset($_GET['min_room']) && isset($_GET['max_room']))
	        {
	           if($_GET['min_room'] !="" && $_GET['max_room'] !="")
	           {
					$min_room = $_GET['min_room'];
					$max_room = $_GET['max_room'];	
					$query = $query->whereBetween('rooms', [$min_room, $max_room]);
	           }
	        }
	        if(isset($_GET['min_room']) && $_GET['min_room'] !="")
	        {
	        	$min_room = $_GET['min_room'];
	        	$query = $query->where('rooms', '>=', $min_room);
	        }
	        if(isset($_GET['max_room']) && $_GET['max_room'] !="")
	        {
        	 	$max_room = $_GET['max_room'];
	        	$query = $query->where('rooms', '<=', $max_room);
	        }
            if(isset($_GET['min_bathroom']) && isset($_GET['max_bathroom']))
	        {
	           if($_GET['min_bathroom'] !="" && $_GET['max_bathroom'] !="")
	           {
					$min_bathroom = $_GET['min_bathroom'];
					$max_bathroom = $_GET['max_bathroom'];	
					$query = $query->whereBetween('bathroom', [$min_bathroom, $max_bathroom]);
	           }
	        }
	        if(isset($_GET['min_bathroom']) && $_GET['min_bathroom'] !="")
	        {
	        	$min_bathroom = $_GET['min_bathroom'];
	            	$query = $query->where('bathroom', '>=', $min_bathroom);
	        }
	        if(isset($_GET['max_bathroom']) && $_GET['max_bathroom'] !="")
	        {
				$max_bathroom = $_GET['max_bathroom'];
				$query = $query->where('bathroom', '<=', $max_bathroom);
	        }
	        if(isset($_GET['search']) && $_GET['search'] !="")
		    { 
		        if (isset($_GET['latitude']) && $_GET['latitude'] !="") 
		       	{	
				
					$latitude =$postData['latitude'];
					$longitude =$postData['longitude'];
					$query = $query->addSelect(DB::raw('( 
						    3959 * acos (
						      cos ( radians('.$latitude.') )
						      * cos( radians( latitude ) )
						      * cos( radians( longitude ) - radians('.$longitude.') )
						      + sin ( radians('.$latitude.') )
						      * sin( radians( latitude ) )
						    )
						  ) as distance') )->having('distance','<',43);
					
				}
			}
		if(isset($_GET['search2']) && $_GET['search2'] !="")
		{	
			if (isset($_GET['latitude2']) && $_GET['latitude2'] !="") 
	       	{	
			
				$latitude2 =$postData['latitude2'];
				$longitude2 =$postData['longitude2'];
				$query = $query->addSelect(DB::raw('( 
					    3959 * acos (
					      cos ( radians('.$latitude2.') )
					      * cos( radians( latitude ) )
					      * cos( radians( longitude ) - radians('.$longitude2.') )
					      + sin ( radians('.$latitude2.') )
					      * sin( radians( latitude ) )
					    )
					  ) as distance2') )->having('distance2','<',27);
			}
		}
		if(isset($_GET['search1']) && $_GET['search1'] !="")
		{	
			if (isset($_GET['latitude1']) && $_GET['latitude1'] !="") 
	       	{	
			
				$latitude1 =$postData['latitude1'];
				$longitude1 =$postData['longitude1'];
				$query = $query->addSelect(DB::raw('( 
					    3959 * acos (
					      cos ( radians('.$latitude1.') )
					      * cos( radians( latitude ) )
					      * cos( radians( longitude ) - radians('.$longitude1.') )
					      + sin ( radians('.$latitude1.') )
					      * sin( radians( latitude ) )
					    )
					  ) as distance1') )->having('distance1','<',43);
			}
		}	
  			$total_property = $query->where('status','active')
  			->orderBy('id','DESC')        	
            ->get();
	 	    $total_rows = count($total_property);
	        $total_pages = ceil($total_rows / $no_of_records_per_page);

        
  			$property_list = $query->limit($no_of_records_per_page)
  			->offset($offset)
  			->where('status','active')
  			->orderBy('id','DESC') 
            ->get(); 
    	 $page = $pageno;
    	 $limit = $no_of_records_per_page;
    	 return view('agent/property_list',compact('property_list','page','total_pages','limit','sidebar'));
    }

    public function requirement_advance_search(Request $request)
    {
    	$sidebar = 'search_buyer';
    	$postData = Input::all();
    	$where = array();
		if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 3;
        $offset = ($pageno-1) * $no_of_records_per_page;
		$query = \DB::table('requirement')
    	           ->select('*');
    	if (isset($_GET['latitude']) && $_GET['latitude'] !="" ) {
            $latitude =$postData['latitude'];
			$longitude =$postData['longitude'];
        } 
        if (isset($_GET['property_type']) && $_GET['property_type'] !="") {
            $where['property_type'] = $postData['property_type'];
        } 
        if (isset($_GET['purpose']) && $_GET['purpose'] !="") {
            $where['purpose'] = $postData['purpose'];
        }
        if(isset($_GET['all_cash']) && $_GET['all_cash'] !="")
        {
        	$where['all_cash'] = $postData['all_cash'];
        }
        if(isset($_GET['exchange']) && $_GET['exchange'] !="")
        {
        	$where['exchange'] = $postData['exchange'];
        }
        if(isset($_GET['zipcode']) && $_GET['zipcode'] !="")
        {
        	$where['zipcode'] = $postData['zipcode'];
        } 
          

			$query = $query->where($where);
			
	        if(isset($_GET['min_price']) && $_GET['min_price'] !="")
	        {
	        	$min_price = $_GET['min_price'];
	        	
	        	$query = $query->where('min_price','<=', $min_price);
				$query = $query->where('max_price', '>=', $min_price);
	        }
	   //      if(isset($_GET['max_price']) && $_GET['max_price'] !="")
	   //      {
				// $max_price = $_GET['max_price'];
				// $query = $query->where('max_price', '<=', $max_price);
	   //      }
	        if(isset($_GET['min_room']) && $_GET['min_room'] !="")
	        {
	        	$min_room = $_GET['min_room'];
	        	$query = $query->where('min_room', '<=', $min_room);
	        	$query = $query->where('max_room', '>=', $min_room);
	        }
	        // if(isset($_GET['max_room']) && $_GET['max_room'] !="")
	        // {
        	//  	$max_room = $_GET['max_room'];
	        // 	$query = $query->where('max_room', '<=', $max_room);
	        // }
	        if(isset($_GET['min_bathroom']) && $_GET['min_bathroom'] !="")
	        {
	        	$min_bathroom = $_GET['min_bathroom'];
	            	$query = $query->where('min_bathroom', '<=', $min_bathroom);
				$query = $query->where('max_bathroom', '>=', $min_bathroom);
	        }
	   //      if(isset($_GET['max_bathroom']) && $_GET['max_bathroom'] !="")
	   //      {
				// $max_bathroom = $_GET['max_bathroom'];
				// $query = $query->where('max_bathroom', '<=', $max_bathroom);
	   //      }
	    if(isset($_GET['search']) && $_GET['search'] !="")
	    {    
	        if (isset($_GET['latitude']) && $_GET['latitude'] !="") 
	       	{	
			
				$latitude =$postData['latitude'];
				$longitude =$postData['longitude'];
				$query = $query->addSelect(DB::raw('( 
					    3959 * acos (
					      cos ( radians('.$latitude.') )
					      * cos( radians( latitude ) )
					      * cos( radians( longitude ) - radians('.$longitude.') )
					      + sin ( radians('.$latitude.') )
					      * sin( radians( latitude ) )
					    )
					  ) as distance') )->having('distance','<',43);
				
			}
		}	
		if(isset($_GET['search2']) && $_GET['search2'] !="")
		{	
			if (isset($_GET['latitude2']) && $_GET['latitude2'] !="") 
	       	{	
			
				$latitude2 =$postData['latitude2'];
				$longitude2 =$postData['longitude2'];
				$query = $query->addSelect(DB::raw('( 
					    3959 * acos (
					      cos ( radians('.$latitude2.') )
					      * cos( radians( latitude ) )
					      * cos( radians( longitude ) - radians('.$longitude2.') )
					      + sin ( radians('.$latitude2.') )
					      * sin( radians( latitude ) )
					    )
					  ) as distance2') )->having('distance2','<',27);
			}
		}	
		if(isset($_GET['search1']) && $_GET['search1'] !="")
		{	
			if (isset($_GET['latitude1']) && $_GET['latitude1'] !="") 
	       	{	
			
				$latitude1 =$postData['latitude1'];
				$longitude1 =$postData['longitude1'];
				$query = $query->addSelect(DB::raw('( 
					    3959 * acos (
					      cos ( radians('.$latitude1.') )
					      * cos( radians( latitude ) )
					      * cos( radians( longitude ) - radians('.$longitude1.') )
					      + sin ( radians('.$latitude1.') )
					      * sin( radians( latitude ) )
					    )
					  ) as distance1') )->having('distance1','<',43);
			}
		}	
  			$total_property = $query->where('status','active')
  			->orderBy('id','DESC')        	
            ->get();
	 	    $total_rows = count($total_property);
	        $total_pages = ceil($total_rows / $no_of_records_per_page);

        	// \DB::enableQueryLog();
  			$property_list = $query->limit($no_of_records_per_page)
  			->offset($offset)
  			->where('status','active')
  			->orderBy('id','DESC') 
            ->get(); 
            // $query = \DB::getQueryLog();
            // print_r($query);

    	
    	$page = $pageno;
    	$limit = $no_of_records_per_page;
    	return view('agent/requirement_search',compact('property_list','page','total_pages','limit','sidebar'));
    }

    public function preview_property(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    		$sidebar = 'add_property';
    		$store = Input::all();
    		$price = str_replace(',','', $store['price']);
	       	if($price > 100000000)
	       	{
	       		return back()->withInput()->with('flash_message_error','You can not add price more than $100,000,000');
	       	}
    		$rules = array(
    			'title' => 'required|max:255',
    			'cross_streets' => 'required',
				'city_name' => 'required',
				'local_area' => 'required',
				'rooms' => 'required|numeric|max:50',
				'bathroom' => 'required|numeric|max:50',
				// 'half_bathroom' => 'required|numeric|max:20',
				'price' => 'required',
				'size' => 'required|numeric|min:1',
				'property_type' => 'required',
			);
			$messages = array(
				'city_name.required' => 'The City field is required.',
				'local_area.required' => 'The Neighborhood field is required.',
			);
		 	$validator = Validator::make($store, $rules, $messages);
    		if ($validator->fails())
	        {
	          return back()->withInput()->withErrors($validator);
	        }
	        if($request->amenities !="")
	        {
		        $amenity =  implode($store['amenities'], ',');
		        $store['amenity'] = $amenity;
	       	}
	       	if($request->building_features !="")
	       	{
	       		$building = implode($store['building_features'], ',');
	       		$store['building'] = $building;
	       		$building_features = Building_features::get();
	       	}
	       	if($request->exposure !="")
	       	{
	       		$exposure = implode($store['exposure'], ',');
	       		$store['exposure'] = $exposure;

	       	}
	        $amenities = DB::table('amenities')->get();
	        $uid =Auth::user()->id;
	        if($store['client'] == 0){
	        	$store['client_name'] = Auth::user()->name;
	        }
	        else{
		        $client = Client::where(['id' => $store['client']])->first();
		        $store['client_name'] = $client['fname'];
	        }
          	$property_images= Property_images::where('created_by', $uid)->where('property_id',0)->get();
          	$store['price'] = $price;
	        return view('agent.preview_property',compact('store','amenities','property_images','sidebar','building_features'));
    	}
    }
    public function agent_property_save(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    		$store = Input::all();
			$property_list = new property_list;
			$property_list->title = $request->title;
			$property_list->address = $request->address;
			$property_list->type = $request->type;
			$property_list->property_type = $request->property_type;
			$property_list->size = $request->size;
			$price = str_replace(',', '', $request->price);
			$property_list->price = $price;
			$property_list->purpose = $request->purpose;
			$property_list->amenities = $request->amenities;
			$property_list->building_features = $request->building_features;
			$property_list->zipcode = $request->zipcode;
			$property_list->exchange = $request->exchange;
			$property_list->all_cash =  $request->all_cash;
			$property_list->city_name = $request->city_name;
			$property_list->longitude = $request->longitude;
			$property_list->latitude = $request->latitude;
			$property_list->local_area = $request->local_area;
			$property_list->rooms = $request->rooms;
			$property_list->bathroom = $request->bathroom;
			$property_list->half_bathroom = $request->half_bathroom;
			$property_list->cross_streets = $request->cross_streets;
			$property_list->discription = $request->discription;
			$property_list->status = $request->status;
			$property_list->client = $request->client;
			$property_list->monthly_maintenance = $request->monthly_maintenance;
			$property_list->monthly_tax = $request->monthly_tax;
			$property_list->exposure = $request->exposure;
			$property_list->created_by = Auth::user()->id;
			$property_list->save();
			$lastid = $property_list->id;
			$uid= Auth::user()->id;
			$property_images= Property_images::where('created_by', $uid)->where('property_id',0)
			     ->update(['property_id' =>$lastid]);
			return redirect('myproperty/list')->with('flash_message_success', 'Post successfully'); 
		}
  	}
    public function removedata(Request $request)
    {
     $property = Property_images::where('id',$request->input('id'))->first();
     $post= Property_images::find($request->input('id'));
      if($post->delete())
      {
        echo"data deleted";
      }
        unlink(public_path().'/images/'.$property->image_name);
    }
	public function requirement_list_view()
	{ 
		$sidebar = 'my_requirement';
		$list = new Requirement;
	    	$uid = Auth::user()->id;
	    	$list= Requirement::where('userid', $uid)->orderBy('id', 'DESC')->paginate(3);
	    	foreach ($list as $lists) {
	    		$property_type = $lists->property_type;
	    		$rooms = $lists->max_room;
	    		$max_price = $lists->max_price;
	    		$min_price = $lists->min_price;
	    		$min_room =  $lists->min_room;
	    		$max_room = $lists->max_room;
	    	    $min_bathroom =  $lists->min_bathroom;
	    	    $max_bathroom = $lists->max_bathroom;
	    	
	          	$match[$lists->id] = property_list::where('property_type',$property_type)
		          ->whereBetween('price', [ $min_price,$max_price])
		          ->whereBetween('rooms',[ $min_room, $max_room])
		          ->whereBetween('bathroom',[$min_bathroom, $max_bathroom])
		          ->where('status','active')
		          ->get();    

		        $count = requirement_views::where('requirement_id','=',$lists->id)->distinct('ip_address')->count('ip_address');
				$lists->count = $count;

				if($lists->client == 0){
		        	$lists->client_name = Auth::user()->name;
		        }
		        else{
			        $client = Client::where(['id' => $lists->client])->first();
			        if($client !="")
			        {
			        $lists->client_name = $client->fname;
			        }
		        }

			} 
    	return view('agent/requirement_list',compact('list','match','sidebar'));
	}
	public function req_edit(Request $request, $id = null)
	{
		$sidebar = 'add_requirement';
		$user_id = Auth::user()->id;
		$requirement = Requirement::where('id',$id)->first();
		$amenities = DB::table('amenities')->get();
		$clients = DB::table('client')->where('user_id',$user_id)->get();
		$building = Building_features::get();
		return view('agent/edit_requirement',compact('requirement','amenities','clients','sidebar','building'));
	}
	public function property_edit(Request $request, $id = null)
	{
		$sidebar = 'my_property';
		$property = property_list::where('id',$id)->first();
		$amenities = DB::table('amenities')->get();
		$building = Building_features::get();
		$uid = Auth::user()->id;
		$clients = DB::table('client')->where('user_id',$uid)->get();
		$property_images= Property_images::where('created_by', $uid)->where('property_id',$id)->get();
		return view('agent/edit_property',compact('property','property_images','amenities','clients','sidebar','building'));
	}
    public function myproperty_list()
    {
    	$sidebar = 'my_property';
		$uid = Auth::user()->id;
		$property_list = DB::table('property_list')
			->where('created_by',$uid)
			->orderBy('id','DESC')
			->paginate(6);
		foreach ($property_list as $key => $property) 
		{
			$image = DB::table('property_images')
		     		->where('property_id',$property->id)
		     		->first();
			if(isset($image) && !empty($image))
			{
				$property->image = $image->image_name;
			}
			else
			{
				$property->image = "noimage.jpg";
			}

			$count = property_views::where('property_id','=',$property->id)->distinct('ip_address')->count('ip_address');
			$property->count = $count;

			if($property->client == 0){
	        	$property->client_name = Auth::user()->name;
	        }
	        else{
		        $client = Client::where(['id' => $property->client])->first();
		        $property->client_name = $client['fname'];
	        }
		}
		return view('agent/myproperty_list',compact('property_list','sidebar'));
    } 

    public function agent_profile(Request $request)
    {
        $sidebar = 'profile';
        
    	if($request->isMethod('post'))
    	{
    		$postData = Input::all();
            $rules = array(
                        'fname' => 'required',
                        'lname' => 'required',
                         'state' => 'required',
                         'city_name' => 'required',
                        'file' => 'nullable|max:2048',
                    );

             $validator = Validator::make($postData, $rules);
             if ($validator->fails())
             {
               return back()->withInput()->withErrors($validator); 
             }
    		$id = Auth::user()->id;
			$update = User::find($id);
			$update->fname = $request->fname;
			$update->lname = $request->lname;
			$update->email = $request->email;
			$update->state = $request->state;
			$update->city_name =$request->city_name;
			$update->zipcode =$request->zipcode;
			$update->state_licence_id = $request->state_licence_id;
			$update->realestate_firm = $request->realestate_firm;
			$update->agent_profile_url = $request->agent_profile_url;
			$update->phone_no = $request->phone_no;
			$update->public_view = $request->public_view;
            if($request->file !="")
            {
            	$pic="";
            	$pic = User::where('id',$id)->select('profile_pic')->first();
            	if(!empty($pic->profile_pic))
            	{
            		if(file_exists(public_path().'/images/'.$pic->profile_pic)){
						   unlink(public_path().'/images/'.$pic->profile_pic);
						}else{
						    echo 'file not found';
						}
            	}
		           	$files = $request->file('file');
		           	 $file_name = uniqid().'.'.$files->getClientOriginalExtension();
					if($request->hasFile('file'))
					{
					    $destinationPath = "images";
					    $files->move($destinationPath,$file_name);
					    $target_file = $file_name;
					}
					$update->profile_pic = $target_file;
			}
			if($request->firm !="")
            {
		           	$firm = $request->file('firm');
					if($request->hasFile('firm'))
					{
					    $destinationPath = "images";
					    $firm->move($destinationPath,$firm->getClientOriginalName());
					    $target_file_firm = $firm->getClientOriginalName();
					}
					$update->firm_logo = $target_file_firm;
		    }
            $update->save();
            return redirect('property/user/view/'.$id)->with('flash_message_success','Profile updated successfully');
    	}
    	$detail= User::where('id',Auth::user()->id)->first();
        return view('dashboard.edit-profile',compact('sidebar','detail'));
    }
    public function change_password(Request $request)
    { 
    	$sidebar = 'password';
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
                    $rules = array(
                        'new_password' => 'required|string|min:6',
                        'confirm_password' => 'required|string|min:6|same:new_password'
                    );
                    $messages = array(
                    'confirm_password.same' => 'Password and confirm password not match'
                    );

                    $validator = Validator::make($postData, $rules, $messages);
                    if ($validator->fails())
                    {
                        return back()->withInput()->withErrors($validator);
                    }
                    else
                    {
                        $psswd = bcrypt($data['new_password']);
                        User::where(['id'=>$getData->id])->update(['password'=>$psswd]);
                        return back()->with('flash_message_success','Password Changed successfully');
                    }
                }
                else
                {
                    return back()->with('flash_message_error','Incorrect old password');
                }
            }
    	}
        return view('agent.change_password',compact('sidebar'));
    }
       public function property_detail($id)
		 {
		 	$sidebar = 'my_property';
		 	$insert_view_counts = array(
                'property_id' => $id,
                'user_id' => Auth::user()->id,
                'ip_address' => \Request::ip(),
	        );
		 	$property_views = property_views::create($insert_view_counts);
		 	$property_list = property_list::where('id',$id)->first();
            $property_images = Property_images::where('property_id',$id)->get();
            $amenities = DB::table('amenities')->get();
            $building = Building_features::get();
		 	return view('agent/property_detail',compact('property_list','property_images','amenities','sidebar','building'));
		 }
	public function remview($id)
	{
		$sidebar = 'my_requirement';
	 	$insert_view_counts = array(
            'requirement_id' => $id,
            'user_id' => Auth::user()->id,
            'ip_address' => \Request::ip(),
        ); 
	 	$requirement_views = requirement_views::create($insert_view_counts);
		$req = Requirement::where('id',$id)->first();
		$amenities = DB::table('amenities')->get();
		$building_features = Building_features::get();
		return view('agent.req_view',compact('req','sidebar','amenities','building_features'));
	}
	public function agent_dashboard()
    {
    	$property_list = array();
    	$match = array();
        $sidebar = 'requirement';
        $uid = Auth::user()->id;
        $total_requirement      = count(Requirement::where('userid',$uid)->get());
        $total_properties   	= count(property_list::where('created_by',$uid)->get());
        $list = new Requirement;
        $uid = Auth::user()->id;
        $list= Requirement::where('userid', $uid)->orderBy('id', 'DESC')->limit(3)->get();
        foreach ($list as $lists) 
        {
            $match[$lists->id] = property_list::where('property_type',$lists->property_type)
				->whereBetween('price', [ $lists->min_price,$lists->max_price])
				->whereBetween('rooms',[ $lists->min_room, $lists->max_room])
				->whereBetween('bathroom',[$lists->min_bathroom, $lists->max_bathroom])
				->where('status','active')
				->get();


		 	$count = requirement_views::where('requirement_id','=',$lists->id)->distinct('ip_address')->count('ip_address');
			$lists->count = $count; 
			if($lists->client == 0){
	        	$lists->client_name = Auth::user()->name;
	        }
	        else{
		        $client = Client::where(['id' => $lists->client])->first();
		        $lists->client_name = $client['username'];
	        }
        } 
		$property_list = DB::table('property_list')
			->where('created_by',$uid)
			->orderBy('id','DESC')
			->limit(3)->get();   
		foreach ($property_list as $property) 
        {
            $count = property_views::where('property_id','=',$property->id)->distinct('ip_address')->count('ip_address');
			$property->count = $count;
			if($property->client == 0){
	        	$property->client_name = Auth::user()->name;
	        }
	        else{
		        $client = Client::where(['id' => $property->client])->first();
		        $property->client_name = $client->username;
	        }
        }  
        return view('dashboard.dashboard',compact('total_requirement','total_properties','sidebar','list','match','property_list'));
    }
    public function agent_profile_view()
    {
    	$sidebar = 'profile';
    	$requirement_count = count(Requirement::where('userid',Auth::user()->id)->get());
    	$property_count = count(property_list::where('created_by',Auth::user()->id)->get());
    	$user = User::where('id',Auth::user()->id)->first();
    	return view('dashboard.agent_profile_view',compact('sidebar','requirement_count','property_count','user'));
    }
     public function client_list(Request $request)
    {
        $sidebar = 'client_list';
        $slider_list = Client::where('user_id',Auth::user()->id)->orderBy('id','DESC')->paginate(10);
        return view('agent/client_list',compact('slider_list','sidebar'));
    }
    public function edit_client(Request $request , $id)
    {
        $sidebar = 'client';
        $slider_detail = Client::where('id',$id)->first();
        // echo "<pre>";
        // print_r($slider_detail);
        // die('ggg');
        $postData = $request->all();
        $client_image = $slider_detail->client_image;
        if($request->isMethod('post'))
        {
        	$rules1 = array(
                        'fname' => 'required',
                        'lname' => 'required',
                    );
            $validator = Validator::make($postData, $rules1);
             if ($validator->fails())
             {
               return back()->withInput()->withErrors($validator); 
             }
            $Slider = Client::find($id);
            $Slider->fname = $request->fname;
            $Slider->lname = $request->lname;
            $Slider->email = $request->email;
            $Slider->mobile = $request->mobile;
            $Slider->save();
            return redirect('client/list/agent')->with('flash_message_success', 'Update Successfully'); 
        }

        return view('agent/update_clients',compact('slider_detail','sidebar'));
    }
    public function delete_client($id)
    {
    	Client::where('id', $id)->delete();
      return redirect('client/list/agent')->with('flash_message_delete','Client delete successfully');
    }
    public function view_client($id)
    {
    	$sidebar = 'client';
        $slider_detail = Client::where('id',$id)->orderBy('id','DESC')->first();
        $list = Requirement::where('client',$id)->get();
        $property_list = property_list::where('client',$id)->get();
        return view('agent/view_clients',compact('slider_detail','sidebar','list','property_list'));
    }
    public function add_client(Request $request)
    {
        $sidebar = 'add_client';
        $postData = $request->all();
        $client_image = "";
        $user_id = Auth::user()->id;
        if($request->isMethod('post'))
        {
            $rules1 = array(
                        'fname' => 'required',
                        'lname' => 'required',

                    );

             $validator = Validator::make($postData, $rules1);
             if ($validator->fails())
             {
               return back()->withInput()->withErrors($validator); 
             }
        if($request->email !="")
        {
	        $user_email = Client::where('user_id',$user_id)
	        ->where('email',$request->email)
	        ->get();
	        if(count($user_email))
	        {
	        	return back()->withInput()->with('flash_message_email','email already has been taken');
	        }
	    }    
		            $Slider= new Client;
		            $Slider->fname = $request->fname;
		            $Slider->lname = $request->lname;
		            $Slider->email = $request->email;
		            $Slider->mobile = $request->mobile;
		            $Slider->user_id = Auth::user()->id;
		            $Slider->save();
            return redirect('client/list/agent')->with('flash_message_success', 'Client Added Successfully'); 
        }
	 	return view('agent/add_clients',compact('sidebar'));
    }
    public function change_membership(Request $request)
    {
    	$sidebar = 'membership';
    	$response = [];
        if (session()->has('code')) {
            $response['code'] = session()->get('code');
            session()->forget('code');
        }

        if (session()->has('message')) {
            $response['message'] = session()->get('message');
            session()->forget('message');
        }
        $packages = Subscription::get();
        $invoice = Invoice::where('user_id',Auth::user()->id)->where('status',1)->first();
        if($invoice !="")
        {
          $package_active = Subscription::where('id',$invoice->package_id)->first();
        }
        else{
        	$package_active = "";
        }
        return view('agent/membership_change',compact('sidebar','packages','response','package_active'));
    }
    public function search_list_data(Request $request)
    {
    	$sidebar = 'my_search_list';
    	$search_data_property = Search_data::where('user_id',Auth::user()->id)->where('search_type','property')->orderBy('id','DESC')->paginate(9);
    	return view('agent.search_data',compact('sidebar','search_data_property'));
    }
    public function search_list_buyers(Request $request)
    {
    	$sidebar = 'my_search_list';
    	$search_data_buyers = Search_data::where('user_id',Auth::user()->id)->where('search_type','buyers')->orderBy('id','DESC')->paginate(9);
    	return view('agent.search_data_buyers',compact('search_data_buyers','sidebar'));
    }
    public function edit_search_data($id)
    {
    	$sidebar = 'my_search_list';
    	$data = Search_data::where('id',$id)->first();
    	return view('agent.edit_search_data',compact('data','sidebar'));
    }
    public function update_search_data(Request $request,$id)
    {
    	if($request->isMethod('post'))
    	{
    		$data = Search_data::find($id);
    		 $data->title = $request->title;
    		 $data->save();
    		 return back()->with('flash_message_success','Search Data Updated');
    	}
    }
    public function delete_search_data($id)
    {
    	if($id)
    	{
    		$data = Search_data::where('id',$id)->delete();
    		return back()->with('flash_message_success','Data Deleted');

    	}
    }
   public function save_my_search(Request $request)
   {
   	  if($request->isMethod('post'))
   	  {
   	  	if(isset($request->title) && $request->title !="")
    	{
	    	 	$search_data =  new Search_data;
	    	 	$search_data->title = $request->title;
	    	 	$search_data->user_id = Auth::user()->id;
	    	 	$search_data->url =  $request->url;
	    	 	$search_data->search_type = $request->search_type;
	    	 	$search_data->save();
	    	 	return redirect($request->url)->with('flash_message_success','saved successfully');
    	}
   	  }
   }
   public function agent_connect(Request $request)
   {
   	   if($request->isMethod('post'))
   	   {
         $postData = input::all();
   	   	if(!empty($postData['request_id']))
   	   	{
   	   		$cancel_request = agent_connect::where('id',$request->request_id)->delete();
   	   		return back()->with('flash_message_success','Request Cancel');
   	   	}
   	   	else{
   	   		   $where = array('user_id'=>Auth::user()->id,
   	   		   	             'agent_id'=>$request->agent_id);
   	   		   $orwhere = array('agent_id'=>Auth::user()->id,'user_id'=>$request->agent_id);
            $get_record = agent_connect::where($where)->orWhere(function ($qry) use ($orwhere) {
	            $qry->where($orwhere);
	        })->first();
   	   	   if(!empty($get_record))
   	   	   {
              return back()->with('flash_message_success','you are alrady friend');
   	   	   }
   	   	   else{
   	   	   	$agent_connect = new agent_connect;
   	   	   	$agent_connect->user_id = Auth::user()->id;
   	   	   	$agent_connect->agent_id = $request->agent_id;
   	   	   	$agent_connect->save();
   	   	   }
   	   	   return back()->with('flash_message_success','Request Send');
   	   	}
   	   }
   }
   public function user_request_list(Request $request)
   {
   	 $sidebar = 'my_request';
   	  $user_list = agent_connect::where('agent_id',Auth::user()->id)->where('confirm',0)->get();
   	  return view('agent.user_request_list',compact('user_list','sidebar'));
   }
   public function accept_request(Request $request,$id)
   {
		   	if($id)
		   	{  
		   	  $accept_request = agent_connect::find($id);
		   	  $accept_request->confirm = 1;
		   	  $accept_request->save();
		   	  return back()->with('flash_message_success','Request Accepted Successfully');
		   	}  
   }
   public function cancel_request(Request $request,$id)
   {
   	   if($id)
   	   {
   	   	  $cancel_request = agent_connect::where('id',$id)->delete();
   	   	  return back()->with('flash_message_success','Request Cancel Successfully');
   	   }
   } 
   public function agent_accepted_list(Request $request)
   {
   	    $sidebar = 'agent_list';
   	    $data = agent_connect::where('confirm',1)->where('agent_id',Auth::user()->id)->orWhere('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
   	    return view('agent.agent_friend_list',compact('data','sidebar'));
   }
   public function confirm_in_page(Request $request,$id)
   {
   	  	if($id)
		   	{  
		   	  $accept_request = agent_connect::find($id);
		   	  $accept_request->confirm = 1;
		   	  $accept_request->save();
		   	  return back();
		   	}  
   }
   public function chat_box_pannel(Request $request,$id)
   {
   	    $sidebar = 'my_messages';
   	    $reciver_id = $id;
				$name = User::select('fname','lname','profile_pic','id')->where('id',$id)->first();
				$where = array('sender_id'=>Auth::user()->id,
				'reciver_id'=>$id);
				$orwhere = array('reciver_id'=>Auth::user()->id,'sender_id'=>$id); 
				$message = messages::where($where)->orWhere(function ($qry) use ($orwhere) {
				$qry->where($orwhere);
				})->get();
				$delete_button = messages::where($where)->orWhere(function ($qry) use ($orwhere) {
				$qry->where($orwhere);
				})->orderBy('id','DESC')->first();

				return view('agent.chat_box_user',compact('sidebar','message','reciver_id','name','delete_button'));
   }
   public function message_save(Request $request)
   {
   	    if($request->isMethod('post'))
   	    {
   	    	$postData = input::all();
   	    	$rules = array(
                        'file' => 'file|mimes:doc,docx,pdf,txt,ppt,pptx,jpg,png,gif,jpeg,tiff,svg',
                    );
            $validator = Validator::make($postData, $rules);
             if ($validator->fails())
             {
               return back()->withInput()->withErrors($validator); 
             }
             if(empty($request->message) && empty($request->file))
             {

             	return back()->with('flash_message_error','Message Should Be Required');
             }
   	    	$where = array('user_id'=>Auth::user()->id,
                             'agent_id'=>$request->reciver_id);
               $orwhere = array('agent_id'=>Auth::user()->id,'user_id'=>$request->reciver_id);
            $agent_connect = agent_connect::where('confirm',1)->where($where)->orWhere(function ($qry) use ($orwhere) {
                $qry->where($orwhere);
            })->first();
		        if(!empty($agent_connect))
		        {
		   	    	$message1 = new messages;
		   	    	$message1->sender_id = Auth::user()->id;
		   	    	$message1->reciver_id = $request->reciver_id;
		   	    	$message1->message = $request->message;
		   	    	        if ($request->hasFile('file') && !empty($request->file))
		                    {
		                        $file = $request->file('file');
		                        $file_name =uniqid(). '.' .$file->getClientOriginalExtension();
		                        $location = public_path('images');
		                        $file->move($location,$file_name);
		                        $message1->file = $file_name;
		                    }
		   	    	$message1->save();
		   	    	if (!$message1)
					{
					  App::abort(500, 'Error');
					}
		   	    	$msg_list = msg_list::updateOrCreate(
					    ['user_id' => Auth::user()->id, 'reciver_id' => $request->reciver_id],
					    ['last_message_id' => $message1->id,'user_id'=> Auth::user()->id,'reciver_id'=>$request->reciver_id,'delete_status'=> 0]
					);
					$status_update = msg_list::updateOrCreate(
					    ['reciver_id' => Auth::user()->id, 'user_id' => $request->reciver_id],
					    ['delete_status'=> 0]
					    );
					
                    $user_data = User::select('fname','lname','email','id','address')->where('id',$request->reciver_id)->first();
                     $user_name = $user_data->fname;
			                $user_email = trim($user_data->email);
			                $email_data = array(
			                    'name'          => $user_data->name,
			                    "email"         => $user_data->email,
			                    "id"          => Auth::user()->id,
			                    "from"   => $postData['sender_name'],
			                );
			                Mail::send('email.new_message', $email_data, function($message) use ($user_name, $user_email) {
			                    $message->from('pankajdheervisionvivante@gmail.com','Agent Connect');
			                    $message->to($user_email, $user_name)->subject('new messages');
			                });
		   	    	  return back();
		   	    }
		   	    else
		   	    {
		   	    	return back()->with('flash_message_error','This user not your friend list');
		   	    }	
   	    }
   }
   public function message_list(Request $request)
   {
   	    	$sidebar = 'my_messages';
   	    	$distinct = array('reciver_id','user_id');

   	    	 $data = msg_list::where('user_id',Auth::user()->id)->orWhere('reciver_id',Auth::user()->id)
             ->orderBy('updated_at','DESC')->get();
			return view('agent.my_messages_friend',compact('data','sidebar'));
   }
   public function temp_delete_msg(Request $request)
   {
   	    if($request->isMethod('post'))
   	    {
   	    	    $where = array('sender_id'=>Auth::user()->id,'reciver_id'=>$request->reciver_id);
				$orwhere = array('reciver_id'=>Auth::user()->id,'sender_id'=>$request->reciver_id); 
				$message = messages::where($where)->orWhere(function ($qry) use ($orwhere) {
				$qry->where($orwhere);
				})->get();		
			foreach ($message as $key => $msg) {	
				if(empty($msg->delete_1) || is_null($msg->delete_1))
				{
                      $data = messages::find($msg->id);
                      $data->delete_1 = Auth::user()->id;
                      $data->save();
				}
				elseif(!empty($msg->delete_1) && empty($msg->delete_2))
				{
					if($msg->delete_1 != Auth::user()->id)
					{	
                      $data1 = messages::find($msg->id);
                      $data1->delete_2 = Auth::user()->id;
                      $data1->save();
                    }  
				}
			}
			if(isset($data) && !empty($data))
			{
				msg_list::updateOrCreate(
					    ['user_id' => Auth::user()->id, 'reciver_id' => $request->reciver_id],
					    ['delete_status'=> 1]
					);
			}
			if(isset($data1) && !empty($data1))
			{
				msg_list::updateOrCreate(
					    ['user_id' => Auth::user()->id, 'reciver_id' => $request->reciver_id],
					    ['delete_status'=> 1]
					);
			}		
		      // $message->update(['delete_1' => Auth::user()->id]); ///this id delete the conversation
		     return redirect('agent-message-friends')->with('flash_message_success','delete conversation');		

   	    }
   }
   public function unfriend_agents(Request $request,$id)
   {
   	    if($request->isMethod('post'))
   	    {
   	    	if($id){
   	        $unfriend = agent_connect::where('id',$id)->delete();
            return back()->with('flash_message_success','Unfriend Successfully');
             }
   	    }
   }

    public function importExportView()
    {
       return view('import');
    }

    public function import_property(Request $request)
    {
    	$sidebar = 'import_csv';
    	if($request->isMethod('post'))
   	    {
   	    	$file = request()->file('file');
		    $customerArr = $this->csvToArray($file);
		    // echo "<pre>";
		    // print_r($customerArr[0]['Address']);
		    // die('amit');
		    for ($i = 0; $i < count($customerArr); $i ++)
		    {
				$Address = $customerArr[$i]['Address'];
				$Apt = $customerArr[$i]['Apt #'];
				$Rooms = $customerArr[$i]['Rooms'];
				$Beds = $customerArr[$i]['Beds'];
				$Baths = $customerArr[$i]['Baths'];
				$SqFt = $customerArr[$i]['SqFt'];

				$Price = str_replace(',','',$customerArr[$i]['Price']);
				$Price =  str_replace('$','',$Price);

				$Maint = str_replace(',','',$customerArr[$i]['Maint/CC']);
				$Maint =  str_replace('$','',$Maint);
				$Maint =  ($Maint?$Maint:0);

				$Property_Tax = str_replace(',','',$customerArr[$i]['Property Tax']);
				$Property_Tax =  str_replace('$','',$Property_Tax);

				$Property_Tax =  ($Property_Tax?$Property_Tax:0);

				$Property_Type = $customerArr[$i]['Property Type'];
				$Buyer_Commission = $customerArr[$i]['Buyer Commission'];
				$Neighborhood = $customerArr[$i]['Neighborhood'];
				$Zipcode = $customerArr[$i]['Zipcode'];
				$For = $customerArr[$i]['Sale/Rental'];
				//   $Test_Agent = $customerArr[$i]['Test Agent'];
				$Description = $customerArr[$i]['Description'];
				$Agent_Office = $customerArr[$i]['Agent Office'];
				$Status = $customerArr[$i]['Status'];
				$Last_Updated = $customerArr[$i]['Last Updated'];
				$List_Date = $customerArr[$i]['List Date'];
				$Expiration_Date = $customerArr[$i]['Expiration Date'];
				$URL = $customerArr[$i]['URL'];
				$Agent_Name = $customerArr[$i]['Agent Name'];
				$images = $customerArr[$i]['images'];
				$address = $Address.'+'.$Zipcode;
				$address = urlencode($address);

				$url = "https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&key=AIzaSyBqfifWC_FXLjDQo4j8rXkTJjHU35VWSlI";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
				$response = curl_exec($ch);
				curl_close($ch);
				$response_a = json_decode($response);

				$lat = $response_a->results[0]->geometry->location->lat;

				$long = $response_a->results[0]->geometry->location->lng;

				$property_list = new property_list();
				$property_list->property_type = $Property_Type;
				$property_list->size = $SqFt; 
				$property_list->price = $Price;
				$property_list->rooms =$Rooms;
				$property_list->discription = $Description;
				$property_list->created_by = Auth::user()->id;
				$property_list->user_id = Auth::user()->id;
				$property_list->city_name = $Address;
				$property_list->longitude = $long;
				$property_list->latitude = $lat; 
				$property_list->type = ($For=='Sale'?'buy':'rent');
				$property_list->address = $Address;
				// $property_list->type
				// $property_list->status = 
				$property_list->bathroom = $Baths;
				// $property_list->half_bathroom
				// $property_list->cross_streets
				// $property_list->amenities
				// $property_list->building_features
				$property_list->local_area = $Neighborhood;
				$property_list->status = strtolower($Status);
				// $property_list->all_cash
				// $property_list->exchange
				// $property_list->cover_pic
				$property_list->zipcode = $Zipcode;
				$property_list->monthly_tax = $Property_Tax;
				$property_list->monthly_maintenance = $Maint;
				// $property_list->exposure
				$property_list->title = $Apt;
				// $property_list->client = $Agent_Name;
				// property_list::firstOrCreate($customerArr[$i]);
				$property_list->save();
				$lastid = $property_list->id;
				$uid= Auth::user()->id;

				$images1;
				$images1 =($images) ? explode(',',$images) : array() ;
				// echo "<pre>";
				// print_r($images1);
				// die('sd');
				if(!empty($images1) && is_array($images1))
				{
					foreach ($images1 as $key => $value) {
						$ext=explode('.',$value);
						$ext =end($ext);
						$file_name = uniqid().'_'.time().'_'.Auth::user()->id.'.'.$ext;

						$copied = copy( public_path('/import_image/'.$value) , public_path('/images/'.$file_name) );					
						$target_file = $file_name;
						$property_images = new Property_images;
						$property_images->image_name = $target_file;
						$property_images->property_id = $lastid;
						$property_images->created_by = Auth::user()->id;
						$property_images->save();
					}
				}
		    }
       		return back()->with('flash_message_success','Properties successfully imported');
   	    }
       	return view('agent/import-property',compact('sidebar'));
    }

    public function import_requirement(Request $request)
    {
    	$sidebar = 'import_csv';
    	if($request->isMethod('post'))
   	    {
   	    	$file = request()->file('file');
		    $customerArr = $this->csvToArray($file);
		    // echo "<pre>";
		    // print_r($customerArr);
		    // die('dddd');

		    for ($i = 0; $i < count($customerArr); $i ++)
		    {
		    	$customerArr[$i];
		    	if($customerArr[$i]['property_type'] != '' && $customerArr[$i]['min_price'] != '' && $customerArr[$i]['max_price'] != '' && $customerArr[$i]['discription'] != '' && $customerArr[$i]['userid'] != '' && $customerArr[$i]['purpose'] != '' && $customerArr[$i]['all_cash'] != '' && $customerArr[$i]['city_name'] && $customerArr[$i]['longitude'] != '' && $customerArr[$i]['latitude'] != '')
		    	{
                   continue;
		    	}
		        Requirement::firstOrCreate($customerArr[$i]);
		    }
       		return back()->with('flash_message_success','Buyers successfully imported');
   	    }

       	return view('agent/import-requirement',compact('sidebar'));
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new PropertyExport, 'users.xlsx');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
    	$file = request()->file('file');
	    $customerArr = $this->csvToArray($file);

	    for ($i = 0; $i < count($customerArr); $i ++)
	    {
	        property_list::firstOrCreate($customerArr[$i]);
	    }

	    return 'Jobi done or what ever';    

        Excel::import(new PropertyImport,request()->file('file'));
           
        return back();
    }

    function csvToArray($filename = '', $delimiter = ',')
	{
	    if (!file_exists($filename) || !is_readable($filename))
	        return false;

	    $header = null;
	    $data = array();
	    if (($handle = fopen($filename, 'r')) !== false)
	    {
	        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
	        {
	            if (!$header)
	            {
	                $header = $row;
	            }
	            else{
	                $data[] = array_combine($header, $row);
	            }
	        }
	        fclose($handle);
	    }

	    return $data;
	}
}
 