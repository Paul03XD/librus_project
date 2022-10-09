<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add(Request $request,$name){
        $username = $request->input('username');
        $subject = $request->input('gradeSubject');
        $user_id = $request->input('usersSelectList');
        $subject_id = $request->input('subjectsSelectList');
        DB::table('grades')->insert([
            'value' => $request->input('gradeValue'),
            'weight' => $request->input('gradeWeight'),
            'description' => $request->input('gradeDescription'),
            'user_id' => $user_id,
            'subject_id' => $subject_id,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        return view('grades',[
            'name'=>$name
        ]);
    }

    public function showuser()
    {
        return view('userGrades');
    }

    public function show($name)
    {
        return view('grades',[
            'name'=>$name
        ]);
    }

    public function showform($name)
    {
        return view('addGrades',[
            'name'=>$name
        ]);
    }
}
