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
                <h3>Employee
                <p class="text-subtitle text-muted">Handle data and profile.
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employee</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
                    <div class="card-header bg-gradient-primary text-white py-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Detail Employee</h4>
                            <div>
                                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-light me-2">
                                    <i class="bi bi-pencil-square me-1"></i>Edit
                                </a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="bi bi-trash me-1"></i>Delete
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <dl class="row gy-3">

                            <!-- Nama Lengkap -->
                            <div class="col-12">
                                <dt class="text-muted small fw-semibold mb-1">Nama Lengkap</dt>
                                <dd class="fs-5 fw-bold mb-0">{{ $employee->fullname }}</dd>
                            </div>

                            <!-- Email -->
                            <div class="col-12">
                                <dt class="text-muted small fw-semibold mb-1">Email</dt>
                                <dd class="mb-0">{{  $employee->email }}</dd>
                            </div>

                            {{-- Department --}}
                            <div class="col-12">
                                <dt class="text-muted small fw-semibold mb-1">Department</dt>
                                <dd class="mb-0">
                                    {{ $employee->department->name ?? '-' }}
                                </dd>
                            </div>

                            {{-- Role --}}
                            <div class="col-12">
                                <dt class="text-muted small fw-semibold mb-1">Role</dt>
                                <dd class="mb-0">
                                    {{ $employee->role->title ?? '-' }}
                                </dd>
                            </div>

                            <!-- Phone Number -->
                            <div class="col-12">
                                <dt class="text-muted small fw-semibold mb-1">Phone Number</dt>
                                <dd class="mb-0">
                                    @php
                                        $phone = $employee->phone_number;

                                        // Pastikan format +62
                                        if ($phone && substr($phone, 0, 1) === '0') {
                                            $phone = '+62' . substr($phone, 1);
                                        }

                                        // Hapus semua non-digit
                                        $cleanPhone = preg_replace("/[^0-9]/", "", $phone);

                                        // Tambahkan spasi setiap 2-3-4 digit (contoh: +62 812 3456 7890)
                                        $formattedPhone = '';
                                        $length = strlen($cleanPhone);
                                        for ($i = 0; $i < $length; $i++) {
                                            $formattedPhone .= $cleanPhone[$i];
                                            if ($i == 2 || $i == 5 || $i == 9) {
                                                $formattedPhone .= ' ';
                                            }
                                        }
                                    @endphp

                                    {{ $formattedPhone ?: '-' }}
                                </dd>
                            </div>

                            <!-- Address -->
                            <div class="col-12">
                                <dt class="text-muted small fw-semibold mb-1">Address</dt>
                                <dd class="mb-0">{{  $employee->address }}</dd>
                            </div>

                            {{-- Birth Date --}}
                            <div class="col-12">
                                <dt class="text-muted small fw-semibold mb-1">Birth Date</dt>
                                <dd class="mb-0">
                                    {{ \Carbon\Carbon::parse($employee->birth_date)->translatedFormat('d F Y') }}
                                </dd>
                            </div>

                            {{-- Hire Date --}}
                            <div class="col-12">
                                <dt class="text-muted small fw-semibold mb-1">Hire Date</dt>
                                <dd class="mb-0">
                                    {{ \Carbon\Carbon::parse($employee->hire_date)->translatedFormat('d F Y') }}
                                </dd>
                            </div>

                            <!-- Status -->
                            <div class="col-12">
                                <dt class="text-muted small fw-semibold mb-1">Status</dt>
                                <dd class="mb-0">
                                    @if ($employee->status == 'active')
                                        <span class="badge bg-success px-3 py-2">{{ ucfirst($employee->status) }}</span>
                                    @else
                                        <span class="badge bg-danger px-3 py-2">{{ ucfirst($employee->status) }}</span>
                                    @endif
                                </dd>
                            </div>

                            <!-- Salary -->
                            <div class="col-12">
                                <dt class="text-muted small fw-semibold mb-1">Salary</dt>
                                <dd class="bg-light p-3 rounded border mb-0">
                                    Rp{{ number_format($employee->salary ?? 0, 0, ',', '.') }}
                                </dd>
                            </div>

                        </dl>

                        <div class="mt-4">
                            <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left-circle me-1"></i>Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

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

@endsection