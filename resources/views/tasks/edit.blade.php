@extends('layouts.dashboard')

@section('content')
    
<header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tasks</h3>
                <p class="text-subtitle text-muted">Handle employee tasks</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Tasks</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Edit.
                </h5>
            </div>
            <div class="card-body">

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-2">
                        <label for="" class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $task->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label">Employee</label>
                        <select name="assigned_to" id="assigned_to" class="form-control @error('assigned_to') is-invalid @enderror">
                            <option value="">Select an Employee</option>
                            @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}" @if(old('assigned_to', $task->assigned_to) == $employee->id) selected @endif>{{ $employee->fullname }}</option>
                            @endforeach
                        </select>
                        @error('assigned_to')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label">Due date</label>
                        <input type="date" class="form-control date @error('due_date') is-invalid @enderror" name="due_date" value="{{ old('due_date', $task->due_date) }}" required>
                        @error('due_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="pending" @if (old('status', $task->status) == 'pending')
                                selected
                            @endif>Pending</option>
                            <option value="on progress" @if (old('status', $task->status) == 'on progress')
                                selected
                            @endif>On Progress</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label">Description</label>
                        <textarea name="description" id="" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror" >{{ old('description', $task->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-grid gap-2 d-md-flex mt-3">
                        <button type="submit" class="btn btn-primary">Update Task</button>
                        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </form>
            </div>
        </div>

    </section>
</div>
@endsection