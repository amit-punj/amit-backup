<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use Calendar;
use App\EventModel;
// use MaddHatter\LaravelFullcalendar\Event;
use App\Event;
use App\appointments;
use App\UsersAvailability;
use Illuminate\Support\Str;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\User;
use Illuminate\Support\Facades\Input;
 
class EventController extends Controller {
    const Property_Manager = 3;
    const Property_Description_Experts = 4;
    const Legal_Advisor = 5;
    const Visit_Organizer = 6;
    const Tenant = 1;
    const Property_Owner = 2;
    public function index() {
        $events = $data = [];
        if(\Auth::user()->user_role == self::Visit_Organizer){
           $data = appointments::where('vo_id',Auth::user()->id)->where('appointment_status', 1)->get();
        }
        if(\Auth::user()->user_role == self::Property_Description_Experts){
           $data = appointments::where('pde_id',Auth::user()->id)->where('appointment_status', 1)->get();
        }
        $UsersAvailability = UsersAvailability::where('user_id',Auth::user()->id)->first();
        if($data->count()) {
            $color = '#349a6e;';
            foreach ($data as $key => $value) {
                if(Auth::user()->user_role == self::Property_Description_Experts) {
                    if(strtolower($value->appointment_type) == 'entry'){
                       $color = '#349a6e;';
                    }
                    if(strtolower($value->appointment_type) == 'exit'){
                       $color = '#82a21c;';
                    }
                }
                $events[] = Calendar::event(
                    $value->title,
                    true,
                    new \DateTime($value->time),
                    new \DateTime($value->time),
                    null,
                    [
                        'color' => $color,
                        'url' => 'visit-details/'.$value->id,
                    ]
                );
            }
        }
        if($UsersAvailability){
            $arr = explode(",", $UsersAvailability->selecteddates);
            if(count($arr) > 0){
                foreach ($arr as $key => $value) {
                $events[] = Calendar::event(
                        'Holiday',
                        true,
                        new \DateTime($value),
                        new \DateTime($value),
                        null,
                        [
                            'color' => '#f6e588',
                        ]
                    );
                }
            }
        }
        $calendar = \Calendar::addEvents($events)
                    ->setCallbacks([ 
                    'dayRender' => 'function(date, cell) {
                        var today = $.fullCalendar.moment();
                        if (date.get("date") == today.get("date") && date.get("month") == today.get("month")) {
                            cell.css("background", "#1a73e8");
                        }
                       
                    }'
                ]);
        return view('events.index', compact('calendar','data'));
    }
 
    public function create(Request $request){
        $usersAvailability =  UsersAvailability::where('user_id',Auth::user()->id )->first();
        if($request->isMethod('post')) {
            if($usersAvailability){
                $data = $usersAvailability;
            } else {
                $data = new UsersAvailability;
            }
            $data->user_id = Auth::user()->id;
            $data->start_time = $request->start_time;
            $data->end_time = $request->end_time;
            if(isset($request->days)){
                $data->days = implode(",", $request->days);
            } else {
                // $data->days = null;
            }
            $data->selecteddates = $request->selecteddates;
            $data->save();
            toastr()->success('Availability Updated Successfully!');
            return redirect()->back();
        }
        return view('events.add-availability')->with([ 'usersAvailability' => $usersAvailability ]);
    }
 
    public function view($id)
    {
 
    }
}
 
        