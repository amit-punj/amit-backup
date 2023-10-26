<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Properties;
use App\Book_appointment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
Use Helper;
use Validator;
Use Carbon\Carbon;
use App\PropertiesUnit;
use App\Booking;
use App\Tickets;
use App\LegalActions;
use App\MeterReadings;
use App\UnitsRent;

class LegalActionController extends Controller
{
	const Tenant = 1;
	const Property_Owner = 2;
	const Property_Manager = 3;
	const Visit_Organizer = 6;
    const Property_Description_Experts = 4;
    const Leagla_Adviser = 5;

    protected $url;
    public function __construct(UrlGenerator $url){
        $this->middleware('auth');
        $this->url = $url;
    }

    //Leagla Action list page PO-PM 
    public function legalAction(){
        $unitIds = [];
        if(\Auth::user()->user_role == self::Property_Owner){
            $units = DB::table('property_units')
                ->join('unit_booking', 'property_units.id', '=', 'unit_booking.unit_id')
                ->where('property_units.user_id', \Auth::user()->id)
                //->where('unit_booking.status', ">=","6")
                ->select('property_units.*','unit_booking.*','property_units.id' , 'unit_booking.id as unit_contract_id')
                ->get();
            $legalActions = LegalActions::where('po_id', \Auth::user()->id )->orderBy('id','DESC')->paginate(5);
            return view('legalaction.list-legal-action')->with([
                'units' => $units,
                'legalActions' => $legalActions,
            ]);
        }

        if(\Auth::user()->user_role == self::Property_Manager){
            $units = DB::table('property_units')
                ->join('unit_booking', 'property_units.id', '=', 'unit_booking.unit_id')
                ->where('property_units.property_manager_id', \Auth::user()->id)
                //->where('unit_booking.status', ">=","6")
                ->select('property_units.*','unit_booking.*','property_units.id' , 'unit_booking.id as unit_contract_id')
                ->get();
            if($units){
                foreach ($units as $key => $unit) {
                    $unitIds[] = $unit->id;
                }
            }
            $legalActions = LegalActions::whereIn('unit_id', $unitIds )->orderBy('id','DESC')->paginate(5);
            return view('legalaction.list-legal-action')->with([
                'units' => $units,
                'legalActions' => $legalActions,
            ]);
        }

        if(\Auth::user()->user_role == self::Leagla_Adviser){
            $units = DB::table('property_units')
                ->join('unit_booking', 'property_units.id', '=', 'unit_booking.unit_id')
                ->where('property_units.user_id', \Auth::user()->id)
                //->where('unit_booking.status', ">=","6")
                ->select('property_units.*','unit_booking.*','property_units.id' , 'unit_booking.id as unit_contract_id')
                ->get();

            $legalActions = LegalActions::where('legal_advisor_id', \Auth::user()->id )->orderBy('id','DESC')->paginate(5);
            return view('legalaction.list-legal-action')->with([
                //'units' => $units,
                'legalActions' => $legalActions,
            ]);
        }
    }

    //Single View Page
    public function legalActionView($id){
         $legalAction = LegalActions::find($id);
         return view('legalaction.legal-action-details')->with([
                'legalAction' => $legalAction,
            ]);
    }


    //create Legal Action
    public function createLegalAction(Request $request){
        $request->validate([
            'related_to' => ['required'],
            'unit_id' => ['required','numeric'],
            'po_id' => ['required','numeric'],
            'contract_id' => ['required','numeric'],
            'tenant_id' => ['required','numeric'],
            'legal_advisor_id' => ['required','numeric'],
            'comment' => ['required']
        ]);
        $legalActions = new LegalActions;
        $legalActions->po_id = $request->po_id;
        $legalActions->related_to = $request->related_to;
        $legalActions->unit_id = $request->unit_id;
        $legalActions->tenant_id = $request->tenant_id;
        $legalActions->legal_advisor_id = $request->legal_advisor_id;
        $legalActions->contract_id = $request->contract_id;
        $legalActions->due_amount = $request->due_amount;
        $legalActions->comment = $request->comment;
        $legalActions->status = 'pending';
        $legalActions->create_time = Carbon::now();
        $legalActions->save();

        $legal = User::find($request->legal_advisor_id);
        $legalAvdiserName      = $legal->name." ".$legal->last_name;
        $legalAvdiserEmail     = $legal->email;

        $propertyOwner = User::find($request->po_id);
        $propertyOwnerName      = $propertyOwner->name." ".$propertyOwner->last_name;
        $propertyOwnerEmail     = $propertyOwner->email;

        $tenant = User::find($request->tenant_id);
        $tenantName      = $tenant->name." ".$tenant->last_name;

        $unit = PropertiesUnit::find($request->unit_id);
        $propertyManager = User::find($unit->property_manager_id);
        $propertyManager     = $propertyManager->email;
        
        $pm_data = array(
                'po_name'      => $propertyOwnerName,
                'lad_name'      => $legalAvdiserName,
                "email"     => $propertyOwnerEmail,
                "unit_name"     => $unit->unit_name,
                "comment"   => $request->comment,
                "tenant_name"   => $tenantName,
            );      
        Mail::send('emails.legal_action_email_to_lad', $pm_data, function($message) use ($propertyManager, $legalAvdiserEmail) {
            $message->to($legalAvdiserEmail, $propertyManager)
                    ->subject('Legal Action Email');
            $message->from('amitpunjvision@gmail.com','Reasy Property');
        });

        toastr()->success('Legal Action Created Successfully!');
        return redirect()->back();
    }

