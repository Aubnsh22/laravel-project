<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClockController extends Controller
{
    function Clocking_In(){
        return view('employee/CLOCK-IN');
    }

    function Clocking_Out(){
        return view('employee/CLOCK-OUT');
    }

    function Leave(){
        return view('employee/LEAVE');
    }

    function History(){
        return view('employee/HISTORY');
    }

     function Stats(){
        return view('employee/STATS');
    }

    function Settings(){
        return view('employee/SETTINGS');
    }

    function MyAccount(){
        return view('employee/MYACCOUNT');
    }

    function Tasks(){
        return view('employee/TASKS');
    }




}
