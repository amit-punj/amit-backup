<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Pages;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class PagesController extends Controller
{
	public function __construct()
    {
        // $this->middleware(['is_admin'], ['except' => ['login']]);
    }
    public function addPages(Request $request)
    {
        $sidebar = 'add_page';
    	if($request->isMethod('post'))
    	{
           $postData = Input::all();
                    $rules = array(
                        'page_name' => 'required',
                        'page_content' => 'required',
                        'page_slug' => 'required',
                    );
                $validator = Validator::make($postData, $rules);
                if ($validator->fails()){
                        return back()->withInput()->withErrors($validator);
                    }

            $data = $request->all();
			// $slug = str_replace(' ', '_', strtolower($data['page_name']));

   //          $get_slugdata = DB::table('pages')->where('slug', $slug)->first();
   //          if($get_slugdata)
   //          {
   //              $slug = $slug . '_' . rand(1000,100000);
   //          }

            $pages = new Pages;
			$pages->name = $data['page_name'];
    		$pages->content = $data['page_content'];
    		$pages->slug = $data['page_slug'];
            $pages->status = $data['page_status'];
            $pages->meta_key = ($data['meta_key'])?$data['meta_key']:'';
    		$pages->meta_value = ($data['meta_value'])?$data['meta_value']:'';
            $pages->save();
    		return redirect('/admin/view-page')->with('flash_message_success','Page added successfully');
    	}
    	return view('admin.pages.add-page',compact('sidebar'));
    }
    public function editPages(Request $request,$id = null)
    {
        $sidebar = 'page';
    	if($request->isMethod('post'))
    	{
    		$data = $request->all();
    		// $slug = str_replace(' ', '_', strtolower($data['page_name']));

      //       $get_slugdata = DB::table('pages')->where('slug', $slug)->first();
      //       if($get_slugdata)
      //       {
      //           $slug = $slug . '_' . rand(1000,100000);
      //       }
            
    		Pages::where(['id'=>$id])->update([
                'name'=>$data['page_name'],
                'content'=>$data['page_content'],
                'slug'=>$data['page_slug'],
                'meta_key'=>$data['meta_key'],
                'meta_value'=>$data['meta_value'],
                'status'=>$data['page_status']
            ]);
    		return redirect('/admin/view-page')->with('flash_message_success','Page update successfully');
    	}
    	$PageDetails = Pages::where(['id'=>$id])->first();
    	return view('admin.pages.edit-page')->with(compact('PageDetails','sidebar'));
    }
    public function deletePages($id = null)
    {
    	if(!empty($id))
    	{
    		Pages::where(['id'=>$id])->delete();
    		return redirect()->back()->with('flash_message_success','Page deleted successfully');
    	}
    }
    public function viewPages()
    {
        $sidebar = 'page';
    	$Pages = Pages::get();
    	return view('admin.pages.view-page')->with(compact('Pages','sidebar'));
    }
}
