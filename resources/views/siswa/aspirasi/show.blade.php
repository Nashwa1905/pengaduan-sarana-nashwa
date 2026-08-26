@extends('layouts.siswa')
@section('title', 'Detail Aspirasi')
@section('page-title', 'Detail Aspirasi')

@push('styles')
<style>
    /* =========================================
       TEMA GLOBAL (MENGIKUTI LAYOUT SISWA)
       ========================================= */
    h5, h6, .fw-600 {
        font-family: 'Inter', sans-serif !important;
        color: #1a202c;
    }

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

    /* Tombol */
    .btn {
        border-radius: 10px !important;
        font-weight: 700 !important;
        font-size: 14px !important;
        transition: all 0.3s ease !important;
        padding: 10px 20px !important;
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

    /* Badge */
    .badge {
        padding: 8px 12px !important;
        border-radius: 50px !important;
        font-weight: 600 !important;
        font-size: 12px !important;
    }

    /* Empty State */
    .empty-icon {
        font-size: 3rem !important;
        color: #cbd5e0 !important;
        display: block !important;
        margin-bottom: 10px !important;
    }
</style>
@endpush

@section('content')
<div class="mb-3">
    <a href="{{ route('siswa.aspirasi.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

{{-- Cek apakah data aspirasi ada --}}
@if(isset($aspirasi) && $aspirasi)
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h5 class="fw-bold mb-1">{{ $aspirasi->title }}</h5>
                    <div class="text-muted small">
                        <i class="bi bi-tag me-1"></i>{{ $aspirasi->category->name }}
                        &nbsp;·&nbsp;
                        <i class="bi bi-calendar me-1"></i>
                        {{ \Carbon\Carbon::parse($aspirasi->created_at)->translatedFormat('d F Y, H:i') }}
                    </div>
                </div>
                <span class="badge bg-{{ $aspirasi->status_color }} fs-6">{{ $aspirasi->status_label }}</span>
            </div>
            <hr>
            <p class="mb-0" style="white-space: pre-wrap;">{{ $aspirasi->content }}</p>
        </div>
    </div>
@else
    {{-- Tampilkan pesan kosong jika data tidak ditemukan --}}
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="bi bi-inbox empty-icon"></i>
            <h6 class="fw-bold mb-2">Aspirasi Tidak Ditemukan</h6>
            <p class="text-muted mb-4">Data aspirasi yang Anda cari tidak tersedia atau sudah dihapus.</p>
            <a href="{{ route('siswa.aspirasi.index') }}" class="btn btn-primary">
                <i class="bi bi-arrow-left me-1"></i>Kembali ke Daftar Aspirasi
            </a>
        </div>
    </div>
@endif
@endsection