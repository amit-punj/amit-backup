<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Plans;
// use Illuminate\Support\Facades\Input;
// use Illuminate\Support\Facades\Validator;

class PlanController extends Controller {

    public function index(){
    	return view('admin.addnewplan'); 
    }

    public function create(request $request){
    	$request->validate([
           		'title' => 'required',
				'status' => 'required|numeric',
                'price' => 'required|numeric',
                'short_description' => 'required',
                'plan_type' => 'required',
                'features' => 'required',
                'description' => 'required',
                'time_period_type' => 'required',
       			]);
        $time_period = null;
        if($request->input('time_period_type') == 'monthly'){
            $time_period = $request->input('number_of_months');
        } else {
            $time_period = $request->input('number_of_years');
        }
        $obj = new Plans;
        $description = $obj->textEditorData($request->input('description'));
        $features = $obj->textEditorData($request->input('features'));
    	$plan = new Plans;
       	$plan->title = $request->input('title');
       	$plan->status = $request->input('status');
        $plan->price = $request->input('price');
		$plan->short_description = $request->input('short_description');
        $plan->description = $description;
        $plan->plan_type = $request->input('plan_type');
        $plan->features = $features;
        $plan->time_period_type = $request->input('time_period_type');
        $plan->time_period = $time_period;
        $plan->save();
       	return redirect('/admin/listplans')->with('message', 'Plan Created Successfully!');
    }
    public function list(request $request){
        $plans = Plans::all();        
    	return view('admin.listplanespage')->with(['plans'=>$plans]);
    }
    public function edit($id){
        $data = Plans::find($id);
        return view('admin.editplanpage')->with(['data'=>$data]);
    }
    public function delete($id){
        $plans = new Plans;
        $plans->find($id)->delete();
        return back()->with('message', 'Plan Deleted Successfully!');
    }
    public function update(request $request){
        $this->validate($request, [
                'title' => 'required',
                'status' => 'required|numeric',
                'price' => 'required|numeric',
                'short_description' => 'required',
                'description' => 'required',
                'time_period_type' => 'required',
                ]);
        $time_period = null;
        if($request->input('time_period_type') == 'monthly'){
            $time_period = $request->input('number_of_months');
        } else {
            $time_period = $request->input('number_of_years');
        }
        $obj = new Plans;
        $description = $obj->textEditorData($request->input('description'));
        $features = $obj->textEditorData($request->input('features'));
        $plan = Plans::find($request->input('id'));
        $plan->title = $request->input('title');
        $plan->status = $request->input('status');
        $plan->price = $request->input('price');
        $plan->short_description = $request->input('short_description');
        $plan->description = $description;
        $plan->plan_type = $request->input('plan_type');
        $plan->features = $features;
        $plan->time_period_type = $request->input('time_period_type');
        $plan->time_period = $time_period;
        $plan->save();
        return back()->with('message', 'Plan Update Successfully!');
    }

}
