<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Booking;
use App\UserBankAccount;
Use Helper;
use App\PropertiesUnit;
use Illuminate\Support\Facades\DB;
class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    const Property_Manager = 3;
    const Property_Description_Experts = 4;
    const Legal_Advisor = 5;
    const Visit_Organizer = 6;
    const Tenant = 1;
    const Property_Owner = 2;
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    //User View Profile Page 
    public function index(request $request){
        if (Auth::check()) {
            $user = Auth::user();
            $account_info = UserBankAccount::where('user_id',$user->id)->first();
            $data = array('user'=>$user, 'account_info'=> $account_info);
            return view('userProfile.profile')->with($data);
        }
    }

    // Edit Profile View Page
    public function editprofile(request $request){
        if (Auth::check()) {
            $user = Auth::user();
            $data = array('user'=>$user);
            return view('userProfile.editprofile')->with($data);
        }
    }

    //User Profile Update
    public function updateprofile(Request $request){
        $user = Auth::user();
        $data = $this->validate(request(), [
                    'id'=>'required',
                    'name'=> 'required',
                    'last_name'=> 'required',
                    'gender'=> 'required',
                    'phone_no'=> 'required|numeric',
                    'email'=>'required|email',
                    'image.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
        $imageName = $user->image;
        if($image=$request->file('image')){
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images/users'), $imageName);
            //$image->move($destinationPath,$image->getClientOriginalName());
        }
        $user->name = request('name'); 
        $user->last_name = request('last_name'); 
        $user->gender = request('gender'); 
        $user->phone_no = request('phone_no'); 
        $user->email = request('email');
        $user->image = $imageName;
        $user->postal = request('postal');
        $user->nr = request('nr');
        $user->postal_code = request('postal_code');
        $user->city = request('city');
        $user->id_card = request('id_card');
        $user->professional_status = request('professional_status');
        $user->school_company_name = request('school_company_name');
        $user->tenant_type = request('tenant_type');
        
        $user->company_name = request('company_name');
        $user->company_address = request('company_address');
        $user->vat_nr = request('vat_nr');
        $user->registration_number = request('registration_number');
        $user->bank_account_number = request('bank_account_number');
        $user->phone_verify = 1;
        $user->save();

        toastr()->success('Profile Updated Successfully!');
        return redirect('/profile');
    }

    //View of Tenant Detail Page
    public function tenantDetails($id){
        $userDetail = User::find($id);
        return view('tenant.tenantdetails')->with([
            'userDetail' => $userDetail,
        ]);
    }

    //Delete Tenant Document Through Tenant detail Page
    public function deleteTenantDocument($id, $documentType){
        $user = User::find($id);
        if($documentType == 'tenant_photo'){
            $user->tenant_photo = null; 
        } else if($documentType == 'tenant_photo_id_proof'){
            $user->tenant_photo_id_proof = null;
        } else if($documentType == 'tenant_photo_esignature'){
            $user->tenant_photo_esignature = null;    
        }
        $user->save();
        toastr()->success('Document Delete Successfully!');
        return redirect()->back();
    }   

    //List Of Tenant View Page 
    public function listAllTenants(){
        if(\Auth::user()->user_role == self::Property_Owner){
            $unitIds = $data = $tenants = $bookings = null;
            $user = Auth::user();
            $units = PropertiesUnit::select('id')->where('user_id',$user->id)->get();
            if($units){
                foreach ($units as $key => $unit) {
                    $unitIds[] = $unit->id;
                }
            }
            if($unitIds != null){
                $bookings = Booking::select('tenant_id','unit_id')->whereIn('unit_id', $unitIds);
                if(isset($_GET['status']) && $_GET['status'] != '' )
                {
                    $bookings = $bookings->where('status', 6);
                }
                $bookings = $bookings->paginate(5);
                // if($bookings){
                //     foreach ($bookings as $key => $booking) {
                //         $data[$key]['tenant'] = User::where('id',$booking->tenant_id)->get();
                //         $data[$key]['unit'] = PropertiesUnit::where('id',$booking->unit_id)->get();
                //     }
                // }
            }
            return view('tenant.list-all-tenants')->with([
                'data' => $data,
                'bookings' => $bookings,
            ]);
        }
        if(\Auth::user()->user_role == self::Property_Manager){
            $unitIds = $data = $tenants = $bookings = null;
            $user = Auth::user();
            $units = PropertiesUnit::select('id')->where('property_manager_id',$user->id)->get();
            if($units){
                foreach ($units as $key => $unit) {
                    $unitIds[] = $unit->id;
                }
            }
            if($unitIds != null){
                $bookings = Booking::select('tenant_id','unit_id')->whereIn('unit_id', $unitIds);
                if(isset($_GET['status']) && $_GET['status'] != '' )
                {
                    $bookings = $bookings->where('status', 6);
                }
                $bookings = $bookings->paginate(5);
                // if($bookings){
                //     foreach ($bookings as $key => $booking) {
                //         $data[$key]['tenant'] = User::where('id',$booking->tenant_id)->get();
                //         $data[$key]['unit'] = PropertiesUnit::where('id',$booking->unit_id)->get();
                //     }
                // }
            }
            return view('tenant.list-all-tenants')->with([
                'data' => $data,
                'bookings' => $bookings,
            ]);
        }
    }

    //Edit Bank Account Using User Profile
    public function editBankAccount(){
        $user = Auth::user();
        $account_info = UserBankAccount::where('user_id',$user->id)->first();
        $data = array('user'=>$user);
        return view('userProfile.edit-bank-account')->with([
            'user'=> $user,
            'account_info'=> $account_info
        ]);
    }

    //Update Bank Account Using User Profile
    public function updateBankAccount(Request $request){
        $this->validate(request(), [
            'user_id'=>'required',
            'user_role'=> 'required',
            'bank_name'=> 'required',
            'ada_number'=> 'required',
            'account_number'=> 'required',
            'routing_number'=>'required',
        ]);
        $user = Auth::user();
        $account_info = UserBankAccount::where('user_id',$user->id)->first();

        if($account_info){
            $account_info->user_id = $user->id;
            $account_info->user_type = $user->user_role;
            $account_info->bank_name = request('bank_name'); 
            $account_info->ada_number = request('ada_number'); 
            $account_info->account_number = request('account_number'); 
            $account_info->routing_number = request('routing_number'); 
            $account_info->paypal_email = request('paypal_email'); 
            $account_info->save();
        } else {
            $account_info = new UserBankAccount;
            $account_info->user_id = $user->id;
            $account_info->user_type = $user->user_role;
            $account_info->bank_name = request('bank_name'); 
            $account_info->ada_number = request('ada_number'); 
            $account_info->account_number = request('account_number'); 
            $account_info->routing_number = request('routing_number'); 
            $account_info->paypal_email = request('paypal_email');
            $account_info->save();
        }

        toastr()->success('Bank Account Edit Successfully!');
        return redirect('/profile');
    }

    // List of Tenants in Single unit View
    public function listTenantsForSingleUnit($id){
        $tenantIds = [];
        $unit = DB::table('property_units')->where('id', $id)->first();
        $data = DB::table('unit_booking')->select('tenant_id')->where('unit_id', $id)->get();
        if($data){
            foreach ($data as $key => $value) {
                $tenantIds[] = $value->tenant_id;
            }
        }
        $tenants = DB::table('unit_booking')
            ->join('users', 'users.id', '=', 'unit_booking.tenant_id')
            ->whereIn('users.id',$tenantIds)
            ->where('unit_booking.unit_id',$id)
            ->paginate(5);
        //$tenants = User::whereIn('id',$tenantIds)->paginate(5);
        return view('tenant.list-tenants-Single-unit')->with([
            'unit'=>$unit,
            'tenants'=>$tenants
        ]);
    }
    // public function purchaseview(request $request){ 
    //     return view('dashboard.purchasemembership');
    // }

    // public function dashboard(request $request){ 
    //     return view('dashboard.dashboard');
    // }
}
