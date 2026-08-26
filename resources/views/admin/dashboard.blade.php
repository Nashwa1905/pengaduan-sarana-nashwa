@extends('layouts.admin')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

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

    h6, .fw-600 {
        font-family: 'Inter', sans-serif !important;
        color: #1a202c;
    }

    /* Tombol */
    .btn {
        border-radius: 10px !important;
        font-weight: 700 !important;
        font-size: 14px !important;
        transition: all 0.3s ease !important;
        padding: 10px 20px !important;
    }

    .btn-outline-primary {
        border: 2px solid #008891 !important;
        color: #008891 !important;
        background-color: transparent !important;
    }

    .btn-outline-primary:hover {
        background-color: #008891 !important;
        color: white !important;
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

    /* Kartu Statistik Modern */
    .stat-card {
        border: none !important;
        border-radius: 12px !important;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05) !important;
        background: white;
        padding: 20px;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 15px;
    }

    .stat-value {
        font-size: 28px;
        font-weight: 800;
        color: #1a202c;
        line-height: 1.2;
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 13px;
        font-weight: 600;
        color: #718096;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-desc {
        font-size: 12px;
        color: #a0aec0;
        margin-top: 8px;
    }

    /* Warna Ikon */
    .bg-icon-blue { background: #e6f7ff; color: #008891; }
    .bg-icon-warning { background: #fffaf0; color: #dd6b20; }
    .bg-icon-info { background: #e6f7ff; color: #3182ce; }
    .bg-icon-success { background: #f0fff4; color: #2f855a; }
    .bg-icon-danger { background: #fff5f5; color: #e53e3e; }
    .bg-icon-purple { background: #faf5ff; color: #805ad5; }
    .bg-icon-gray { background: #f7fafc; color: #4a5568; }

    /* Tabel */
    .table thead th {
        background-color: #f7fafc !important;
        color: #4a5568 !important;
        font-size: 12px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        border-bottom: 2px solid #e2e8f0 !important;
        padding: 15px !important;
    }

    .table tbody td {
        color: #1a202c !important;
        font-size: 14px !important;
        padding: 15px !important;
        border-bottom: 1px solid #edf2f7 !important;
        vertical-align: middle !important;
    }

    .table tbody tr:hover {
        background-color: #f7fafc !important;
    }

    /* Badge */
    .badge {
        padding: 8px 12px !important;
        border-radius: 50px !important;
        font-weight: 600 !important;
        font-size: 12px !important;
    }

    .badge.bg-secondary {
        background-color: #edf2f7 !important;
        color: #4a5568 !important;
    }
</style>
@endpush

@section('content')
<!-- Baris Statistik Utama -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon bg-icon-blue"><i class="bi bi-inbox"></i></div>
            <div class="stat-value">{{ $stats['total'] }}</div>
            <div class="stat-label">Total Aspirasi</div>
            <div class="stat-desc">Semua masuk</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon bg-icon-warning"><i class="bi bi-clock"></i></div>
            <div class="stat-value text-warning">{{ $stats['pending'] }}</div>
            <div class="stat-label">Menunggu</div>
            <div class="stat-desc">Belum diproses</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon bg-icon-info"><i class="bi bi-arrow-repeat"></i></div>
            <div class="stat-value text-info">{{ $stats['on_progress'] }}</div>
            <div class="stat-label">Diproses</div>
            <div class="stat-desc">Sedang ditangani</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon bg-icon-success"><i class="bi bi-check-circle"></i></div>
            <div class="stat-value text-success">{{ $stats['resolved'] }}</div>
            <div class="stat-label">Selesai</div>
            <div class="stat-desc">Terselesaikan</div>
        </div>
    </div>
</div>

<!-- Baris Statistik Tambahan -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon bg-icon-danger"><i class="bi bi-x-circle"></i></div>
            <div class="stat-value text-danger">{{ $stats['rejected'] }}</div>
            <div class="stat-label">Ditolak</div>
            <div class="stat-desc">Aspirasi ditolak</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon bg-icon-purple"><i class="bi bi-tags"></i></div>
            <div class="stat-value">{{ $stats['categories'] }}</div>
            <div class="stat-label">Kategori Aktif</div>
            <div class="stat-desc">Kategori tersedia</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon bg-icon-gray"><i class="bi bi-people"></i></div>
            <div class="stat-value">{{ $stats['students'] }}</div>
            <div class="stat-label">Total Siswa</div>
            <div class="stat-desc">Siswa terdaftar</div>
        </div>
    </div>
</div>

<!-- Tabel Aspirasi Terbaru -->
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h6 class="mb-0 fw-bold">Aspirasi Terbaru</h6>
        <a href="{{ route('admin.aspirasi.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Judul</th>
                    <th>Siswa</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($latest as $asp)
                <tr>
                    <td class="fw-500">{{ Str::limit($asp->title, 40) }}</td>
                    <td>{{ $asp->user->name }}</td>
                    <td><span class="badge bg-secondary">{{ $asp->category->name }}</span></td>
                    <td>
                        <span class="badge bg-{{ $asp->status_color }}">{{ $asp->status_label }}</span>
                    </td>
                    <td class="text-muted small">
                        {{ \Carbon\Carbon::parse($asp->created_at)->translatedFormat('d F Y') }}
                    </td>
                    <td>
                        <a href="{{ route('admin.aspirasi.show', $asp) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada aspirasi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection