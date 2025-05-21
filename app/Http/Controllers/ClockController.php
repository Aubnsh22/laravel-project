<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use App\Models\Attendance;
use App\Models\ExpectedHours;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;

class ClockController extends Controller
{
    // Helper method to get the expected hours for today
    private function getTodayExpectedHours()
    {
        $today = Carbon::today('Africa/Casablanca');
        $weekStart = $today->copy()->startOfWeek(Carbon::MONDAY);
        $expectedHours = ExpectedHours::where('week_start_date', $weekStart->toDateString())->first();

        \Log::info('Current Date: ' . $today->toDateString());
        \Log::info('Week Start Date: ' . $weekStart->toDateString());
        \Log::info('Expected Hours: ' . json_encode($expectedHours));

        if (!$expectedHours) {
            \Log::warning('No expected hours found for week starting: ' . $weekStart->toDateString());
            return null;
        }

        $dayName = strtolower($today->format('l'));
        return $expectedHours->getTimesForDay($dayName);
    }

    // Helper method to get user messages
    private function getUserMessages()
    {
        $user = Auth::user();
        if (!$user) {
            return collect([]);
        }
        $messages = Message::with('sender')
            ->where(function ($query) use ($user) {
                $query->whereJsonContains('recipients', $user->id)
                      ->orWhereJsonContains('recipients', json_encode([$user->department]))
                      ->orWhere('recipients', json_encode(User::pluck('id')->toArray()));
            })
            ->orderBy('sent_at', 'desc')
            ->take(5)
            ->get();

        $messages->each(function ($message) {
            $message->sent_at_human = Carbon::parse($message->sent_at, 'Africa/Casablanca')->diffForHumans();
        });

        return $messages;
    }

    // Display Clock-In page
    public function showClockIn()
    {
        if (!View::exists('employee.CLOCK-IN')) {
            \Log::error('View employee.CLOCK-IN not found.');
            return redirect()->route('welcome')->with('error', 'Clock-In view not found.');
        }

        $user = Auth::user();
        $today = Carbon::today('Africa/Casablanca');
        $attendance = Attendance::where('user_id', $user->id)
            ->where('date', $today->toDateString())
            ->first();

        $messages = $this->getUserMessages();

        $isClockedIn = $attendance ? $attendance->isClockedIn() : false;
        $hasClockedOut = $attendance && $attendance->clock_out !== null;

        $expectedTimes = $this->getTodayExpectedHours();
        $timeMessage = null;

        if ($hasClockedOut) {
            $nextDay = $today->copy()->addDay()->format('F j, Y');
            $timeMessage = "You have already clocked in and out today. Please wait until tomorrow, $nextDay, to clock in again.";
        } elseif ($expectedTimes && $expectedTimes['start_time'] && $expectedTimes['end_time']) {
            $startTime = Carbon::parse($expectedTimes['start_time'], 'Africa/Casablanca');
            $endTime = Carbon::parse($expectedTimes['end_time'], 'Africa/Casablanca');
            $now = Carbon::now('Africa/Casablanca');

            \Log::info('Clock-In - Current Time: ' . $now->toDateTimeString());
            \Log::info('Clock-In - Start Time: ' . $startTime->toDateTimeString());
            \Log::info('Clock-In - End Time: ' . $endTime->toDateTimeString());

            if ($now->lt($startTime)) {
                $timeMessage = "It's too early to clock in. Please wait until " . $startTime->format('h:i A') . ".";
            } elseif ($now->gt($endTime)) {
                $timeMessage = "It's too late to clock in. The clock-in window closed at " . $endTime->format('h:i A') . ".";
            }
        }

        return view('employee.CLOCK-IN', [
            'user' => $user,
            'messages' => $messages,
            'isClockedIn' => $isClockedIn,
            'attendance' => $attendance,
            'timeMessage' => $timeMessage,
            'expectedTimes' => $expectedTimes,
        ]);
    }

