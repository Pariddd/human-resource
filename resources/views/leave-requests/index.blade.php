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
                <h3>Leave Request</h3>
                <p class="text-subtitle text-muted">Manage leave request data</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Leave Request</li>
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
                    <a href="{{ route('leave-requests.create') }}" class="btn btn-primary mb-3 ms-auto">New Leave Request</a>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Name Employee</th>
                            <th>Leave Type</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            @if (session('role') == 'HR')
                                <th>Option</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leaveRequests as $leaveRequest)    
                        <tr>
                            <td>{{ $leaveRequest->employee->fullname ?? 'No Name' }}</td>
                            <td>{{ $leaveRequest->leave_type }}</td>
                            <td>{{ $leaveRequest->start_date }}</td>
                            <td>{{ $leaveRequest->end_date }}</td>
                            <td>
                                @if ($leaveRequest->status == 'confirm')
                                    <span class="badge bg-success">
                                        {{ucfirst($leaveRequest->status)}}
                                    </span>
                                @elseif($leaveRequest->status == 'reject')
                                    <span class="badge bg-danger">
                                        {{ucfirst($leaveRequest->status)}}
                                    </span>  
                                @else
                                    <span class="badge bg-warning">
                                        {{ucfirst($leaveRequest->status)}}
                                    </span>  
                                @endif
                            </td>
                            <td>
                                @if (session('role') == 'HR')
                                    @if ($leaveRequest->status == 'pending' || $leaveRequest->status == 'reject')
                                        <a href="{{ route('leave-requests.confirm', $leaveRequest->id) }}" class="btn btn-success btn-sm">Confirm</a>
                                    @else
                                        <a href="{{ route('leave-requests.reject', $leaveRequest->id) }}" class="btn btn-secondary btn-sm">reject</a>
                                    @endif
                                    <a href="{{ route('leave-requests.edit', $leaveRequest->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <button 
                                    type="button" 
                                    class="btn btn-danger btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal" 
                                    data-id="{{ $leaveRequest->id }}" 
                                    data-name="{{ $leaveRequest->employee->fullname ?? 'No Name' }}">
                                    Delete
                                    </button>
                                @endif
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
                    Apakah Anda yakin ingin menghapus Leave Request dengan nama
                    <strong id="name"></strong>  
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
        var name = document.getElementById('name');

        if (deleteModal && deleteForm && name) {
            deleteModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var leaveRequestId = button.getAttribute('data-id'); 
                var title = button.getAttribute('data-name');

                // Set action form
                var action = "{{ url('leave-requests') }}/" + leaveRequestId;
                deleteForm.setAttribute('action', action);

                name.textContent = ' (' + title + ')';
            });
        }
    });
</script>
</div>
@endsection