<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use URL;
use Session;
use Redirect;
use App\User;
use App\Properties;
use App\Meters;
use App\MeterReadings;
use App\Contracts;
Use Helper;
use App\PropertiesUnit;
use App\Vendors;
use App\appointments;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image; 
use App\Booking;
use App\Terminate;
use App\Transactions;
use App\Documents;
use App\Refund;
use App\Sub_Tenant;
use App\UserBankAccount;
use Stripe;
use PDF;


class PropertyController extends Controller {   
    const Property_Manager = 3;
    const Property_Description_Experts = 4;
    const Legal_Advisor = 5;
    const Visit_Organizer = 6;
    const Tenant = 1;
    const Property_Owner = 2;
    public function __construct(){
        $this->middleware('auth');
    }

    //Create Unit Page
    public function index(){
        $amenities = DB::table('amenities')->get();
        $PropertyManagers = DB::table('users')->where('user_role', self::Property_Manager)->get();
        $PropertyDescriptionExperts = DB::table('users')->where('user_role', self::Property_Description_Experts)->get();
        $LegalAdvisors = DB::table('users')->where('user_role', self::Legal_Advisor)->get();
        $VisitOrganizers = DB::table('users')->where('user_role', self::Visit_Organizer)->get();
        $properties = DB::table('properties')->where('IsDeleted', '=' , 0)->where('user_id', \Auth::user()->id)->get();
        return view('dashboard.createproperty',
            compact('PropertyManagers','PropertyDescriptionExperts','LegalAdvisors','VisitOrganizers','amenities','properties')
        ); 
    }

    //Create unit post function
    public function createProperty(Request $request){
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
            $propertiesUnit->building_id = $request->input('building_id');
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
                            if($value['name'] == 'consumption'){
                                $Meter->consumption = $value['value'];
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
            toastr()->success('Unit Created Successfully!');
            return redirect('/list-units');
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
            toastr()->success('Building Created Successfully!');
            return redirect('/list-units'); 
        }
    }

