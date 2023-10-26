<?php

namespace App\Http\Controllers\Resource;

use App\QuestTarget;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestTargetResource extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $quests = QuestTarget::orderBy('created_at' , 'desc')->get();
        return view('admin.questTarget.index', compact('quests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.questTarget.create');
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
        $this->validate($request, [
            'number_of_trips' => 'required|max:100',
            'bonus_amount' => 'required|numeric',
            'time_period' => 'required',
        ]);

        try{

            QuestTarget::create($request->all());
            return redirect()->route('admin.quest.index')->with('flash_success','Quest Saved Successfully');

        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Quest Not Found');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\QuestTarget  $questTarget
     * @return \Illuminate\Http\Response
     */
    public function show(QuestTarget $questTarget, $id)
    {
        //
        try {
            return QuestTarget::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QuestTarget  $questTarget
     * @return \Illuminate\Http\Response
     */
    public function edit(QuestTarget $questTarget, $id)
    {
        //
        try {
            $quests = QuestTarget::findOrFail($id);
            return view('admin.questTarget.edit',compact('quests'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QuestTarget  $questTarget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuestTarget $questTarget, $id)
    {
        //
        $this->validate($request, [
            'number_of_trips' => 'required|max:100',
            'bonus_amount' => 'required|numeric',
            'time_period' => 'required',
        ]);

        try {

           $quest = QuestTarget::findOrFail($id);

            $quest->number_of_trips = $request->number_of_trips;
            $quest->bonus_amount = $request->bonus_amount;
            $quest->time_period = $request->time_period;
            $quest->save();

            return redirect()->route('admin.quest.index')->with('flash_success', 'Quest Updated Successfully');    
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Quest Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QuestTarget  $questTarget
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestTarget $questTarget, $id)
    {
        //
        try {
            QuestTarget::find($id)->delete();
            return back()->with('message', 'Quest deleted successfully');
        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Quest Not Found');
        }
    }
}
