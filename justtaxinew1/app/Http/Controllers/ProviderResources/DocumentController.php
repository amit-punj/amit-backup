<?php

namespace App\Http\Controllers\ProviderResources;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Document;
use App\ProviderDocument;
use App\ProviderVehicleDocument;
use Illuminate\Support\Facades\Input;
use App\Helpers\Helper;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $VehicleDocuments = Document::vehicle()->get();
        $DriverDocuments = Document::driver()->get();
        
        $Provider = \Auth::guard('provider')->user();

        return view('provider.document.index', compact('DriverDocuments', 'VehicleDocuments', 'Provider'));
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
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }
    public function user_doc_edit($id)
    {
        $VehicleDocuments = Document::vehicle()->get();
        $DriverDocuments = Document::driver()->get();

        $getDocs = ProviderDocument::where(['provider_id' => $id])->get();
        
        return view('admin/providers/user_doc_edit', compact('VehicleDocuments', 'DriverDocuments', 'id', 'getDocs'));
    }

    public function vehicle_document_update($provider_id, $id)
    {
        $VehicleDocuments = Document::vehicle()->get();
        $DriverDocuments = Document::driver()->get();

        $getDocs = ProviderVehicleDocument::where(['provider_id' => $provider_id])->where('vehicle_id', $id)->get();
        
        return view('admin/providers/vehicle_document_update', compact('VehicleDocuments', 'DriverDocuments','provider_id','id', 'getDocs'));
    }

    public function admin_provider_doc(Request $request)
    {
        $postData = Input::all();
       
        $files = $request->file('document');

        if($request->hasFile('document'))
        {
            foreach ($files as $key => $file)
            {
                if(isset($postData['expiry'][$key]) && !empty($postData['expiry'][$key]))
                {
                    try
                    {                
                        $Document = ProviderDocument::where('provider_id', $postData['provider_id'])
                            ->where('document_id', $key)
                            ->firstOrFail();

                        $Document->update([
                            'url' => $file->store('provider/documents'),
                            'status' => 'ASSESSING',
                            'expiry' => $postData['expiry'][$key],
                        ]);
                    }
                    catch (ModelNotFoundException $e) {
                        // echo "catch"; print_r($postData); die();
                        ProviderDocument::create([
                            'url' => $file->store('provider/documents'),
                            'provider_id' => $postData['provider_id'],
                            'document_id' => $key,
                            'status' => 'ASSESSING',
                            'expiry' => $postData['expiry'][$key],
                        ]);
                        
                    }
                }
            }
        }
        return back()->with('flash_success', 'Provider Document Added successfully!');
    }

    public function admin_vehicle_doc(Request $request)
    {
        $postData = Input::all();
        // echo "<pre>"; print_r($postData); die();
        $files = $request->file('document');
        if($request->hasFile('document'))
        {
            foreach ($files as $key => $file)
            {
                if(isset($postData['expiry'][$key]) && !empty($postData['expiry'][$key]))
                {
                    try
                    {                
                        $Document = ProviderVehicleDocument::where('provider_id', $postData['provider_id'])->where('vehicle_id', $postData['vehicle_id'])
                            ->where('document_id', $key)
                            ->firstOrFail();

                        $Document->update([
                            'url' => $file->store('provider/vehicle/documents'),
                            'status' => 'PROCESSING',
                            'expiry' => $postData['expiry'][$key],
                        ]);
                    }
                    catch (ModelNotFoundException $e) {
                        // echo "catch"; print_r($postData); die();
                        ProviderVehicleDocument::create([
                            'url' => $file->store('provider/vehicle/documents'),
                            'provider_id' => $postData['provider_id'],
                            'vehicle_id' => $postData['vehicle_id'],
                            'document_id' => $key,
                            'status' => 'PROCESSING',
                            'expiry' => $postData['expiry'][$key],
                        ]);
                    }
                }
            }
            return back()->with('flash_success', 'Provider vehicle Document Added successfully!');
        }
        else
        {
            return back()->with('flash_error', 'Provider Vehicle Document not found!');
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
                'document' => 'mimes:jpg,jpeg,png,pdf',
            ]);

        try {
            
            $Document = ProviderDocument::where('provider_id', \Auth::guard('provider')->user()->id)
                ->where('document_id', $id)
                ->firstOrFail();

            $Document->update([
                    'url' => $request->document->store('provider/documents'),
                    'status' => 'ASSESSING',
                ]);

            return back();

        } catch (ModelNotFoundException $e) {

            ProviderDocument::create([
                    'url' => $request->document->store('provider/documents'),
                    'provider_id' => \Auth::guard('provider')->user()->id,
                    'document_id' => $id,
                    'status' => 'ASSESSING',
                ]);
            
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
