<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    function Welcome(){
        return view('welcomepage/WELCOME');
    }

    function Sign_In(){
        return view('welcomepage/signin');
    }
}
