<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Leave_request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.signin');
    }

    public function dashboard()
    {
        if (!View::exists('admin.dashboard')) {
            \Log::error('View admin.dashboard not found.');
            return redirect()->route('welcome')->with('error', 'Dashboard view not found.');
        }

        $user = Auth::user();
        $recentActivities = $this->getRecentActivities();
        $today = Carbon::today()->toDateString();

        return view('admin.dashboard', [
            'user' => $user,
            'recentActivities' => $recentActivities,
            'today' => $today
        ]);
    }

    private function getRecentActivities()
    {
        $activities = [];

        // Fetch recent clock-ins
        $clockIns = Attendance::with('user')
            ->whereNotNull('clock_in')
            ->orderBy('clock_in', 'desc')
            ->take(5)
            ->get();

        foreach ($clockIns as $clockIn) {
            $activities[] = [
                'icon' => 'fas fa-user-check',
                'color' => 'text-success',
                'text' => "{$clockIn->user->full_name} a pointé son entrée à " . Carbon::parse($clockIn->clock_in)->format('H:i'),
                'timestamp' => $clockIn->clock_in,
                'user' => $clockIn->user->full_name
            ];
        }

        // Fetch recent clock-outs
        $clockOuts = Attendance::with('user')
            ->whereNotNull('clock_out')
            ->orderBy('clock_out', 'desc')
            ->take(5)
            ->get();

        foreach ($clockOuts as $clockOut) {
            $activities[] = [
                'icon' => 'fas fa-user-times',
                'color' => 'text-danger',
                'text' => "{$clockOut->user->full_name} a pointé sa sortie à " . Carbon::parse($clockOut->clock_out)->format('H:i'),
                'timestamp' => $clockOut->clock_out,
                'user' => $clockOut->user->full_name
            ];
        }

        // Fetch recent leave requests
        $leaveRequests = Leave_request::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        foreach ($leaveRequests as $request) {
            $activities[] = [
                'icon' => 'fas fa-envelope',
                'color' => 'text-info',
                'text' => "{$request->user->full_name} a fait une demande de congé",
                'timestamp' => $request->created_at,
                'user' => $request->user->full_name
            ];
        }

        // Sort activities by timestamp (most recent first)
        usort($activities, function ($a, $b) {
            return strtotime($b['timestamp']) - strtotime($a['timestamp']);
        });

        // Limit to 3 most recent activities
        return array_slice($activities, 0, 3);
    }

    public function getAttendanceByDate(Request $request)
    {
        $selectedDate = $request->input('date');
        $today = Carbon::today()->toDateString();
        $selectedCarbon = Carbon::parse($selectedDate);

        // Check if date is in the future
        if ($selectedCarbon->isFuture()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Impossible de générer un rapport pour une date future.'
            ]);
        }

        // Check if date is today and not finished
        if ($selectedDate === $today) {
            $now = Carbon::now('Africa/Casablanca');
            $midnight = Carbon::today()->addDay()->startOfDay();
            $hoursUntilMidnight = $now->diffInHours($midnight);
            $minutesUntilMidnight = $now->diffInMinutes($midnight) % 60;
            return response()->json([
                'status' => 'error',
                'message' => "Le jour n'est pas encore terminé. Attendez jusqu'à minuit (dans environ {$hoursUntilMidnight}h {$minutesUntilMidnight}min)."
            ]);
        }

        // Fetch attendance for the selected date
        $attendances = Attendance::with('user')
            ->where('date', $selectedDate)
            ->whereNotNull('clock_in')
            ->get();

        $attendanceData = [];
        foreach ($attendances as $attendance) {
            $clockIn = Carbon::parse($attendance->clock_in);
            $clockOut = $attendance->clock_out ? Carbon::parse($attendance->clock_out) : null;
            $status = $attendance->clock_out ? 'Terminé' : 'Incomplet';
            $hours = $clockOut ? $clockIn->diffInHours($clockOut, false) : 0;

            $attendanceData[] = [
                'user' => $attendance->user->full_name,
                'status' => $status,
                'clock_in' => $clockIn->format('H:i'),
                'clock_out' => $clockOut ? $clockOut->format('H:i') : 'Non pointé',
                'hours' => number_format($hours, 1)
            ];
        }

        return response()->json([
            'status' => 'success',
            'data' => $attendanceData,
            'selectedDate' => $selectedDate
        ]);
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

        // Active employees today
        $activeEmployees = Attendance::where('date', Carbon::today()->toDateString())
            ->distinct('user_id')
            ->count('user_id');

        // Total hours this month
        $totalHoursThisMonth = Attendance::whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->whereNotNull('clock_out')
            ->get()
            ->sum(function ($attendance) {
                return Carbon::parse($attendance->clock_in)->diffInHours(Carbon::parse($attendance->clock_out), false);
            });

        // Percentage change vs last month
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();
        $lastMonthActiveDays = Attendance::whereBetween('date', [$lastMonthStart, $lastMonthEnd])
            ->distinct('date', 'user_id')
            ->get()
            ->groupBy('date')
            ->map->count()
            ->avg();
        $percentChange = $lastMonthActiveDays > 0
            ? round(($activeEmployees - $lastMonthActiveDays) / $lastMonthActiveDays * 100, 1)
            : 0;

        // Daily hours for last 7 days
        $dailyHours = [];
        $dates = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $hours = Attendance::where('date', $date->toDateString())
                ->whereNotNull('clock_out')
                ->get()
                ->sum(function ($attendance) {
                    return Carbon::parse($attendance->clock_in)->diffInHours(Carbon::parse($attendance->clock_out), false);
                });
            $dailyHours[] = round($hours, 1);
            $dates[] = $date->format('D');
        }

        // Monthly average hours per employee (last 12 months)
        $monthlyHours = [];
        $months = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $totalHours = Attendance::whereMonth('date', $month->month)
                ->whereYear('date', $month->year)
                ->whereNotNull('clock_out')
                ->get()
                ->sum(function ($attendance) {
                    return Carbon::parse($attendance->clock_in)->diffInHours(Carbon::parse($attendance->clock_out), false);
                });
            $employeeCount = Attendance::whereMonth('date', $month->month)
                ->whereYear('date', $month->year)
                ->distinct('user_id')
                ->count('user_id');
            $avgHours = $employeeCount > 0 ? round($totalHours / $employeeCount, 1) : 0;
            $monthlyHours[] = $avgHours;
            $months[] = $month->format('M');
        }

        // Top performers (top 4 by hours this month)
        $topPerformers = Attendance::whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->whereNotNull('clock_out')
            ->join('users', 'attendances.user_id', '=', 'users.id')
            ->selectRaw('users.id, users.full_name, users.role, SUM(TIMESTAMPDIFF(HOUR, clock_in, clock_out)) as total_hours')
            ->groupBy('users.id', 'users.full_name', 'users.role')
            ->orderByDesc('total_hours')
            ->take(4)
            ->get()
            ->map(function ($employee) {
                $maxHours = Attendance::whereMonth('date', Carbon::now()->month)
                    ->whereYear('date', Carbon::now()->year)
                    ->whereNotNull('clock_out')
                    ->join('users', 'attendances.user_id', '=', 'users.id')
                    ->selectRaw('SUM(TIMESTAMPDIFF(HOUR, clock_in, clock_out)) as total_hours')
                    ->groupBy('users.id')
                    ->orderByDesc('total_hours')
                    ->first()
                    ->total_hours ?? 1;
                $score = round(($employee->total_hours / $maxHours) * 100, 1);
                return [
                    'name' => $employee->full_name,
                    'position' => $employee->role,
                    'department' => 'N/A', // Replace with department if available
                    'score' => $score,
                    'hours' => $employee->total_hours
                ];
            });

        return view('admin.statistics', [
            'user' => $user,
            'latestMessage' => null, // No message data available
            'activeEmployees' => $activeEmployees,
            'totalHoursThisMonth' => round($totalHoursThisMonth, 1),
            'percentChange' => $percentChange,
            'dailyHours' => $dailyHours,
            'dates' => $dates,
            'monthlyHours' => $monthlyHours,
            'months' => $months,
            'topPerformers' => $topPerformers
        ]);
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
        $users = User::all();
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

    //blackllist
    //  public function adminacc()
    // {
    //     if (!View::exists('admin.admacc')) {
    //         \Log::error('View admin.admacc not found.');
    //         return redirect()->route('dashboard')->with('error', 'Account view not found.');
    //     }

    //     $user = Auth::user();
    //     return view('admin.admacc', ['user' => $user]);
    // }
}