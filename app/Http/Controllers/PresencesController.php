<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Presences;
use Illuminate\Http\Request;

class PresencesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presences = Presences::all();

        return view('presences.index', compact('presences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('presences.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
            'date' => 'required|date',
            'status' => 'required|string',
        ]);

        Presences::create($validated);
        return redirect()->route('presences.index')->with('success', 'Presence recorded successfully');
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
    public function edit(Presences $presence)
    {
        $employees = Employee::all();

        return view('presences.edit', compact('presence', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Presences $presence)
    {
        $validated = $request->validate([
            'employee_id' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
            'date' => 'required|date',
            'status' => 'required|string',
        ]);

        $presence->update($validated);
        return redirect()->route('presences.index')->with('success', 'Presence updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presences $presence)
    {
        $presence->delete();
        return redirect()->route('presences.index')->with('success', 'Presence deleted successfully');
    }
}
