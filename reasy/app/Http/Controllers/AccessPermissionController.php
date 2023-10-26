<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;
use App\User;
use App\Vendors;
use App\AccessPermission;
Use Helper;
use Illuminate\Support\Facades\DB;
class AccessPermissionController extends Controller
{ 
    const Tenant = 1;
    const Property_Manager = 3;
    const Property_Description_Experts = 4;
    const Legal_Advisor = 5;
    const Visit_Organizer = 6;
    public function __construct() {
        $this->middleware('auth');
    }

    //access permissio view
    public function accessPermission(){
        $propertManagerPermissions = AccessPermission::where([
            [ 'po_id', \Auth::user()->id ],
            [ 'user_role', self::Property_Manager ]
        ])->first();
        $propertDescriptionExpertsPermissions = AccessPermission::where([
            [ 'po_id', \Auth::user()->id ],
            [ 'user_role', self::Property_Description_Experts ]
        ])->first();
        $propertLegalAdvisorPermissions = AccessPermission::where([
            [ 'po_id', \Auth::user()->id ],
            [ 'user_role', self::Legal_Advisor ]
        ])->first();
        return view('accessPermission.access-permissions')->with([
            'pmp' => $propertManagerPermissions,
            'pdep' => $propertDescriptionExpertsPermissions,
            'lap' => $propertLegalAdvisorPermissions
        ]);
    }

    public function saveAccessPermission(Request $request){
        $this->validate($request, [
            'user_role' => 'required',
            'unit_permission' => 'required',
            'contract_permission' => 'required',
            'meter_permission' => 'required',
            'reading_permission' => ['required'],
            'booking_permission' => ['required'],
            'transaction_permission' => ['required'],
            'documents_permission' => ['required'],
            'tickets_permission' => ['required'],
            'legal_permission' => ['required'],
        ]);
        $accessPermission = AccessPermission::where([
            [ 'po_id', \Auth::user()->id ],
            [ 'user_role', $request->input('user_role') ]
        ])->first();
        if($accessPermission){
            $accessPermissions = AccessPermission::find($accessPermission->id);
        } else {
            $accessPermissions = new AccessPermission;
        }
        $accessPermissions->po_id =  \Auth::user()->id;
        $accessPermissions->user_role = $request->input('user_role');
        $accessPermissions->unit_permission = $request->input('unit_permission');
        $accessPermissions->contract_permission = $request->input('contract_permission');
        $accessPermissions->meter_permission = $request->input('meter_permission');
        $accessPermissions->reading_permission = $request->input('reading_permission');
        $accessPermissions->booking_permission = $request->input('booking_permission');
        $accessPermissions->transactio_permission = $request->input('transaction_permission');
        $accessPermissions->documents_permission = $request->input('documents_permission');
        $accessPermissions->tickets_permission = $request->input('tickets_permission');
        $accessPermissions->legal_permission = $request->input('legal_permission');
        $accessPermissions->save();
        toastr()->success('Permissions Save Successfully!');
        return redirect()->back();
    }
}
