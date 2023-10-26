<?php

namespace App\Http\Controllers\Resource;

use App\Faq;
use App\FaqField;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Helpers\Helper;

class FaqResource extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::orderBy('created_at' , 'desc')->get();
        $faqs = Faq::orderBy('created_at' , 'desc')->get();
        return view('admin.Faq.index', compact('categories','faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::whereNotIn('id',function($query1){
                $query1->select('parent')->from('category');
            })->get();
        return view('admin.Faq.create', compact('categories'));
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
        if($request->isMethod('post'))
        {
            $postData = Input::all();
            $this->validate($request, [
                'category' => 'required',
                'question' => 'required',
                'answer'   => 'required',
            ]);
           
            $data = array(
                'category_id' => implode(",",$postData["category"]),
                'question'   => $postData['question'],
                'answer'     => $postData['answer'],
            );
            $faq = Faq::create($data);

            foreach($postData['label_of_field'] as $index => $value) {
                $model = new FaqField;
                $model->faq_id = $faq['id'];
                $model->label = $value;
                $model->type = $postData['type_of_field'][$index];
                $model->save();
            }
           
            return redirect()->route('admin.faq.index')->with('flash_success','Faq Saved Successfully');
        }     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        try {
            $categories = Category::whereNotIn('id',function($query1){
                $query1->select('parent')->from('category');
            })->get();
            $faq = faq::findOrFail($id);
            $faqfield = FaqField::where('faq_id', $id)->get();
            return view('admin.Faq.edit',compact('faq','categories','faqfield'));
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Category Not Found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $postData = Input::all();
        /*helper::pr($postData);
        die('dsd');*/
        $this->validate($request, [
            'category'      => 'required',
            'question'      => 'required',
            'answer'      => 'required',
        ]);

        $data = array(
            'category_id' => implode(",",$postData["category"]),
            'question'     => $postData['question'],
            'answer'     => $postData['answer'],
        );
        $faq = faq::where(['id' => $id])->update($data);

        foreach($postData['label_of_field'] as $index => $value) {

            $faq_data = array(
                'faq_id' => $id,
                'label' => $value,
                'type' => $postData['type_of_field'][$index],
            );
            $where = array('id' => $postData['faqfield_id'][$index]);
            $field_data = FaqField::updateOrCreate($where,$faq_data);
        }
        return redirect()->route('admin.faq.index')->with('flash_success', 'Faq Updated Successfully');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            faq::find($id)->delete();
            return back()->with('flash_success', 'FAQ deleted successfully');
        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'FAQ Not Found');
        }
    }


    public function delete($id)
    {

        $fields = FaqField::find($id);
        $fields->delete();

        // return response()->json(['success'=>true]);

        return Response()->json(array(
                'status' => true,
            ));

         // return Response()->json(array(
         //        'success' => true,
         //    ));
       
    }

}
