<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use URL;
use Session;
use Redirect;
use App\User;
use App\Properties;
use App\Meters;
use App\Contracts;
use App\PropertiesUnit;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;
use Helper;
use Illuminate\Support\Facades\Input;


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

    //HomePage View
    public function index(){
        $userIds = [];
        $validMemberShipUser = DB::table('membership_payments')
                              ->select('user_id')
                              ->where('membership_end_at', '>', Carbon::now())
                              ->get();
        foreach ($validMemberShipUser as $key => $value) {
          $userIds[] = $value->user_id;
        }
        $properties = PropertiesUnit::where('booking_status', '=' , 0)
                      ->where('IsDeleted', '=' , 0)
                      ->whereIn('user_id', $userIds);

        if(Session::get('user_role') == 1)
        {
          if(Auth::user())
          {
            $user = User::find(Auth::user()->id);
            if(!empty($user))
            {
              if($user->user_role == 3)
              {
                  $properties = $properties->where('property_manager_id', '!=' , Auth::user()->id);
              }
              elseif ($user->user_role == 4) {
                  $properties = $properties->where('property_description_experts_id', '!=' , Auth::user()->id);
              }
              elseif ($user->user_role == 5) {
                  $properties = $properties->where('property_legal_advisor_id', '!=' , Auth::user()->id);
              }
              elseif ($user->user_role == 6) {
                  $properties = $properties->where('property_visit_organizer_id', '!=' , Auth::user()->id);
              }
            }
          }
        }
          $properties = $properties->orderBy('id', 'desc');
          $properties = $properties->paginate(8);
        return view('homepage')->with(['properties'=>$properties]);
    }
    //Home Page Ajax
    public function homePageAjax(Request $request){
        $userIds = [];
        $validMemberShipUser = DB::table('membership_payments')
                              ->select('user_id')
                              ->where('membership_end_at', '>', Carbon::now())
                              ->get();
        foreach ($validMemberShipUser as $key => $value) {
          $userIds[] = $value->user_id;
        }

        $properties = PropertiesUnit::where('booking_status', '=' , 0)
                      ->where('IsDeleted', '=' , 0)
                      ->whereIn('user_id', $userIds);

        if(Session::get('user_role') == 1)
        {
          if(Auth::user())
          {
            $user = User::find(Auth::user()->id);
            if(!empty($user))
            {
              if($user->user_role == 3)
              {
                  $properties = $properties->where('property_manager_id', '!=' , Auth::user()->id);
              }
              elseif ($user->user_role == 4) {
                  $properties = $properties->where('property_description_experts_id', '!=' , Auth::user()->id);
              }
              elseif ($user->user_role == 5) {
                  $properties = $properties->where('property_legal_advisor_id', '!=' , Auth::user()->id);
              }
              elseif ($user->user_role == 6) {
                  $properties = $properties->where('property_visit_organizer_id', '!=' , Auth::user()->id);
              }
            }
          }
        }
          $properties = $properties->orderBy('id', 'desc');
          $properties = $properties->paginate(8);

         // $properties = PropertiesUnit::where('booking_status', '=' , 0)
        //               ->where('IsDeleted', '=' , 0)
        //               ->whereIn('user_id', $userIds)
        //               ->orderBy('id', 'desc')
        //               ->paginate(8);
        $html = '';
        foreach ($properties as $key => $property) {
          $rent = Helper::CURRENCYSYMBAL.$property->rent;
          $url = '/images/property_banners/260X225/'.$property->cover_image;
          $html .='<div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
                      <a href="'.url('/propertydetails/'.$property->id).'">
                          <div class="property-main" style="background-image: url('.url($url).');">
                              <span class="prop-tag">'.substr($property->unit_name,0,15) .'...</span>
                              <div class="property-info">
                                  <h5 class="price">'.$rent.'</h5>
                                  <h5 class="add1">'.$property->address.'</h5>
                              </div>
                          </div>
                      </a>
                  </div>';
        }
        return $html;
    }

    public function search(Request $request)
    {
        $postData = Input::all();
        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 10;
        $offset = ($pageno-1) * $no_of_records_per_page;

        $page = $pageno;
        $limit = $no_of_records_per_page;

        $latitude = 0;
        $longitude = 0;
        $query = \DB::table('property_units')->select('*');
        if($postData['keyword'] != '' && !empty($postData['keyword']))
        { 
            $query = $query->where('unit_name', 'like', '%'.$postData['keyword'].'%');
        }
        if($postData['property_type'] != '' && !empty($postData['property_type']))
        {
            $query = $query->where('u_type',  $postData['property_type']);
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
                ) as distance') )->having('distance','<',10);
          }
        }

        $query = $query->where('booking_status', '=' , 0);
        $query = $query->where('IsDeleted', '=' , 0);
        $total_property = $query->get();
        $property_list  = $query->limit($no_of_records_per_page)->offset($offset)->get();
       
        $total_rows = count($total_property);
        $total_pages = ceil($total_rows / $no_of_records_per_page);
        return view('property_search_list',compact('property_list','page','total_pages','limit'));
    }

    public function change_to_tenant(Request $request)
    {
      if(Auth::user()->user_role == 3 || Auth::user()->user_role == 4 || Auth::user()->user_role == 5 || Auth::user()->user_role == 6)
      {
          Session::put('user_role', 1);
          Session::put('previous_role', Auth::user()->user_role);
          toastr()->success('Successfully switch to tenant!');
          return Redirect('/dashboard');
      }
      if(Session::get('user_role') == 1)
      {
          Session::put('user_role', 0);
          toastr()->success('Successfully switch back!');
          return Redirect('/dashboard');
      }
    }

}
