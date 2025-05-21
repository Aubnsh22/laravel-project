<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClockController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AuthentificationController;
use App\Http\Controllers\PasswordResetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
|
*/

// Password Reset Routes
Route::get('/forgot-password', [AuthentificationController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthentificationController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [AuthentificationController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthentificationController::class, 'resetPassword'])->name('password.update');
Route::post('/reset-password', [PasswordResetController::class, 'sendResetCode'])->name('reset-password');
Route::patch('/reset-password', [PasswordResetController::class, 'verifyResetCode']);
Route::delete('/reset-password', [PasswordResetController::class, 'updatePassword']);

// Auth Routes
Route::post('/signin', [AuthentificationController::class, 'Authent'])->name('login');
Route::post('/logout', [AuthentificationController::class, 'logout'])->name('logout');

// Welcome and Login Routes
Route::get('/welcome', [WelcomeController::class, 'Welcome'])->name('welcome');
Route::get('/signin', [WelcomeController::class, 'Sign_In'])->name('signin');

// Employee Routes
Route::middleware('auth')->group(function () {
    // Clock-In/Out Routes
    Route::get('/Clock-In', [ClockController::class, 'showClockIn'])->name('Clock_In');
    Route::post('/Clock-In', [ClockController::class, 'storeClockIn']);
    Route::get('/Clock-Out', [ClockController::class, 'showClockOut'])->name('Clock_Out');
    Route::post('/Clock-Out', [ClockController::class, 'storeClockOut']);

    // Leave management routes
    Route::get('/leave', [LeaveRequest::class, 'index'])->name('employee.leave');
    Route::post('/leave', [LeaveRequest::class, 'store'])->name('leave.store');
    Route::get('/leave/{id}/edit', [LeaveRequest::class, 'edit'])->name('leave.edit');
    Route::put('/leave/{id}', [LeaveRequest::class, 'update'])->name('leave.update');
    Route::delete('/leave/{id}', [LeaveRequest::class, 'destroy'])->name('leave.delete');

    // History, Stats, Settings, Account, and Tasks routes
    Route::get('/history', [ClockController::class, 'History'])->name('employee.history');
    Route::get('/stats', [ClockController::class, 'Stats'])->name('employee.stats');
    Route::get('/settings', [ClockController::class, 'Settings'])->name('employee.setting');
    Route::get('/myaccount', [ClockController::class, 'MyAccount'])->name('employee.account');
    Route::get('/tasks', [ClockController::class, 'Tasks'])->name('employee.tasks');

    // Password and profile picture routes
    Route::post('/password/update', [AuthentificationController::class, 'changePassword'])->name('password.update');
    Route::get('/set-profile-picture', [AuthentificationController::class, 'showSetProfilePictureForm'])->name('set.profile.picture');
    Route::post('/set-profile-picture', [AuthentificationController::class, 'storeProfilePicture'])->name('store.profile.picture');
});

// Admin routes (protected by auth middleware)
Route::middleware('auth')->group(function () {
    Route::get('/sign', [AdminController::class, 'index'])->name('login');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/employees', [AuthentificationController::class, 'employes'])->name('admin.employees');
    Route::get('/tasksadmin', [AdminController::class, 'Tasks'])->name('admin.tasks');
    Route::get('/requests', [AuthentificationController::class, 'listRequests'])->name('requests');
    Route::post('/requests/{id}/approve', [AuthentificationController::class, 'approveRequest'])->name('requests.approve');
    Route::post('/requests/{id}/deny', [AuthentificationController::class, 'denyRequest'])->name('requests.deny');
    Route::get('/requests/{id}/download', [AuthentificationController::class, 'downloadCertificate'])->name('request.download');
    Route::get('/all-requests', [AuthentificationController::class, 'listAllRequests'])->name('all.requests');
    Route::get('/statistics', [AdminController::class, 'Stats'])->name('statistics');
    Route::get('/settingsadmin', [AdminController::class, 'setting'])->name('settings');
    Route::get('/myaccountt', [AuthentificationController::class, 'myAccount'])->name('myaccountt');
    Route::post('/employees', [AuthentificationController::class, 'store'])->name('employee.store');
    Route::delete('/employees/{id}', [AuthentificationController::class, 'destroy'])->name('employee.destroy');
    Route::put('/employees/{id}', [AuthentificationController::class, 'update'])->name('employee.update');

    // Message Routes
    Route::get('/sendmessage', [AuthentificationController::class, 'showSendMessageForm'])->name('send.message');
    Route::post('/sendmessage', [AuthentificationController::class, 'storeMessage'])->name('messages.store');

    // Expected Hours Routes
    Route::get('/set-expected-hours', [AuthentificationController::class, 'showSetExpectedHoursForm'])->name('set.expected.hours');
    Route::post('/store-expected-hours', [AuthentificationController::class, 'storeExpectedHours'])->name('store.expected.hours');
    Route::delete('/expected-hours/{id}', [AuthentificationController::class, 'deleteExpectedHours'])->name('delete.expected.hours');

    // Attendance by Date Route
    Route::post('/get-attendance-by-date', [AdminController::class, 'getAttendanceByDate'])->name('get-attendance-by-date');
});

// Admin Message Route
Route::get('/message', [AdminController::class, 'msg'])->name('admin.message')->middleware('auth');

?>
