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
use App\User;
use App\Client;
use App\Invoice;
use App\Building_features;
class adminuserController extends Controller
{
  public function __construct()
	{
	   $this->middleware(['sub_admin'],['except' => ['login']]);
  }
  public function allusers()
  {
      $sidebar = 'allusers';
      $user = new User;
      $user = User::where('role','!=','1')->orderBy('id','DESC')->paginate(10);
      return view('admin.user.allusers',compact('user','sidebar'));
  } 
public function updateuser(Request $request,$id)
{
  $sidebar = 'allusers';
	$user = User::find($id);
  $psswd = $user->password;
	if($request->isMethod('post')){
    $postData = Input::all();
    $data = $request->all();
            $rules = array(
                'email' => 'required|string|email|max:255',
                'profile_pic' => 'image|mimes:jpeg,png,jpg,gif,svg',
            );
            if($data['new_password'] != '')
            {
                $rules['new_password'] = 'required|string|min:6';
                $rules['confirm_password'] = 'required|string|min:6|same:new_password';
            }
            $messages = array(
                'confirm_password.same' => 'password and confirm password not match'
            );

            $validator = Validator::make($postData, $rules, $messages);
            if ($validator->fails())
            {
                 return redirect("updateuser/{$user->id}")->withInput()->withErrors($validator);
            }
            else
            {
                $psswd = bcrypt($data['new_password']);
            }

            $user1 = User::find($id);
              $user1->name = $request->name;
              $user1->fname = $request->fname;
              $user1->lname = $request->lname;
              $user1->address = $request->address;
              $user1->email = $request->email;
       
              $user1->phone_no = $request->phone_no;
              $user1->telephone = $request->telephone;
              $user1->role = $request->role;
              $user1->zipcode = $request->zipcode;
              $user1->agent_profile_url = $request->agent_profile_url;
              $user1->state_licence_id = $request->state_licence_id;
              $user1->realestate_firm  = $request->realestate_firm ;
              $user1->password = $psswd;
              if($request->profile_pic !="")
              {
                $pic ="";
                $pic = User::where('id',$id)->select('profile_pic')->first();
                if($pic !="")
                {
                      if(file_exists(public_path().'/images/'.$pic->profile_pic))
                      {
                          unlink(public_path().'/images/'.$pic->profile_pic);
                      }
                }
                $image = $request->file('profile_pic');
                 $file_name = uniqid().'.'.$image->getClientOriginalExtension();
                $destinationPath = "images";
                $image->move($destinationPath,$file_name);
                $user1->profile_pic = $file_name;
              }
              $user1->save();
               return redirect("updateuser/{$user1->id}")->with('flash_message','data updated sucessfully');
            }
       return view('admin.user.updateuser',compact('user','sidebar'));
}
   public function destroy($id)
   {
    User::where('id', $id)->delete();
    return redirect('allusers')->with('flash_message_delete','data deleted');
   }
     public function viewuser($id)
     {
      $sidebar = 'allusers';
      $user = User::where('id',$id)->first();
      $transactions = Invoice::where(['user_id' => $user->id,'paid' => 1])->first();
      return view('admin/user/viewuser',compact('user','sidebar','transactions'));
     }
     public function filter(Request $request)
      {
        $sidebar = 'allusers';
          if($request->isMethod('get'))
          {
             $filter = Input::all();
             if($request->status_search == 2)
             {
              $user2 = User::where('role','2')->orderBy('id', 'DESC')->paginate(10);
              return view('admin/user/allusers',compact('user2','sidebar'));  
             }
             if($request->status_search == 3)
             {
               $user3 = User::where('role','3')->orderBy('id', 'DESC')->paginate(10);
              return view('admin/user/allusers',compact('user3','sidebar'));  
             }
             if($request->status_search == 4)
             {
              $user4 = User::where('role','4')->orderBy('id', 'DESC')->paginate(10);
              return view('admin/user/allusers',compact('user4','sidebar'));  
             }
             if($request->status_search == 0)
             {
             $user = User::where('role','!=','1')->orderBy('id', 'DESC')->paginate(10);
              return view('admin.user.allusers',compact('user','sidebar'));
             }
          }
      }
   public function view_requirement($id)
    {
      $sidebar = 'requirement';
      $amenities = DB::table('amenities')->get();
       $building_features = Building_features::get();
      $requirement = Requirement::where('id',$id)->first();
     return view('admin/user/requirement',compact('requirement','amenities','sidebar','building_features'));
    }
    public function delete_requirement($id)
    {
      Requirement::where('id',$id)->delete();
       return redirect('admin/all/requirement')->with('flash_message_delete','data deleted');
    }
    public function addrequirement()
    {
      $sidebar = 'add_requirement';
      $user = User::get();
      $amenities = DB::table('amenities')->get();
     $building_features = Building_features::get();
      return view('admin/user/newrequirement',compact('amenities','sidebar','user','building_features'));
    }
    public function allrequirement()
    {
      $sidebar = 'requirement';
      $property_list = Requirement::orderBy('id','DESC')->paginate(10);
      // return view('admin/user/allrequirement',compact('customer','sidebar'));
      return view('admin/user/all_requirement',compact('property_list','sidebar'));
    }
    public function store_requirement(Request $request)
    {
      if($request->isMethod('post'))
      {
        $store = Input::all();
         $rules = array(
                  'title' => 'required|max:255',
                  'city_name' => 'required|string',
                  'min_room' => 'required',
                  'max_room' => 'required',
                  'property_type' => 'required',
              );
           $validator = Validator::make($store, $rules);

        if ($validator->fails()){
          return redirect("admin/add/requirement")->withInput()->withErrors($validator);
        }
        $amenities = (isset($request->amenities) && !empty($request->amenities)) ?  implode($request->amenities, ',') : '' ;
         $building = (isset($request->building_features) && !empty($request->building_features)) ?  implode($request->building_features, ',') : '' ;
          $store = new Requirement;
          $store->title = $request->title;
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
          $store->amenities = $amenities;
          $store->building_features = $building;
          $store->purpose = $request->purpose;
          $store->discription = $request->discription;
          $store->city_name = $request->city_name;
          $store->client = $request->client_id;
          $store->local_area = $request->local_area;
          $store->status = $request->status;
          $store->latitude = $request->latitude;
          $store->longitude = $request->longitude;
          $store->investment_buyer = $request->investment_buyer;
          $store->pre_approved = $request->pre_approved;
          if($request->userid !="")
          {
            $store->userid = $request->userid;
          }
          else{
          $store->userid = Auth::user()->id;
          }
          $store->save();
          return back()->with('flash_message_success','data sucessfully store');
     }
  }
    public function edit_requirement($id)
    {
      $sidebar = 'requirement';
      $requirement = Requirement::where('id',$id)->first();
      $amenities = DB::table('amenities')->get();
      $building_features = Building_features::get();

      return view('admin/user/edit_requirement',compact('requirement','amenities','sidebar','building_features'));
    }

