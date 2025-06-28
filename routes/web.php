<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveRequest;
use App\Http\Controllers\LeaveRequestController;
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

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Handle Task
    Route::resource('tasks', TaskController::class)->middleware(['role:HR,Developer,Sales Tiktok,Operator']);
    Route::get('tasks/done/{id}', [TaskController::class, 'done'])->name('tasks.done')->middleware(['role:HR,Developer,Sales Tiktok,Operator']);
    Route::get('tasks/pending/{id}', [TaskController::class, 'pending'])->name('tasks.pending')->middleware(['role:HR,Developer,Sales Tiktok,Operator']);
    Route::get('tasks/onprogress/{id}', [TaskController::class, 'progress'])->name('tasks.progress')->middleware(['role:HR,Developer,Sales Tiktok,Operator']);

    // Handle Employee
    Route::resource('employees', EmployeeController::class)->middleware(['role:HR']);

    // Handle Department
    Route::resource('departments', DepartmentController::class)->middleware(['role:HR']);

    // Handle Role
    Route::resource('roles', RoleController::class)->middleware(['role:HR']);

    // Handle Presences
    Route::resource('presences', PresencesController::class)->middleware(['role:HR,Developer,Sales Tiktok,Operator']);

    // Handle Payroll
    Route::resource('payrolls', PayrollController::class)->middleware(['role:HR,Developer,Sales Tiktok,Operator']);

    // Handle Leave Requests
    Route::resource('leave-requests', LeaveRequestController::class)->middleware(['role:HR,Developer,Sales Tiktok,Operator']);
    Route::get('leave-requests/confirm/{id}', [LeaveRequestController::class, 'confirm'])->name('leave-requests.confirm')->middleware(['role:HR']);
    Route::get('leave-requests/reject/{id}', [LeaveRequestController::class, 'reject'])->name('leave-requests.reject')->middleware(['role:HR']);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
