@extends('layouts.admin')
@section('title', 'Daftar Aspirasi')
@section('page-title', 'Manajemen Aspirasi')

@push('styles')
<style>
    /* 
       TEMA GLOBAL (MENGIKUTI HALAMAN LOGIN)
      */
    body, .content-wrapper, .main-panel {
        background-color: #f4f7f6 !important;
        font-family: 'Inter', sans-serif !important;
    }

    h1, h2, h3, h4, h5, h6, .fw-600 {
        font-family: 'Inter', sans-serif !important;
        color: #1a202c;
    }

    /* 
       STYLING KARTU & FILTER
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

    /*
       INPUT FORM (Sesuai Login)
        */
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
        outline: none !important;
    }

    /* 
       TOMBOL (BUTTON)
       */
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

    .btn-outline-primary {
        border: 2px solid #008891 !important;
        color: #008891 !important;
        background-color: transparent !important;
    }

    .btn-outline-primary:hover {
        background-color: #008891 !important;
        color: white !important;
    }

    /*
       TABEL & BADGE
      */
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

    /* Badge Status */
    .badge {
        padding: 8px 12px !important;
        border-radius: 50px !important;
        font-weight: 600 !important;
        font-size: 12px !important;
    }

    /* 
       PAGINATION
        */
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
<div class="card mb-3">
    <div class="card-body py-4">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-2">
                <label class="form-label mb-1">Tanggal</label>
                <input type="date" name="date" class="form-control" value="{{ request('date') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label mb-1">Bulan</label>
                <select name="month" class="form-select">
                    <option value="">Semua Bulan</option>
                    @foreach(range(1,12) as $m)
                        <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                            {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label mb-1">Siswa</label>
                <select name="user_id" class="form-select">
                    <option value="">Semua Siswa</option>
                    @foreach($students as $s)
                        <option value="{{ $s->id }}" {{ request('user_id') == $s->id ? 'selected' : '' }}>
                            {{ $s->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label mb-1">Kategori</label>
                <select name="category_id" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label mb-1">Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    @foreach(\App\Models\Aspiration::STATUS_LABELS as $val => $label)
                        <option value="{{ $val }}" {{ request('status') == $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button class="btn btn-primary w-100"><i class="bi bi-funnel"></i> Filter</button>

            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white py-3">
        <h6 class="mb-0 fw-bold">
            Daftar Aspirasi
            <span class="badge bg-secondary ms-2">{{ $aspirations->total() }}</span>
        </h6>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Siswa</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($aspirations as $asp)
                <tr>
                    <td class="text-muted small">{{ $asp->id }}</td>
                    <td class="fw-medium">{{ Str::limit($asp->title, 45) }}</td>
                    <td>{{ $asp->user->name }}</td>
                    <td><span class="badge bg-secondary">{{ $asp->category->name }}</span></td>
                    <td><span class="badge bg-{{ $asp->status_color }}">{{ $asp->status_label }}</span></td>
                    <td class="text-muted small">{{ $asp->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.aspirasi.show', $asp) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-5">Tidak ada aspirasi ditemukan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($aspirations->hasPages())
    <div class="card-footer bg-white">
        {{ $aspirations->links() }}
    </div>
    @endif
</div>
@endsection