    // Process Clock-In action
    public function storeClockIn(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today('Africa/Casablanca');
        $now = Carbon::now('Africa/Casablanca');

        $attendance = Attendance::where('user_id', $user->id)
            ->where('date', $today->toDateString())
            ->first();

        if ($attendance && $attendance->clock_out !== null) {
            $nextDay = $today->copy()->addDay()->format('F j, Y');
            return redirect()->route('Clock_In')->with('error', "You have already clocked in and out today. Please wait until tomorrow, $nextDay, to clock in again.");
        }

        $expectedTimes = $this->getTodayExpectedHours();
        if ($expectedTimes && $expectedTimes['start_time'] && $expectedTimes['end_time']) {
            $startTime = Carbon::parse($expectedTimes['start_time'], 'Africa/Casablanca');
            $endTime = Carbon::parse($expectedTimes['end_time'], 'Africa/Casablanca');

            \Log::info('Store Clock-In - Current Time: ' . $now->toDateTimeString());
            \Log::info('Store Clock-In - Start Time: ' . $startTime->toDateTimeString());
            \Log::info('Store Clock-In - End Time: ' . $endTime->toDateTimeString());

            if ($now->lt($startTime)) {
                return redirect()->route('Clock_In')->with('error', 'It\'s too early to clock in. Please wait until ' . $startTime->format('h:i A') . '.');
            } elseif ($now->gt($endTime)) {
                return redirect()->route('Clock_In')->with('error', 'It\'s too late to clock in. The clock-in window closed at ' . $endTime->format('h:i A') . '.');
            }
        }

        if (!$attendance) {
            Attendance::create([
                'user_id' => $user->id,
                'date' => $today,
                'status' => 'present',
                'clock_in' => $now->toTimeString(),
            ]);
            \Log::info('Clocked in for user ID: ' . $user->id . ' at ' . $now->toDateTimeString());
        } else {
            \Log::info('User ID: ' . $user->id . ' already clocked in today.');
        }

        return redirect()->route('Clock_In')->with('success', 'Successfully clocked in.');
    }

    // Display Clock-Out page
    public function showClockOut()
    {
        if (!View::exists('employee.CLOCK-OUT')) {
            \Log::error('View employee.CLOCK-OUT not found.');
            return redirect()->route('Clock_In')->with('error', 'Clock-Out view not found.');
        }

        $user = Auth::user();
        $today = Carbon::today('Africa/Casablanca');
        $attendance = Attendance::where('user_id', $user->id)
            ->where('date', $today->toDateString())
            ->first();

        $messages = $this->getUserMessages();

        $isClockedIn = $attendance ? $attendance->isClockedIn() : false;

        $expectedTimes = $this->getTodayExpectedHours();
        $timeMessage = null;
        if ($expectedTimes && $expectedTimes['start_time'] && $expectedTimes['end_time']) {
            $startTime = Carbon::parse($expectedTimes['start_time'], 'Africa/Casablanca');
            $endTime = Carbon::parse($expectedTimes['end_time'], 'Africa/Casablanca');
            $now = Carbon::now('Africa/Casablanca');

            \Log::info('Clock-Out - Current Time: ' . $now->toDateTimeString());
            \Log::info('Clock-Out - Start Time: ' . $startTime->toDateTimeString());
            \Log::info('Clock-Out - End Time: ' . $endTime->toDateTimeString());

            if ($now->lt($startTime)) {
                $timeMessage = "It's too early to clock out. Please wait until " . $startTime->format('h:i A') . ".";
            }
        }

        return view('employee.CLOCK-OUT', [
            'user' => $user,
            'messages' => $messages,
            'isClockedIn' => $isClockedIn,
            'attendance' => $attendance,
            'timeMessage' => $timeMessage,
            'expectedTimes' => $expectedTimes,
        ]);
    }

