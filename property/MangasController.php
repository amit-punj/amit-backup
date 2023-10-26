<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Genres;
use App\Author;
use App\Subgenres;
use App\Manga;
use App\Character;
use App\Chapter;
use File;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Filesystem\Filesystem;


class MangasController extends Controller
{
    public function index(User $model)
    {
        if(isset($_GET['search'])){
            $s = $_GET['search'];
            $mangas =  Manga::select('*');
            if($s != ''){
                $mangas->where('title','LIKE','%'.$s.'%');
            }if($_GET['search-editor'] != ''){
                $mangas->where(['editors_picks'=>$_GET['search-editor']]);
            }
            $mangas = $mangas->orderBy('id', 'DESC')->paginate(15);
        }else{
            $mangas = Manga::orderBy('id', 'DESC')->paginate(15);
        }
        return view('mangas.index')->with(compact('mangas'));
    }

    public function create()
    {
    	$authors = Author::get();
    	$genres = Genres::get();
    	$subgenres = Subgenres::get();
    	$character = Character::get();
        return view('mangas.create')->with(compact('authors','genres','subgenres','character'));
    }

    public function store(Request $request)
    {
    	if($request->isMethod('post'))
        {
        	$postData = Input::all();
    		$rules = array(
                'title' => 'required',
                'cover_image' => 'required|mimes:jpeg,bmp,png,gif,jpg',
                'profile_image' => 'required|mimes:jpeg,bmp,png,gif,jpg',
                'summary' => 'required'
            );
            $validator = Validator::make($postData, $rules);

            if ($validator->fails())
            {
                return redirect('/mangas/create')->withInput()->withErrors($validator);
            }
            else
            {
            	$cover_image = "";
            	$profile_image = "";
            	$previous_image = "";
            	if ($request->hasFile('cover_image')) 
                {
                	$image = $request->file('cover_image');
                	$path = public_path().'/Coverimages/';
                    if (!file_exists($path)) 
                    {
                        File::makeDirectory($path, $mode = 0777, true, true);
                    }
                    $cover_image = $request->title.rand(100,999) . '.' . $image->getClientOriginalExtension();
	                $image->move($path,$cover_image);
                }
                if ($request->hasFile('profile_image')) 
                {
                	$image = $request->file('profile_image');
                	$path = public_path().'/Profileimages/';
                    if (!file_exists($path)) 
                    {
                        File::makeDirectory($path, $mode = 0777, true, true);
                    }
                    $profile_image = $request->title.rand(100,999) . '.' . $image->getClientOriginalExtension();
	                $image->move($path,$profile_image);
                }
                if ($request->hasFile('previous_image')) 
                {
                	$image = $request->file('previous_image');
                	$path = public_path().'/Previousimages/';
                    if (!file_exists($path)) 
                    {
                        File::makeDirectory($path, $mode = 0777, true, true);
                    }
                    $previous_image = $request->title.rand(100,999) . '.' . $image->getClientOriginalExtension();
	                $image->move($path,$previous_image);
                }


            	$mangas = new Manga();
            	$mangas->title = $request->title;
            	$mangas->summary = $request->summary;
            	$mangas->description = $request->description;
            	$mangas->cover_image = $cover_image;
            	$mangas->profile_image = $profile_image;
            	$mangas->authors = ($request->authors)?implode(',',$request->authors):"";
            	$mangas->genres = ($request->genres)?implode(',',$request->genres):"";
            	$mangas->subgenres = ($request->subgenres)?implode(',',$request->subgenres):"";
            	$mangas->characters = ($request->character)?implode(',',$request->character):"";
            	$mangas->other_facts = ($request->other_facts)?$request->other_facts:"";
            	$mangas->previous_photo = $previous_image;
            	$mangas->mangas_type = "";
            	$mangas->status = $request->status;
            	$mangas->rank = $request->rank;
                $mangas->gallery_images  = ($request->galleryimg)?implode(',', $request->galleryimg):'';
            	$mangas->save();
            	
            	return redirect('/mangas')->withStatus(__('Mangas successfully created.'));
            }
    	}
        
    }

    public function edit(Request $request,$id=NULL)
    {
    	$authors = Author::get();
    	$genres = Genres::get();
    	$subgenres = Subgenres::get();
    	$character = Character::get();
    	$mangas = Manga::where(['id'=>$id])->first();
        return view('mangas.edit')->with(compact('authors','genres','subgenres','character','mangas'));
    }

