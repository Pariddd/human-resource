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
                <h3>Presence</h3>
                <p class="text-subtitle text-muted">Handle Employee Presence</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('presences.index') }}">Presence</a></li>
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
                @if (session('role') == 'HR')
                    <form action="{{ route('presences.store') }}" method="POST">
                        @csrf
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
                            <label for="" class="form-label">Check In</label>
                            <input type="datetime" class="form-control datetime @error('check_in') is-invalid @enderror" name="check_in" value="{{ old('check_in') }}" required>
                            @error('check_in')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Check Out</label>
                            <input type="datetime" class="form-control datetime @error('check_out') is-invalid @enderror" name="check_out" value="{{ old('check_out') }}" required>
                            @error('check_out')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Date</label>
                            <input type="date" class="form-control date @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="present" >Present</option>
                                <option value="absent">Absent</option>
                                <option value="leave">Leave</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid gap-2 d-md-flex mt-3">
                            <button type="submit" class="btn btn-primary">Submit Presence</button>
                            <a href="{{ route('presences.index') }}" class="btn btn-secondary">Back to List</a>
                        </div>
                    </form>
                @else
                    <form action="{{ route('presences.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <b>Note</b> : Mohon izinkan akses lokasi, supaya presensi diterima
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Latitude</label>
                            <input type="text" class="form-control" name="latitude" id="latitude" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Longitude</label>
                            <input type="text" class="form-control" name="longitude" id="longitude" required>
                        </div>
                        <div class="mb-3">
                            <iframe src="" frameborder="0" width="500" height="300" scrolling='no' marginheight='0' margingwidth='0'></iframe>
                        </div>
                        <button type="submit" class="btn btn-primary" id="btn-present" disabled>Present</button>
                    </form>
                @endif
            </div>
        </div>

    </section>
</div>
<script>
    const iframe = document.querySelector('iframe');
    const jurusanLat = 5.199843;
    const jurusanLong = 97.063653;
    const treshold = 0.01;

    navigator.geolocation.getCurrentPosition(function(position){
        const lat = position.coords.latitude;
        const long = position.coords.longitude;
        iframe.src = `https://www.google.com/maps?q=${lat},${long}&output=embed`;
    });

    document.addEventListener('DOMContentLoaded',(event) => {
        if(navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position){
                const lat = position.coords.latitude;
                const long = position.coords.longitude;
                
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = long;

                // compare lokasi sekarang dan lokasi tempat/kantor
                const distance = Math.sqrt(Math.pow(lat - jurusanLat, 2) + Math.pow(long - jurusanLong, 2));
                if(distance <= treshold) {
                    // posisi ada di sekitar tempat/kantor
                    alert('Kamu berada di kantor, selamat bekerja');
                    document.getElementById('btn-present').removeAttribute('disabled');
                } else {
                    alert('Kamu berada di luar kantor, pastikan kamu berada di kantor untuk melakukan presensi');
                }
            });
        } 
    })
</script>
@endsection