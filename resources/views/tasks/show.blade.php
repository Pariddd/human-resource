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
                <h3>Detail Tugas</h3>
                <p class="text-subtitle text-muted">Lihat informasi lengkap tentang tugas ini.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Tasks</a></li>
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
                            <h4 class="mb-0">Detail Tugas</h4>
                            @if (session('role') == 'HR')
                                <div>
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-light me-2">
                                        <i class="bi bi-pencil-square me-1"></i>Edit
                                    </a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        <i class="bi bi-trash me-1"></i>Delete
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <dl class="row gy-3">

                            <!-- Title -->
                            <div class="col-12">
                                <dt class="text-muted small fw-semibold mb-1">Judul Tugas</dt>
                                <dd class="fs-5 fw-bold mb-0">{{ $task->title }}</dd>
                            </div>

                            <!-- Employee -->
                            <div class="col-12">
                                <dt class="text-muted small fw-semibold mb-1">Pegawai</dt>
                                <dd class="mb-0">{{ $task->employee->fullname }}</dd>
                            </div>

                            <!-- Due Date -->
                            <div class="col-12">
                                <dt class="text-muted small fw-semibold mb-1">Tanggal Batas Waktu</dt>
                                <dd class="mb-0">
                                    {{ \Carbon\Carbon::parse($task->due_date)->translatedFormat('d F Y') }}
                                </dd>
                            </div>

                            <!-- Status -->
                            <div class="col-12">
                                <dt class="text-muted small fw-semibold mb-1">Status</dt>
                                <dd class="mb-0">
                                    @if ($task->status == 'done')
                                        <span class="badge bg-success px-3 py-2">{{ ucfirst($task->status) }}</span>
                                    @elseif($task->status == 'pending')
                                        <span class="badge bg-warning text-dark px-3 py-2">{{ ucfirst($task->status) }}</span>
                                    @else
                                        <span class="badge bg-info text-dark px-3 py-2">{{ ucfirst($task->status) }}</span>
                                    @endif
                                </dd>
                            </div>

                            <!-- Description -->
                            <div class="col-12">
                                <dt class="text-muted small fw-semibold mb-1">Deskripsi</dt>
                                <dd class="bg-light p-3 rounded border mb-0">
                                    {{ $task->description ?? 'Tidak ada deskripsi' }}
                                </dd>
                            </div>

                        </dl>

                        <div class="mt-4">
                            <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">
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
                Apakah Anda yakin ingin menghapus tugas <strong>"{{ $task->title }}"</strong>?  
                Tindakan ini tidak dapat dibatalkan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
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