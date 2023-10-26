<?php

namespace App\Http\Controllers\Resource;

use App\Ticket;
use App\User;
use App\TicketsFeedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use Exception;
use Auth;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class TicketResource extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tickets = Ticket::orderBy('created_at' , 'desc')->get();
        return view('admin.tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $ticket)
    {
        $authID = Auth::id();
        $role = "Admin";
        $postData = $request->all();

        $rules = array(
                'reply' => 'required',
            );
            $message = array(
                'reply' => 'Reply cannot be Blank',
            );

            $validator = Validator::make($postData, $rules);
        
        try{
            if (!empty($postData['reply']) && trim($postData['reply']) != '') {
                $reply_data = array(
                    'ticket_id' => $ticket,
                    'role' => $role,
                    'sender' => $authID,
                    'reply' => $postData['reply'],
                );
                $reply = TicketsFeedback::create($reply_data);
                return back()->with('flash_success', "Reply Sent");
            }
            else{
                return back()->with('flash_error', "Reply not Sent");
            }
        }
        catch (Exception $e) {
            return back()->with('flash_error', 'Error Sending Reply');
        }
    } 


    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $ticket_id)
    {
        $messages = TicketsFeedback::where('ticket_id' , $ticket_id)->get();
        $ticket = Ticket::findOrFail($ticket_id);
        $user = User::where('id', $ticket['issue_raised_by'])->first();
        return view('admin.tickets.view_ticket', compact('ticket','messages', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        // echo "<br><pre>"; print_r($ticket); /**/ /*print_r($request);*/ die('qwerty');
        // TicketsFeedback::where('id',$id)->update(['reply' => $request->reply]);
        // return back()->with('flash_success', "Reply Sent");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }


    public function approve($id)
    {
        try {
            $ticket = Ticket::findOrFail($id);
            if($ticket->status) {
                $ticket->update(['status' => 'open']);
                return back()->with('flash_success', "Ticket Opened");
            } 
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', "Something went wrong! Please try again later.");
        }
    }

    public function disapprove($id)
    {
        Ticket::where('id',$id)->update(['status' => 'close']);
        return back()->with('flash_success', "Ticket Closed");
    }

}
