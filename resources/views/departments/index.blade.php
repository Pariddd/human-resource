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
                <h3>Department</h3>
                <p class="text-subtitle text-muted">Handle deparment data</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Departments</li>
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
                    <a href="{{ route('departments.create') }}" class="btn btn-primary mb-3 ms-auto">New Department</a>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Name Department</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $department)    
                        <tr>
                            <td>{{ $department->name }}</td>
                            <td>{{ $department->description ?? '-'}}</td>
                            <td>
                                @if ($department->status == 'active')
                                    <span class="text-success">{{ ucfirst($department->status) }}</span>
                                @else
                                    <span class="text-warning">
                                        {{ ucfirst($department->status) }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <button 
                                type="button" 
                                class="btn btn-danger btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteModal" 
                                data-id="{{ $department->id }}" 
                                data-name="{{ $department->name }}">
                                Delete
                                </button>
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
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Penghapusan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus Department ini?
                    <strong id="departmentName"></strong>  
                    Tindakan ini tidak dapat dibatalkan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
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
        var departmentName = document.getElementById('departmentName');

        if (deleteModal && deleteForm && departmentName) {
            deleteModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var departmentId = button.getAttribute('data-id'); 
                var title = button.getAttribute('data-name');

                // Set action form
                var action = "{{ url('departments') }}/" + departmentId;
                deleteForm.setAttribute('action', action);

                taskName.textContent = ' (' + title + ')';
            });
        }
    });
</script>
</div>
@endsection