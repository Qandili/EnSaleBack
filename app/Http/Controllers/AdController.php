<?php

namespace App\Http\Controllers;

use App\Ad;
use Illuminate\Http\Request;
use App\Http\Resources\AdResource;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //Get ads
         $ads=Ad::orderBy('created_at','desc')->paginate(5);
         //Return collection of ads as a resource
         return AdResource ::collection($ads);
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
        $ad=$request->isMethod('put')?Ad::findOrFail($request->ad_id):new Ad;
        $ad->id=$request->input('ad_id');
        $ad->title=$request->input('title');
        $ad->description=$request->input('description');
        $ad->price=$request->input('price');
        $ad->sold=$request->input('sold');
        $ad->student=$request->input('student');
        $ad->categorie=$request->input('categorie');
        if($ad->save())
            return new AdResource($ad);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $id)
    {
        //Get ad
        $ad=Ad::findOrFail($id);
        //Return single article as a resource
        return new AdResource($ad);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ad $ad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ad $ad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $id)
    {
         //Get ad
         $ad=Ad::findOrFail($id);
         if($ad->each->delete())
            return new AdResource($ad);
    }
}
