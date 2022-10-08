<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function loggedin()
    {
        return view('logged');
    }

    public function show()
    {
        return view('usersList');
    }
}
