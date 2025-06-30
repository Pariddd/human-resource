<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (session('role') == 'HR') {
            $leaveRequests = LeaveRequest::all();
        } else {
            $leaveRequests = LeaveRequest::where('employee_id', session('employee_id'))
                ->get();
        }

        return view('leave-requests.index', compact('leaveRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('leave-requests.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (session('role') == 'HR') {
            $validated = $request->validate([
                'employee_id' => 'required',
                'leave_type' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);

            $request->merge([
                'status' => 'pending',
            ]);

            LeaveRequest::create($validated);
        } else {
            LeaveRequest::create([
                'employee_id' => session('employee_id'),
                'leave_type' => $request->leave_type,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => 'pending',
            ]);
        }

        return redirect()->route('leave-requests.index')->with('success', 'Leave request created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaveRequest $leaveRequest)
    {
        $employees = Employee::all();
        return view('leave-requests.edit', compact('leaveRequest', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeaveRequest $leaveRequest)
    {
        $validated = $request->validate([
            'employee_id' => 'required',
            'leave_type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $leaveRequest->update($request->all());
        return redirect()->route('leave-requests.index')->with('success', 'Leave request updated successfully!');
    }

    public function confirm(int $id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        $leaveRequest->update(['status' => 'confirm']);
        return redirect()->route('leave-requests.index')->with('success', 'Leave request Confirmed successfully!');
    }

    public function reject(int $id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        $leaveRequest->update(['status' => 'reject']);
        return redirect()->route('leave-requests.index')->with('success', 'Leave request Rejected successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeaveRequest $leaveRequest)
    {
        $leaveRequest->delete();
        return redirect()->route('leave-requests.index')->with('success', 'Leave request deleted successfully!');
    }
}
