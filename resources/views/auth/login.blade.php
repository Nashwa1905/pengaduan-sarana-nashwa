<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem Informasi - SMK BPPI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            height: 100vh;
            width: 100vw;
            overflow: hidden;
            background: #f4f7f6;
        }

        /* LAYOUT UTAMA (SPLIT SCREEN) */
        .main-container {
            display: flex;
            height: 100%;
            width: 100%;
        }

        /* === BAGIAN KIRI (BRANDING / ILLUSTRATION) === */
        .left-panel {
            flex: 1.2;
            background: linear-gradient(135deg, #0f3057, #00587a, #008891);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        /* Dekorasi lingkaran transparan besar di background kiri */
        .left-panel::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
            top: -150px;
            left: -150px;
        }

        .left-panel::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
            bottom: -100px;
            right: -100px;
        }

        .left-content {
            position: relative;
            z-index: 10;
            text-align: center;
            max-width: 400px;
        }

        .left-logo {
            width: 180px;
            margin-bottom: 30px;
            /* Gunakan filter agar logo terlihat menyatu jika backgroundnya putih */
            filter: drop-shadow(0 10px 15px rgba(0,0,0,0.3));
            background: rgba(255,255,255,0.95);
            padding: 10px;
            border-radius: 20px;
        }

        .left-panel h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .left-panel p {
            font-size: 16px;
            line-height: 1.6;
            opacity: 0.9;
            margin-bottom: 40px;
        }

        .btn-call {
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.4);
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            backdrop-filter: blur(5px);
            transition: 0.3s;
        }

        .btn-call:hover {
            background: rgba(255,255,255,0.4);
        }

        /* === BAGIAN KANAN (FORM LOGIN) === */
        .right-panel {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #ffffff;
            padding: 40px;
        }

        .login-box {
            width: 100%;
            max-width: 380px;
        }

        .login-mobile-logo {
            display: none; /* Akan muncul di layar kecil */
            text-align: center;
            margin-bottom: 30px;
        }

        .login-mobile-logo img {
            width: 100px;
            background: rgba(255,255,255,0.95);
            padding: 5px;
            border-radius: 10px;
        }

        .login-header {
            margin-bottom: 30px;
        }

        .login-header h2 {
            font-size: 26px;
            color: #1a202c;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .login-header p {
            color: #718096;
            font-size: 14px;
        }

        /* Input Styling yang Clean */
        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #4a5568;
        }

        .input-group input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 15px;
            color: #1a202c;
            outline: none;
            transition: 0.3s ease;
            background: #f7fafc;
        }

        .input-group input:focus {
            border-color: #008891;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(0, 136, 145, 0.1);
        }

        .input-group input::placeholder {
            color: #a0aec0;
        }

        /* Opsi remember me & lupa password */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            font-size: 13px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #4a5568;
            cursor: pointer;
        }

        .remember-me input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #008891;
        }

        .forgot-pass {
            color: #008891;
            text-decoration: none;
            font-weight: 600;
        }

        .forgot-pass:hover {
            text-decoration: underline;
        }

        /* Tombol Login */
        button.submit-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(90deg, #00587a, #008891);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 136, 145, 0.3);
            margin-bottom: 20px;
        }

        button.submit-btn:hover {
            background: linear-gradient(90deg, #004a66, #006e75);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 136, 145, 0.4);
        }

        /* Footer login */
        .login-footer {
            text-align: center;
            font-size: 12px;
            color: #a0aec0;
        }

        /* === RESPONSIVE (TAMPILAN HP) === */
        @media (max-width: 900px) {
            .left-panel {
                display: none; /* Sembunyikan panel kiri di HP */
            }
            .right-panel {
                flex: 1;
                padding: 20px;
                background: linear-gradient(135deg, #0f3057, #008891);
            }
            .login-mobile-logo {
                display: block;
            }
            .login-box {
                background: white;
                padding: 40px 30px;
                border-radius: 20px;
                box-shadow: 0 15px 30px rgba(0,0,0,0.2);
            }
        }
    </style>
</head>
<body>

    <div class="main-container">
        
        <!-- PANEL KIRI: Branding Sekolah -->
        <div class="left-panel">
            <div class="left-content">
                <!-- Logo di sini -->
                <img src="{{ asset('logo-smk.jpg') }}" alt="Logo SMK BPPI" class="left-logo">
                
                <h1>SMK BPPI Baleendah</h1>
                <p>Sistem Pengaduan Sarana Terpadu. Kelola keluhan yang ada di sekolah dengan mudah dan efisien.</p>
                
                
            </div>
        </div>

        <!-- PANEL KANAN: Form Login -->
        <div class="right-panel">
            <div class="login-box">
                
                <!-- Logo untuk Mobile (Jika layar HP) -->
                <div class="login-mobile-logo">
                    <img src="{{ asset('logo-smk.jpg') }}" alt="Logo SMK BPPI">
                </div>

                <div class="login-header">
                    <h2>Selamat Datang!</h2>
                    <p>Silakan login untuk mengakses dashboard Anda.</p>
                </div>

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    @if($errors->any())
                        <div style="background:#fff5f5;color:#c53030;border-left:4px solid #e53e3e;padding:12px 16px;border-radius:8px;margin-bottom:20px;font-size:13px;font-weight:500;">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda" required>
                    </div>

                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>
                    </div>

                    <div class="form-options">
                        <label class="remember-me">
                            <input type="checkbox" name="remember"> Ingat Saya
                        </label>
                        <a href="#" class="forgot-pass">Lupa Password?</a>
                    </div>

                    <button type="submit" class="submit-btn">Login ke Sistem</button>
                </form>

                <div class="login-footer">
                    &copy; Pengaduan sarana 2026
                </div>
            </div>
        </div>

    </div>

</body>
</html>