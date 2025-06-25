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
                <h3>Payroll</h3>
                <p class="text-subtitle text-muted">Manage payroll employee</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('payrolls.index') }}">Payroll</a></li>
                        <li class="breadcrumb-item active" aria-current="page">New</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Add.
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('payrolls.store') }}" method="POST">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-2">
                        <label for="" class="form-label">Name Employee</label>
                        <select name="employee_id" id="employee_id" class="form-control @error('employee_id') is-invalid @enderror">
                            <option value="">Select an Employee</option>
                            @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">
                              {{ $employee->fullname }} 
                            </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label">Salary</label>
                        <input type="number" class="form-control @error('salary') is-invalid @enderror" name="salary" value="{{ old('salary') }}" required>
                        @error('salary')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label">Bonuses</label>
                        <input type="number" class="form-control @error('bonuses') is-invalid @enderror" name="bonuses" value="{{ old('bonuses') }}" required>
                        @error('bonuses')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label">Deductions</label>
                        <input type="number" class="form-control @error('deductions') is-invalid @enderror" name="deductions" value="{{ old('deductions') }}" required>
                        @error('deductions')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label">Pay Date</label>
                        <input type="date" class="form-control date @error('pay_date') is-invalid @enderror" name="pay_date" value="{{ old('pay_date') }}" required>
                        @error('pay_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-grid gap-2 d-md-flex mt-3">
                        <button type="submit" class="btn btn-primary">Submit Payroll</button>
                        <a href="{{ route('payrolls.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </form>
            </div>
        </div>

    </section>
</div>
@endsection