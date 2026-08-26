@extends('layouts.admin')
@section('title', 'Kelola Kategori')
@section('page-title', 'Kelola Kategori')

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

    .card-footer {
        border-top: 2px solid #e2e8f0 !important;
        background-color: #ffffff !important;
        border-radius: 0 0 12px 12px !important;
        padding: 15px 25px !important;
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

    .btn-outline-primary {
        border: 2px solid #008891 !important;
        color: #008891 !important;
        background-color: transparent !important;
    }

    .btn-outline-primary:hover {
        background-color: #008891 !important;
        color: white !important;
    }

    .btn-outline-danger {
        border: 2px solid #e53e3e !important;
        color: #e53e3e !important;
        background-color: transparent !important;
    }

    .btn-outline-danger:hover {
        background-color: #e53e3e !important;
        color: white !important;
    }

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

    .badge.bg-success {
        background: linear-gradient(90deg, #2d6a4f, #40916c) !important;
    }

    /* Pagination */
    .pagination .page-link {
        border: none !important;
        color: #008891 !important;
        border-radius: 8px !important;
        margin: 0 3px !important;
        font-weight: 600 !important;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(90deg, #00587a, #008891) !important;
        color: white !important;
        box-shadow: 0 4px 10px rgba(0, 136, 145, 0.3) !important;
    }

    .pagination .page-item.disabled .page-link {
        color: #a0aec0 !important;
    }
</style>
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <p class="text-muted mb-0">Kelola kategori aspirasi yang tersedia untuk siswa.</p>
    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i>Tambah Kategori
    </a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Aspirasi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $cat)
                <tr>
                    <td class="text-muted small">{{ $cat->id }}</td>
                    <td class="fw-500">{{ $cat->name }}</td>
                    <td class="text-muted small">{{ Str::limit($cat->description, 60) }}</td>
                    <td>
                        <span class="badge bg-secondary">{{ $cat->aspirations_count }}</span>
                    </td>
                    <td>
                        @if($cat->is_active)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-secondary">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.kategori.edit', $cat) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.kategori.destroy', $cat) }}"
                                  onsubmit="return confirm('Hapus kategori ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-5">Belum ada kategori.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($categories->hasPages())
    <div class="card-footer bg-white">{{ $categories->links() }}</div>
    @endif
</div>
@endsection