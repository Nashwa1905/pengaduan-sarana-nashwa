@extends('layouts.admin')
@section('title', 'Tambah Kategori')
@section('page-title', 'Tambah Kategori')

@push('styles')
<style>
    /* 
       TEMA GLOBAL (MENGIKUTI LOGIN & DASHBOARD)
      */
    .card {
        border: none !important;
        border-radius: 12px !important;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05) !important;
        margin-bottom: 20px;
    }

    .card-header {
        border-bottom: 2px solid #e2e8f0 !important;
        background-color: #ffffff !important;
        border-radius: 12px 12px 0 0 !important;
        padding: 20px 25px !important;
    }

    .card-body {
        padding: 25px !important;
    }

    h6, .fw-600 {
        font-family: 'Inter', sans-serif !important;
        color: #1a202c;
    }

    /* Input & Select */
    .form-label {
        font-weight: 600 !important;
        color: #4a5568 !important;
        font-size: 13px !important;
    }

    .form-control, .form-select {
        border: 2px solid #e2e8f0 !important;
        border-radius: 10px !important;
        padding: 10px 15px !important;
        font-size: 14px !important;
        color: #1a202c !important;
        background-color: #f7fafc !important;
        transition: all 0.3s ease !important;
    }

    .form-control:focus, .form-select:focus {
        border-color: #008891 !important;
        background-color: #ffffff !important;
        box-shadow: 0 0 0 4px rgba(0, 136, 145, 0.1) !important;
    }

    .form-control.is-invalid {
        border-color: #e53e3e !important;
        box-shadow: 0 0 0 4px rgba(229, 62, 62, 0.1) !important;
    }

    /* Checkbox Modern */
    .form-check-input {
        width: 18px;
        height: 18px;
        border: 2px solid #e2e8f0 !important;
        border-radius: 5px !important;
        transition: all 0.3s ease !important;
        cursor: pointer;
    }

    .form-check-input:checked {
        background-color: #008891 !important;
        border-color: #008891 !important;
        box-shadow: 0 2px 5px rgba(0, 136, 145, 0.3) !important;
    }

    .form-check-label {
        font-weight: 500 !important;
        color: #4a5568 !important;
    }

    /* Tombol */
    .btn {
        border-radius: 10px !important;
        font-weight: 700 !important;
        font-size: 14px !important;
        transition: all 0.3s ease !important;
        padding: 10px 20px !important;
    }

    .btn-primary {
        background: linear-gradient(90deg, #00587a, #008891) !important;
        border: none !important;
        color: white !important;
        box-shadow: 0 4px 15px rgba(0, 136, 145, 0.3) !important;
    }

    .btn-primary:hover {
        background: linear-gradient(90deg, #004a66, #006e75) !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 20px rgba(0, 136, 145, 0.4) !important;
    }

    .btn-outline-secondary {
        border: 2px solid #e2e8f0 !important;
        color: #4a5568 !important;
        background-color: white !important;
    }

    .btn-outline-secondary:hover {
        background-color: #f7fafc !important;
        border-color: #cbd5e0 !important;
        color: #1a202c !important;
    }
</style>
@endpush

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card" style="max-width:600px;">
    <div class="card-header bg-white py-3">
        <h6 class="mb-0 fw-bold">Form Tambah Kategori</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.kategori.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label small fw-600">Nama Kategori <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}" placeholder="Contoh: Fasilitas Kelas" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label small fw-600">Deskripsi</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                          rows="3" placeholder="Deskripsi singkat kategori ini...">{{ old('description') }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4 form-check d-flex align-items-center gap-2">
                <input type="checkbox" name="is_active" value="1" class="form-check-input" id="isActive"
                    {{ old('is_active', true) ? 'checked' : '' }}>
                <label class="form-check-label small" for="isActive">Aktif (tampil ke siswa)</label>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i>Simpan Kategori
                </button>
                <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection