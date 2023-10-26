<?php

namespace App\Http\Controllers\Resource;

use App\User;
use App\Ticket;
use App\TicketsFeedback;
use App\UserRequests;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Exception;
use Storage;
use Setting;
use App\UserAccountDetails;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class UserResource extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('demo', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at' , 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
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
            'email' => 'required|unique:users,email|email|max:255',
            'mobile' => 'digits_between:6,13',
            'picture' => 'mimes:jpeg,jpg,bmp,png|max:5242880',
            'password' => 'required|min:6|confirmed',
        ]);

        try{

            $user = $request->all();

            $user['payment_mode'] = 'CASH';
            $user['password'] = bcrypt($request->password);
            if($request->hasFile('picture')) {
                $user['picture'] = $request->picture->store('user/profile');
            }

            $user = User::create($user);

            return redirect()->route('admin.user.index')->with('flash_success','Rider Details Saved Successfully');

        } 

        catch (Exception $e) {
            return back()->with('flash_error', 'Rider Not Found');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return view('admin.users.user-details', compact('user'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);
            // echo "<pre>"; print_r($user->picture); die();
            return view('admin.users.edit',compact('user'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'mobile' => 'digits_between:6,13',
            'picture' => 'mimes:jpeg,jpg,bmp,png|max:5242880',
        ]);

        try {

            $user = User::findOrFail($id);

            if($request->hasFile('picture')) {
                Storage::delete($user->picture);
                $user->picture = $request->picture->store('user/profile');
            }

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->mobile = $request->mobile;
            $user->save();

            return redirect()->route('admin.user.index')->with('flash_success', 'Rider Updated Successfully');    
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Rider Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            User::find($id)->delete();
            return back()->with('flash_success', 'Rider deleted successfully');
        } 
        catch (Exception $e) {
            return back()->with('flash_error', 'Rider Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function request($id){

        try{

            $requests = UserRequests::where('user_requests.user_id',$id)
                    ->RequestHistory()
                    ->get();

            return view('admin.request.index', compact('requests'));
        }

        catch (Exception $e) {
             return back()->with('flash_error','Something Went Wrong!');
        }

    }



    public function approve($id)
    {
        try {
            $User = User::findOrFail($id);
            if($User->status) {
                $User->update(['status' => 'approved']);
                return back()->with('flash_success', "Rider Approved");
            } 
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', "Something went wrong! Please try again later.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $provider
     * @return \Illuminate\Http\Response
     */
    public function disapprove($id)
    {
        User::where('id',$id)->update(['status' => 'banned']);
        return back()->with('flash_success', "Rider Disapproved");
    }

    
    public function accountDetails(Request $request)
    {
       /* $postData = Input::all();
        $accountDB = UserAccountDetails::where(['user_id' => $postData->user_id])->first();*/

        if($request->isMethod('POST'))
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
                    'user_id'       => $postData['user_id'],
                    'bank_account'  => $postData['account'],
                    'bank_name'     => $postData['bank_name'],
                    'branch_code'   => $postData['branch_code'],
                    'branch_name'   => $postData['branch_name'],
                    'ifsc_code'     => $postData['ifsc_code'],
                );
                if (isset($postData['user_id']) && !empty($postData['user_id'])) {
                    $where = array('user_id' => $postData['user_id']);
                    $accounts = UserAccountDetails::updateOrCreate( $where,$account);
                    return back()->with('flash_success', 'Account Updated !');
                }
            }
        }
    }

    public function userAccount($id)
    {
        $userAccount = UserAccountDetails::where(['user_id' => $id])->first();
        // echo $id."<br><pre>"; print_r($userAccount); die();
        
        return view('admin/users/user_account_edit', compact('userAccount', 'id'));
    }
    public function user_tickets(Request $request, $id)
    {
         $tickets = Ticket::where('role','user')->where('issue_raised_by',$id)->orderBy('created_at' , 'desc')->get();
        return view('admin.tickets.index', compact('tickets'));
    }


    public function userTicketList(Request $request, $id)
    {
        $tickets = Ticket::where('issue_raised_by',$id)->orderBy('created_at' , 'desc')->get();
        $user = User::where('id', $id)->first();
        return view('admin.users.user_ticket_list', compact('tickets', 'user'));
    }


    public function userTicket($id)
    {
        $messages = TicketsFeedback::where('ticket_id' , $id)->get();
        $ticket = Ticket::where('id',$id)->first();
        $user = User::where('id', $ticket['issue_raised_by'])->first();
        return view('admin.users.user_view_ticket', compact('ticket','messages','user'));

    }
    

}
