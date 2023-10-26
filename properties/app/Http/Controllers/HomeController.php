<?php

namespace App\Http\Controllers;
 use Illuminate\Routing\UrlGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Slider;
use App\Property_images;
use App\general_setting;
use Illuminate\Support\Facades\Validator;
use App\Testimonial;
use App\Transactions;
use App\User;
use DB;
use App\requirement_views;
use App\property_views;
use App\Requirement;
use App\property_list;
use App\Pages;
use Mail;
use App\Invoice;
use App\Building_features;
use App\agent_connect;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['is_agent'], ['except' => ['login','signup','homepage','pages']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function homepage()
    { 
        if(isset(Auth::user()->role))
        {
                    if(Auth::user()->role == 1)
                    {
                        Auth::logout();
                    }
         }
        $sliders = Slider::where('status', '=', 'Active')->take(1)->get();
        $site_video = general_setting::get();
        $testimonials = Testimonial::where('status', '=', 'Active')->get();
        return view('homepage',compact('sliders','site_video','testimonials'));
    }
      public function dashboard()
    {
        $sidebar = 'requirement';
        $uid = Auth::user()->id;
            $property_list = DB::table('property_list')
                            ->where('created_by',$uid)
                            ->orderBy('id','DESC')
                            ->paginate(3);

            foreach ($property_list as $key => $property) 
            {
                $image =    DB::table('property_images')
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
            }
        return view('dashboard.dashboard',compact('property_list','sidebar'));
    }
    public function pages(Request $request, $slug = null)
    { 
        if($slug == 'contact-us')
        {
            if($request->isMethod('post'))
            {
                $postData = Input::all();
                $rules = array(
                    'name' => 'required',
                    'email' => 'required|email',
                );
                $validator = Validator::make($postData, $rules);
                if ($validator->fails())
                {
                    return redirect('/page/contact-us')->withInput()->withErrors($validator);
                }
                else
                {
                    $customer_email = $postData['email'];
                    $email_send = User::select('email','fname')->where('role',1)->first();
                    $logos = general_setting::select('logo')->first();
                    $admin_mail = $email_send->email;
                    $admin_name = $email_send->fname;
                    $customer_name = $postData['name']; 
                    $subject = "Conatct US"; 
                    $logo_image = url('').'/images/'.$logos->logo;
                    $postData['logo_image'] = $logo_image;
                    try {
                        Mail::send(['html' => 'email/contactus'],$postData, function ($message) use ($postData,$customer_email,$admin_mail,$customer_name,$subject,$admin_name){
                                    $message->from($customer_email, $customer_name);
                                    $message->to($admin_mail,'Agent Connect')->subject($subject);

                        });
                    } catch(Exception $ex){
                            print_r($ex);
                    }   
                }
                return redirect('/page/contact-us')->with('flash_message_success','Email send successfully thanks for contact-us');
            }
            $PageDetails = Pages::where(['slug'=>$slug])->first();
            return view('contact-us',compact('PageDetails'));
        }
        else
        {
            $PageDetails = Pages::where(['slug'=>$slug])->first();
            return view('page_content')->with(compact('PageDetails'));
        }
    }

    public function transaction_list()
    {
        $sidebar = 'transaction';
        $user_id = "";
        if(isset(Auth::user()->id )){
            $user_id = Auth::user()->id;
        }
        $Trasactions = Invoice::where(['user_id' => $user_id])->orderBy('id', 'DESC')->paginate(10);
        return view('dashboard.view-transaction', compact('Trasactions','sidebar'));
    }
    public function property_detail($id)
    {
        if(!isset(Auth::user()->id))
        {
             return redirect('agent/login');
        }
        $insert_view_counts = array(
                'property_id' => $id,
                'user_id' => Auth::user()->id,
                'ip_address' => \Request::ip(),
            );
            $property_views = property_views::create($insert_view_counts);
            $property_list = property_list::where('id',$id)->first();
            $building_features = Building_features::get();
            if(isset($property_list))
            {
          $user = User::select('id','fname')->where('id',$property_list->created_by)->first();
           $property_images = Property_images::where('property_id',$id)->get();
          $amenities = DB::table('amenities')->get();
            }
            return view('property_detail_pub',compact('property_list','property_images','amenities','user','building_features'));

    }
    public function requirement_detail($id)
    {
        if(!isset(Auth::user()->id))
        {
             return redirect('agent/login');
        }
        $insert_view_counts = array(
            'requirement_id' => $id,
            'user_id' => Auth::user()->id,
            'ip_address' => \Request::ip(),
        ); 
        $requirement_views = requirement_views::create($insert_view_counts);
        $req = Requirement::where('id',$id)->first();
        $amenities = DB::table('amenities')->get();
        $building_features = Building_features::get();
        if(isset($req))
        {
         $user = User::select('id','fname')->where('id',$req->userid)->first();
        }
        return view('requirement_detail_pub',compact('req','amenities','user','building_features'));
    }
    public function requirement_user($id)
    {
        $user = User::where('id',$id)->first();
        return view('property_user_view',compact('user'));
    }
    public function table_view_requirement(Request $request,$id)
    {
        $list = Requirement::where('userid',$id)->paginate(10);
        return view('requirement_list_table',compact('list'));
    }
     public function property_user(Request $request,$id)
    {
        if(isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 3;
        $offset = ($pageno-1) * $no_of_records_per_page;
        $user = User::where('id',$id)->first();
        if(empty($user))
        {
            return back();
        }
        $data = property_list::where('created_by',$id)->limit(3)->orderBy('id','DESC')->paginate(3);
        $total_requirement = Requirement::where('userid',$id)->get();
        $where = array('user_id'=>Auth::user()->id,
                             'agent_id'=>$id);
               $orwhere = array('agent_id'=>Auth::user()->id,'user_id'=>$id);
            $agent_connect = agent_connect::where($where)->orWhere(function ($qry) use ($orwhere) {
                $qry->where($orwhere);
            })->first();
        $total_rows = count($total_requirement);
        $total_pages = ceil($total_rows / $no_of_records_per_page);
        $list = Requirement::where('userid',$id)->limit($no_of_records_per_page)
                ->offset($offset)
                ->get();
        if ($request->ajax()){
            return view('property_listing_table', compact('data'));
       }
        $page = $pageno;
        $limit = $no_of_records_per_page;
        return view('property_user_view',compact('user','data','list','page','total_pages','limit','agent_connect','agent_connect1'));
    }
    public function profile_pagination(Request $request)
    {
        if($request->isMethod('post'))
        {
           $postData = Input::all();
          $pageno = $postData['page'];
       }
       else {
            $pageno = 1;
        }
          $id = $postData['id'];
         $no_of_records_per_page = 3;
        $offset = ($pageno-1) * $no_of_records_per_page;
        $total_requirement = Requirement::where('userid',$id)->get();
        $total_rows = count($total_requirement);
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $list = Requirement::where('userid',$id)->limit($no_of_records_per_page)
                ->offset($offset)
                ->get();
        $page = $pageno;
        $limit = $no_of_records_per_page;
        $options = view("requirement_list_table",compact('list'))->render();
        return $options;
    }
   

}
