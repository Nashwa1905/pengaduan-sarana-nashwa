<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Pengaduan Sarana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            color-scheme: light;
            font-family: 'Inter', sans-serif;
        }
        body {
            min-height: 100vh;
            margin: 0;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .page-shell {
            width: min(100%, 1200px);
            padding: 2rem;
        }
        .login-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.75rem;
        }
        @media (min-width: 992px) {
            .login-grid {
                grid-template-columns: 420px 1fr;
                align-items: center;
            }
        }
        .brand-panel {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(148, 163, 184, 0.25);
            border-radius: 30px;
            padding: 2.5rem;
            color: #0f172a;
            box-shadow: 0 40px 120px rgba(15, 23, 42, 0.12);
        }
        .brand-panel h1 {
            font-size: clamp(2rem, 4vw, 3rem);
            margin-bottom: 1rem;
            color: #0f172a;
        }
        .brand-panel p {
            color: #475569;
            line-height: 1.85;
            margin-bottom: 1.75rem;
        }
        .feature-chip {
            display: inline-flex;
            gap: 0.75rem;
            align-items: center;
            padding: 0.9rem 1.2rem;
            border-radius: 999px;
            background: rgba(59, 130, 246, 0.12);
            color: #1e293b;
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }
        .login-card {
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 45px 120px rgba(15, 23, 42, 0.2);
            border: 1px solid rgba(148, 163, 184, 0.2);
            background: #ffffff;
        }
        .login-card .card-body {
            padding: 2.5rem;
            color: #0f172a;
        }
        .login-card .form-control {
            background: #f8fafc;
            border: 1px solid #cbd5e1;
            color: #0f172a;
            min-height: 3.5rem;
        }
        .login-card .form-control::placeholder {
            color: #94a3b8;
        }
        .login-card .form-control:focus {
            color: #0f172a;
            background: #ffffff;
            border-color: #2563eb;
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.18);
        }
        .login-card .btn-primary {
            background: linear-gradient(135deg, #0ea5e9, #4f46e5);
            border: none;
            min-height: 3.5rem;
            font-weight: 600;
        }
        .login-card .btn-primary:hover {
            background: linear-gradient(135deg, #38bdf8, #6366f1);
        }
        .login-icon {
            width: 3.5rem;
            height: 3.5rem;
            display: grid;
            place-items: center;
            border-radius: 16px;
            background: #e0f2fe;
            margin: 0 auto 1.25rem;
            color: #0284c7;
        }
        .status-note {
            border-radius: 14px;
            padding: 1rem 1.15rem;
            background: #eff6ff;
            border: 1px solid #dbeafe;
            color: #0f172a;
        }
        .login-card hr {
            border-color: #cbd5e1;
        }
        .demo-credentials {
            color: #475569;
            font-size: 0.95rem;
            line-height: 1.7;
        }
        .demo-credentials strong {
            color: #0f172a;
        }
        .accent-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.65rem 0.95rem;
            border-radius: 999px;
            background: rgba(59, 130, 246, 0.14);
            color: #bfdbfe;
            font-size: 0.9rem;
            margin-top: 1.5rem;
        }
    </style>
</head>
<body>
<div class="page-shell">
    <div class="login-grid">
        <section class="brand-panel">
            <span class="feature-chip">
                <i class="bi bi-lightning-fill"></i>
                Aplikasi Pengaduan Sarana
            </span>
            <h1>Keluhan Sarana Sekolah<br>Menjadi Lebih Cepat & Terstruktur</h1>
            <p>Lapor masalah fasilitas sekolah, pantau progres perbaikan, dan dapatkan tanggapan langsung dari admin.</p>
            <div class="accent-badge">
                <i class="bi bi-shield-lock-fill"></i>
                Aman & Mudah Digunakan
            </div>
        </section>

        <article class="login-card">
            <div class="card-body">
                <div class="text-center mb-4">
                    <div class="login-icon">
                        <i class="bi bi-megaphone-fill fs-4"></i>
                    </div>
                    <h2 class="h4 text-dark mb-2">Masuk ke Akun Anda</h2>
                    <p class="text-muted mb-0">Gunakan email sekolah dan kata sandi Anda.</p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger py-2 small">
                        <i class="bi bi-exclamation-circle me-1"></i>{{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="/login">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" placeholder="contoh@sekolah.id" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" id="pwdField"
                                   class="form-control" placeholder="••••••••" required>
                            <button class="btn btn-outline-secondary text-muted" type="button" onclick="togglePwd()">
                                <i class="bi bi-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember">
                            <label class="form-check-label text-muted small" for="remember">Ingat saya</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                    </button>
                </form>

                <hr>

                <div class="status-note">
                    <strong>Info:</strong> Jika belum memiliki akun, hubungi pihak sekolah untuk mendapatkan akses.
                </div>

                <div class="demo-credentials mt-4 text-center">
                    <strong>Akun demo</strong><br>
                    Admin: <strong>admin@gmail.com</strong> / <strong>password</strong><br>
                    Siswa: <strong>siswa@gmail.com</strong> / <strong>password</strong>
                </div>
            </div>
        </article>
    </div>
</div>

<script>
function togglePwd() {
    const f = document.getElementById('pwdField');
    const i = document.getElementById('eyeIcon');
    if (f.type === 'password') {
        f.type = 'text';
        i.className = 'bi bi-eye-slash';
    } else {
        f.type = 'password';
        i.className = 'bi bi-eye';
    }
}
</script>
</body>
</html>