    // Process Clock-Out action
    public function storeClockOut(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today('Africa/Casablanca');
        $now = Carbon::now('Africa/Casablanca');

        $expectedTimes = $this->getTodayExpectedHours();
        if ($expectedTimes && $expectedTimes['start_time'] && $expectedTimes['end_time']) {
            $startTime = Carbon::parse($expectedTimes['start_time'], 'Africa/Casablanca');
            $endTime = Carbon::parse($expectedTimes['end_time'], 'Africa/Casablanca');

            \Log::info('Store Clock-Out - Current Time: ' . $now->toDateTimeString());
            \Log::info('Store Clock-Out - Start Time: ' . $startTime->toDateTimeString());
            \Log::info('Store Clock-Out - End Time: ' . $endTime->toDateTimeString());

            if ($now->lt($startTime)) {
                return redirect()->route('Clock_Out')->with('error', 'It\'s too early to clock out. Please wait until ' . $startTime->format('h:i A') . '.');
            }
        }

        $attendance = Attendance::where('user_id', $user->id)
            ->where('date', $today->toDateString())
            ->first();

        if ($attendance && $attendance->isClockedIn()) {
            $attendance->update([
                'clock_out' => $now->toTimeString(),
            ]);
            \Log::info('Clocked out for user ID: ' . $user->id . ' at ' . $now->toDateTimeString());
        } else {
            \Log::info('User ID: ' . $user->id . ' either not clocked in or already clocked out today.');
            return redirect()->route('Clock_Out')->with('error', 'You are not clocked in.');
        }

        return redirect()->route('Clock_In')->with('success', 'Successfully clocked out.');
    }

    // Display Leave page
    public function Leave()
    {
        if (!View::exists('employee.LEAVE')) {
            \Log::error('View employee.LEAVE not found.');
            return redirect()->route('Clock_In')->with('error', 'Leave view not found.');
        }

        $user = Auth::user();
        $messages = $this->getUserMessages();

        return view('employee.LEAVE', [
            'user' => $user,
            'messages' => $messages
        ]);
    }

