<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\WelcomeEmployee;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class LeaveRequest extends Controller
{


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

            LeaveRequest::create($data);

            return redirect()->route('employee.leave')->with('success', 'Leave request submitted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to submit leave request: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to submit leave request.']);
        }
    }

}