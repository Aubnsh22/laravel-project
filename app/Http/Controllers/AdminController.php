<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\User; // Add this to access the User model

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.signin');
    }

    public function dashboard()
    {
        if (!View::exists('admin.dashboard')) {
            \Log::error('View admin.Employees not found.');
            return redirect()->route('welcome')->with('error', 'Employee view not found.');
        }

        $user = Auth::user();
        return view('admin.dashboard', ['user' => $user]);
    }

    public function employes()
    {
        if (!View::exists('admin.Employees')) {
            \Log::error('View admin.Employees not found.');
            return redirect()->route('welcome')->with('error', 'Employee view not found.');
        }

        $user = Auth::user();
        return view('admin.Employees', ['user' => $user]);
    }

    public function Tasks()
    {
        if (!View::exists('admin.tasks')) {
            \Log::error('View admin.tasks not found.');
            return redirect()->route('dashboard')->with('error', 'Tasks view not found.');
        }

        $user = Auth::user();
        return view('admin.tasks', ['user' => $user]);
    }

    public function Stats()
    {
        if (!View::exists('admin.statistics')) {
            \Log::error('View admin.statistics not found.');
            return redirect()->route('dashboard')->with('error', 'Statistics view not found.');
        }

        $user = Auth::user();
        return view('admin.statistics', ['user' => $user]);
    }

    public function Request()
    {
        if (!View::exists('admin.Requests')) {
            \Log::error('View admin.Requests not found.');
            return redirect()->route('dashboard')->with('error', 'Requests view not found.');
        }

        $user = Auth::user();
        return view('admin.Requests', ['user' => $user]);
    }

    public function msg()
    {
        if (!View::exists('admin.message')) {
            \Log::error('View admin.message not found.');
            return redirect()->route('dashboard')->with('error', 'Message view not found.');
        }

        $user = Auth::user();
        $users = User::all(); // Fetch all users for the message form
        return view('admin.message', ['user' => $user, 'users' => $users]);
    }

    public function setting()
    {
        if (!View::exists('admin.settings')) {
            \Log::error('View admin.settings not found.');
            return redirect()->route('dashboard')->with('error', 'Settings view not found.');
        }

        $user = Auth::user();
        return view('admin.settings', ['user' => $user]);
    }

    public function adminacc()
    {
        if (!View::exists('admin.admacc')) {
            \Log::error('View admin.admacc not found.');
            return redirect()->route('dashboard')->with('error', 'Account view not found.');
        }

        $user = Auth::user();
        return view('admin.admacc', ['user' => $user]);
    }

    ///blackllist
    public function adminacc()
    {
        if (!View::exists('admin.admacc')) {
            \Log::error('View admin.admacc not found.');
            return redirect()->route('dashboard')->with('error', 'Account view not found.');
        }

        $user = Auth::user();
        return view('admin.admacc', ['user' => $user]);
    }
}