    // Display Stats page
    public function Stats()
    {
        if (!View::exists('employee.STATS')) {
            \Log::error('View employee.STATS not found.');
            return redirect()->route('Clock_In')->with('error', 'Stats view not found.');
        }

        $user = Auth::user();
        $today = Carbon::today('Africa/Casablanca');
        $currentMonth = $today->copy()->startOfMonth();
        $currentWeekStart = $today->copy()->startOfWeek(Carbon::MONDAY);
        $lastWeekStart = $currentWeekStart->copy()->subWeek();
        $lastWeekEnd = $lastWeekStart->copy()->endOfWeek(Carbon::SUNDAY);

        $attendances = Attendance::where('user_id', $user->id)
            ->where('date', '>=', $currentMonth->toDateString())
            ->orderBy('date', 'asc')
            ->get();

        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $hoursPerDay = array_fill(0, 7, 0);
        foreach ($attendances as $attendance) {
            if ($attendance->date >= $currentWeekStart && $attendance->date <= $today) {
                $dayIndex = Carbon::parse($attendance->date, 'Africa/Casablanca')->dayOfWeekIso - 1;
                if ($attendance->clock_in && !$attendance->clock_out) {
                    $hoursPerDay[$dayIndex] = Carbon::parse($attendance->clock_in, 'Africa/Casablanca')->diffInHours(Carbon::now('Africa/Casablanca'));
                } elseif ($attendance->clock_in && $attendance->clock_out) {
                    try {
                        $hoursPerDay[$dayIndex] = $attendance->hoursWorked();
                    } catch (\Exception $e) {
                        \Log::error('Error calculating hoursWorked for attendance ID: ' . $attendance->id . '. Error: ' . $e->getMessage());
                        $hoursPerDay[$dayIndex] = 0;
                    }
                }
            }
        }

        $completeDays = $attendances->filter(function ($attendance) {
            return $attendance->clock_in && $attendance->clock_out;
        });

        $totalHoursMonth = $attendances->sum(function ($attendance) {
            if ($attendance->clock_in && !$attendance->clock_out) {
                return Carbon::parse($attendance->clock_in, 'Africa/Casablanca')->diffInHours(Carbon::now('Africa/Casablanca'));
            }
            try {
                return $attendance->hoursWorked();
            } catch (\Exception $e) {
                \Log::error('Error in total hours calculation for attendance ID: ' . $attendance->id . '. Error: ' . $e->getMessage());
                return 0;
            }
        });

        $daysWorked = $completeDays->count();
        $dailyAverage = $daysWorked > 0 ? $totalHoursMonth / $daysWorked : 0;

        $lastWeekAttendances = Attendance::where('user_id', $user->id)
            ->whereBetween('date', [$lastWeekStart->toDateString(), $lastWeekEnd->toDateString()])
            ->get();
        $lastWeekHours = $lastWeekAttendances->sum(function ($attendance) {
            try {
                return $attendance->hoursWorked();
            } catch (\Exception $e) {
                return 0;
            }
        });
        $lastWeekDays = $lastWeekAttendances->filter(function ($attendance) {
            return $attendance->clock_in && $attendance->clock_out;
        })->count();
        $lastWeekAverage = $lastWeekDays > 0 ? $lastWeekHours / $lastWeekDays : 0;
        $weeklyChange = $lastWeekAverage > 0 ? (($dailyAverage - $lastWeekAverage) / $lastWeekAverage) * 100 : 0;

        $employees = [
            ['name' => 'Sophie Martin', 'position' => 'Développeuse Fullstack', 'score' => 94, 'trend' => 'up'],
            ['name' => 'Thomas Leroy', 'position' => 'UX Designer', 'score' => 89, 'trend' => 'down'],
            ['name' => $user->full_name, 'position' => $user->role ?? 'Développeur Backend', 'score' => 87, 'trend' => 'up', 'you' => true],
            ['name' => 'Julie Bernard', 'position' => 'Product Manager', 'score' => 85, 'trend' => 'up'],
            ['name' => 'Nicolas Petit', 'position' => 'Développeur Frontend', 'score' => 82, 'trend' => 'stable'],
            ['name' => 'Amélie Dupont', 'position' => 'QA Engineer', 'score' => 80, 'trend' => 'down'],
        ];

        $messages = $this->getUserMessages();

        return view('employee.STATS', [
            'user' => $user,
            'messages' => $messages,
            'dailyAverage' => number_format($dailyAverage, 1),
            'totalHoursMonth' => number_format($totalHoursMonth, 1),
            'weeklyChange' => number_format($weeklyChange, 0),
            'hoursPerDay' => $hoursPerDay,
            'employees' => $employees,
        ]);
    }

    // Display Settings page
    public function Settings()
    {
        if (!View::exists('employee.SETTINGS')) {
            \Log::error('View employee.SETTINGS not found.');
            return redirect()->route('Clock_In')->with('error', 'Settings view not found.');
        }

        $user = Auth::user();
        $messages = $this->getUserMessages();

        return view('employee.SETTINGS', [
            'user' => $user,
            'messages' => $messages
        ]);
    }

    // Display My Account page
    public function MyAccount()
    {
        if (!View::exists('employee.MYACCOUNT')) {
            \Log::error('View employee.MYACCOUNT not found.');
            return redirect()->route('Clock_In')->with('error', 'My Account view not found.');
        }

        $user = Auth::user();
        $messages = $this->getUserMessages();

        return view('employee.MYACCOUNT', [
            'user' => $user,
            'messages' => $messages
        ]);
    }

    // Display Tasks page
    public function Tasks()
    {
        if (!View::exists('employee.TASKS')) {
            \Log::error('View employee.TASKS not found.');
            return redirect()->route('Clock_In')->with('error', 'Tasks view not found.');
        }

        $user = Auth::user();
        $messages = $this->getUserMessages();

        return view('employee.TASKS', [
            'user' => $user,
            'messages' => $messages
        ]);
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