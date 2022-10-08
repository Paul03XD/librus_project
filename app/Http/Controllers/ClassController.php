<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function add(Request $request){
        $name = $request->input('classname');;
        $array = DB::table('classes')
                    ->whereIn('name', [$name])
                    ->get();
        if(count($array)==0){
            DB::table('classes')->insert([
                'name' => $request->input('classname'),
                'created_at' => date('Y-m-d H:i:s')
            ]);
            return view('adminView');
        }
        else{
            echo "Klasa $name już istnieje";
            return view('addClass');
        }
    }

    public function assign(Request $request){
        $user_id = $request->usersSelectList;
        $class_id = $request->classesSelectList;
        DB::table('users')
            ->whereIn('id', [$user_id])
            ->update(['class_id'=>$class_id]);
        return view('adminView');
    }

    public function showassignform(){
        return view('assignClass');
    }

    public function showform(){
        return view('addClass');
    }

    public function show()
    {
        return view('classList');
    }
}
