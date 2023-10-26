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
use App\Building_features;
use App\User;
class adminsellerController extends Controller
{
	public function __construct()
	{
	     $this->middleware(['sub_admin'],['except' => ['login']]);
	}

	public function add_property(Request $request)
	{
        $sidebar = 'add_property';
        if($request->isMethod('post'))
        {
            $postData = $request->all();
            $rules = array(
                  'title' => 'required|max:255',
                  'cross_streets' => 'required',
              );
            $validator = Validator::make($postData, $rules);
            if ($validator->fails()){
              return back()->withInput()->withErrors($validator);
            }

            $validatedData = $request->validate([
                'cover_pic' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',   
            ]);
            $amenities = (isset($request->amenities) && !empty($request->amenities)) ?  implode($request->amenities, ',') : '' ;
            $building = (isset($request->building_features) && !empty($request->building_features)) ?  implode($request->building_features, ',') : '' ;
            $exposure = (isset($request->exposure) && !empty($request->exposure)) ?  implode($request->exposure, ',') : '' ;
        
            $property_list= new property_list;
            $property_list->title = $request->title;
            $property_list->property_type = $request->property_type;
            $property_list->size = $request->size;
            $price = str_replace(',', '', $request->price);
            $property_list->price = $price;
            $property_list->purpose = $request->purpose;
            $property_list->amenities = $amenities;
            $property_list->building_features = $building;
            $property_list->exposure = $exposure;
            $property_list->exchange = $request->exchange;
            $property_list->all_cash =  $request->all_cash;
            $property_list->city_name = $request->city_name;
            $property_list->local_area = $request->local_area;
            $property_list->rooms = $request->rooms;
            $property_list->bathroom = $request->bathroom;
            $property_list->cross_streets = $request->cross_streets;
            $property_list->monthly_maintenance = $request->monthly_maintenance;
            $property_list->monthly_tax = $request->monthly_tax;
            $property_list->address = $request->address;
            $property_list->type = $request->type;
            $property_list->status = $request->status;
            $property_list->longitude = $request->longitude;
            $property_list->latitude = $request->latitude;
            $property_list->zipcode = $request->zipcode;
            $property_list->half_bathroom = $request->half_bathroom;
            $property_list->discription = $request->discription;
            $property_list->user_id = Auth::user()->id;
            $property_list->created_by = $request->userid;
            $property_list->client = $request->client_id;
            $property_list->save();
            $lastid = $property_list->id;
            $uid= Auth::user()->id;
            $property_images= Property_images::where('created_by', $uid)->where('property_id',0)
                   ->update(['property_id' =>$lastid]);
             return redirect('admin/all/properties')->with('flash_message_success', 'Post sucessfully'); 
        }
        $uid= Auth::user()->id;
        $property_images= Property_images::where('created_by', $uid)->where('property_id',0)->delete();
        $amenities = DB::table('amenities')->get();
        $building_features = Building_features::get();
	 	$users = User::get();
        
	 	return view('admin/seller/add_property',compact('amenities','users','sidebar','building_features'));
	}

    public function dragdrop(Request $request)
    {
		$postData = $request->all();
		$file = $request->file('file');
        $file_name = uniqid().'_'.Auth::user()->id.'.'.$file->getClientOriginalExtension();
		if($request->hasFile('file'))
        {
            $destinationPath = "images";
            $file->move($destinationPath,$file_name);
            $target_file = $file_name;
            $property_images = new Property_images;
            $property_images->image_name = $target_file;
            $property_images->property_id = 0;
            $property_images->created_by = Auth::user()->id;
            // $property_images->user_id = $request->user_id;
            $property_images->save();
            return response()->json(['status' => 'success', 'target_file' => $target_file]);
        }
    }

    public function all_property(Request $request )
    {
        $sidebar = 'properties';
        $property_list = property_list::orderBy('id','DESC')->paginate(10);
        return view('admin/seller/all_property',compact('property_list','sidebar'));
    }

