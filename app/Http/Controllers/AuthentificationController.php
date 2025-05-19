<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            $user = Auth::user(); // Récupérer l'utilisateur connecté
            
            return $user->role === 'Administrateur' 
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

            $validatedData['employee_id'] = $employeeId;
            $validatedData['password'] = Hash::make(Str::random(12));

            User::create($validatedData);

            return redirect()->route('admin.employees')->with('success', 'Employee added successfully.');
        } catch (\Exception $e) {
            \Log::error('Failed to create employee: ' . $e->getMessage());
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
            \Log::error('Failed to delete employee: ' . $e->getMessage());
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
            \Log::error('Failed to update employee: ' . $e->getMessage());
            return redirect()->route('admin.employees')->with('error', 'Failed to update employee: ' . $e->getMessage());
        }
    }
}