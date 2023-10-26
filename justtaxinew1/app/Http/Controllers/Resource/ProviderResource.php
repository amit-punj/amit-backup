<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use DB;
use Exception;
use Setting;
use Storage;

use App\Provider;
use App\UserRequestPayment;
use App\UserRequests;
use App\Helpers\Helper;

use App\Ticket;
use App\TicketsFeedback;
use App\Document;
use App\ProviderDocs;
use App\ProviderAccountDetails;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ProviderResource extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('demo', ['only' => [ 'store', 'update', 'destroy', 'disapprove']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $VehicleDocuments = Document::vehicle()->get();
        $DriverDocuments = Document::driver()->get();

        $count_VehicleDocuments = Document::vehicle()->count();
        $count_DriverDocuments = Document::driver()->count();
        
        $providers = Provider::with('service','accepted','cancelled')
                    ->orderBy('id', 'DESC')->get();   

        return view('admin.providers.index', compact('providers','DriverDocuments','VehicleDocuments','count_DriverDocuments','count_VehicleDocuments'));
        
        /*$AllProviders = Provider::with('service','accepted','cancelled')
                    ->orderBy('id', 'DESC');
        if(request()->has('fleet')){
            $providers = $AllProviders->where('fleet',$request->fleet)->get();
        }else{
            $providers = $AllProviders->get();
        }
        return view('admin.providers.index', compact('providers'));*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.providers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|unique:providers,email|email|max:255',
            'mobile' => 'digits_between:6,13',
            'avatar' => 'mimes:jpeg,jpg,bmp,png|max:5242880',
            'password' => 'required|min:6|confirmed',
        ]);

        try{

            $provider = $request->all();

            $provider['password'] = bcrypt($request->password);
            // Helper::pr($provider,1);
            if($request->hasFile('avatar')) {
                $provider['avatar'] = $request->avatar->store('provider/profile');
            }

            $provider = Provider::create($provider);

            return redirect()->route('admin.provider.index')->with('flash_success','Driver Details Saved Successfully');

        } 

        catch (Exception $e) {
            return back()->with('flash_error', 'Driver Not Found');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $provider = Provider::findOrFail($id);
            return view('admin.providers.provider-details', compact('provider'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $provider = Provider::findOrFail($id);
            return view('admin.providers.edit',compact('provider'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'mobile' => 'digits_between:6,13',
            'avatar' => 'mimes:jpeg,jpg,bmp,png|max:5242880',
        ]);

        try {

            $provider = Provider::findOrFail($id);

            if($request->hasFile('avatar')) {
                if($provider->avatar) {
                    Storage::delete($provider->avatar);
                }
                $provider->avatar = $request->avatar->store('provider/profile');                    
            }

            $provider->first_name = $request->first_name;
            $provider->last_name = $request->last_name;
            $provider->mobile = $request->mobile;
            $provider->save();

            return redirect()->route('admin.provider.index')->with('flash_success', 'Driver Updated Successfully');    
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Driver Not Found');
        }
    }


    public function account(Request $request)
    {
        /*$postData = Input::all();
        $accountDB = ProviderAccountDetails::where(['provider_id' => $postData->provider_id])->first();
        // echo "<pre>"; print_r($accountDB); die();*/
        
        if($request->isMethod('post'))
        {
            $postData = Input::all();
            // echo "<pre>"; print_r($postData); die();
            $rules = array(
                'account'       => 'required',
                'bank_name'     => 'required',
                'branch_name'   => 'required',
                'branch_code'   => 'required',
                'ifsc_code'     => 'required',
            );
            $message = array(
                'account'        => 'Please enter bank account number',
                'bank_name'      => 'Please enter bank name',
                'branch_name'    => 'Please enter branch name',
                'branch_code'    => 'Please select branch code',
                'ifsc_code'      => 'Please enter IFSC Code',
            );
            
            $validator = Validator::make($postData, $rules);
            if ($validator->fails())
            {
               return back()->withErrors($validator);
            }
            else
            {
                $account = array(
                    'provider_id'   => $postData['provider_id'],
                    'bank_account'  => $postData['account'],
                    'bank_name'     => $postData['bank_name'],
                    'branch_code'   => $postData['branch_code'],
                    'branch_name'   => $postData['branch_name'],
                    'ifsc_code'     => $postData['ifsc_code'],
                );
                if (isset($postData['provider_id']) && !empty($postData['provider_id'])) {
                    $where = array('provider_id' => $postData['provider_id']);
                    $accounts = ProviderAccountDetails::updateOrCreate( $where,$account);
                    return back()->with('flash_success', 'Account Updated !');
                }
            }
        }
    }


    public function providerAccount($id)
    {
        $providerAccount = ProviderAccountDetails::where(['provider_id' => $id])->first();
        // echo $id."<br><pre>"; print_r($providerAccount); die();

        return view('admin/providers/provider_account_edit', compact('providerAccount', 'id'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            Provider::find($id)->delete();
            return back()->with('flash_success', 'Driver deleted successfully');
        } 
        catch (Exception $e) {
            return back()->with('flash_error', 'Driver Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
        try {
            $Provider = Provider::findOrFail($id);
            if($Provider->service) {
                $Provider->update(['status' => 'approved']);
                return back()->with('flash_success', "Driver Approved");
            } else {
                return redirect()->route('admin.provider.document.index', $id)->with('flash_error', "Driver has not been assigned a service type!");
            }
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', "Something went wrong! Please try again later.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function disapprove($id)
    {
        
        Provider::where('id',$id)->update(['status' => 'banned']);
        return back()->with('flash_success', "Driver Disapproved");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function request($id){

        try{

            $requests = UserRequests::where('user_requests.provider_id',$id)
                    ->RequestHistory()
                    ->get();

            return view('admin.request.index', compact('requests'));
        } catch (Exception $e) {
            return back()->with('flash_error','Something Went Wrong!');
        }
    }

    /**
     * account statements.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function statement($id){

        try{

            $requests = UserRequests::where('provider_id',$id)
                        ->where('status','COMPLETED')
                        ->with('payment')
                        ->get();
            $rides = UserRequests::where('provider_id',$id)->with('payment')->orderBy('id','desc')->paginate(10);
            $cancel_rides = UserRequests::where('status','CANCELLED')->where('provider_id',$id)->count();
            $Provider = Provider::find($id);
            $revenue = UserRequestPayment::whereHas('request', function($query) use($id) {
                                    $query->where('provider_id', $id );
                                })->select(\DB::raw(
                                   'SUM(ROUND(provider_pay)) as overall, SUM(ROUND(provider_commission)) as commission' 
                               ))->get();

            $Joined = $Provider->created_at ? '- Joined '.$Provider->created_at->diffForHumans() : '';

            return view('admin.providers.statement', compact('rides','cancel_rides','revenue'))
                        ->with('page',$Provider->first_name."'s Overall Statement ". $Joined);

        } catch (Exception $e) {
            return back()->with('flash_error','Something Went Wrong!');
        }
    }

    public function Accountstatement($id){

        try{

            $requests = UserRequests::where('provider_id',$id)
                        ->where('status','COMPLETED')
                        ->with('payment')
                        ->get();

            $rides = UserRequests::where('provider_id',$id)->with('payment')->orderBy('id','desc')->paginate(10);
            $cancel_rides = UserRequests::where('status','CANCELLED')->where('provider_id',$id)->count();
            $Provider = Provider::find($id);
            $revenue = UserRequestPayment::whereHas('request', function($query) use($id) {
                                    $query->where('provider_id', $id );
                                })->select(\DB::raw(
                                   'SUM(ROUND(fixed) + ROUND(distance)) as overall, SUM(ROUND(commision)) as commission' 
                               ))->get();


            $Joined = $Provider->created_at ? '- Joined '.$Provider->created_at->diffForHumans() : '';

            return view('account.providers.statement', compact('rides','cancel_rides','revenue'))
                        ->with('page',$Provider->first_name."'s Overall Statement ". $Joined);

        } catch (Exception $e) {
            return back()->with('flash_error','Something Went Wrong!');
        }
    }


    public function providerTicketList(Request $request, $id)
    {
        $tickets = Ticket::where('issue_raised_by',$id)->orderBy('created_at' , 'desc')->get();
        $user = Provider::where('id', $id)->first();
        return view('admin.providers.provider_ticket_list', compact('tickets', 'user'));
    }


    public function providerTicket($id)
    {
        $messages = TicketsFeedback::where('ticket_id' , $id)->get();
        $ticket = Ticket::where('id',$id)->first();
        $user = Provider::where('id', $ticket['issue_raised_by'])->first();
        return view('admin.providers.provider_view_ticket', compact('ticket','messages','user'));

    }


}
