<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendEmail;
use Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $email = $request->email;
        $subject = $request->subject;
        $message=$request->message;
        $objDemo = new \stdClass();
        $objDemo->email =  $email;
        $objDemo->subject =  $subject;
        $objDemo->message = $message;
        Mail::to("imane.bahamad98@gmail.com")->send(new SendEmail($objDemo));
 
        return response()->json(['success'=>true,'email'=>$email]);
    }

}
