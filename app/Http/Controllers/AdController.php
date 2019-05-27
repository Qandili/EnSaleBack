<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Picture;
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
        $reqImage=$request->get('image');
        $ad=$request->isMethod('put')?Ad::findOrFail($request->id):new Ad;
        $ad->title=$request->input('title');
        $ad->description=$request->input('description');
        $ad->price=$request->input('price');
        $ad->user_id=$request->input('user_id');
        $ad->categorie_id=$request->input('categorie_id');
        $ad->save();
        $exploded=explode(',',$reqImage);
        $decoded=base64_decode($exploded[1]);
        if(str_contains($exploded[0],'jpg' )|| str_contains($exploded[0],'jpeg')){
            $extension="jpg";
        }else if(str_contains($exploded[0],'png' )){
            $extension="png";
        }
        $file_name=$ad->title.$ad->id.'.'.$extension;
        $path=public_path().'/'.'serverImages'.'/'.$file_name;
        file_put_contents($path,$decoded); 
        $image=new Picture;
        $image->file = $file_name;
        $image->ad_id = $ad->id;
        $image->save();
        return new AdResource($ad);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //Get ad
        $ad=Ad::findOrFail($request->id);
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
    public function destroy(Ad $ad)
    {
         //Get ad
         $ad=Ad::findOrFail($ad);
         if($ad->each->delete())
            return new AdResource($ad);
    }
}
