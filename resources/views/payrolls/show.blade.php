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
                <h3>Salary Slip</h3>
                <p class="text-subtitle text-muted">Handle salary slip.
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('payrolls.index') }}">Payroll</a></li>
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
                                <a href="{{ route('payrolls.edit', $payroll->id) }}" class="btn btn-light me-2">
                                    <i class="bi bi-pencil-square me-1"></i>Edit
                                </a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="bi bi-trash me-1"></i>Delete
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div id="print-area">
                            
                            <dl class="row gy-3">
                                <div class="col-12">
                                    <dt class="text-muted small fw-semibold mb-1">Nama Employee</dt>
                                    <dd class="fs-5 fw-bold mb-0">{{ $payroll->employee->fullname }}</dd>
                                </div>
                                <div class="col-12">
                                    <dt class="text-muted small fw-semibold mb-1">Salary</dt>
                                    <dd class="mb-0">Rp{{ number_format($payroll->salary ?? 0, 0, ',', '.') }}</dd>
                                </div>
                                <div class="col-12">
                                    <dt class="text-muted small fw-semibold mb-1"> Bonus</dt>
                                    <dd class="mb-0">
                                    Rp{{ number_format($payroll->bonuses ?? 0, 0, ',', '.') }}
                                    </dd>
                                </div>
                                <div class="col-12">
                                    <dt class="text-muted small fw-semibold mb-1">Deductions</dt>
                                    <dd class="mb-0">
                                        Rp{{ number_format($payroll->deductions ?? 0, 0, ',', '.') }}
                                    </dd>
                                </div>
                                <div class="col-12">
                                    <dt class="text-muted small fw-semibold mb-1">Net Salary</dt>
                                    <dd class="mb-0">
                                        Rp{{ number_format($payroll->net_salary ?? 0, 0, ',', '.') }}
                                    </dd>
                                </div>
                                <div class="col-12">
                                    <dt class="text-muted small fw-semibold mb-1">Pay Date</dt>
                                    <dd class="mb-0">
                                        {{ \Carbon\Carbon::parse($payroll->pay_date)->translatedFormat('d F Y') }}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('payrolls.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left-circle me-1"></i>Kembali ke Daftar
                            </a>
                            <button type="button" class="btn btn-primary" id="btn-print">
                                <i class="bi bi-printer me-1"></i>Print
                            </button>
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
                Apakah Anda yakin ingin menghapus tugas <strong>"{{ $payroll->employee->fullname }}"</strong>?  
                Tindakan ini tidak dapat dibatalkan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('payrolls.destroy', $payroll->id) }}" method="POST" style="display: inline;">
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

<script>
    document.getElementById('btn-print').addEventListener('click', function () {
        let printContent = document.getElementById('print-area').innerHTML;
        let originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
    });
</script>

@endsection