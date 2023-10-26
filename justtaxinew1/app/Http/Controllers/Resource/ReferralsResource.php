<?php

namespace App\Http\Controllers\Resource;

use App\Referrals;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReferralsResource extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $referrals = Referrals::orderBy('created_at' , 'desc')->get();
        return view('admin.Referrals.index', compact('referrals'));
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
     * @param  \App\Referrals  $referrals
     * @return \Illuminate\Http\Response
     */
    public function show(Referrals $referrals, $id)
    {
        //
        try {
            $referrals =  Referrals::findOrFail($id);
            return view('admin.Referrals.view',compact('referrals'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Referrals  $referrals
     * @return \Illuminate\Http\Response
     */
    public function edit(Referrals $referrals)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Referrals  $referrals
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Referrals $referrals)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Referrals  $referrals
     * @return \Illuminate\Http\Response
     */
    public function destroy(Referrals $referrals)
    {
        //
    }
}
