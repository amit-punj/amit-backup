<?php 

namespace App\Http\Controllers\Resource;

use App\Area;
use App\ServiceType;
use App\AreaService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Helpers\Helper;

class AreaServiceResource extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $areas = Area::orderBy('created_at' , 'desc')->get();
        return view('admin.AreaService.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.AreaService.create');
    }   

    public function create_service_type(Request $request, $id)
    {
        $services = ServiceType::get();
        $added_services = AreaService::where(['area_id' => $id])->pluck('name')->toArray();

        // Helper::pr($added_services);
        // die('aaa');
// echo "<pre>"; print_r($img); die();

        if($request->isMethod('post'))
        {
            $postData = Input::all();
            $this->validate($request, [
                'name' => 'required|max:255',
                // 'provider_name' => 'required|max:255',
                'capacity' => 'required|numeric',
                'fixed' => 'required|numeric',
                'price' => 'required|numeric',
                'minute' => 'required|numeric',
                'distance' => 'required|numeric',
                'calculator' => 'required|in:MIN,HOUR,DISTANCE,DISTANCEMIN,DISTANCEHOUR',
                'image' => 'mimes:ico,png,jpeg,jpg'
            ]);

            $img = ServiceType::where(['id' => $postData['name']])->pluck('image')->first();

            try {
                $service = $request->all();
                if($request->hasFile('image')) {
                    $service['image'] = Helper::upload_picture($request->image);
                }
                else{
                    $service['image'] = $img;
                }

                $service = AreaService::create($service);

                return redirect()->route('admin.areaservice.show',$id)->with('flash_success','Area Service Type Saved Successfully');
            } catch (Exception $e) {
                dd("Exception", $e);
                return back()->with('flash_error', 'Area Service Type Not Found');
            }
        }
        return view('admin.AreaService.create-service-type',compact('services','id','added_services'));
    }

    
    public function get_serviceTypeDetails(Request $request)
    {
        $postData = Input::all();
        try {
            $services = ServiceType::findOrFail($postData['id']);

            $services->image = img($services->image);
            return response()->json(['data'=>$services,'status' => 'success']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['data'=>'Service Type Not Found','status' => 'error']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->isMethod('post'))
        {
            $postData = Input::all();
            $this->validate($request, [
                'name'      => 'required',
                'unit'      => 'required',
                'service'   => 'required',
                'longitude' => 'required',
                'latitude'  => 'required',
            ]);
           
            $area_data = array(
                'name'      => $postData['name'],
                'unit'      => $postData['unit'],
                'service'   => $postData['service'],
                'longitude' => $postData['longitude'],
                'latitude'  => $postData['latitude'],
            );
            $areas = Area::create($area_data);
            return redirect()->route('admin.areaservice.index')->with('flash_success','Area Saved Successfully');
        }       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AreaService  $areaService
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area, $id)
    {
        try {
            $area = Area::findOrFail($id);
            $areaService = AreaService::where('area_id',$id)->get();
            return view('admin.AreaService.show',compact('area','areaService'));
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Area Type Not Found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AreaService  $areaService
     * @return \Illuminate\Http\Response
     */
    public function edit(AreaService $areaService, $id)
    {
        //
        try {
            $area = Area::findOrFail($id);
            return view('admin.AreaService.edit',compact('area'));
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Area Not Found');
        }
    }
    public function edit_service_type(Request $request, AreaService $areaService, $id, $area_id)
    {
        //
        $services = ServiceType::get();
        $service = AreaService::findOrFail($id);
        if($request->isMethod('post'))
        {
            $this->validate($request, [
                'name' => 'required|max:255',
                // 'provider_name' => 'required|max:255',
                'fixed' => 'required|numeric',
                'price' => 'required|numeric',
                'image' => 'mimes:ico,png'
            ]);

            try {

                $service = AreaService::findOrFail($id);
// echo "<pre>"; print_r($service); die();
                if($request->hasFile('image')) {
                    if($service->image) {
                        Helper::delete_picture($service->image);
                    }
                    $service->image = Helper::upload_picture($request->image);
                }

                $service->name = $request->name;
                // $service->provider_name = $request->provider_name;
                $service->fixed = $request->fixed;
                $service->price = $request->price;
                $service->minute = $request->minute;
                $service->hour = $request->hour;
                $service->distance = $request->distance;
                $service->calculator = $request->calculator;
                $service->capacity = $request->capacity;
                $service->night_charges = $request->night_charges;
                $service->airport_charges = $request->airport_charges;
                $service->cancellation_fee = $request->cancellation_fee;
                $service->platform_fee = $request->platform_fee;
                $service->surge = $request->surge;
                $service->save();

                return redirect()->route('admin.areaservice.show',$area_id)->with('flash_success', 'Area Service Type Updated Successfully');    
            } 

            catch (ModelNotFoundException $e) {
                return back()->with('flash_error', 'Area Service Type Not Found');
            }
        }
        return view('admin.AreaService.edit-service-type',compact('area','service','services','area_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AreaService  $areaService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area, $id)
    {
        
        $postData = Input::all();
        $this->validate($request,[
            'name' => 'required',
            'unit' => 'required',
            'service' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ]);

        $area_data = array(
            'name'      => $postData['name'],
            'unit'      => $postData['unit'],
            'service'   => $postData['service'],
            'longitude' => $postData['longitude'],
            'latitude'  => $postData['latitude'],
        );

        $areas = area::where(['id' => $id])->update($area_data);
        return redirect()->route('admin.areaservice.index')->with('flash_success', 'Area Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AreaService  $areaService
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area, $id)
    {
        //
        try {
            Area::find($id)->delete();
            return back()->with('flash_success', 'Area deleted successfully');
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Area Not Found');
        } catch (Exception $e) {
            return back()->with('flash_error', 'Area Not Found');
        }
    } 
    public function destroy_service_type(Request $request, AreaService $AreaService, $id)
    {
        try {
            AreaService::find($id)->delete();
            return back()->with('flash_success', 'Area Service deleted successfully');
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Area Service Not Found');
        } catch (Exception $e) {
            return back()->with('flash_error', 'Area Service Not Found');
        }
    }
}
