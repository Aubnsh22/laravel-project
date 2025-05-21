<?php

namespace App\Http\Controllers;

use App\Models\Leave_request as LeaveRequestModel; // Correct model import with alias
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveRequest extends Controller
{
    public function index()
    {
        $leaveRequests = LeaveRequestModel::where('user_id', Auth::id())->get();
        return view('employee.LEAVE', compact('leaveRequests'));
    }

    public function store(Request $request)
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

            LeaveRequestModel::create($data);

            return redirect()->route('employee.leave')->with('success', 'Leave request submitted successfully.');
        } catch (\Exception $e) {
            \Log::error('Failed to submit leave request: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to submit leave request.']);
        }
    }

    public function edit($id)
    {
        $leaveRequest = LeaveRequestModel::findOrFail($id);
        if ($leaveRequest->user_id !== Auth::id()) {
            return redirect()->route('employee.leave')->with('error', 'Unauthorized action.');
        }
        $leaveRequests = LeaveRequestModel::where('user_id', Auth::id())->get();
        return view('employee.LEAVE', compact('leaveRequest', 'leaveRequests'));
    }

    public function update(Request $request, $id)
    {
        $leaveRequest = LeaveRequestModel::findOrFail($id);
        if ($leaveRequest->user_id !== Auth::id()) {
            return redirect()->route('employee.leave')->with('error', 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'leave_type' => 'required|string|in:vacation,sick,personal',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'message' => 'required|string|max:1000',
            'certificate' => 'nullable|required_if:leave_type,sick|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $data = [
            'leave_type' => $validatedData['leave_type'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'message' => $validatedData['message'],
        ];

        if ($request->hasFile('certificate')) {
            $path = $request->file('certificate')->store('certificates', 'public');
            $data['certificate_path'] = $path;
        }

        $leaveRequest->update($data);
        return redirect()->route('employee.leave')->with('success', 'Leave request updated successfully.');
    }

    public function destroy($id)
    {
        $leaveRequest = LeaveRequestModel::findOrFail($id);
        if ($leaveRequest->user_id !== Auth::id()) {
            return redirect()->route('employee.leave')->with('error', 'Unauthorized action.');
        }

        $leaveRequest->delete();
        return redirect()->route('employee.leave')->with('success', 'Leave request deleted successfully.');
    }
}