    public function update(Request $request, $id=NULL)
    {
    	$mangas = Manga::where(['id'=>$id])->first();
    	if($request->isMethod('post'))
        {
        	$postData = Input::all();
    		$rules = array(
                'title' => 'required',
                'cover_image' => 'mimes:jpeg,bmp,png,gif,jpg',
                'profile_image' => 'mimes:jpeg,bmp,png,gif,jpg',
                'summary' => 'required'
            );
            $validator = Validator::make($postData, $rules);

            if ($validator->fails())
            {
                return redirect('/mangas/edit/'.$id)->withInput()->withErrors($validator);
            }
            else
            {
            	//echo "<pre>";print_r($_POST);die;
            	$cover_image = $mangas->cover_image;
            	$profile_image = $mangas->profile_image;
            	$previous_image = $mangas->previous_photo;
            	if ($request->hasFile('cover_image')) 
                {
                	$image = $request->file('cover_image');
                	$path = public_path().'/Coverimages/';
                    if (!file_exists($path)) 
                    {
                        File::makeDirectory($path, $mode = 0777, true, true);
                    }
                    $cover_image = $request->title.rand(100,999) . '.' . $image->getClientOriginalExtension();
	                $image->move($path,$cover_image);
                }
                if ($request->hasFile('profile_image')) 
                {
                	$image = $request->file('profile_image');
                	$path = public_path().'/Profileimages/';
                    if (!file_exists($path)) 
                    {
                        File::makeDirectory($path, $mode = 0777, true, true);
                    }
                    $profile_image = $request->title.rand(100,999) . '.' . $image->getClientOriginalExtension();
	                $image->move($path,$profile_image);
                }
                if ($request->hasFile('previous_image')) 
                {
                	$image = $request->file('previous_image');
                	$path = public_path().'/Previousimages/';
                    if (!file_exists($path)) 
                    {
                        File::makeDirectory($path, $mode = 0777, true, true);
                    }
                    $previous_image = $request->title.rand(100,999) . '.' . $image->getClientOriginalExtension();
	                $image->move($path,$previous_image);
                }

            	$mangas->title = $request->title;
            	$mangas->summary = $request->summary;
            	$mangas->description = $request->description;
            	$mangas->cover_image = $cover_image;
            	$mangas->profile_image = $profile_image;
            	$mangas->authors = ($request->authors)?implode(',',$request->authors):"";
            	$mangas->genres = ($request->genres)?implode(',',$request->genres):"";
            	$mangas->subgenres = ($request->subgenres)?implode(',',$request->subgenres):"";
            	$mangas->characters = ($request->character)?implode(',',$request->character):"";
            	$mangas->other_facts = ($request->other_facts)?$request->other_facts:"";
            	$mangas->previous_photo = $previous_image;
                $mangas->mangas_type = "";
                $mangas->status = $request->status;
            	$mangas->rank = $request->rank;
                $mangas->gallery_images  = ($request->galleryimg)?implode(',', $request->galleryimg):'';
            	$mangas->save();

           		
            	return redirect('/mangas')->withStatus(__('Mangas successfully updated.'));
            }
    	}
    }

    public function destroy($id=NULL)
    {
        $Chapter = Chapter::where(['manga_id'=>$id])->get();
        if(count($Chapter)){
            foreach ($Chapter as $key => $value) {
                $ch = Chapter::find( $value->id );
                $ch->delete();
            }
        }
    	$mangas = Manga::find( $id );
		$mangas->delete();
        return redirect('/mangas')->withStatus(__('Mangas successfully deleted.'));
    }

    public function gallery(Request $request)
    {
        $imageName = rand(100,999).request()->file->getClientOriginalName();
        request()->file->move(public_path('mangas_gallery'), $imageName);

        echo json_encode(array('target_file' => $imageName));
    }
    public function getsubgenres(Request $request)
    {
        //$data = implode(',',$request->genres_id);
        foreach ($request->genres_id as $key => $value) {
            $Subgenres[] = Subgenres::where(['genres_id'=>$value])->get();
        }
        if(count($Subgenres)>0)
        {
            return response()->json($Subgenres);
        }
        return response()->json(1); 
    }
    public function change_editor_pick(Request $request)
    {
        $data = Manga::where('id',$request->tb_id)->first();
        $data->editors_picks = $request->val;
        $data->save();

        if($data){
            $id =  1;
        }else{
             $id =  0;
        }
        return response()->json($id);
    }

    public function sort_chapters(Request $request)
    {
        $manga_id = ($request->get('manga'))?$request->get('manga'):0;
        $chapters = DB::table('chapters')
            ->select('chapters.*','chapters.title as chapters_name','mangas.title as mangas_name')
            ->join('mangas','mangas.id','=','chapters.manga_id')
            ->where(['chapters.manga_id' => $manga_id])
            ->orderBy('orders','asc')
            ->get();


        return view('mangas.sort_manga')->with(compact('chapters'));
    }
    public function manga_chapter_sort(Request $request, $id = null)
    {
        $postData = Input::all();
        foreach ($postData['galleryimg'] as $key => $value) {
            $key++;
            $update = Chapter::where(['id' => $value])->update(['orders' => $key]);
        }
        return redirect('mangas');
    }
}
