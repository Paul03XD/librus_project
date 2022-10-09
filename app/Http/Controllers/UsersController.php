<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function loggedin()
    {
        return view('logged');
    }

    public function assign(Request $request){
        $user_id = $request->user_id;
        $uprawnienia = $request->uprawnienia;
        $wynik = DB::table('users')
            ->whereIn('id', [$user_id])
            ->update(['type'=>$uprawnienia]);
        return view('usersList');
    }

    public function showform(){
        return view('assignType');
    }

    public function show()
    {
        return view('usersList');
    }
}
