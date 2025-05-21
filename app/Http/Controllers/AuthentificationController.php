<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Leave_request;
use App\Models\Message;
use App\Models\ExpectedHours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\WelcomeEmployee;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AuthentificationController extends Controller
{
    public function Authent(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt([
            'username' => $request->username,
            'password' => $request->password
        ])) {
            $user = Auth::user();

            // Check if the user is blocked
            if ($user->status === 'blocked') {
                Auth::logout(); // Log the user out immediately
                return redirect()->route('signin')->with('error', 'Your account has been blocked. Please contact the administrator.');
            }
            $request->session()->regenerate();


            return $user->role === 'admin'
                ? redirect()->route('admin.tasks')
                : redirect()->route('Clock_In');
        }

        return back()->withErrors([
            'username' => 'Identifiants incorrects',
        ])->withInput($request->only('username'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'full_name' => 'required|string|max:255',
                'username' => 'required|string|max:50|unique:users,username',
                'email' => 'required|email|max:255|unique:users,email',
                'phone_number' => 'required|string|max:20|regex:/^\+?[1-9]\d{1,14}$/',
                'department' => 'required|string|in:Information Technology,Creative,Operations,Human Resources',
                'role' => 'required|string|in:Employee,Developer,Designer,Manager',
                'hire_date' => 'required|date|before_or_equal:today',
                'work_location' => 'required|string|max:255',
            ]);

            do {
                $number = mt_rand(1, 9999);
                $formattedNumber = str_pad($number, 4, '0', STR_PAD_LEFT);
                $employeeId = "EMP-{$formattedNumber}";
                $exists = User::where('employee_id', $employeeId)->exists();
            } while ($exists);

            $plainPassword = Str::random(12);
            $validatedData['employee_id'] = $employeeId;
            $validatedData['password'] = Hash::make($plainPassword);

            $user = User::create($validatedData);

            try {
                Mail::to($validatedData['email'])->send(new WelcomeEmployee($validatedData, $plainPassword));
            } catch (\Exception $e) {
                Log::error('Failed to send welcome email to ' . $validatedData['email'] . ': ' . $e->getMessage());
            }

            return redirect()->route('admin.employees')->with('success', 'Employee added successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to create employee: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to add employee: ' . $e->getMessage()]);
        }
    }

    public function employes()
    {
        $employees = User::all();
        return view('admin.Employes', compact('employees'));
    }

    public function destroy($id)
    {
        try {
            $employee = User::findOrFail($id);
            $employee->delete();
            return redirect()->route('admin.employees')->with('success', 'Employee deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete employee: ' . $e->getMessage());
            return redirect()->route('admin.employees')->with('error', 'Failed to delete employee.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $employee = User::findOrFail($id);

            $validatedData = $request->validate([
                'full_name' => 'required|string|max:255',
                'username' => 'required|string|max:50|unique:users,username,' . $employee->id,
                'email' => 'required|email|max:255|unique:users,email,' . $employee->id,
                'phone_number' => 'required|string|max:20|regex:/^\+?[1-9]\d{1,14}$/',
                'department' => 'required|string|in:Information Technology,Creative,Operations,Human Resources',
                'role' => 'required|string|in:Employee,Developer,Designer,Manager',
                'hire_date' => 'required|date|before_or_equal:today',
                'work_location' => 'required|string|max:255',
            ]);

            $employee->update($validatedData);

            return redirect()->route('admin.employees')->with('success', 'Employee updated successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to update employee: ' . $e->getMessage());
            return redirect()->route('admin.employees')->with('error', 'Failed to update employee: ' . $e->getMessage());
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'currentPassword' => 'required|string',
            'newPassword' => 'required|string|min:8',
            'confirmPassword' => 'required|string|same:newPassword',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->currentPassword, $user->password)) {
            return back()->withErrors(['currentPassword' => 'The current password is incorrect.']);
        }

        $user->password = Hash::make($request->newPassword);
        $user->save();

        return redirect()->route('employee.account')->with('success', 'Password updated successfully.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/signin');
    }

    public function storeLeaveRequest(Request $request)
    {
        $validatedData = $request->validate([
            'leave_type' => 'required|string|in:vacation,sick,personal',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'message' => 'required|string|max:1000',
            'certificate' => 'nullable|required_if:leave_type,sick|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        try {
            $data = [
                'user_id' => Auth::id(),
                'leave_type' => $validatedData['leave_type'],
                'start_date' => $validatedData['start_date'],
                'end_date' => $validatedData['end_date'],
                'message' => $validatedData['message'],
                'status' => 'pending',
            ];

            if ($request->hasFile('certificate')) {
                $path = $request->file('certificate')->store('certificates', 'public');
                $data['certificate_path'] = $path;
            }

            Leave_request::create($data);

            return redirect()->route('employee.leave')->with('success', 'Leave request submitted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to submit leave request: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to submit leave request.']);
        }
    }

    public function listRequests()
    {
        $requests = Leave_request::with('user')
            ->where('status', 'pending')
            ->get();
        return view('admin.Requests', compact('requests'));
    }

    public function listAllRequests()
    {
        $requests = Leave_request::with('user')->get();
        return view('admin.all-requests', compact('requests'));
    }

    public function approveRequest(Request $request, $id)
    {
        try {
            $leaveRequest = Leave_request::findOrFail($id);
            if ($leaveRequest->status !== 'pending') {
                return redirect()->route('requests')->with('error', 'Request is already processed.');
            }
            $leaveRequest->update(['status' => 'approved']);
            return redirect()->route('requests')->with('success', 'Request approved successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to approve request: ' . $e->getMessage());
            return redirect()->route('requests')->with('error', 'Failed to approve request.');
        }
    }

    public function denyRequest(Request $request, $id)
    {
        try {
            $leaveRequest = Leave_request::findOrFail($id);
            if ($leaveRequest->status !== 'pending') {
                return redirect()->route('requests')->with('error', 'Request is already processed.');
            }
            $leaveRequest->update(['status' => 'denied']);
            return redirect()->route('requests')->with('success', 'Request denied successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to deny request: ' . $e->getMessage());
            return redirect()->route('requests')->with('error', 'Failed to deny request.');
        }
    }

    public function myAccount()
    {
        $user = Auth::user();
        return view('admin.admacc', compact('user'));
    }

    public function showSendMessageForm()
    {
        $users = User::all();
        return view('admin.message', compact('users'));
    }

    public function storeMessage(Request $request)
    {
        $validatedData = $request->validate([
            'recipientType' => 'required|in:all,name,department',
            'recipientName' => 'required_if:recipientType,name|exists:users,id',
            'recipientDept' => 'required_if:recipientType,department|in:Information Technology,Creative,Operations,Human Resources',
            'messageContent' => 'required|string|max:1000',
        ]);

        $recipients = [];
        if ($validatedData['recipientType'] === 'all') {
            $recipients = User::pluck('id')->toArray();
        } elseif ($validatedData['recipientType'] === 'name') {
            $recipients = [$validatedData['recipientName']];
        } else {
            $recipients = [json_encode([$validatedData['recipientDept']])];
        }

        Message::create([
            'sender_id' => Auth::id(),
            'recipients' => json_encode($recipients),
            'content' => $validatedData['messageContent'],
        ]);

        return redirect()->route('send.message')->with('success', 'Message sent successfully.');
    }

    public function getUserMessages()
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

        return $messages;
    }

    public function showSetProfilePictureForm()
    {
        return view('employee.set-profile-picture');
    }

    public function storeProfilePicture(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();
        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
                Log::info('Old photo deleted: ' . $user->profile_photo_path);
            }

            $fileName = time() . '_' . $request->file('profile_photo')->getClientOriginalName();
            $path = $request->file('profile_photo')->storeAs('profile_photos', $fileName, 'public');
            Log::info('New photo stored at: ' . $path);

            $user->profile_photo_path = $path;
            if ($user->save()) {
                Log::info('User profile_photo_path updated to: ' . $user->profile_photo_path);
            } else {
                Log::error('Failed to save user profile_photo_path');
                return redirect()->route('set.profile.picture')->with('error', 'Failed to update profile picture. Please try again.');
            }
        } else {
            Log::warning('No file uploaded in the request');
            return redirect()->route('set.profile.picture')->with('error', 'No file was uploaded.');
        }

        return redirect()->route('Clock_In')->with('success', 'Profile picture updated successfully.');
    }

    public function showSetExpectedHoursForm()
    {
        $latestExpectedHours = ExpectedHours::orderBy('week_start_date', 'desc')->first();
        $allExpectedHours = ExpectedHours::orderBy('week_start_date', 'desc')->get();
        return view('admin.set-expected-hours', compact('latestExpectedHours', 'allExpectedHours'));
    }

    public function storeExpectedHours(Request $request)
    {
        $validatedData = $request->validate([
            'week_start_date' => 'required|date',
            'monday_start_time' => 'nullable|date_format:H:i',
            'monday_end_time' => 'nullable|date_format:H:i|after:monday_start_time',
            'tuesday_start_time' => 'nullable|date_format:H:i',
            'tuesday_end_time' => 'nullable|date_format:H:i|after:tuesday_start_time',
            'wednesday_start_time' => 'nullable|date_format:H:i',
            'wednesday_end_time' => 'nullable|date_format:H:i|after:wednesday_start_time',
            'thursday_start_time' => 'nullable|date_format:H:i',
            'thursday_end_time' => 'nullable|date_format:H:i|after:thursday_start_time',
            'friday_start_time' => 'nullable|date_format:H:i',
            'friday_end_time' => 'nullable|date_format:H:i|after:friday_start_time',
            'saturday_start_time' => 'nullable|date_format:H:i',
            'saturday_end_time' => 'nullable|date_format:H:i|after:saturday_start_time',
            'sunday_start_time' => 'nullable|date_format:H:i',
            'sunday_end_time' => 'nullable|date_format:H:i|after:sunday_start_time',
        ]);

        $weekStartDate = Carbon::parse($validatedData['week_start_date']);
        if ($weekStartDate->dayOfWeek !== Carbon::MONDAY) {
            return redirect()->back()->with('error', 'Week start date must be a Monday.');
        }

        $existing = ExpectedHours::where('week_start_date', $weekStartDate->toDateString())->first();
        if ($existing) {
            $existing->update($validatedData);
            return redirect()->route('set.expected.hours')->with('success', 'Expected hours updated successfully.');
        }

        // Create a new entry
        ExpectedHours::create($validatedData);
        return redirect()->route('set.expected.hours')->with('success', 'Expected hours set successfully.');
    }

    public function downloadCertificate($id)
    {
        $request = Leave_request::findOrFail($id);
        if ($request->certificate_path && file_exists(storage_path('app/public/' . $request->certificate_path))) {
            return response()->download(storage_path('app/public/' . $request->certificate_path));
        }
        return redirect()->back()->with('error', 'Certificate not found.');
    }


    //blacklist

    public function blacklist()
    {
        $blacklistedUsers = User::where('status', 'blocked')->get();
        $availableUsers = User::where('status', 'active')->get();
        return view('admin.blacklist', compact('blacklistedUsers', 'availableUsers'));
    }

    public function addToBlacklist(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);
        try {
            $user = User::findOrFail($request->user_id);
            if ($user->status === 'active') {
                $user->update(['status' => 'blocked']);
                return redirect()->route('blacklist')->with('success', 'User added to blacklist successfully.');
            }
            return redirect()->route('blacklist')->with('error', 'User is already blacklisted.');
        } catch (\Exception $e) {
            Log::error('Failed to add user to blacklist: ' . $e->getMessage());
            return redirect()->route('blacklist')->with('error', 'Failed to add user to blacklist.');
        }
    }

    public function removeFromBlacklist($userId)
    {
        try {
            $user = User::findOrFail($userId);
            if ($user->status === 'blocked') {
                $user->update(['status' => 'active']);
                return redirect()->route('blacklist')->with('success', 'User removed from blacklist successfully.');
            }
            return redirect()->route('blacklist')->with('error', 'User is not blacklisted.');
        } catch (\Exception $e) {
            Log::error('Failed to remove user from blacklist: ' . $e->getMessage());
            return redirect()->route('blacklist')->with('error', 'Failed to remove user from blacklist.');
        }
    }


}