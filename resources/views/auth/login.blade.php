<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Peminjaman | YKPI Al-Ittihad</title>

    <!-- Font Nunito -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f0f4f8;
        }

        .login-box {
            max-width: 420px;
            margin: 80px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        .login-box h2 {
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
            color: #198754;
        }

        .brand {
            font-weight: bold;
            font-size: 1.25rem;
            color: #198754;
            text-align: center;
            margin-bottom: 10px;
        }

        .subtitle {
            font-size: 0.95rem;
            text-align: center;
            color: #6c757d;
            margin-bottom: 25px;
        }

        .form-label {
            font-weight: 600;
        }

        .btn-success {
            font-weight: 600;
        }

        .footer-text {
            font-size: 0.85rem;
            text-align: center;
            color: #adb5bd;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <div class="brand">YKPI Al-Ittihad</div>
        <h2>Login Sistem</h2>
        <div class="subtitle">Silakan masuk untuk mengakses sistem peminjaman aset & kendaraan</div>

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email Pengguna</label>
                <input type="login" name="login" class="form-control" id="login" placeholder="Masukkan Email atau NIP" required autofocus>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi Anda</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan kata sandi" required>
            </div>

            <button type="submit" class="btn btn-success w-100">Masuk</button>
        </form>

        <div class="footer-text">
            &copy; {{ date('Y') }} YKPI Al-Ittihad | Sistem Peminjaman
        </div>
    </div>
</body>

</html>