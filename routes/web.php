<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PresencesController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Presences;
use App\Models\Role;
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

// Handle Department
Route::resource('departments', DepartmentController::class);

// Handle Department
Route::resource('roles', RoleController::class);

// Handle Presences
Route::resource('presences', PresencesController::class);

// Handle Payrolls
Route::resource('payrolls', PayrollController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
