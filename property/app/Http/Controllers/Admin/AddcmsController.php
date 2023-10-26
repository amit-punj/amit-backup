<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cmspage;

class AddcmsController extends Controller {

    public function index(){
    	return view('admin.addcmspage');
    }

    public function create(request $request){
    	$this->validate($request, [
           		'title' => 'required',
				'content' => 'required',
       			]);
        $obj = new Cmspage;
        $content = $obj->textEditorData($request->input('content'));
    	$cmspage = new Cmspage;
       	$cmspage->title = $request->input('title');
       	$cmspage->status = $request->input('status');
		$cmspage->content = $content;
        $cmspage->save();
       	return redirect('/admin/listcmspage');
    }
    public function list(request $request){
        $cmspages = Cmspage::all();        
    	return view('admin.listcmspage')->with(['cmspages'=>$cmspages]);
    }
    public function edit($id){
        $data = Cmspage::find($id);
        return view('admin.editcmspage')->with(['data'=>$data]);
    }
    public function delete($id){
        $cmspages = new Cmspage;
        $cmspages->find($id)->delete();
        return back();
    }
    public function update(request $request){
        $obj = new Cmspage;
        $content = $obj->textEditorData($request->input('content'));
        $cmspage = Cmspage::find($request->input('id'));
        $cmspage->title = $request->input('title');
        $cmspage->status = $request->input('status');
        $cmspage->content = $content;
        $cmspage->save();
        return back();
    }

}
