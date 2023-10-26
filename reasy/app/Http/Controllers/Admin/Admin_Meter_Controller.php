<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use URL;
use Session;
use Redirect;
use App\User;
use App\Properties;
use App\Meters;
use App\MeterReadings;
use App\Contracts;
use App\PropertiesUnit;
use App\Vendors;
Use Helper;
use Illuminate\Support\Facades\DB;
class Admin_Meter_Controller extends Controller
{ 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Dashboard Meters view through Unit Utility
    public function meterDetails($id){
        $meter = Meters::find($id);
        $unit = PropertiesUnit::find($meter->unit_id);
        $meterReadings = MeterReadings::where('meter_id', $id)->get();
        return view('admin.admin_meter.meterdetails')->with([
            'unit'=>$unit,
            'meter' => $meter,
            'meterReadings' => $meterReadings
        ]);
    }

    // Dashboard Unit Utility Meters
    public function listMeters($id){
        $unit = PropertiesUnit::find($id);
        $property = DB::table('properties')->where('id', $unit->building_id)->first();
        $electricMeters = Meters::where('unit_id', $id)->where('meter_type', 'electric_meter')->get();
        $waterMeters = Meters::where('unit_id', $id)->where('meter_type', 'water_meter')->get();
        $gasMeters = Meters::where('unit_id', $id)->where('meter_type', 'gas_meter')->get();
        return view('admin/admin_meter/meter_list')->with([
            'unit'=>$unit,
            'electricMeters'=>$electricMeters,
            'waterMeters'=>$waterMeters,
            'gasMeters'=>$gasMeters,
            'property'=>$property
        ]);
    }

    // Dashboard Meters create through Unit Utility
    public function createMeter(Request $request){
        $request->validate([
            'unit_id' => ['required'],
            'meter_type' => ['required'],
            'unit_price' => ['required','numeric'],
            'ean_number' => ['required'],
            'meter_number' => ['required'],
        ]);
        $MeterObj = new Meters;
        $MeterObj->unit_id = $request->input('unit_id');
        $MeterObj->meter_type = $request->input('meter_type');
        $MeterObj->unit_price = $request->input('unit_price');
        $MeterObj->ean_number = $request->input('ean_number');
        $MeterObj->meter_number = $request->input('meter_number');
        $MeterObj->save();
        toastr()->success('Meter Added Successfully!');
        return redirect()->back();
        //return redirect()->back()->with('message', 'Meter Added Successfully!');
    }

    // Dashboard Meters delete through Unit Utility
    public function deleteMeter($id){
        $meters = new Meters;
        $meters->find($id)->delete();
        toastr()->success('Meter Delete Successfully!');
        return redirect()->back();
        //return redirect()->back()->with('message', 'Meter Delete Successfully!');
    }

    // Dashboard Meters update through Unit Utility
    public function updateMeter(Request $request){
       $this->validate($request, [
            'meter_id' => 'required',
            'unit_price' => 'required|numeric',
            'ean_number' => 'required',
            'meter_number' => ['required'],
        ]);
        $meter = Meters::find($request->input('meter_id'));
        $meter->unit_price = $request->input('unit_price');
        $meter->ean_number = $request->input('ean_number');
        $meter->meter_number = $request->input('meter_number');
        $meter->save();
        toastr()->success('Meter Update Successfully!');
        return redirect()->back();
        //return redirect()->back()->with('message', 'Meter Update Successfully!');
    }

    //Dashboard Utility Add Meter Reading
    public function addMeterReading($id,Request $request){
        $this->validate($request, [
            'reading_date' => 'required',
            'last_reading' => 'required|numeric',
            'current_reading' => 'required|numeric',
            'per_unit_price' => 'required|numeric',
            'amount' => 'required|numeric',
            'status' => 'required',
        ]);
        $MeterRe = new MeterReadings;
        $MeterRe->unit_id = $request->input('unit_id');
        $MeterRe->meter_id = $id;
        $MeterRe->reading_date = $request->input('reading_date');
        $MeterRe->last_reading = $request->input('last_reading');
        $MeterRe->current_reading = $request->input('current_reading');
        $MeterRe->per_unit_price = $request->input('per_unit_price');
        $MeterRe->amount = $request->input('amount');
        $MeterRe->upload_document = $request->input('upload_document');
        $MeterRe->status = $request->input('status');
        $MeterRe->save();
        toastr()->success('Reading Added Successfully!');
        return redirect()->back();
    }

    //Dashboard Utility Delete Meter Reading
    public function deleteMeterReading($id){
        $meters = new MeterReadings;
        $meters->find($id)->delete();
        toastr()->success('Reading Delete Successfully!');
        return redirect()->back();
    }

    //Upload Meter Document
    public function uploadMeterReadingDocument(Request $request) {
        $files = $request->file('file');
        if($request->hasFile('file')){
            $destinationPath = public_path('images/meter_reading_document/');
            $fileName = str_replace(" ", "_", time()."_".$files->getClientOriginalName()) ;
            $files->move($destinationPath,$fileName);
            return response()->json(['status' => 'success', 'target_file' => $fileName]);
        }
    }
}