    //Report submit by legel adviser
    public function submitLegalAactionReport(Request $request){
        $request->validate([
            'action_comment' => ['required'],
            'legal_action_id' => ['required','numeric'],
        ]);
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $file = $request->file('document');      
            $file_name = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/legal_document'), $file_name);
        }
        $legalActions = LegalActions::find($request->legal_action_id);
        $legalActions->action_comment = $request->action_comment;
        $legalActions->document = $file_name;
        $legalActions->status = 'complete';
        $legalActions->save();

        $legal = User::find($legalActions->legal_advisor_id);
        $legalAvdiserName      = $legal->name." ".$legal->last_name;
        $legalAvdiserEmail     = $legal->email;

        $propertyOwner = User::find($legalActions->po_id);
        $propertyOwnerName      = $propertyOwner->name." ".$propertyOwner->last_name;
        $propertyOwnerEmail     = $propertyOwner->email;

        $tenant = User::find($legalActions->tenant_id);
        $tenantName      = $tenant->name." ".$tenant->last_name;

        $unit = PropertiesUnit::find($legalActions->unit_id);
        $propertyManager = User::find($unit->property_manager_id);
        $propertyManager     = $propertyManager->email;
        
        $pm_data = array(
                'po_name'      => $propertyOwnerName,
                'lad_name'      => $legalAvdiserName,
                "email"     => $propertyOwnerEmail,
                "unit_name"     => $unit->unit_name,
                "comment"   => $request->action_comment,
                "tenant_name"   => $tenantName,
            );      
        Mail::send('emails.legal_action_report_to_po', $pm_data, function($message) use ($propertyOwnerEmail, $legalAvdiserEmail) {
            $message->to($legalAvdiserEmail, $propertyOwnerEmail)
                    ->subject('Legal Action Email');
            $message->from('amitpunjvision@gmail.com','Reasy Property');
        });



        toastr()->success('Report Submit Successfully!');
        return redirect()->back();
    }

    //Create legal action popup AjAX
    public function unitTenantLegalAdvisor(Request $request){
        $postData = Input::all();
        $tenant = User::find($request->tenant_id);
        $legal = User::find($request->legal_id);

        $tenantData = "<option value='".$request->tenant_id."' selected>".$tenant->name." ".$tenant->last_name."</option>";
        $legalData = "<option value='".$request->legal_id."' selected>".$legal->name." ".$legal->last_name."</option>";
        return response()->json(['tenant' => $tenantData, 'legal' => $legalData]);
    }


    //List of tasks For PO
    public function listOfTasks(){
        $unitIds = [];
        $units = DB::table('property_units')
                    ->select('id')
                    ->where('property_manager_id', \Auth::user()->id)
                    ->get();
        if($units){
            foreach ($units as $key => $value) {
                $unitIds[] = $value->id;
            }
        }
        $holdReadings = MeterReadings::whereIn('unit_id',$unitIds)->where('status','hold')->paginate(5);
        $holdRents = UnitsRent::whereIn('unit_id',$unitIds)->where('rent_status','hold')->paginate(5);
        return view('tasks.list-of-tasks')->with([
                'holdReadings' => $holdReadings,
                'holdRents' => $holdRents
        ]);
    }
}
