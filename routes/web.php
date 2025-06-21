<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TaskController;
use App\Models\Employee;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Handle Task
Route::resource('tasks', TaskController::class);
Route::get('tasks/done/{id}', [TaskController::class, 'done'])->name('tasks.done');
Route::get('tasks/pending/{id}', [TaskController::class, 'pending'])->name('tasks.pending');
Route::get('tasks/onprogress/{id}', [TaskController::class, 'progress'])->name('tasks.progress');

// Handle Employee
Route::resource('employees', EmployeeController::class);
Route::get('tasks/active/{id}', [EmployeeController::class, 'active'])->name('employees.active');
Route::get('tasks/inactive/{id}', [EmployeeController::class, 'inactive'])->name('employees.inactive');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
