<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Attendance;
use Carbon\Carbon;

class ClockController extends Controller
{
    // Display Clock-In page
    public function showClockIn()
    {
        if (!View::exists('employee.CLOCK-IN')) {
            \Log::error('View employee.CLOCK-IN not found.');
            return redirect()->route('welcome')->with('error', 'Clock-In view not found.');
        }

        $user = Auth::user();
        $today = Carbon::today();
        $attendance = Attendance::where('user_id', $user->id)
            ->where('date', $today->toDateString())
            ->first();

        $authController = new AuthentificationController();
        $messages = $authController->getUserMessages() ?? collect();
        $messages->each(function ($message) {
            $message->sent_at_human = Carbon::parse($message->sent_at)->diffForHumans();
        });

        $isClockedIn = $attendance ? $attendance->isClockedIn() : false;

        return view('employee.CLOCK-IN', [
            'user' => $user,
            'messages' => $messages,
            'isClockedIn' => $isClockedIn,
            'attendance' => $attendance,
        ]);
    }

    // Process Clock-In action
    public function storeClockIn(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today();
        $attendance = Attendance::where('user_id', $user->id)
            ->where('date', $today->toDateString())
            ->first();

        if (!$attendance) {
            Attendance::create([
                'user_id' => $user->id,
                'date' => $today,
                'status' => 'present',
                'clock_in' => Carbon::now()->toTimeString(),
            ]);
            \Log::info('Clocked in for user ID: ' . $user->id);
        } else {
            \Log::info('User ID: ' . $user->id . ' already clocked in today.');
        }

        return redirect()->route('Clock_In');
    }

    // Display Clock-Out page
    public function showClockOut()
    {
        if (!View::exists('employee.CLOCK-OUT')) {
            \Log::error('View employee.CLOCK-OUT not found.');
            return redirect()->route('Clock_In')->with('error', 'Clock-Out view not found.');
        }

        $user = Auth::user();
        $today = Carbon::today();
        $attendance = Attendance::where('user_id', $user->id)
            ->where('date', $today->toDateString())
            ->first();

        $authController = new AuthentificationController();
        $messages = $authController->getUserMessages() ?? collect();
        $messages->each(function ($message) {
            $message->sent_at_human = Carbon::parse($message->sent_at)->diffForHumans();
        });

        $isClockedIn = $attendance ? $attendance->isClockedIn() : false;

        return view('employee.CLOCK-OUT', [
            'user' => $user,
            'messages' => $messages,
            'isClockedIn' => $isClockedIn,
            'attendance' => $attendance,
        ]);
    }

    // Process Clock-Out action
    public function storeClockOut(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today();
        $attendance = Attendance::where('user_id', $user->id)
            ->where('date', $today->toDateString())
            ->first();

        if ($attendance && $attendance->isClockedIn()) {
            $attendance->update([
                'clock_out' => Carbon::now()->toTimeString(),
            ]);
            \Log::info('Clocked out for user ID: ' . $user->id);
        } else {
            \Log::info('User ID: ' . $user->id . ' either not clocked in or already clocked out today.');
        }

        return redirect()->route('Clock_In');
    }

    function Leave()
    {
        if (!View::exists('employee.LEAVE')) {
            \Log::error('View employee.LEAVE not found.');
            return redirect()->route('Clock_In')->with('error', 'Leave view not found.');
        }

        $user = Auth::user();
        return view('employee.LEAVE', ['user' => $user]);
    }

    function Stats()
    {
        if (!View::exists('employee.STATS')) {
            \Log::error('View employee.STATS not found.');
            return redirect()->route('Clock_In')->with('error', 'Stats view not found.');
        }

        $user = Auth::user();
        return view('employee.STATS', ['user' => $user]);
    }

    function Settings()
    {
        if (!View::exists('employee.SETTINGS')) {
            \Log::error('View employee.SETTINGS not found.');
            return redirect()->route('Clock_In')->with('error', 'Settings view not found.');
        }

        $user = Auth::user();
        return view('employee.SETTINGS', ['user' => $user]);
    }

    function MyAccount()
    {
        if (!View::exists('employee.MYACCOUNT')) {
            \Log::error('View employee.MYACCOUNT not found.');
            return redirect()->route('Clock_In')->with('error', 'My Account view not found.');
        }

        $user = Auth::user();
        return view('employee.MYACCOUNT', ['user' => $user]);
    }

    function Tasks()
    {
        if (!View::exists('employee.TASKS')) {
            \Log::error('View employee.TASKS not found.');
            return redirect()->route('Clock_In')->with('error', 'Tasks view not found.');
        }

        $user = Auth::user();
        return view('employee.TASKS', ['user' => $user]);
    }
    
   public function History(Request $request)
{
    $user = Auth::user();
    \Log::info('Fetching attendance for user ID: ' . $user->id);

    $query = Attendance::where('user_id', $user->id);

    // Apply filters based on request
    if ($request->has('week') && !empty($request->input('week'))) {
        $week = Carbon::parse($request->input('week'));
        $startOfWeek = $week->startOfWeek()->toDateString();
        $endOfWeek = $week->endOfWeek()->toDateString();
        $query->whereBetween('date', [$startOfWeek, $endOfWeek]);
    }

    if ($request->has('month') && !empty($request->input('month'))) {
        $month = $request->input('month');
        $year = $request->input('year') ?: date('Y');
        $query->whereMonth('date', Carbon::parse($month)->month)->whereYear('date', $year);
    }

    if ($request->has('year') && !empty($request->input('year'))) {
        $query->whereYear('date', $request->input('year'));
    }

    $attendances = $query->orderBy('date', 'desc')->get();
    \Log::info('Retrieved attendances: ' . $attendances->toJson());

    $authController = new AuthentificationController();
    $messages = $authController->getUserMessages() ?? collect();
    $messages->each(function ($message) {
        $message->sent_at_human = Carbon::parse($message->sent_at)->diffForHumans();
    });

    $today = Carbon::today();
    $currentAttendance = Attendance::where('user_id', $user->id)
        ->where('date', $today->toDateString())
        ->first();
    $isClockedIn = $currentAttendance ? $currentAttendance->isClockedIn() : false;

    return view('employee.history', compact('attendances', 'messages', 'isClockedIn', 'currentAttendance'));
}
}