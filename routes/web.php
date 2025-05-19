<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClockController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AuthentificationController;

//auth
Route::post('/login', [AuthentificationController::class, 'Authent'])->name('login');

//welcome+login
Route::get('/welcome', [WelcomeController::class, 'Welcome'])->name('welcome');
Route::get('/signin', [WelcomeController::class, 'Sign_In']);
Route::post('/login', [AuthentificationController::class, 'Authent'])->name('login');
Route::post('/logout', [AuthentificationController::class, 'logout'])->name('logout');

//employee
Route::get('/Clock_In', [ClockController::class, 'Clocking_In'])->name('Clock_In');
Route::get('/Clock_Out', [ClockController::class, 'Clocking_Out']);
Route::get('/leave', [ClockController::class, 'Leave']);
Route::get('/history', [ClockController::class, 'History']);
Route::get('/stats', [ClockController::class, 'Stats']);
Route::get('/settings', [ClockController::class, 'Settings']);
Route::get('/myaccount', [ClockController::class, 'MyAccount']);
Route::get('/tasks', [ClockController::class, 'Tasks'])->name('employee.tasks');

//admin
Route::get('/sign', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'dashboard']);
Route::get('/employees', [AuthentificationController::class, 'employes'])->name('admin.employees');
Route::get('/tasks', [AdminController::class, 'Tasks'])->name('admin.tasks');
Route::get('/requests', [AdminController::class, 'Request']);
Route::get('/statistics', [AdminController::class, 'Stats']);
Route::get('/settingss', [AdminController::class, 'setting']);
Route::get('/myaccountt', [AdminController::class, 'adminacc']);

Route::post('/employees', [AuthentificationController::class, 'store'])->name('employee.store');
Route::delete('/employees/{id}', [AuthentificationController::class, 'destroy'])->name('employee.destroy');
Route::put('/employees/{id}', [AuthentificationController::class, 'update'])->name('employee.update');
