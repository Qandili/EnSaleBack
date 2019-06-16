<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('UserInfos/profile');
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
        $user=User::findOrFail($request["id"]);
        $reqImage=$request->get('image');
            $exploded=explode(',',$reqImage);
            $decoded=base64_decode($exploded[1]);
            if(str_contains($exploded[0],'jpg' )|| str_contains($exploded[0],'jpeg')){
                $extension="jpg";
            }else if(str_contains($exploded[0],'png' )){
                $extension="png";
            }
            $user->picture_name=$user->email.'_'.$user->cne.'.'.$extension;
            $user->save();
            $file_name=$user->picture_name;
            if(!file_exists(public_path().'/'.'Profile_Pictures')){
                $path = public_path().'/'.'Profile_Pictures';
                File::makeDirectory($path, $mode = 0755, true, true);
            }
            $path=public_path().'/'.'Profile_Pictures'.'/'.$file_name;
            file_put_contents($path,$decoded); 
            $user->save();
            return response()->json([
                'message' => 'Successfully Updated Picture'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
