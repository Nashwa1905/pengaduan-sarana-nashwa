@extends('layouts.admin')
@section('title', 'Detail Aspirasi')
@section('page-title', 'Detail Aspirasi')

@push('styles')
<style>

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

    .btn-success {
        background: linear-gradient(90deg, #2d6a4f, #40916c) !important;
        border: none !important;
        box-shadow: 0 4px 15px rgba(45, 106, 79, 0.3) !important;
    }

    .btn-success:hover {
        box-shadow: 0 6px 20px rgba(45, 106, 79, 0.4) !important;
        transform: translateY(-2px) !important;
    }

    /* Badge */
    .badge {
        padding: 8px 12px !important;
        border-radius: 50px !important;
        font-weight: 600 !important;
        font-size: 12px !important;
    }

    /* Kotak Feedback */
    .border.rounded {
        border: 2px solid #e2e8f0 !important;
        border-radius: 10px !important;
        background-color: #f7fafc !important;
    }
</style>
@endpush

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.aspirasi.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        {{-- Detail Aspirasi --}}
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h5 class="fw-bold mb-1">{{ $aspiration->title }}</h5>
                        <div class="text-muted small">
                            <i class="bi bi-person me-1"></i>{{ $aspiration->user->name }}
                            &nbsp;·&nbsp;
                            <i class="bi bi-tag me-1"></i>{{ $aspiration->category->name }}
                            &nbsp;·&nbsp;
                            <i class="bi bi-calendar me-1"></i>{{ $aspiration->created_at->format('d M Y, H:i') }}
                        </div>
                    </div>
                    <span class="badge bg-{{ $aspiration->status_color }} fs-6">{{ $aspiration->status_label }}</span>
                </div>
                <hr>
                <p class="mb-0" style="white-space: pre-wrap;">{{ $aspiration->content }}</p>
            </div>
        </div>

        {{-- Ubah Status --}}
        <div class="card mb-3">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="bi bi-arrow-repeat me-2"></i>Ubah Status</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.aspirasi.status', $aspiration) }}" class="d-flex gap-2 align-items-center">
                    @csrf @method('PATCH')
                    <select name="status" class="form-select form-select-sm w-auto">
                        @foreach(\App\Models\Aspiration::STATUS_LABELS as $val => $label)
                            <option value="{{ $val }}" {{ $aspiration->status === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-sm btn-primary">Simpan Status</button>
                </form>
            </div>
        </div>

        {{-- Umpan Balik --}}
        <div class="card mb-3">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="bi bi-chat-square-text me-2"></i>Umpan Balik</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.aspirasi.feedback', $aspiration) }}" class="mb-4">
                    @csrf
                    <textarea name="message" class="form-control mb-2" rows="3"
                        placeholder="Tulis umpan balik untuk siswa..." required></textarea>
                    <button class="btn btn-sm btn-primary">
                        <i class="bi bi-send me-1"></i>Kirim Umpan Balik
                    </button>
                </form>
                @forelse($aspiration->feedbacks as $fb)
                <div class="border rounded p-3 mb-2 bg-light">
                    <div class="d-flex justify-content-between small text-muted mb-1">
                        <span><i class="bi bi-person-badge me-1"></i>{{ $fb->admin->name }}</span>
                        <span>{{ $fb->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    <p class="mb-0 small" style="white-space:pre-wrap;">{{ $fb->message }}</p>
                </div>
                @empty
                <p class="text-muted small mb-0">Belum ada umpan balik.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        {{-- Catat Progres --}}
        <div class="card mb-3">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="bi bi-list-check me-2"></i>Catat Progres</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.aspirasi.progress', $aspiration) }}">
                    @csrf
                    <div class="mb-2">
                        <label class="form-label small">Tahapan</label>
                        <select name="stage" class="form-select form-select-sm">
                            @foreach(\App\Models\ProgressUpdate::STAGE_LABELS as $val => $label)
                                <option value="{{ $val }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small">Keterangan</label>
                        <textarea name="description" class="form-control form-control-sm" rows="3"
                            placeholder="Deskripsi progres..." required></textarea>
                    </div>
                    <button class="btn btn-sm btn-success w-100">
                        <i class="bi bi-plus-circle me-1"></i>Catat Progres
                    </button>
                </form>
            </div>
        </div>

        {{-- Riwayat Progres --}}
        <div class="card">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="bi bi-clock-history me-2"></i>Riwayat Progres</h6>
            </div>
            <div class="card-body p-0">
                @forelse($aspiration->progressUpdates as $pu)
                <div class="border-bottom p-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="badge bg-info text-dark">{{ $pu->stage_label }}</span>
                        <span class="text-muted" style="font-size:.72rem;">{{ $pu->created_at->format('d M Y') }}</span>
                    </div>
                    <p class="mb-0 small" style="white-space:pre-wrap;">{{ $pu->description }}</p>
                    <div class="text-muted" style="font-size:.72rem;">oleh {{ $pu->admin->name }}</div>
                </div>
                @empty
                <p class="text-muted small p-3 mb-0">Belum ada progres dicatat.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection