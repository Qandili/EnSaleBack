<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Http\Resources\StudentResource;

class LoginController extends Controller
{
    //
    public function login(Request $request)
    {
        $student=Student::where('student_cne','=',$request->input('student_cne'))
        ->where('password','=',$request->input('password'))
        ->get();
        return (count($student));
    }
}