    public function update(Request $request , $id)
    {
        $sidebar = 'properties';
        if($request->isMethod('post'))
        {
            $update = Input::all();
                $rules = array(
                  'title' => 'required|max:255',
                  'city_name' => 'required',
                  'local_area' => 'required',
                  'price' => 'numeric',
                  'property_type' => 'required',
                );
            $validator = Validator::make($update, $rules);

            if ($validator->fails()){
              return back()->withInput()->withErrors($validator);
            }          
            $amenities = (isset($request->amenities) && !empty($request->amenities)) ?  implode($request->amenities, ',') : '' ;
            $building_features = (isset($request->building_features) && !empty($request->building_features)) ?  implode($request->building_features, ',') : '' ;
            $exposure = (isset($request->exposure) && !empty($request->exposure)) ?  implode($request->exposure, ',') : '' ;

            $property_list = property_list::find($id);
            $property_list->title = $request->title;
            $property_list->price = $request->price;
            $property_list->bathroom = $request->bathroom;
            $property_list->all_cash = $request->all_cash;
            $property_list->exchange = $request->exchange;
            $property_list->property_type = $request->property_type;
            $property_list->rooms = $request->rooms;
            $property_list->amenities = $amenities;
            $property_list->building_features = $building_features;
            $property_list->exposure = $exposure;
            $property_list->purpose = $request->purpose;
            $property_list->discription = $request->discription;
            $property_list->city_name = $request->city_name;
            $property_list->local_area = $request->local_area;
            $property_list->size = $request->size;
            $property_list->cross_streets = $request->cross_streets;
            $property_list->address = $request->address;
            $property_list->type = $request->type;
            $property_list->latitude = $request->latitude;
            $property_list->longitude = $request->longitude;
            $property_list->half_bathroom = $request->half_bathroom;
            $property_list->status = $request->status;
            $property_list->zipcode = $request->zipcode;
            $property_list->monthly_tax = $request->monthly_tax;
            $property_list->monthly_maintenance = $request->monthly_maintenance;
            $property_list->save();
            $uid = Auth::user()->id;
            $property_images= Property_images::where('created_by', $uid)->where('property_id',0)
           ->update(['property_id' =>$id]);
            return back()->with('flash_message_update','data updated');
        }
        $property_details = property_list::where('id','=',$id)->first();
        $uid= Auth::user()->id;
        $property_images= Property_images::where('created_by', $uid)->where('property_id',0)->delete();
        $amenities = DB::table('amenities')->get();
        $users = User::get();
        $building_features = Building_features::get();
        $prop_images = Property_images::where('property_id', $id)->get();
        return view('admin/seller/update_property',compact('property_details', 'amenities', 'users','sidebar','prop_images','building_features'));
    }

    public function property_delete($id)
    {
      property_list::where('id', $id)->delete();
      return redirect('admin/all/properties')->with('flash_message_delete','data deleted');
    }

    public function view_property($id)
    {
        $sidebar = 'properties';
        $amenities = DB::table('amenities')->get();
        $building_features = Building_features::get();
        $property_detail = property_list::where('id',$id)->first();
        $property_images = Property_images::where('property_id',$id)->get();
        $users = User::get();
        return view('admin/seller/view_property',compact('property_detail','amenities','property_images','users','sidebar','building_features'));
    }
    public function remove_images(Request $request)
    {
        $property = Property_images::where('id',$request->input('id'))->first();
     $post= Property_images::find($request->input('id'));
        unlink(public_path().'/images/'.$property->image_name);
      if($post->delete())
      {
        echo"data deleted";
      }
    }

    public function import_property(Request $request)
    {
        $sidebar = 'import_csv';
        if($request->isMethod('post'))
        {
            $file = request()->file('file');
            $customerArr = $this->csvToArray($file);

            for ($i = 0; $i < count($customerArr); $i ++)
            { 
                $user_id = Auth::user()->id;
                $email = $customerArr[$i]['Email'];
                if(!empty($email) && $email != '')
                {
                    $user_details = User::where('email',$email)->first();
                    if(!empty($user_details) && $user_details != '')
                    {
                        $user_id = $user_details->id;
                    } 
                }

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
                $property_list->user_id = $user_id;
                // $property_list->city_name
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
                $images;
                $images = explode(',',$images);
                foreach ($images as $key => $value) {
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
            return back()->with('flash_message_success','Properties successfully imported');
        }
        return view('admin/seller/import-property',compact('sidebar'));
        
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
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }
}