<?php

namespace App\Http\Controllers\Resource;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Helpers\Helper;

class CategoryResource extends Controller
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
        return view('admin.Category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::get();
        return view('admin.Category.create', compact('categories'));
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
            // Helper::pr($postData,1);
            $this->validate($request, [
                'category'      => 'required',
            ]);
           
            $category_data = array(
                'parent'     => $postData['parent'],
                'category'     => $postData['category'],
            );
            $category = Category::create($category_data);
            return redirect()->route('admin.category.index')->with('flash_success','Category Saved Successfully');
        }      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
            // Helper::pr($category->category_name->category,1);
        try {
            $categories = Category::where('id','!=', $id)->get();
            $category = Category::findOrFail($id);
            return view('admin.Category.edit',compact('category','categories'));
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Category Not Found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $postData = Input::all();
        $this->validate($request,[
            'category' => 'required',
        ]);

        $category_data = array(
            'parent'     => $postData['parent'],
            'category'   => $postData['category'],
        );

        $category = Category::where(['id' => $id])->update($category_data);
        return redirect()->route('admin.category.index')->with('flash_success', 'Category Updated Successfully');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        try {
            Category::find($id)->delete();
            return back()->with('message', 'Category deleted successfully');
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Category Not Found');
        } catch (Exception $e) {
            return back()->with('flash_error', 'Category Not Found');
        }
    }
}
