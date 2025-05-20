<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClockController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AuthentificationController;

// Auth
Route::post('/signin', [AuthentificationController::class, 'Authent'])->name('login');
Route::post('/logout', [AuthentificationController::class, 'logout'])->name('logout');

// Welcome + Login
Route::get('/welcome', [WelcomeController::class, 'Welcome'])->name('welcome');
Route::get('/signin', [WelcomeController::class, 'Sign_In'])->name('signin');

// Employee
Route::middleware('auth')->group(function () {
    // Clock-In routes
    Route::get('/Clock-In', [ClockController::class, 'showClockIn'])->name('Clock_In');
    Route::post('/Clock-In', [ClockController::class, 'storeClockIn']);

    Route::get('/Clock-Out', [ClockController::class, 'showClockOut'])->name('Clock_Out');
    Route::post('/Clock-Out', [ClockController::class, 'storeClockOut']);

    Route::get('/leave', function () {
        return view('employee.LEAVE');
    })->name('employee.leave');
    Route::post('/leave', [AuthentificationController::class, 'storeLeaveRequest'])->name('leave.store');
    Route::get('/history', [ClockController::class, 'History'])->name('employee.history');
    Route::get('/stats', [ClockController::class, 'Stats'])->name('employee.stats');
    Route::get('/settings', [ClockController::class, 'Settings'])->name('employee.setting');
    Route::get('/myaccount', [ClockController::class, 'MyAccount'])->name('employee.account');
    Route::get('/tasks', [ClockController::class, 'Tasks'])->name('employee.tasks');
    Route::post('/password/update', [AuthentificationController::class, 'changePassword'])->name('password.update');
    Route::get('/set-profile-picture', [AuthentificationController::class, 'showSetProfilePictureForm'])->name('set.profile.picture');
    Route::post('/set-profile-picture', [AuthentificationController::class, 'storeProfilePicture'])->name('store.profile.picture');
});

// Admin
Route::middleware('auth')->group(function () {
    Route::get('/sign', [AdminController::class, 'index']);
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/employees', [AuthentificationController::class, 'employes'])->name('admin.employees');
    Route::get('/tasksadmin', [AdminController::class, 'Tasks'])->name('admin.tasks');
    Route::get('/requests', [AuthentificationController::class, 'listRequests'])->name('requests');
    Route::post('/requests/{id}/approve', [AuthentificationController::class, 'approveRequest'])->name('requests.approve');
    Route::post('/requests/{id}/deny', [AuthentificationController::class, 'denyRequest'])->name('requests.deny');
    Route::get('/statistics', [AdminController::class, 'Stats'])->name('statistics');
    Route::get('/settingsadmin', [AdminController::class, 'setting'])->name('settings');
    Route::get('/myaccountt', [AuthentificationController::class, 'myAccount'])->name('myaccountt');
    Route::post('/employees', [AuthentificationController::class, 'store'])->name('employee.store');
    Route::delete('/employees/{id}', [AuthentificationController::class, 'destroy'])->name('employee.destroy');
    Route::put('/employees/{id}', [AuthentificationController::class, 'update'])->name('employee.update');

    #message
    Route::get('/sendmessage', [AuthentificationController::class, 'showSendMessageForm'])->name('send.message');
    Route::post('/sendmessage', [AuthentificationController::class, 'storeMessage'])->name('messages.store');

    # Expected Hours
    Route::get('/set-expected-hours', [AuthentificationController::class, 'showSetExpectedHoursForm'])->name('set.expected.hours');
    Route::post('/set-expected-hours', [AuthentificationController::class, 'storeExpectedHours'])->name('store.expected.hours');
});

Route::get('/message', [AdminController::class, 'msg'])->name('admin.message')->middleware('auth');