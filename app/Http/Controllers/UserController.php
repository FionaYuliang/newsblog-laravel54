<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function setting(){
        return view('user.index');
    }


    public  function settingStore(){
        return null;
    }
}
