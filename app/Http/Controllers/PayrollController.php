<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Payroll;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payrolls = Payroll::all();

        return view('payrolls.index', compact('payrolls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();

        return view('payrolls.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required',
            'salary' => 'required|numeric',
            'deductions' => 'required|numeric',
            'bonuses' => 'required|numeric',
            'pay_date' => 'required|date',
        ]);

        $netSalary = $validated['salary'] - $validated['deductions'] + $validated['bonuses'];
        $validated['net_salary'] = $netSalary;

        Payroll::create($validated);
        return redirect()->route('payrolls.index')->with('success', 'Payroll created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payroll $payroll)
    {
        return view('payrolls.show', compact('payroll'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payroll $payroll)
    {
        $employees = Employee::all();

        return view('payrolls.edit', compact('payroll', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payroll $payroll)
    {
        $validated = $request->validate([
            'employee_id' => 'required',
            'salary' => 'required|numeric',
            'deductions' => 'required|numeric',
            'bonuses' => 'required|numeric',
            'pay_date' => 'required|date',
        ]);

        $netSalary = $validated['salary'] - $validated['deductions'] + $validated['bonuses'];
        $validated['net_salary'] = $netSalary;

        $payroll->update($validated);
        return redirect()->route('payrolls.index')->with('success', 'Payroll updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payroll $payroll)
    {
        $payroll->delete();
        return redirect()->route('payrolls.index')->with('success', 'Payroll deleted successfully!');
    }
}
