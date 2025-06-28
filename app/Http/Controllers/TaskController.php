<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (session('role') == 'HR') {
            $tasks = Task::all();
        } else {
            $tasks = Task::where('assigned_to', session('employee_id'))->get();
        }
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('tasks.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'required',
            'due_date' => 'required|date',
            'status' => 'required',
        ]);

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $employees = Employee::all();

        return view('tasks.edit', compact('task', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'required',
            'due_date' => 'required|date',
            'status' => 'required',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function done(int $id)
    {
        $task = Task::find($id);
        $task->update(['status' => 'done']);
        return redirect()->route('tasks.index')
            ->with('success', 'Task marked as Done.');
    }

    public function pending(int $id)
    {
        $task = Task::find($id);
        $task->update(['status' => 'pending']);
        return redirect()->route('tasks.index')
            ->with('success', 'Task marked as Pending.');
    }

    public function progress(int $id)
    {
        $task = Task::find($id);
        $task->update(['status' => 'on progress']);
        return redirect()->route('tasks.index')
            ->with('success', 'Task marked as On Progress.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
