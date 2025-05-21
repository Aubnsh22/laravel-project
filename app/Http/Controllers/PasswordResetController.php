<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\PasswordResetToken;
use App\Mail\PasswordResetMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function sendResetCode(Request $request)
    {
        // Validate the email input
        $request->validate([
            'email' => 'required|email'
        ]);

        // Check if email exists in the users table
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No user found with this email address.']);
        }

        // Generate a 6-digit code
        $code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        // Store the reset code in password_reset_tokens table
        PasswordResetToken::updateOrCreate(
            ['email' => $request->email],
            [
                'email' => $request->email,
                'token' => $code,
                'created_at' => now()
            ]
        );

        // Send the email with the reset code
        Mail::to($request->email)->send(new PasswordResetMail($code));


        // Return the resetpassword view
        return view('codeforpassword', ['email' => $request->email]);
    }

    public function verifyResetCode(Request $request)
    {
        // Validate the code input
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|digits:6'
        ]);

        // Check if the code is valid
        $token = PasswordResetToken::where('email', $request->email)
            ->where('token', $request->code)
            ->where('created_at', '>=', now()->subMinutes(60)) // Code expires after 60 minutes
            ->first();

        if (!$token) {
            return back()->withErrors(['code' => 'Invalid or expired code.']);
        }

        // Code is valid, redirect to a password update page or handle password reset
        // For simplicity, we'll assume a success message here
        return view('newpassword',['email'=>$request->email])->with('status', 'Code verified! You can now reset your password.');
    }


    public function updatePassword(Request $request)
    {

        // Validate the new password
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        // Find the user
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No user found with this email address.']);
        }

        // Update the user's password
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        // Delete the reset token
        PasswordResetToken::where('email', $request->email)->delete();

        // Redirect to login with success message
        return redirect()->route('signin')->with('status', 'Password updated successfully! Please log in.');
    }
}