<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return view('admin/signin');
    }
      public function dashboard(){ 
        return view('admin/dashboard');
    }
       public function employes(){ 
        return view('admin/Employes');
    }
     public function Tasks() {
        return view('admin/tasks');
    }
       public function Stats() {
        return view('admin/statistics');
}
public function Request() {
        return view('admin/Requests');
    }
public function msg() {
        return view('admin/message');
    }
        public function setting() {
        return view('admin/settings');
}
     public function adminacc(){
        return view('admin/admacc');
    }
}
