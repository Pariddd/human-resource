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
                <h3>Employees</h3>
                <p class="text-subtitle text-muted">Handle employee data or profile</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Employees</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Data.
                </h5>
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3 ms-auto">New Employee</a>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Departments</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Salary</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)    
                        <tr>
                            <td>{{ $employee->fullname }}</td>
                            <td>{{ $employee->department->name }}</td>
                            <td>{{ $employee->role->title }}</td>
                            <td>
                                @if ($employee->status == 'active')
                                    <span class="text-success">{{ ucfirst($employee->status) }}</span>
                                @else
                                    <span class="text-warning">
                                        {{ ucfirst($employee->status) }}</span>
                                @endif
                            </td>
                            <td>Rp{{ number_format($employee->salary ?? 0, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info btn-sm mb-2 mt-2">View</a>
                                {{-- @if ($employee->status == 'pending')
                                    <a href="{{ route('employees.done', $employee->id) }}" class="btn btn-success btn-sm">Mark as Done</a>
                                    <a href="{{ route('employees.progress', $employee->id) }}" class="btn btn-info btn-sm">Mark as On Progress</a>
                                @elseif($employee->status == 'done')
                                    <a href="{{ route('employees.pending', $employee->id) }}" class="btn btn-warning btn-sm">Mark as Pending</a>
                                @else
                                    <a href="{{ route('employees.done', $employee->id) }}" class="btn btn-success btn-sm">Mark as Done</a>
                                    <a href="{{ route('employees.pending', $employee->id) }}" class="btn btn-warning btn-sm">Mark as Pending</a>
                                @endif --}}
                                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $employee->id }}">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3 shadow-sm border-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Penghapusan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus tugas <strong>"{{ $employee->fullname }}"</strong>?  
                    Tindakan ini tidak dapat dibatalkan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash me-1"></i>Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script JS untuk update action form -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var deleteModal = document.getElementById('deleteModal');
            var deleteForm = document.getElementById('deleteForm');

            if (deleteModal && deleteForm) {
                deleteModal.addEventListener('show.bs.modal', function (event) {
                    var button = event.relatedTarget;
                    var employeeId = button.getAttribute('data-id');
                    var action = "{{ url('employees') }}/" + employeeId;

                    deleteForm.setAttribute('action', action);
                });
            }
        });
    </script>
</div>
@endsection