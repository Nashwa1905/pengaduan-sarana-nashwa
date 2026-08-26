@extends('layouts.siswa')
@section('title', 'Kirim Aspirasi')


@push('styles')
<style>
    /* =========================================
       TEMA GLOBAL (MENGIKUTI LOGIN & DASHBOARD)
       ========================================= */
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
        padding: 12px 15px !important;
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

    .form-control.is-invalid, .form-select.is-invalid {
        border-color: #e53e3e !important;
        box-shadow: 0 0 0 4px rgba(229, 62, 62, 0.1) !important;
    }

    .form-text {
        color: #718096 !important;
        font-size: 12px !important;
        margin-top: 5px !important;
    }

    /* Tombol */
    .btn {
        border-radius: 10px !important;
        font-weight: 700 !important;
        font-size: 14px !important;
        transition: all 0.3s ease !important;
        padding: 12px 20px !important;
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
    <a href="{{ route('siswa.aspirasi.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card" style="max-width:680px;">
    <div class="card-header bg-white py-3">
        <h6 class="mb-0 fw-bold"><i class="bi bi-megaphone me-2"></i>Form Kirim Aspirasi</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('siswa.aspirasi.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label small fw-600">Kategori <span class="text-danger">*</span></label>
                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                            @if($cat->description) — {{ Str::limit($cat->description, 40) }}@endif
                        </option>
                    @endforeach
                </select>
                @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label small fw-600">Judul Aspirasi <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                       value="{{ old('title') }}"
                       placeholder="Contoh: Kursi kelas 9A banyak yang rusak" required>
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="form-label small fw-600">Isi Pengaduan <span class="text-danger">*</span></label>
                <textarea name="content" class="form-control @error('content') is-invalid @enderror"
                          rows="6" placeholder="Jelaskan masalah atau aspirasimu secara detail..."
                          required>{{ old('content') }}</textarea>
                @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                <div class="form-text">Jelaskan lokasi, kondisi, dan dampak dari masalah yang kamu laporkan.</div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-send me-1"></i>Kirim Aspirasi
                </button>
                <a href="{{ route('siswa.aspirasi.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection