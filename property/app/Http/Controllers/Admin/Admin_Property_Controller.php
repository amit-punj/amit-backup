<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\PropertiesUnit;
use Auth;
use App\Meters;
use App\User;
use App\Properties;
use App\Contracts;
use App\Visits;
use App\appointments;
use App\Booking;
use App\Guarantor;
use App\email_log;
use App\VerifyEmail;
use App\VerifyUser;
use App\Transactions;
use App\MeterReadings;
use App\Mail\VerifyMail;
use Illuminate\Support\Facades\Input;
use Mail;
use App\Vendors;
use App\Terminate;
use App\Documents;
use App\Refund;
use App\UserBankAccount;
use Stripe;

class Admin_Property_Controller extends Controller
{

     const Property_Manager = 3;
    const Property_Description_Experts = 4;
    const Legal_Advisor = 5;
    const Visit_Organizer = 6;
    const Tenant = 1;
    const Property_Owner = 2;
    public function __construct(){
        $this->middleware('auth');
    }
    public function list_all_property(Request $request)
    {
       $propertiesWithBuilding = array();
        $ids = null;
        $propertiesWithoutBuilding = DB::table('property_units')
                            ->where('building_id', null)->orderBy('id','DESC')
                            ->get();
        $buildingIds = DB::table('properties')
                            ->select('id')
                            ->get();
        foreach ($buildingIds as $key => $value) {
            if($value->id != null){
                $ids[] = $value->id;
            }
        }
        if($ids != null){
            foreach ($ids as $key => $value) {
                $propertiesWithBuilding[$key]['building_id'] =  $value;
                $propertiesWithBuilding[$key]['data'] = DB::table('property_units')
                        ->where('building_id',$value)
                        ->get();
            }
        }
        return view('admin/property/list_properties')->with([
            'propertiesWithoutBuilding' => $propertiesWithoutBuilding,
            'propertiesWithBuilding' => $propertiesWithBuilding
        ]);
    }
     public function viewProperty($id)
     {
        $units = PropertiesUnit::find($id);
        $amenities = DB::table('amenities')->get();
        // $contracts = Contracts::where(['property_unit_id' => $id])->get();
        $contracts = Contracts::where(['unit_id' => $id])->get();

        $verifyEmail = 0;
        if(Auth::user() )
        {
            $email = Auth::user()->email;
            $EmailData = VerifyEmail::select('status')->where(['email' => $email])->first();
            $verifyEmail = ($EmailData) ? $EmailData->status : 0 ;            
        }
        // Helper::pr($VerifyEmail->status);
        // echo $email;
        // // $contracts = Contracts::get();
        
        // die('ffff');
        if($units){
            $images = array();
            if($units['images']) {
                $images = explode(',', $units['images']);
            }
            // Helper::pr($units);
            return view('admin/property')->with(['data'=>$units,'images'=> $images,'amenities'=>$amenities,'contracts' => $contracts, 'VerifyEmail' => $verifyEmail]);
        } else {
            return abort(404);
        }      
    }
     public function admin_editUnit($id){
        $unit = DB::table('property_units')->where('id', $id)->first();
        $property = DB::table('properties')->where('id', $id)->first();
        $PropertyManagers = DB::table('users')->where('user_role', self::Property_Manager)->get();
        $PropertyDescriptionExperts = DB::table('users')->where('user_role', self::Property_Description_Experts)->get();
        $LegalAdvisors = DB::table('users')->where('user_role', self::Legal_Advisor)->get();
        $VisitOrganizers = DB::table('users')->where('user_role', self::Visit_Organizer)->get();
        $amenities = DB::table('amenities')->get();
        $properties = DB::table('properties')->where('user_id', \Auth::user()->id)->get();
        $meters = DB::table('meters')->where('unit_id', $id)->get();
        $unitVendors = DB::table('property_vendors')->where('property_unit_id', $id)->get();
        $buildingVendors = DB::table('property_vendors')->where('building_id', $id)->get();
        return view('admin.property.edit_property')->with([
            'unit'=>$unit,
            'property'=>$property,
            'properties'=>$properties,
            'PropertyManagers'=> $PropertyManagers, 
            'PropertyDescriptionExperts'=> $PropertyDescriptionExperts,
            'LegalAdvisors' => $LegalAdvisors,
            'VisitOrganizers' => $VisitOrganizers,
            'amenities' => $amenities,
            'meters' => $meters,
            'unitVendors' => $unitVendors,
            'buildingVendors' => $buildingVendors,
        ]);
    }
     public function viewProperty_admin($id){
        $units = PropertiesUnit::find($id);
        $amenities = DB::table('amenities')->get();
        // $contracts = Contracts::where(['property_unit_id' => $id])->get();
        $contracts = Contracts::where(['unit_id' => $id])->get();

        $verifyEmail = 0;
        if(Auth::user() )
        {
            $email = Auth::user()->email;
            $EmailData = VerifyEmail::select('status')->where(['email' => $email])->first();
            $verifyEmail = ($EmailData) ? $EmailData->status : 0 ;            
        }
        // Helper::pr($VerifyEmail->status);
        // echo $email;
        // // $contracts = Contracts::get();
        
        // die('ffff');
        if($units){
            $images = array();
            if($units['images']) {
                $images = explode(',', $units['images']);
            }
            // Helper::pr($units);

            return view('admin.property.unit_detail')->with(['data'=>$units,'images'=> $images,'amenities'=>$amenities,'contracts' => $contracts, 'VerifyEmail' => $verifyEmail]);
        } else {
            return abort(404);
        }      
    }
    public function buildingDetails_admin($id){
        $buildingDetail = DB::table('properties')
                            ->where('id', $id)
                            ->first();
        $buildingUnits = DB::table('property_units')
                            ->where('building_id', $id)
                            ->get();
        $amenities = DB::table('amenities')->get();
        $properties = new Properties;
        $propertyManager = $properties->buildingPropertyManager($id);
        $propertyDescriptionExperts = $properties->buildingPropertyDescriptionExperts($id);
        $propertyLegalAdvisor = $properties->buildingPropertyLegalAdvisor($id);
        $propertyVisitOrganizer = $properties->buildingPropertyVisitOrganizer($id);
        return view('admin.property.property_detail')->with([
            'buildingDetail'=>$buildingDetail, 
            'buildingUnits' => $buildingUnits, 
            'amenities'=>$amenities,
            'propertyManager'=>$propertyManager,
            'propertyDescriptionExperts'=>$propertyDescriptionExperts,
            'propertyLegalAdvisor'=>$propertyLegalAdvisor,
            'propertyVisitOrganizer'=>$propertyVisitOrganizer,
        ]);
    }
    public function createproperty(){
        $amenities = DB::table('amenities')->get();
        $PropertyManagers = DB::table('users')->where('user_role', self::Property_Manager)->get();
        $PropertyDescriptionExperts = DB::table('users')->where('user_role', self::Property_Description_Experts)->get();
        $LegalAdvisors = DB::table('users')->where('user_role', self::Legal_Advisor)->get();
        $VisitOrganizers = DB::table('users')->where('user_role', self::Visit_Organizer)->get();
        $properties = DB::table('properties')->where('user_id', \Auth::user()->id)->get();
        return view('admin.property.create_property',
            compact('PropertyManagers','PropertyDescriptionExperts','LegalAdvisors','VisitOrganizers','amenities','properties')
        ); 
    }
    public function editBuilding($id)
    {
        $unit = DB::table('property_units')->where('id', $id)->first();
        $property = DB::table('properties')->where('id', $id)->first();
        $PropertyManagers = DB::table('users')->where('user_role', self::Property_Manager)->get();
        $PropertyDescriptionExperts = DB::table('users')->where('user_role', self::Property_Description_Experts)->get();
        $LegalAdvisors = DB::table('users')->where('user_role', self::Legal_Advisor)->get();
        $VisitOrganizers = DB::table('users')->where('user_role', self::Visit_Organizer)->get();
        $amenities = DB::table('amenities')->get();
        $properties = DB::table('properties')->where('user_id', \Auth::user()->id)->get();
        $meters = DB::table('meters')->where('unit_id', $id)->get();
        $unitVendors = DB::table('property_vendors')->where('property_unit_id', $id)->get();
        $buildingVendors = DB::table('property_vendors')->where('building_id', $id)->get();
        
        return view('admin.property.editbuilding')->with([
            'unit'=>$unit,
            'property'=>$property,
            'properties'=>$properties,
            'PropertyManagers'=> $PropertyManagers, 
            'PropertyDescriptionExperts'=> $PropertyDescriptionExperts,
            'LegalAdvisors' => $LegalAdvisors,
            'VisitOrganizers' => $VisitOrganizers,
            'amenities' => $amenities,
            'meters' => $meters,
            'unitVendors' => $unitVendors,
            'buildingVendors' => $buildingVendors,
        ]);
    }
    public function listContracts($id){
        $unit = DB::table('property_units')->where('id', $id)->first();
        // $property = DB::table('properties')->where('id', $unit->property_id)->first();
        // $units = DB::table('properties')
        //     ->join('property_units', 'properties.id', '=', 'property_units.property_id')
        //     ->where('properties.user_id', \Auth::user()->id)
        //     ->select('property_units.*','properties.title')
        //     ->get();
        // $contracts = DB::table('contracts')
        //         ->join('property_units', 'property_units.id', '=', 'contracts.property_unit_id')
        //         ->join('properties', 'properties.id', '=', 'property_units.property_id')
        //         ->join('users', 'users.id', '=', 'contracts.tenent_id')
        //         //->where('properties.user_id', \Auth::user()->id)
        //         ->where('contracts.property_unit_id',$id)
        //         ->select('property_units.*','properties.title','contracts.*','users.name','contracts.id')
        //         ->get();
        // $contracts = DB::table('contracts')
        //         ->join('property_units', 'property_units.id', '=', 'contracts.property_unit_id')
        //         ->join('properties', 'properties.id', '=', 'property_units.property_id')
        //         ->where('properties.user_id', \Auth::user()->id)
        //         ->select('property_units.*','properties.title','contracts.*')
        //         ->get();
        //$properties = DB::table('properties')->where('user_id', \Auth::user()->id)->get(); 
        $tenents = DB::table('users')->where('user_role', 1)->get();
        return view('admin/contract/single-unit-contract-list')->with([
            'unit'=>$unit,
            // 'tenents'=>$tenents,
            // 'property'=>$property, 
            // 'contracts'=>$contracts, 
            // 'units'=>$units
        ]);
    }
    public function property_tanents($id){
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
        return view('admin.tenant.list_tanent-single_unit')->with([
            'unit'=>$unit,
            'tenants'=>$tenants
        ]);
    }
     public function tanent_detail_admin($id){
        $userDetail = User::find($id);
        return view('admin.tenant.tenantdetails')->with([
            'userDetail' => $userDetail,
        ]);
    }
     public function unitManagment_admin($id){
        $contractIds = [];
        $unit = DB::table('property_units')->where('id', $id)->first();
        $contracts = Booking::select('id')->where('unit_id',$id)->get();
        if($contracts){
            foreach ($contracts as $key => $contract) {
                $contractIds[] = $contract->id;
            }
        }
        $transactions = Transactions::whereIn('booking_id', $contractIds)->orderBy('created_at','desc')->paginate(5);
        $rentalBills = MeterReadings::where('unit_id', $id)->orderBy('id', 'desc')->paginate(5);
        return view('admin.unitmanagment_admin')->with([
            'unit'=>$unit,
            'rentalBills'=>$rentalBills,
            'transactions'=>$transactions,
        ]);
    }
    public function admin_contract_list(Request $request)
    {
       if (isset($_GET['pageno'])) {
                $pageno = $_GET['pageno'];
            } else {
                $pageno = 1;
            }
            $no_of_records_per_page = 5;
            $offset = ($pageno-1) * $no_of_records_per_page;

            $page = $pageno;
            $limit = $no_of_records_per_page;

            $where = array('step' => '5');
            $postData = Input::all();
            $query = Booking::select('*');
            if(isset($_GET['keyword']) && $_GET['keyword'] != '' )
            {
                $keyword = $_GET['keyword'];
                $query = $query->join('users','users.id','=','unit_booking.po_id')
                ->where('users.name', 'like', '%'.$keyword.'%')->where(['users.user_role' => 2]);
            }
            if(isset($_GET['search']) && $_GET['search'] != '' )
            {
                $where['status'] = $_GET['search'];
            }
            $query = $query->where($where);

            $total_property = $query->get();
            $contracts = $query->orderBy('unit_booking.id','desc')->limit($no_of_records_per_page)->offset($offset)->get();

            $total_rows = count($total_property);
            $total_pages = ceil($total_rows / $no_of_records_per_page);
            return view('admin.contract.contract_list_user',compact('contracts','page','total_pages','limit'));
    }
    public function admin_add_property(Request $request)
    {
         if($request->input('p_type') == 'unit'){
            $request->validate([
                //step 1
                'p_type' => ['required'],

                //step 2
                'unit_name' => ['required'],
                'area' => ['required','numeric'],
                'description' => ['required'],
                'address' => ['required'],

                //step 3
                'u_type' => ['required'],
                'rent' => ['required','numeric'],
                'cost_provision' => ['required','numeric'],
                'deposit' => ['required','numeric'],
                'fixed_price' => ['required','numeric'],
                'tax' => ['required','numeric'],
                'bedrooms' => ['required','numeric'],
                'bed_funished' => ['required'],
                'kitchen' => ['required'],
                'toilet' => ['required'],
                'choose_guarantor' => ['required'],
                'total_amount' => ['required'],
                'po_esignature' => ['required'],

                //step 4
                'min_age' => ['required','numeric'],
                'max_age' => ['required','numeric'],
                
                //step 7
                'cover_image' => ['required'],
                'images' => ['required'],
            ]);

            // create unit
            $propertiesUnit = new PropertiesUnit;
            if(!empty($request->input('building_id')))
            {
             $propertiesUnit->building_id = $request->input('building_id');
            }
            $propertiesUnit->unit_name = $request->input('unit_name');
            $propertiesUnit->area = $request->input('area');
            $propertiesUnit->area_in = $request->input('area_in');
            $propertiesUnit->description = $request->input('description');
            $propertiesUnit->latitude = $request->input('latitude');
            $propertiesUnit->longitude = $request->input('longitude');
            $propertiesUnit->address = $request->input('address');
            $propertiesUnit->u_type = $request->input('u_type');

            if($request->input('u_type') == 'residential'){
                $propertiesUnit->unit_category = $request->input('unit_category_residential');
            } else {
                $propertiesUnit->unit_category = $request->input('unit_category_commercial');
            }

            $propertiesUnit->rent = $request->input('rent');
            if(!empty($request->building_id_query_str) && empty($request->input('building_id')))
            {
                $propertiesUnit->building_id = $request->input('building_id_query_str');
            }
            $propertiesUnit->cost_provision = $request->input('cost_provision');
            $propertiesUnit->deposit = $request->input('deposit');
            $propertiesUnit->fix_price = $request->input('fixed_price');
            $propertiesUnit->tax = $request->input('tax');
            $propertiesUnit->bedrooms = $request->input('bedrooms');
            $propertiesUnit->bed_funished = $request->input('bed_funished');
            $propertiesUnit->bed_lock = $request->input('bed_lock');
            $propertiesUnit->kitchen = $request->input('kitchen');
            $propertiesUnit->toilet = $request->input('toilet');
            $propertiesUnit->choose_guarantor = $request->input('choose_guarantor');
            $propertiesUnit->total_amount = $request->input('total_amount');
            $propertiesUnit->po_esignature = $request->input('po_esignature');
            $propertiesUnit->living_room = $request->input('living_room');
            $propertiesUnit->balcony_terrace = $request->input('balcony_terrace');
            $propertiesUnit->garden = $request->input('garden');
            $propertiesUnit->basement = $request->input('basement');
            $propertiesUnit->parking = $request->input('parking');
            $propertiesUnit->wheelchair = $request->input('wheelchair');
            $propertiesUnit->allergy_friendly = $request->input('allergy_friendly');

            if($request->input('amenities') != ''){
                $propertiesUnit->amenities = implode(",",$request->input('amenities'));
            }

            $propertiesUnit->preferred_gender = $request->input('preferred_gender');
            $propertiesUnit->min_age = $request->input('min_age');
            $propertiesUnit->max_age = $request->input('max_age');
            $propertiesUnit->tenant_type = $request->input('tenant_type');
            $propertiesUnit->couples_allowed = $request->input('couples_allowed');
            $propertiesUnit->p_type = $request->input('p_type');
            
            $propertiesUnit->user_id = \Auth::user()->id;

            if($request->input('property_manager_id') == ''){
                $propertiesUnit->property_manager_id = \Auth::user()->id;
            } else {
               $propertiesUnit->property_manager_id = $request->input('property_manager_id');
            }
            if($request->input('property_description_experts_id') == ''){
                $propertiesUnit->property_description_experts_id = \Auth::user()->id;
            } else {
               $propertiesUnit->property_description_experts_id = $request->input('property_description_experts_id');
            }
            if($request->input('property_legal_advisor_id') == ''){
                $propertiesUnit->property_legal_advisor_id = \Auth::user()->id;
            } else {
               $propertiesUnit->property_legal_advisor_id = $request->input('property_legal_advisor_id');
            }
            if($request->input('property_visit_organizer_id') == ''){
                $propertiesUnit->property_visit_organizer_id = \Auth::user()->id;
            } else {
                $propertiesUnit->property_visit_organizer_id = $request->input('property_visit_organizer_id');
            }
            
            $propertiesUnit->registration_possible = $request->input('registration_possible');
            $propertiesUnit->cleaning_commonc_room_incl = $request->input('cleaning_commonc_room_incl');
            $propertiesUnit->cleaning_private_room_incl = $request->input('cleaning_private_room_incl');
            $propertiesUnit->animal_allowed = $request->input('animal_allowed');
            $propertiesUnit->play_musical_instrument = $request->input('play_musical_instrument');
            $propertiesUnit->smoking_allowed = $request->input('smoking_allowed');
            $propertiesUnit->cover_image = $request->input('cover_image');
            $propertiesUnit->images = $request->input('images');
            $propertiesUnit->save();

            //Add Vandors
            if($request->input('vandor_data') != ''){
                $vandors = explode("],", $request->input('vandor_data'));
                foreach ($vandors as $key => $vandor) {
                    $data = json_decode($vandor."]", true);
                    if(is_array($data) == 1){
                        $propertiesVendor = new Vendors;
                        $propertiesVendor->user_id = \Auth::user()->id;
                        $propertiesVendor->property_unit_id = $propertiesUnit->id;
                        foreach ($data as $key => $value) {
                            if($value['name'] == 'vendor_type'){
                                $propertiesVendor->vendor_type = $value['value'];
                            }
                            if($value['name'] == 'vendor_name'){
                                $propertiesVendor->name = $value['value'];
                            }
                            if($value['name'] == 'vendor_phone_no'){
                                $propertiesVendor->phone_no = $value['value'];
                            }
                            if($value['name'] == 'vendor_email'){
                                $propertiesVendor->email = $value['value'];
                            }
                        }
                        $propertiesVendor->save();
                    }
                }
             }

            //Add Meter
            if($request->input('new_meter') != ''){
                $meters = explode("],", $request->input('new_meter'));
                foreach ($meters as $key => $vandor) {
                    $data = json_decode($vandor."]", true);
                    if(is_array($data) == 1){
                        $Meter = new Meters;
                        $Meter->unit_id = $propertiesUnit->id;
                        $Meter->user_id = \Auth::user()->id;
                        foreach ($data as $key => $value) {
                            if($value['name'] == 'meter_type'){
                                $Meter->meter_type = $value['value'];
                            }
                            if($value['name'] == 'meter_number'){
                                $Meter->meter_number = $value['value'];
                            }
                            if($value['name'] == 'ean_number'){
                                $Meter->ean_number = $value['value'];
                            }
                            if($value['name'] == 'unit_price'){
                                $Meter->unit_price = $value['value'];
                            }
                        }
                        $Meter->save();
                    }
                }
             }

            // $this->sendMail([
            //     "Property Manager" => $propertiesUnit->property_manager_id, 
            //     "Property Description Experts" =>$propertiesUnit->property_description_experts_id, 
            //     "Property Legal Advisor" => $propertiesUnit->property_legal_advisor_id,  
            //     "Property Visit Organizer" => $propertiesUnit->property_visit_organizer_id
            // ]);
            return redirect('/list/all/properties')->with('flash_message_success','Create Unit Successfully');
          }
          if($request->input('p_type') == 'building'){
            $request->validate([
                //step 1
                'p_type' => ['required'],

                //step 2
                'unit_name' => ['required'],
               // 'area' => ['required','numeric'],
                'description' => ['required'],
                'address' => ['required'],

                //step 7
                'cover_image' => ['required'],
                'images' => ['required'],
            ]);
            /*  Create Property */
            $property = new Properties;
            $property->user_id = \Auth::user()->id;
            $property->p_type = $request->input('p_type');
            $property->unit_name = $request->input('unit_name');
            $property->area = $request->input('area');
            $property->description = $request->input('description');
            $property->latitude = $request->input('latitude');
            $property->longitude = $request->input('longitude');
            $property->address = $request->input('address');

            
            if($request->input('property_manager_id') == ''){
                $property->property_manager_id = \Auth::user()->id;
            } else {
               $property->property_manager_id = $request->input('property_manager_id');
            }
            if($request->input('property_description_experts_id') == ''){
                $property->property_description_experts_id = \Auth::user()->id;
            } else {
               $property->property_description_experts_id = $request->input('property_description_experts_id');
            }
            if($request->input('property_legal_advisor_id') == ''){
                $property->property_legal_advisor_id = \Auth::user()->id;
            } else {
               $property->property_legal_advisor_id = $request->input('property_legal_advisor_id');
            }
            if($request->input('property_visit_organizer_id') == ''){
                $property->property_visit_organizer_id = \Auth::user()->id;
            } else {
                $property->property_visit_organizer_id = $request->input('property_visit_organizer_id');
            }
            
            $property->registration_possible = $request->input('registration_possible');
            $property->cleaning_commonc_room_incl = $request->input('cleaning_commonc_room_incl');
            $property->cleaning_private_room_incl = $request->input('cleaning_private_room_incl');
            $property->animal_allowed = $request->input('animal_allowed');
            $property->play_musical_instrument = $request->input('play_musical_instrument');
            $property->smoking_allowed = $request->input('smoking_allowed');
            $property->cover_image = $request->input('cover_image');
            $property->images = $request->input('images');
            $property->save();

            //Add Vandors
            if($request->input('vandor_data') != ''){
                $vandors = explode("],", $request->input('vandor_data'));
                foreach ($vandors as $key => $vandor) {
                    $data = json_decode($vandor."]", true);
                    if(is_array($data) == 1){
                        $propertiesVendor = new Vendors;
                        $propertiesVendor->user_id = \Auth::user()->id;
                        $propertiesVendor->building_id = $property->id;
                        foreach ($data as $key => $value) {
                            if($value['name'] == 'vendor_type'){
                                $propertiesVendor->vendor_type = $value['value'];
                            }
                            if($value['name'] == 'vendor_name'){
                                $propertiesVendor->name = $value['value'];
                            }
                            if($value['name'] == 'vendor_phone_no'){
                                $propertiesVendor->phone_no = $value['value'];
                            }
                            if($value['name'] == 'vendor_email'){
                                $propertiesVendor->email = $value['value'];
                            }
                        }
                        $propertiesVendor->save();
                    }
                }
            }
            return redirect('/list/all/properties')->with('flash_message_success','Create Building Successfully'); 
        }
    }
    public function update_unit_admin(Request $request,$id)
    {
          $request->validate([
            //step 1
            'p_type' => ['required'],

            //step 2
            'unit_name' => ['required'],
            'area' => ['required','numeric'],
            'description' => ['required'],
            'address' => ['required'],

            //step 3
            'u_type' => ['required'],
            'rent' => ['required','numeric'],
            'cost_provision' => ['required','numeric'],
            'deposit' => ['required','numeric'],
            'fixed_price' => ['required','numeric'],
            'tax' => ['required','numeric'],
            'bedrooms' => ['required','numeric'],
            'bed_funished' => ['required'],
            'kitchen' => ['required'],
            'toilet' => ['required'],
            'choose_guarantor' => ['required'],
            'total_amount' => ['required'],
            'po_esignature' => ['required'],

            //step 4
            'min_age' => ['required','numeric'],
            'max_age' => ['required','numeric'],
            
            //step 7
            'cover_image' => ['required'],
            'images' => ['required'],
        ]);
        if($request->input('vandor_remove') != ''){
            DB::table('property_vendors')->whereIn('id', explode(',', $request->input('vandor_remove')))->delete();
        }
        if($request->input('meter_remove') != ''){
            DB::table('meters')->whereIn('id', explode(',', $request->input('meter_remove')))->delete();
        }
        $propertiesUnit = PropertiesUnit::find($id);
        if(!empty($request->input('building_id')))
        {
           $propertiesUnit->building_id = $request->input('building_id');
        }
        $propertiesUnit->unit_name = $request->input('unit_name');
        $propertiesUnit->area = $request->input('area');
        $propertiesUnit->area_in = $request->input('area_in');
        $propertiesUnit->description = $request->input('description');
        $propertiesUnit->latitude = $request->input('latitude');
        $propertiesUnit->longitude = $request->input('longitude');
        $propertiesUnit->address = $request->input('address');
        $propertiesUnit->u_type = $request->input('u_type');

        if($request->input('u_type') == 'residential'){
            $propertiesUnit->unit_category = $request->input('unit_category_residential');
        } else {
            $propertiesUnit->unit_category = $request->input('unit_category_commercial');
        }
        $propertiesUnit->rent = $request->input('rent');
        $propertiesUnit->cost_provision = $request->input('cost_provision');
        $propertiesUnit->deposit = $request->input('deposit');
        $propertiesUnit->fix_price = $request->input('fixed_price');
        $propertiesUnit->tax = $request->input('tax');
        $propertiesUnit->bedrooms = $request->input('bedrooms');
        $propertiesUnit->bed_funished = $request->input('bed_funished');
        $propertiesUnit->bed_lock = $request->input('bed_lock');
        $propertiesUnit->kitchen = $request->input('kitchen');
        $propertiesUnit->toilet = $request->input('toilet');
        $propertiesUnit->choose_guarantor = $request->input('choose_guarantor');
        $propertiesUnit->total_amount = $request->input('total_amount');
        $propertiesUnit->po_esignature = $request->input('po_esignature');
        $propertiesUnit->living_room = $request->input('living_room');
        $propertiesUnit->balcony_terrace = $request->input('balcony_terrace');
        $propertiesUnit->garden = $request->input('garden');
        $propertiesUnit->basement = $request->input('basement');
        $propertiesUnit->parking = $request->input('parking');
        $propertiesUnit->wheelchair = $request->input('wheelchair');
        $propertiesUnit->allergy_friendly = $request->input('allergy_friendly');
        if($request->input('amenities') != ''){
            $propertiesUnit->amenities = implode(",",$request->input('amenities'));
                
        }

        $propertiesUnit->preferred_gender = $request->input('preferred_gender');
        $propertiesUnit->min_age = $request->input('min_age');
        $propertiesUnit->max_age = $request->input('max_age');
        $propertiesUnit->tenant_type = $request->input('tenant_type');
        $propertiesUnit->couples_allowed = $request->input('couples_allowed');
        $propertiesUnit->p_type = $request->input('p_type');
        
        $propertiesUnit->user_id = \Auth::user()->id;

        if($request->input('property_manager_id') == ''){
            $propertiesUnit->property_manager_id = \Auth::user()->id;
        } else {
           $propertiesUnit->property_manager_id = $request->input('property_manager_id');
        }
        if($request->input('property_description_experts_id') == ''){
            $propertiesUnit->property_description_experts_id = \Auth::user()->id;
        } else {
           $propertiesUnit->property_description_experts_id = $request->input('property_description_experts_id');
        }
        if($request->input('property_legal_advisor_id') == ''){
            $propertiesUnit->property_legal_advisor_id = \Auth::user()->id;
        } else {
           $propertiesUnit->property_legal_advisor_id = $request->input('property_legal_advisor_id');
        }
        if($request->input('property_visit_organizer_id') == ''){
            $propertiesUnit->property_visit_organizer_id = \Auth::user()->id;
        } else {
            $propertiesUnit->property_visit_organizer_id = $request->input('property_visit_organizer_id');
        }
        
        $propertiesUnit->registration_possible = $request->input('registration_possible');
        $propertiesUnit->cleaning_commonc_room_incl = $request->input('cleaning_commonc_room_incl');
        $propertiesUnit->cleaning_private_room_incl = $request->input('cleaning_private_room_incl');
        $propertiesUnit->animal_allowed = $request->input('animal_allowed');
        $propertiesUnit->play_musical_instrument = $request->input('play_musical_instrument');
        $propertiesUnit->smoking_allowed = $request->input('smoking_allowed');
        $propertiesUnit->cover_image = $request->input('cover_image');
        $propertiesUnit->images = $request->input('images');
        $propertiesUnit->save();

        //Add Vandors
            if($request->input('vandor_data') != ''){
                $vandors = explode("],", $request->input('vandor_data'));
                foreach ($vandors as $key => $vandor) {
                    $data = json_decode($vandor."]", true);
                    if(is_array($data) == 1){
                        $propertiesVendor = new Vendors;
                        $propertiesVendor->user_id = \Auth::user()->id;
                        $propertiesVendor->property_unit_id = $id;
                        foreach ($data as $key => $value) {
                            if($value['name'] == 'vendor_type'){
                                $propertiesVendor->vendor_type = $value['value'];
                            }
                            if($value['name'] == 'vendor_name'){
                                $propertiesVendor->name = $value['value'];
                            }
                            if($value['name'] == 'vendor_phone_no'){
                                $propertiesVendor->phone_no = $value['value'];
                            }
                            if($value['name'] == 'vendor_email'){
                                $propertiesVendor->email = $value['value'];
                            }
                        }
                        $propertiesVendor->save();
                    }
                }
            }

            //Add Meter
                        if($request->input('new_meter') != ''){
                            $meters = explode("],", $request->input('new_meter'));
                            foreach ($meters as $key => $vandor) {
                                $data = json_decode($vandor."]", true);
                                if(is_array($data) == 1){
                                    $Meter = new Meters;
                                    $Meter->unit_id = $id;
                                    $Meter->user_id = \Auth::user()->id;
                                    foreach ($data as $key => $value) {
                                        if($value['name'] == 'meter_type'){
                                            $Meter->meter_type = $value['value'];
                                        }
                                        if($value['name'] == 'meter_number'){
                                            $Meter->meter_number = $value['value'];
                                        }
                                        if($value['name'] == 'ean_number'){
                                            $Meter->ean_number = $value['value'];
                                        }
                                        if($value['name'] == 'unit_price'){
                                            $Meter->unit_price = $value['value'];
                                        }
                                    }
                                    $Meter->save();
                                }
                            }
                        }
                toastr()->success('Update Successfully!');
                return back()->with('flash_message_success','unit update successfully');
    }
    public function update_building_admin(Request $request,$id)
    {
          $request->validate([
            //step 1
            'p_type' => ['required'],

            //step 2
            'unit_name' => ['required'],
            //'area' => ['required','numeric'],
            'description' => ['required'],
            'address' => ['required'],

            //step 7
            'cover_image' => ['required'],
            'images' => ['required'],
        ]);

        if($request->input('vandor_remove') != ''){
            DB::table('property_vendors')->whereIn('id', explode(',', $request->input('vandor_remove')))->delete();
        }
        $property = Properties::find($id);
        $property->user_id = \Auth::user()->id;
        $property->p_type = $request->input('p_type');
        $property->unit_name = $request->input('unit_name');
        $property->area = $request->input('area');
        $property->description = $request->input('description');
        $property->latitude = $request->input('latitude');
        $property->longitude = $request->input('longitude');
        $property->address = $request->input('address');

        
        if($request->input('property_manager_id') == ''){
            $property->property_manager_id = \Auth::user()->id;
        } else {
           $property->property_manager_id = $request->input('property_manager_id');
        }
        if($request->input('property_description_experts_id') == ''){
            $property->property_description_experts_id = \Auth::user()->id;
        } else {
           $property->property_description_experts_id = $request->input('property_description_experts_id');
        }
        if($request->input('property_legal_advisor_id') == ''){
            $property->property_legal_advisor_id = \Auth::user()->id;
        } else {
           $property->property_legal_advisor_id = $request->input('property_legal_advisor_id');
        }
        if($request->input('property_visit_organizer_id') == ''){
            $property->property_visit_organizer_id = \Auth::user()->id;
        } else {
            $property->property_visit_organizer_id = $request->input('property_visit_organizer_id');
        }
        
        $property->registration_possible = $request->input('registration_possible');
        $property->cleaning_commonc_room_incl = $request->input('cleaning_commonc_room_incl');
        $property->cleaning_private_room_incl = $request->input('cleaning_private_room_incl');
        $property->animal_allowed = $request->input('animal_allowed');
        $property->play_musical_instrument = $request->input('play_musical_instrument');
        $property->smoking_allowed = $request->input('smoking_allowed');
        $property->cover_image = $request->input('cover_image');
        $property->images = $request->input('images');
        $property->save();

        //Add Vandors
        if($request->input('vandor_data') != ''){
            $vandors = explode("],", $request->input('vandor_data'));
            foreach ($vandors as $key => $vandor) {
                $data = json_decode($vandor."]", true);
                if(is_array($data) == 1){
                    $propertiesVendor = new Vendors;
                    $propertiesVendor->user_id = \Auth::user()->id;
                    $propertiesVendor->building_id = $property->id;
                    foreach ($data as $key => $value) {
                        if($value['name'] == 'vendor_type'){
                            $propertiesVendor->vendor_type = $value['value'];
                        }
                        if($value['name'] == 'vendor_name'){
                            $propertiesVendor->name = $value['value'];
                        }
                        if($value['name'] == 'vendor_phone_no'){
                            $propertiesVendor->phone_no = $value['value'];
                        }
                        if($value['name'] == 'vendor_email'){
                            $propertiesVendor->email = $value['value'];
                        }
                    }
                    $propertiesVendor->save();
                }
            }
        }
        toastr()->success('Building Update Successfully!');
          return back()->with('flash_message_success','Building update successfully');
    }
}
