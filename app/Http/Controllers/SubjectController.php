<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function add(Request $request){
        $name = $request->input('subname');;
        $array = DB::table('subjects')
                    ->whereIn('name', [$name])
                    ->get();
        if(count($array)==0){
            DB::table('subjects')->insert([
                'name' => $name,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            return view('adminView');
        }
        else{
            echo "Przedmiot $name już istnieje";
            return view('addSubject');
        }
    }
    public function assign(Request $request){
        $class_id = $request->input('class_id');
        $subject_id = $request->input('subject_id');
        $array = DB::table('class_subject')
                    ->whereIn('class_id', [$class_id])
                    ->whereIn('subject_id', [$subject_id])
                    ->get();
        if(count($array)==0){
            DB::table('class_subject')->insert([
                'class_id' => $class_id,
                'subject_id' => $subject_id,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            return view('adminView');
        }
        else{
            echo "Przedmiot już jest przypisany do tej klasy";
            return view('assignSubject');
        }
    }
    
    public function showassignform(){
        return view('assignSubject');
    }
    public function show()
    {
        return view('addSubject');
    }
}
