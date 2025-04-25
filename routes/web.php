<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Authentication routes (login, register, reset password)
Auth::routes();

// Override the default logout route
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Default redirect
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Home route after authentication
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Protected routes
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Calendar
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
    
    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::put('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile');
    Route::put('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password');
    
    // Tasks API
    Route::get('/api/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/api/tasks/date', [TaskController::class, 'getByDate'])->name('tasks.date');
    Route::get('/api/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
    Route::post('/api/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::put('/api/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/api/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    
    // Notes API
    Route::get('/api/notes', [NoteController::class, 'getByDate'])->name('notes.date');
    Route::post('/api/notes', [NoteController::class, 'store'])->name('notes.store');
    Route::delete('/api/notes', [NoteController::class, 'destroy'])->name('notes.destroy');
});