    function pdf()
    {
        $pdf_data = array(
            'lessor_name' => 'lessor name kumar sharma punj from panchkula 132117',
            'lessor_email' => 'lessor_email.com',
            'lessor_phone' => '919813607878',
            'lessor_postal' => 'GFT-H45RHF',
            'lessor_address' => 'lessor addres sector 18, panchkula (Haryana) India 132117 lessor addres sector 18, panchkula (Haryana) India 132117 lessor addres sector 18, panchkula (Haryana) India 132117',
            'lessor_id' => 'ID23234232323343',
            'lessor_signature' => 'lessor signature',
        );

        $pdf_data = array(
            'lessor_name' => \Auth::user()->name,
            'lessor_email' => \Auth::user()->email,
            'lessor_phone' => \Auth::user()->phone_no,
            'lessor_postal' => \Auth::user()->postal_code,
            'lessor_address' => \Auth::user()->postal.', '.\Auth::user()->city,
            'lessor_id' => \Auth::user()->id_card,
            'lessor_signature' => 'lessor signature',
        );
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_customer_data_to_html($pdf_data));
        return $pdf->stream();
    }

    function convert_customer_data_to_html($data)
    {
        // Helper::pr($data);
        // die('amit');
         return view('dynamic_pdf',compact('data'));
    }

    //Dashboard List unit page 
    public function listUnit(){
        if(\Auth::user()->user_role == self::Property_Owner){
            $propertiesWithBuilding = array();
            $ids = null;
            if(isset($_GET['occupied']) && $_GET['occupied'] == 'yes')
            {
                $contracts = Booking::select('unit_id')->where('status', 6)->where('po_id', \Auth::user()->id)->get();
                if($contracts){
                    foreach ($contracts as $key => $value) {
                        $unitIds[] = $value->unit_id;
                    }
                }
                $propertiesWithoutBuilding = PropertiesUnit::where('user_id', \Auth::user()->id)
                                ->where('IsDeleted', '=' , 0)
                                ->whereIn('id', $unitIds)
                                ->orderBy('id', 'desc')
                                ->get();
            }
            elseif(isset($_GET['occupied']) && $_GET['occupied'] == 'no') {
                $propertiesWithoutBuilding = PropertiesUnit::where('user_id', \Auth::user()->id)
                        ->where('IsDeleted', '=' , 0)
                        ->where('booking_status', '=' , 0)
                        ->orderBy('id', 'desc')
                        ->get();
            }
            else
            {
                $propertiesWithoutBuilding = PropertiesUnit::where('user_id', \Auth::user()->id)
                                    ->where('building_id', null)
                                    ->where('IsDeleted', '=' , 0)
                                    ->orderBy('id', 'desc')
                                    ->get();
                $buildingIds = DB::table('properties')
                                    //->select('id')
                                    ->where('user_id', \Auth::user()->id)
                                    ->where('IsDeleted', '=' , 0)
                                    ->get();
                if(count($buildingIds) > 0){
                    foreach ($buildingIds as $key => $value) {
                        if($value->id != null){
                            //$ids[] = $value->id;
                            $propertiesWithBuilding[$key]['building_id'] =  $value;
                            $propertiesWithBuilding[$key]['data'] = DB::table('property_units')
                                ->where('building_id',$value->id)
                                ->orderBy('id', 'desc')
                                ->get();

                            $booked_unit = DB::table('unit_booking')
                                ->join('property_units', function($join)
                                {
                                    $join->on('unit_booking.unit_id', '=', 'property_units.id')
                                        ->where(function ($query) {
                                            $query->where('status', 6)->orWhere('status', 3)->orWhere('payment_status','paid')->orWhere('payment_status','hold');
                                            })
                                            ->orWhere(function ($qry)  {
                                                $qry->where(['payment_status'=>'pending','payment_method'=>'bank']);
                                        } );
                                })->where('property_units.building_id',$value->id)
                                ->count();

                        $propertiesWithBuilding[$key]['active_unit_count'] =
                            $booked_unit;
                        }
                    }
                }
            }
            // if($ids != null){
            //     foreach ($ids as $key => $value) {
            //         $propertiesWithBuilding[$key]['building_id'] =  $value;
            //         $propertiesWithBuilding[$key]['data'] = DB::table('property_units')
            //                                                     ->where('building_id',$value)
            //                                                     ->get();
            //     }
            // }
            // echo "<pre>";
            // print_r($propertiesWithBuilding);die;
            return view('dashboard.listunits')->with([
                'propertiesWithoutBuilding' => $propertiesWithoutBuilding,
                'propertiesWithBuilding' => $propertiesWithBuilding
            ]);
        }

        if(\Auth::user()->user_role == self::Visit_Organizer){
            $unitIds = [];
            $propertiesWithoutBuilding = PropertiesUnit::where('property_visit_organizer_id', \Auth::user()->id)
                                //->where('building_id', null)
                                ->where('IsDeleted', '=' , 0)
                                ->orderBy('id', 'desc')
                                ->get();
            $propertiesWithBuilding = [];
            return view('dashboard.listunits')->with([
                'propertiesWithoutBuilding' => $propertiesWithoutBuilding,
                'propertiesWithBuilding' => $propertiesWithBuilding
            ]);
        }
        
        if(\Auth::user()->user_role == self::Legal_Advisor){
            $unitIds = [];
            $propertiesWithoutBuilding = PropertiesUnit::where('property_legal_advisor_id', \Auth::user()->id)
                                //->where('building_id', null)
                                ->where('IsDeleted', '=' , 0)
                                ->orderBy('id', 'desc')
                                ->get();
            // \DB::enableQueryLog();
            // Helper::pr($propertiesWithoutBuilding[0]->current_contracts);
            //  $query = \DB::getQueryLog();
            //  print_r($query);
            // die('dddd');
            $propertiesWithBuilding = [];
            return view('dashboard.legal-listunits')->with([
                'propertiesWithoutBuilding' => $propertiesWithoutBuilding,
                'propertiesWithBuilding' => $propertiesWithBuilding
            ]);
        }

        if(\Auth::user()->user_role == self::Property_Description_Experts){
            $unitIds = [];
            $propertiesWithoutBuilding = PropertiesUnit::where('property_description_experts_id', \Auth::user()->id)
                //->where('building_id', null)
                ->where('IsDeleted', '=' , 0)
                ->orderBy('id', 'desc')
                // ->get()
                ->paginate(10);
            $propertiesWithBuilding = [];
            // Helper::pr($propertiesWithoutBuilding);
            // die('ddd');
            return view('dashboard.pde-listunit')->with([
                'propertiesWithoutBuilding' => $propertiesWithoutBuilding,
                'propertiesWithBuilding' => $propertiesWithBuilding
            ]);
        }

        if(\Auth::user()->user_role == self::Property_Manager){
            $unitIds = [];
            if(isset($_GET['occupied']) && $_GET['occupied'] == 'yes')
            {
                $contracts = Booking::select('unit_id')->where('status', 6)->where('pm_id', \Auth::user()->id)->get();
                if($contracts){
                    foreach ($contracts as $key => $value) {
                        $unitIds[] = $value->unit_id;
                    }
                }
                $propertiesWithoutBuilding = PropertiesUnit::where('property_manager_id', \Auth::user()->id)
                                ->where('IsDeleted', '=' , 0)
                                ->whereIn('id', $unitIds)
                                ->orderBy('id', 'desc')
                                ->get();
            }
            elseif(isset($_GET['occupied']) && $_GET['occupied'] == 'no') {
                $propertiesWithoutBuilding = PropertiesUnit::where('property_manager_id', \Auth::user()->id)
                                    ->where('IsDeleted', '=' , 0)
                                    ->where('booking_status', '=' , 0)
                                    ->orderBy('id', 'desc')
                                    ->get();
            }
            else
            {
                $propertiesWithoutBuilding = PropertiesUnit::where('property_manager_id', \Auth::user()->id)
                                    ->where('IsDeleted', '=' , 0)
                                    ->orderBy('id', 'desc')
                                    ->get();
            }
            $propertiesWithBuilding = [];
            return view('dashboard.listunits')->with([
                'propertiesWithoutBuilding' => $propertiesWithoutBuilding,
                'propertiesWithBuilding' => $propertiesWithBuilding
            ]);
        }

    }

    //Dashboard Building Details Page
    public function buildingDetails($id){
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
        return view('dashboard.buildingdetails')->with([
            'buildingDetail'=>$buildingDetail, 
            'buildingUnits' => $buildingUnits, 
            'amenities'=>$amenities,
            'propertyManager'=>$propertyManager,
            'propertyDescriptionExperts'=>$propertyDescriptionExperts,
            'propertyLegalAdvisor'=>$propertyLegalAdvisor,
            'propertyVisitOrganizer'=>$propertyVisitOrganizer,
        ]);
    }

    //Dashboard Delete Building
    public function deleteProperty($id){
        $property = Properties::find($id);
        $property->IsDeleted = 1;
        $property->save();

        $property_units = PropertiesUnit::where('building_id','=',$id)->update(['IsDeleted'=>'1']);
        $property_vendors = Vendors::where('building_id','=',$id)->update(['IsDeleted'=>'1']);
        // DB::table('property_units')->where('building_id', '=', $id)->delete();
        // DB::table('property_vendors')->where('building_id', '=', $id)->delete();
        //Meters::where('property_id', $id)->delete();
        //return redirect()->back()->with('message', 'Building Delete Successfully!');
        toastr()->success('Building Delete Successfully!');
        return redirect()->back();
    } 

    //Dashboard Delete Unit
    public function deleteUnit($id){
        $propertiesUnit = PropertiesUnit::find($id);
        $propertiesUnit->IsDeleted = 1;
        $propertiesUnit->save();

        $propertiesVendor = Vendors::where('property_unit_id','=',$id)->update(['IsDeleted'=>'1']);
        toastr()->success('Unit Delete Successfully!');
        return redirect()->back();
    }

    //Dashboard edit Unit
    public function editUnit($id){
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
        
        return view('dashboard.editbuilding')->with([
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

    //Dashboard Update Unit
    public function updateUnit($id,Request $request){
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
        $propertiesUnit->building_id = $request->input('building_id');
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
                            if($value['name'] == 'consumption'){
                                $Meter->consumption = $value['value'];
                            }
                        }
                        $Meter->save();
                    }
                }
            }

        toastr()->success('Update Successfully!');
        return redirect()->back();
        //return redirect()->back()->with('message', 'Update Successfully!');
    }

    //Dashboard edit Building
    public function editBuilding($id){
        $unit = DB::table('properties')->where('id', $id)->first();
        $property = DB::table('properties')->where('id', $id)->first();
        // echo "<pre>";
        // print_r($property);die;
        $PropertyManagers = DB::table('users')->where('user_role', self::Property_Manager)->get();
        $PropertyDescriptionExperts = DB::table('users')->where('user_role', self::Property_Description_Experts)->get();
        $LegalAdvisors = DB::table('users')->where('user_role', self::Legal_Advisor)->get();
        $VisitOrganizers = DB::table('users')->where('user_role', self::Visit_Organizer)->get();
        $amenities = DB::table('amenities')->get();
        $properties = DB::table('properties')->where('user_id', \Auth::user()->id)->get();
        $meters = DB::table('meters')->where('unit_id', $id)->get();
        $unitVendors = DB::table('property_vendors')->where('property_unit_id', $id)->get();
        $buildingVendors = DB::table('property_vendors')->where('building_id', $id)->get();
        
        return view('dashboard.editbuilding')->with([
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

    //Dashboard Update Building
    public function updateBuilding($id,Request $request){
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
        return redirect()->back();
    }

    public function listBookingRequests(){
        $user = \Auth::user();
        $bookings = array();
        if($user->user_role == self::Property_Manager){
            $bookings = Booking::where(['pm_id' => $user->id,'step' => '5'])->orderBy('id', 'desc')->paginate(5);
        }
        elseif($user->user_role == self::Property_Owner){
            $bookings = Booking::where(['po_id' => $user->id,'step' => '5'])->orderBy('id', 'desc')->paginate(5);
        }
        return view('dashboard.listbookingrequests',compact('bookings'));
    }

        // public function Contract_list(){
        //     return view('dashboard.Contract_list');
        // }

        // public function contractDetails($id){
        //     return view('dashboard.contractdetails');
        // } 
    // public function tenantDetails($id){
    //     return view('dashboard.tenantdetails');
    // }
    // public function give_permissions($id){
    //     return view('dashboard.manager.give-permissions');
    // }
    public function unitManagment($id){
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
        return view('dashboard.unitmanagment')->with([
            'unit'=>$unit,
            'rentalBills'=>$rentalBills,
            'transactions'=>$transactions,
        ]);
    }
    public function terminate_contract(Request $request, $id){
        $contract = Booking::find($id);
        $terminate = Terminate::where(['booking_id' => $id])->first();
        if($request->isMethod('post'))
        {
            $postData = Input::all();
            if($postData['step'] == 1)
            {
                $rules = array(
                    'email'         => 'required',
                );
                $message = array(
                    'name'          => 'Please enter name',
                );
                $validator = Validator::make($postData, $rules, $message);
                if ($validator->fails())
                {
                    return Response()->json(array(
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray(),
                    )); // 400 being the HTTP code for an invalid request.
                }
                else
                {
                    $where_data = array('unit_id' => $id, 'tenant_id' => $tenant_id);
                    $terminate_data = array(
                        'step' => $postData['step'],
                        'tenant_photo' =>$tenant_photo,
                        'tenant_photo_id_proof' =>$tenant_photo_id_proof,
                        'tenant_photo_esignature' =>$tenant_photo_esignature,
                        'tenant_pay_slip'       =>$tenant_pay_slip,
                        'pde_id'=>$unit->property_description_experts_id,
                        'vo_id' =>$unit->property_visit_organizer_id,
                        'po_id' =>$unit->user_id,
                        'pm_id' =>$unit->property_manager_id,
                        'lad_id' =>$unit->property_legal_advisor_id,
                    );

                    $booking = Booking::updateOrCreate($where_data, $terminate_data);
                }
            }
        }
        return view('tenant.terminate-contract',compact('contract','terminate','id'));
    }

    // public function membershipdetails(){
    //     $membership_data = DB::table('membership_payments')
    //         ->join('plans', 'membership_payments.plan_id', '=', 'plans.id')
    //         ->where('membership_payments.user_id', \Auth::user()->id)
    //         ->select('membership_payments.*', 'plans.*', 'membership_payments.status')
    //         ->get();
    //     return view('dashboard.membershipdetails')->with(['membership_data'=>$membership_data]);
    // }

    public function managnentUnits(){
        return view('dashboard.managnent');
    }

    public function list(){
        $properties = DB::table('properties')->where('user_id', \Auth::user()->id)->get();
        return view('dashboard.listofproperties')->with(['properties'=>$properties]);
    }  
    public function managelist(){
        $propertyIds = null;
        $invitations = DB::table('invitations')->select('property_id')->groupBy('property_id')->where('email', \Auth::user()->email)->get();
        foreach ($invitations as $key => $value) {
            $propertyIds[] = $value->property_id;
        }
        $properties = DB::table('properties')->whereIn('id', $propertyIds)->get();
        return view('dashboard.manager.listofproperties')->with(['properties'=>$properties]);
    }
    public function my_contract_list(Request $request) {
        $user = \Auth::user();
        $contracts = array();
        $booking_ids = array();
        if($user->user_role == self::Tenant)
        {
            if (isset($_GET['pageno'])) {
                $pageno = $_GET['pageno'];
            } else {
                $pageno = 1;
            }
            $no_of_records_per_page = 10;
            $offset = ($pageno-1) * $no_of_records_per_page;

            $page = $pageno;
            $limit = $no_of_records_per_page;

            $sub_tenants = $booking_ids = Sub_Tenant::where('tenant_id', $user->id)->pluck('booking_id')->toArray();

            $where = array('tenant_id' => $user->id,'step' => '5');
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
            $query = $query->orWhereIn('id',$booking_ids);
            $total_property = $query->get();
            // Helper::pr($total_property);
            // die('aaaaaaa');
            $contracts = $query->orderBy('unit_booking.id', 'desc')->limit($no_of_records_per_page)->offset($offset)->get();

            $total_rows = count($total_property);
            $total_pages = ceil($total_rows / $no_of_records_per_page);
            return view('contracts.tenant-contract-list',compact('contracts','page','total_pages','limit'));
        }
        elseif($user->user_role == self::Property_Manager){

            if (isset($_GET['pageno'])) {
                $pageno = $_GET['pageno'];
            } else {
                $pageno = 1;
            }
            $no_of_records_per_page = 10;
            $offset = ($pageno-1) * $no_of_records_per_page;

            $page = $pageno;
            $limit = $no_of_records_per_page;

            $where = array('pm_id' => $user->id,'step' => '5');
            $postData = Input::all();
            // echo $postData['search'];
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
            if(isset($_GET['last']) && $_GET['last'] != '' )
            {
                $startDate = Carbon::today()->subDays(60)->format('Y/m/d');
                $query = $query->where('status', 6)->where('start_date','>', $startDate);
            }
            if(isset($_GET['end']) && $_GET['end'] != '' )
            {
                $endDate = Carbon::today()->addMonths(2)->format('Y/m/d');
                $query =  $query->where('status', 6)->where('end_date','<', $endDate);
            }

            $total_property = $query->get();
            $contracts = $query->orderBy('unit_booking.id', 'desc')->limit($no_of_records_per_page)->offset($offset)->get();

            $total_rows = count($total_property);
            $total_pages = ceil($total_rows / $no_of_records_per_page);
           
            return view('contracts.PM-PO-contract_list',compact('contracts','page','total_pages','limit'));



            $contracts = Booking::where(['pm_id' => $user->id,'step' => '5'])->orderBy('unit_booking.id', 'desc')->paginate(5);
            return view('contracts.PM-PO-contract_list', compact('contracts'));
        }
        elseif($user->user_role == self::Property_Owner){

            if (isset($_GET['pageno'])) {
                $pageno = $_GET['pageno'];
            } else {
                $pageno = 1;
            }
            $no_of_records_per_page = 10;
            $offset = ($pageno-1) * $no_of_records_per_page;

            $page = $pageno;
            $limit = $no_of_records_per_page;

            $where = array('po_id' => $user->id,'step' => '5');
            $postData = Input::all();
            // echo $postData['search'];
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

            if(isset($_GET['last']) && $_GET['last'] != '' )
            {
                $startDate = Carbon::today()->subDays(60)->format('Y/m/d');
                $query = $query->where('status', 6)->where('start_date','>', $startDate);
            }
            if(isset($_GET['end']) && $_GET['end'] != '' )
            {
                $endDate = Carbon::today()->addMonths(2)->format('Y/m/d');
                $query =  $query->where('status', 6)->where('end_date','<', $endDate);
            }
            
            $total_property = $query->get();
            $contracts = $query->orderBy('unit_booking.id', 'desc')->limit($no_of_records_per_page)->offset($offset)->get();
           
            $total_rows = count($total_property);
            $total_pages = ceil($total_rows / $no_of_records_per_page);
            return view('contracts.PM-PO-contract_list',compact('contracts','page','total_pages','limit'));
            

            $contracts = Booking::where(['po_id' => $user->id,'step' => '5'])->orderBy('id', 'desc')->paginate(5);
            return view('contracts.PM-PO-contract_list', compact('contracts'));
        }
        elseif($user->user_role == self::Legal_Advisor){
            $contracts = Booking::where(['lad_id' => $user->id,'step' => '5'])->orderBy('id', 'desc')->paginate(5);
            return view('contracts.PM-PO-contract_list', compact('contracts'));
        }
        // Helper::pr($contracts[0]->tenant_id);
        // die('dddd');
        // \DB::enableQueryLog();
            // Helper::pr($contracts[0]->user);
        //  $query = \DB::getQueryLog();
        //  echo "<pre>";
        //  print_r($query);
        // Helper::pr($contracts);
        // die('ffff');
        return view('dashboard.my-contract-list', compact('contracts'));
    }

    public function update_booking_status(Request $request)
    {
        $postData = Input::all();
        $sendMail_time = ($postData['status'] == '3') ? Helper::DateTime(date("Y-m-d H:m:s")) : '' ;
        $update_data = array(
            'status' =>  $postData['status'],
            'sendMail_time' =>  $sendMail_time,
        );
        $booking = Booking::where(['id' => $postData['id']])->first()->toArray();
        // $update = Booking::where(['id'=>$postData['id']])->update($update_data);
        if($postData['status'] == '3')
        {
            if($booking['payment_method'] == 'stripe'){
                $transection = Transactions::where(['booking_id'=>$booking['id']])->first();
                if($transection){
                    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                    $retrieve = Stripe\Charge::retrieve($transection->stripe_id);
                    if(!$retrieve->captured){
                        $return = $retrieve->capture();
                        if($return->status == 'succeeded'){
                            $transectionsave =  Transactions::find($transection->id);
                            $transectionsave->stripe_capture_id = $return->id;
                            $transectionsave->save();
                            $update = Booking::where(['id'=>$postData['id']])->update(['payment_status'=>'paid']);
                            //return json_encode(array('success'=>'Accepted Successfully'));
                        }
                    } else {
                       return json_encode(array('error'=>'Something went Wrong. Payment still on hold'));
                    }
                }
                else {
                    return json_encode(array('error'=>'Not Found Transection Id'));
                }
            }
            $update = Booking::where(['id'=>$postData['id']])->update($update_data);

            $unit = PropertiesUnit::where(['id' => $booking['unit_id']])->first()->toArray();
            $pm_id = $booking['pm_id'];
            $pm_details = User::find($pm_id)->toArray();
            $pm_name      = $pm_details['name'];
            $pm_email     = trim($pm_details['email']);

            $po_id = $booking['po_id'];
            $po_details = User::find($po_id)->toArray();
            $po_name      = $po_details['name'];
            $po_email     = trim($po_details['email']);

            $tenant_details = User::find($booking['tenant_id'])->toArray();
            $tenant_name      = $tenant_details['name'];
            $tenant_email     = trim($tenant_details['email']);

            $tenant_data = array(
                'name'          => $tenant_details['name'],
                "email"         => $tenant_details['email'],
                "unit_name"     => $unit['unit_name'],
                "description"   => $unit['description'],
                "price"         => $unit['rent'] + $unit['cost_provision'],
                "booking_id"    => $postData['id'],
                "pm_name"       => $pm_name,
            );
            Mail::send('emails.confirmation_mail_to_tenant', $tenant_data, function($message) use ($tenant_name, $tenant_email) {
                $message->to($tenant_email, $tenant_name)
                        ->subject('Property Booking Confirmation');
                $message->from('amitpunjvision@gmail.com','Reasy Property');
            });

            $get_sub_tenant = Sub_Tenant::where('booking_id', $postData['id'])->get();
            if($get_sub_tenant)
            {
                foreach ($get_sub_tenant as $key => $value) {
                    $tenant_details = User::find($value->tenant_id)->toArray();
                    $tenant_name      = $tenant_details['name'];
                    $tenant_email     = trim($tenant_details['email']);

                    $tenant_data = array(
                        'name'          => $tenant_details['name'],
                        "email"         => $tenant_details['email'],
                        "unit_name"     => $unit['unit_name'],
                        "description"   => $unit['description'],
                        "price"         => $unit['rent'] + $unit['cost_provision'],
                        "booking_id"    => $postData['id'],
                        "pm_name"       => $pm_name,
                    );
                    Mail::send('emails.confirmation_mail_to_tenant', $tenant_data, function($message) use ($tenant_name, $tenant_email) {
                        $message->to($tenant_email, $tenant_name)
                                ->subject('Property Booking Confirmation');
                        $message->from('amitpunjvision@gmail.com','Reasy Property');
                    });
                }
            }

            $pm_data = array(
                'name'      => $pm_details['name'],
                "email"     => $pm_details['email'],
                "unit_name"     => $unit['unit_name'],
                "description"   => $unit['description'],
                "price"         => $unit['rent'] + $unit['cost_provision'],
                "tenant_name"   => $tenant_details['name'],
                "booking_id"    => $postData['id'],
            );
                
            Mail::send('emails.confirmation_mail_to_pm', $pm_data, function($message) use ($pm_name, $pm_email) {
                $message->to($pm_email, $pm_name)
                        ->subject('Property Booking Confirmation');
                $message->from('amitpunjvision@gmail.com','Reasy Property');
            });

            $po_data = array(
                'name'      => $po_details['name'],
                "email"     => $po_details['email'],
                "unit_name"     => $unit['unit_name'],
                "description"   => $unit['description'],
                "price"         => $unit['rent'] + $unit['cost_provision'],
                "tenant_name"   => $tenant_details['name'],
                "booking_id"    => $postData['id'],
            );
                
            Mail::send('emails.confirmation_mail_to_pm', $po_data, function($message) use ($po_name, $po_email) {
                $message->to($po_email, $po_name)
                        ->subject('Property Booking Confirmation');
                $message->from('amitpunjvision@gmail.com','Reasy Property');
            });
        }
        if($postData['status'] == '4')
        {
            if($booking['payment_method'] == 'stripe')
            {
                $transection = Transactions::where(['booking_id'=>$booking['id']])->first();
                if($transection){
                    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                    $amount = $transection->amount * 100;
                    $refund = \Stripe\Refund::create([
                        'charge' => $transection->stripe_id,
                        'amount' => $amount,
                    ]);
                    if($refund->object == 'refund'){
                        if($refund->status == 'succeeded'){
                            $transectionsave =  Transactions::find($transection->id);
                            $transectionsave->stripe_refundID = $refund->id;
                            $transectionsave->save();
                            $update = Booking::where(['id'=>$postData['id']])->update(['payment_status'=>'refund']);

                            $refund_data = array(
                                'contract_id'  => $postData['id'],
                                'unit_id'  => $booking['unit_id'],
                                'po_id'  => $booking['po_id'],
                                'tenant_id'  => $booking['tenant_id'],
                                'refund_amount'  => $transection->amount,
                                'method'  => 'stripe',
                                'refundID'  => $refund->id,
                                'time'      => Helper::DateTime(date("Y-m-d H:m:s")),
                                'status'    => 'done',
                                'related_to'  => 'PropertyReject',
                            );
                            $refund = Refund::create($refund_data);
                            // return json_encode(array('success'=>'Accepted Successfully'));
                        }
                    } else { 
                       return json_encode(array('error'=>'Sothing went Wrong. Payment Still on Hold'));
                    }
                }
                else {
                    return json_encode(array('error'=>'Not Found Transection Id'));
                }
            }
            $update_data['current_status'] = 1;
            $update = Booking::where(['id'=>$postData['id']])->update($update_data);

            $unit = PropertiesUnit::find( $booking['unit_id'] );
            $unit->booking_status = 0;
            $unit->save();          
        }
        echo json_encode(array('response'=>$update));
        die;
    }

    //public function editUnit($id){
        // $unit = DB::table('property_units')->where('id', $id)->first();
        // $PropertyManagers = DB::table('users')->where('user_role', self::Property_Manager)->get();
        // $PropertyDescriptionExperts = DB::table('users')->where('user_role', self::Property_Description_Experts)->get();
        // $LegalAdvisors = DB::table('users')->where('user_role', self::Legal_Advisor)->get();
        // $VisitOrganizers = DB::table('users')->where('user_role', self::Visit_Organizer)->get();
        // $amenities = DB::table('amenities')->get();
        // $properties = DB::table('properties')->where('user_id', \Auth::user()->id)->get();
        // $meters = DB::table('meters')->where('unit_id', $id)->get();
        // $propertyVendors = DB::table('property_vendors')->where('property_unit_id', $id)->get();
        
        // $property = DB::table('properties')->where('id', $unit->property_id)->first();
        // $unitPropertyManager = DB::table('users')->where('id', $unit->property_manager_id)->first();
        // $unitPropertyDescriptionExpert = DB::table('users')->where('id', $unit->property_description_experts_id)->first();
        // $unitLegalAdvisor = DB::table('users')->where('id', $unit->property_legal_advisor_id)->first();
        // $unitVisitOrganizer = DB::table('users')->where('id', $unit->property_visit_organizer_id)->first();
        
        // return view('dashboard.editunit')->with([
        //     'unit'=>$unit,
            //'property'=>$property,
            // 'properties'=>$properties,
            // 'PropertyManagers'=> $PropertyManagers, 
            // 'PropertyDescriptionExperts'=> $PropertyDescriptionExperts,
            // 'LegalAdvisors' => $LegalAdvisors,
            // 'VisitOrganizers' => $VisitOrganizers,
            // 'amenities' => $amenities,
            // 'meters' => $meters,
            // 'propertyVendors' => $propertyVendors,
            // 'unitPropertyManager' => $unitPropertyManager,
            // 'unitPropertyDescriptionExpert' => $unitPropertyDescriptionExpert,
            // 'unitLegalAdvisor' => $unitLegalAdvisor,
            // 'unitVisitOrganizer' => $unitVisitOrganizer,
    //     ]);
    // }


    // public function view($id){
    //     $data = Properties::find($id);
    //     if($data){
    //         $images = null;
    //         if($data->images) {
    //             $images = json_decode($data->images, true);
    //         }
    //         return view('viewproperty')->with(['data'=>$data,'images'=> $images]);
    //     } else {
    //         return abort(404);
    //     }       
    // }

    // public function listTenants($id){
    //     $unit = DB::table('property_units')->where('id', $id)->first();
    //     return view('dashboard.listtenants')->with(['unit'=>$unit]);
    // }

    public function managelistUnit(){
        $invitations = DB::table('invitations')
                        ->select(['property_id','property_unit_id'])
                        ->groupBy(['property_id','property_unit_id'])
                        ->where('email', \Auth::user()->email)
                        ->get();
        foreach ($invitations as $key => $value) {
            $propertyIds[] = $value->property_id;
            $propertyUnitIds[] = $value->property_unit_id;
        }
        $assignedUnits = DB::table('properties')
            ->join('property_units', 'properties.id', '=', 'property_units.property_id')
            ->whereIn('property_units.id', $propertyUnitIds)
            ->select('property_units.*','properties.title','property_units.id')
            ->get();
        $createdUnits = DB::table('properties')
            ->join('property_units', 'properties.id', '=', 'property_units.property_id')
            ->where('property_units.created_user_id', \Auth::user()->id)
            ->select('property_units.*','properties.title','property_units.id')
            ->get();
        $properties = DB::table('properties')->whereIn('id', $propertyIds)->get();
        return view('dashboard.manager.listunits')->with(['properties'=>$properties, 'assignedUnits'=>$assignedUnits,'createdUnits'=>$createdUnits]);
    }

    public function listAllContracts(){
        return view('dashboard.listallcontacts');
    }
    // public function listAllTenants(){
    //     return view('dashboard.listalltenants');
    // }

    // List of contracts on single unit view 
    public function listContracts($id){
        //6 = complete
        $oldContract = $documents = [];
        $unit = DB::table('property_units')->where('id', $id)->first();
        $currentContract = Booking::where(['unit_id' => $id,'status' => '6'])->first();
        $oldContracts = Booking::where(['unit_id' => $id,'status' => '9'])->get();
        if($currentContract){
            $documents = Documents::where(['unit_id' =>  $id, 'contract_id' => $currentContract->id ])->get();
        }
        return view('contracts.single-unit-contract-list')->with([
            'unit'=>$unit,
            'currentContract'=>$currentContract,
            'oldContracts'=>$oldContracts,
            'documents'=>$documents,

        ]);
    }

    public function listGuarantors($id){
        $unit = DB::table('property_units')->where('id', $id)->first();
        //$property = DB::table('properties')->where('id', $unit->property_id)->first();
        $invitations = DB::table('invitations')->where([['user_id', \Auth::user()->id],['property_unit_id',$id]])->get(); 
        return view('dashboard.listguarantors')->with(['unit'=>$unit, 'invitations'=>$invitations]); 
    }

    // public function createUnit(Request $request){
    //     $request->validate([
    //         'property_id' => ['required'],
    //         'unit_name' => ['required'],
    //         'rent' => ['required','numeric'],
    //         'deposit' => ['required','numeric'],
    //     ]);
    //     $propertiesUnit = new PropertiesUnit;
    //     $propertiesUnit->property_id = $request->input('property_id');
    //     $propertiesUnit->unit_name = $request->input('unit_name');
    //     $propertiesUnit->rent = $request->input('rent');
    //     $propertiesUnit->deposit = $request->input('deposit');
    //     $propertiesUnit->created_user_id = \Auth::user()->id;
    //     if($request->input('property_manager_id') == ''){
    //         $propertiesUnit->property_manager_id = \Auth::user()->id;
    //     } else {
    //        $propertiesUnit->property_manager_id = $request->input('property_manager_id');
    //     }
    //     if($request->input('property_description_experts_id') == ''){
    //         $propertiesUnit->property_description_experts_id = \Auth::user()->id;
    //     } else {
    //        $propertiesUnit->property_description_experts_id = $request->input('property_description_experts_id');
    //     }
    //     if($request->input('property_legal_advisor_id') == ''){
    //         $propertiesUnit->property_legal_advisor_id = \Auth::user()->id;
    //     } else {
    //        $propertiesUnit->property_legal_advisor_id = $request->input('property_legal_advisor_id');
    //     }
    //     if($request->input('property_visit_organizer_id') == ''){
    //         $propertiesUnit->property_visit_organizer_id = \Auth::user()->id;
    //     } else {
    //         $propertiesUnit->property_visit_organizer_id = $request->input('property_visit_organizer_id');
    //     }
    //     if($request->input('amenities') != ''){
    //         $propertiesUnit->amenities = implode(",",$request->input('amenities'));
    //     }
    //     $propertiesUnit->save();
    //     $this->sendMail([
    //         "Property Manager" => $propertiesUnit->property_manager_id, 
    //         "Property Description Experts" =>$propertiesUnit->property_description_experts_id, 
    //         "Property Legal Advisor" => $propertiesUnit->property_legal_advisor_id,  
    //         "Property Visit Organizer" => $propertiesUnit->property_visit_organizer_id
    //     ]);
    //     return redirect()->back()->with('message', 'Unit Created Successfully!');
    // }

    

    // public function createContract(Request $request){
    //     $request->validate([
    //         'property_id' => ['required'],
    //         'property_unit_id' => ['required'],
    //         'contract_type' => ['required'],
    //         'tenent_id' => ['required'],
    //         'starting_date' => ['required'],
    //         'end_date' => ['required']
    //     ]);
    //     $contract = new Contracts;
    //     $contract->property_id = $request->input('property_id');
    //     $contract->property_unit_id = $request->input('property_unit_id');
    //     $contract->tenent_id = $request->input('tenent_id');
    //     $contract->contract_type = $request->input('contract_type');
    //     $contract->starting_date = $request->input('starting_date');
    //     $contract->end_date = $request->input('end_date');
    //     $contract->save();
    //     return redirect()->back()->with('message', 'Contract Created Successfully!');
    // }


    public function deleteContract($id){
        $contract = new Contracts;
        $contract->find($id)->delete();
        return redirect()->back()->with('message', 'Meter Delete Successfully!');
    }

    // public function updateContract(Request $request){
    //     die('dsad');
    // }

    public function sendMail($ids){
        foreach ($ids as $as => $id) {
            $user = DB::table('users')->where('id', $id)->first();
            $to_name = $user->name." ".$user->last_name;
            $to_email = $user->email;
            $data = array('name'=>$to_name, "email" => $to_email,"as" => $as);
                
            Mail::send('emails.invitation', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                        ->subject('Invitations from Reasy Properties');
                $message->from('malkeetvisionvivante@gmail.com','Reasy Property');
            });
        }
        return true;
    }
    public function dragdrop(Request $request)
    {
            $files = $request->file('file');
            if($request->hasFile('file')){
                $destinationPathBanner = public_path('images/property_banners/');
                $destinationPathPropertImages = public_path('images/property_images/');
                $fileName = str_replace(" ", "_", time()."_".$files->getClientOriginalName()) ;
                if($request->input('image_for') == 'banner'){
                    Image::make($request->file('file'))->fit(260, 225)->save($destinationPathBanner."260X225/".$fileName, 90);
                    Image::make($request->file('file'))->fit(540, 380)->save($destinationPathBanner."540X380/".$fileName, 90);
                } else {
                    Image::make($request->file('file'))->fit(210, 130)->save($destinationPathPropertImages."210X130/".$fileName, 90);
                    Image::make($request->file('file'))->fit(540, 380)->save($destinationPathPropertImages."540X380/".$fileName, 90);
                }
                return response()->json(['status' => 'success', 'target_file' => $fileName]);
            }
    }

    // public function View_Unit(request $request, $id)
    // { 
    //     $unit = DB::table('property_units')->where('id', $id)->first();
    //     $property = DB::table('properties')->where('id', $unit->property_id)->first();
    //     $PropertyManagers = DB::table('users')->where('user_role', self::Property_Manager)->get();
    //     $PropertyDescriptionExperts = DB::table('users')->where('user_role', self::Property_Description_Experts)->get();
    //     $LegalAdvisors = DB::table('users')->where('user_role', self::Legal_Advisor)->get();
    //     $VisitOrganizers = DB::table('users')->where('user_role', self::Visit_Organizer)->get();
    //     $amenities = DB::table('amenities')->get();
        
    //     $unitPropertyManager = DB::table('users')->where('id', $unit->property_manager_id)->first();
    //     $unitPropertyDescriptionExpert = DB::table('users')->where('id', $unit->property_description_experts_id)->first();
    //     $unitLegalAdvisor = DB::table('users')->where('id', $unit->property_legal_advisor_id)->first();
    //     $unitVisitOrganizer = DB::table('users')->where('id', $unit->property_visit_organizer_id)->first();
    //     return view('dashboard.view-unit')->with([
    //         'unit'=>$unit,
    //         'property'=>$property,
    //         'PropertyManagers'=> $PropertyManagers, 
    //         'PropertyDescriptionExperts'=> $PropertyDescriptionExperts,
    //         'LegalAdvisors' => $LegalAdvisors,
    //         'VisitOrganizers' => $VisitOrganizers,
    //         'amenities' => $amenities,
    //         'unitPropertyManager' => $unitPropertyManager,
    //         'unitPropertyDescriptionExpert' => $unitPropertyDescriptionExpert,
    //         'unitLegalAdvisor' => $unitLegalAdvisor,
    //         'unitVisitOrganizer' => $unitVisitOrganizer,
    //     ]);
    // }
}