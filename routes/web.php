<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\AspirationController as AdminAspiration;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboard;
use App\Http\Controllers\Siswa\AspirationController as SiswaAspiration;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Alur Route Aplikasi Pengaduan Sarana
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. REDIRECT ROOT
// ==========================================
Route::get('/', fn() => redirect('/login'));

// ==========================================
// 2. AUTH (GUEST)
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// ==========================================
// 3. LOGOUT (AUTHENTICATED)
// ==========================================
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================================
// 4. ROUTE ADMIN
// ==========================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    // ================= ASPIRASI =================
    // Index & Detail
    Route::get('/aspirasi', [AdminAspiration::class, 'index'])->name('aspirasi.index');
    Route::get('/aspirasi/{aspiration}', [AdminAspiration::class, 'show'])->name('aspirasi.show');

    // Aksi pada Aspirasi (Status, Feedback, Progress)
    Route::patch('/aspirasi/{aspiration}/status', [AdminAspiration::class, 'updateStatus'])->name('aspirasi.status');
    Route::post('/aspirasi/{aspiration}/feedback', [AdminAspiration::class, 'storeFeedback'])->name('aspirasi.feedback');
    Route::post('/aspirasi/{aspiration}/progress', [AdminAspiration::class, 'storeProgress'])->name('aspirasi.progress');

    // ================= KATEGORI =================
    // Index & Create (Create HARUS sebelum route {kategori})
    Route::get('/kategori', [CategoryController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [CategoryController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [CategoryController::class, 'store'])->name('kategori.store');

    // Edit & Update
    Route::get('/kategori/{kategori}/edit', [CategoryController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{kategori}', [CategoryController::class, 'update'])->name('kategori.update');

    // Delete
    Route::delete('/kategori/{kategori}', [CategoryController::class, 'destroy'])->name('kategori.destroy');
});

// ==========================================
// 5. ROUTE SISWA
// ==========================================
Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [SiswaDashboard::class, 'index'])->name('dashboard');

    // ================= ASPIRASI =================
    // Index (Daftar Aspirasi Saya)
    Route::get('/aspirasi', [SiswaAspiration::class, 'index'])->name('aspirasi.index');

    // CREATE HARUS DILETAKKAN SEBELUM {aspirasi}
    Route::get('/aspirasi/create', [SiswaAspiration::class, 'create'])->name('aspirasi.create');
    Route::post('/aspirasi', [SiswaAspiration::class, 'store'])->name('aspirasi.store');

    // Detail Aspirasi (Route dengan parameter HARUS di paling akhir)
    Route::get('/aspirasi/{aspirasi}', [SiswaAspiration::class, 'show'])->name('aspirasi.show');
});