    public function update_requirement(Request $request,$id)
    {
      if($request->isMethod('post'))
      {
        $update = Input::all();
         $rules = array(
                  'title' => 'required|max:255',
                  'city_name' => 'required|string',
                  'min_room' => 'required',
                  'max_room' => 'required',
                  'property_type' => 'required',
              );
           $validator = Validator::make($update, $rules);

        if ($validator->fails()){
          return back()->withInput()->withErrors($validator);
        }

        $amenities = (isset($request->amenities) && !empty($request->amenities)) ?  implode($request->amenities, ',') : '' ;
         $building_features = (isset($request->building_features) && !empty($request->building_features)) ?  implode($request->building_features, ',') : '' ;
        $update = Requirement::find($id);
        $update->title = $request->title;
          $update->min_price = $request->min_price;
           $update->max_price = $request->max_price;
          $update->min_bathroom = $request->min_bathroom;
           $update->max_bathroom = $request->max_bathroom;
          $update->all_cash = $request->all_cash;
           $update->exchange = $request->exchange;
          $update->property_type = $request->property_type;
           $update->min_room = $request->min_room;
          $update->max_room = $request->max_room;
          $update->amenities = $amenities;
          $update->building_features = $building_features;
          $update->purpose = $request->purpose;
          $update->discription = $request->discription;
          $update->city_name = $request->city_name;
          $update->local_area = $request->local_area;
          $update->status = $request->status;
          $update->pre_approved = $request->pre_approved;
          $update->investment_buyer = $request->investment_buyer;
           $update->latitude = $request->latitude;
          $update->longitude = $request->longitude;
           $update->save();
           return back()->with('flash_message_update','data updated');
    }
  }
  public function getuser_client(Request $request)
    {
         $postData = Input::all();
          $client = Client::where('user_id',$postData['userid'])->get();
        return response()->json(['status' => 'success', 'client' => $client]);
    }

}