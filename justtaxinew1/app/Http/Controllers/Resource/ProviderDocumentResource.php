<?php

namespace App\Http\Controllers\Resource;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SendPushNotification;
use Illuminate\Support\Facades\Input;

use DB;
use Exception;
use Setting;

use App\Ticket;
use App\TicketsFeedback;
use App\Provider;
use App\ServiceType;
use App\ProviderService;
use App\AreaService;
use App\ProviderDocument;
use App\ProviderVehicleDocument;
use App\Helpers\Helper;

use App\User;
use App\Document;
use App\Fleet;
use App\Admin;
use App\UserPayment;
use App\UserRequests;
use App\UserRequestRating;
use App\UserRequestPayment;
use App\CustomPush;


class ProviderDocumentResource extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $provider)
    {
        try 
        {
            $DriverDocuments = Document::driver()->get();

            $tickets = Ticket::where('role','provider')->where('issue_raised_by',$provider)->orderBy('created_at' , 'desc')->get();
            $Provider = Provider::findOrFail($provider);
            // pr($Provider->active_documents());
            // die('amit');
            $ProviderService = ProviderService::where('provider_id',$provider)->with('service_type')->get();
            $ServiceTypes = ServiceType::all();
            $added_services = ProviderService::where('provider_id',$provider)->pluck('service_type_id')->toArray();
            return view('admin.providers.document.index', compact('Provider', 'ServiceTypes','ProviderService','tickets','DriverDocuments'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.index');
        }
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
    public function store(Request $request, $provider)
    {
        $postData = $request->all();
        // echo $provider;
        // Helper::pr($postData);
        // die('aaaa');
        $this->validate($request, [
                'service_type' => 'required|exists:service_types,id',
                'service_number' => 'required|unique:provider_services,service_number,'.$postData['service_id'],
                'chassis_number' => 'required|unique:provider_services,chassis_number,'.$postData['service_id'],
                'service_model' => 'required',
            ]);
        

        try {
            
            $ProviderService = ProviderService::where('provider_id', $provider)->where('id', $postData['service_id'])->firstOrFail();
            $ProviderService->update([
                    'service_type_id' => $request->service_type,
                    'status' => 'offline',
                    'service_number' => $request->service_number,
                    'chassis_number' => $request->chassis_number,
                    'service_model' => $request->service_model,
                ]);

            // Sending push to the provider
            (new SendPushNotification)->DocumentsVerfied($provider);

        } catch (ModelNotFoundException $e) {
            ProviderService::create([
                    'provider_id' => $provider,
                    'service_type_id' => $request->service_type,
                    'status' => 'offline',
                    'service_number' => $request->service_number,
                    'chassis_number' => $request->chassis_number,
                    'service_model' => $request->service_model,
                ]);
            return redirect()->route('admin.provider.document.index', $provider)->with('flash_success', 'Vehicle added successfully!');
        }

        return redirect()->route('admin.provider.document.index', $provider)->with('flash_success', 'Vehicle updated successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($provider, $id)
    {
        try {
            $Document = ProviderDocument::where('provider_id', $provider)
                ->findOrFail($id);
            return view('admin.providers.document.edit', compact('Document'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $provider, $id)
    {
        try {
            $Document = ProviderDocument::where('provider_id', $provider)->findOrFail($id);
            if(isset($_GET['status']) && !empty($_GET['status']) && $_GET['status'] == 'active')
            {
                $Document->update(['status' => 'ACTIVE']);
                return redirect()
                    ->route('admin.provider.document.index', $provider)
                    ->with('flash_success', 'Provider document has been approved.');
            }
            elseif(isset($_GET['status']) && !empty($_GET['status']) && $_GET['status'] == 'reject')
            {
                $Document->update(['status' => 'REJECT']);
                return redirect()
                    ->route('admin.provider.document.index', $provider)
                    ->with('flash_success', 'Provider document has been rejected.');
            }

        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('admin.provider.document.index', $provider)
                ->with('flash_error', 'Provider not found!');
        }
    }

    public function vehicle_document_update(Request $request, $provider,$vehicle, $document, $status)
    {
        // echo $provider."-".$vehicle."-".$document."-".$status;
        try {
            $Document = ProviderVehicleDocument::where('provider_id', $provider)
                        ->where('vehicle_id', $vehicle)
                        ->where('document_id', $document)
                        ->firstOrFail();

            $Document->update(['status' => $status]);

            $this->update_vehicle_status($vehicle);

            return redirect()
                ->route('admin.provider.document.index', $provider)
                ->with('flash_success', 'Provider Vehicle document Status has been updated.');
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('admin.provider.document.index', $provider)
                ->with('flash_error', 'Provider Vehicle document not found!');
        }
    }

    public function update_vehicle_status($vehicle_id)
    {
        $count_VehicleDocuments = Document::vehicle()->count();
        $active_document = ProviderVehicleDocument::where('vehicle_id', $vehicle_id)->where('status', 'ACTIVE')->count();
        $ProviderService = ProviderService::findOrFail($vehicle_id);
        if($count_VehicleDocuments == $active_document)
        {
            $ProviderService->active_status = 1;
        }
        elseif($count_VehicleDocuments != $active_document)
        {
            $ProviderService->active_status = 0;
        }
        $ProviderService->save();
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($provider, $document)
    {
            // echo "ProviderID = ".$provider; echo "<br>ID = ".$document; 
        try {
            $Document = ProviderDocument::where('provider_id', $provider)
                ->where('id', $document)
                ->firstOrFail();
            $Document->delete();
            return redirect()
                ->route('admin.provider.document.index', $provider)
                ->with('flash_success', 'Provider document has been deleted');
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('admin.provider.document.index', $provider)
                ->with('flash_error', 'Provider not found!');
        }
    }  

    /**
     * Delete the service type of the provider.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function service_destroy(Request $request, $provider, $id)
    {
        try {

            $ProviderService = ProviderService::where('provider_id', $provider)->findOrFail($id);
            $ProviderService->delete();

            return redirect()
                ->route('admin.provider.document.index', $provider)
                ->with('flash_success', 'Vehicle has been deleted.');
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('admin.provider.document.index', $provider)
                ->with('flash_error', 'Vehicle not found!');
        }
    }

    public function vehicle_prime_status(Request $request)
    {
        $postData = Input::all();
        $affected = DB::table('provider_services')->update(array('prime' => 0));
        ProviderService::where('id' , $postData['id'])->update(['prime' => $postData['prime']]);
        return Response()->json(array(
                        'success' => true,
                        'flash_success' => 'Vehicle is prime now!'
                    )); // 400 being the HTTP code for an invalid request.
    }
}
