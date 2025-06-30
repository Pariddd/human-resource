<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Payroll;
use App\Models\Presences;
use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $employee = Employee::count();
        $department = Department::count();
        $payroll = Payroll::count();
        $presence = Presences::count();
        $tasks = Task::with('employee')
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard.index', compact('employee', 'department', 'payroll', 'presence', 'tasks'));
    }
}
