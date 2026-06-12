<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Xiaomi Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            min-height: 100vh; display: flex; align-items: center; justify-content: center;
        }
        .login-card {
            background: #fff; border-radius: 20px; padding: 2.5rem;
            width: 100%; max-width: 420px; box-shadow: 0 20px 60px rgba(0,0,0,.4);
        }
        .brand-logo { color: #FF6900; font-size: 2rem; font-weight: 800; margin-bottom: .25rem; }
        .brand-logo span { color: #1a1a1a; }
        .btn-login {
            background: #FF6900; border: none; color: #fff; padding: .75rem;
            border-radius: 10px; font-weight: 600; font-size: 1rem;
        }
        .btn-login:hover { background: #e05e00; color: #fff; }
        .form-control { border-radius: 10px; padding: .7rem 1rem; border: 1.5px solid #e0e0e0; }
        .form-control:focus { border-color: #FF6900; box-shadow: 0 0 0 .2rem rgba(255,105,0,.2); }
        .form-label { font-weight: 600; color: #333; font-size: .9rem; }
        .back-link { color: #888; font-size: .85rem; text-decoration: none; }
        .back-link:hover { color: #FF6900; }
    </style>
</head>
<body>
<div class="login-card">
    <div class="text-center mb-4">
        <div class="brand-logo">Xiaomi<span>Store</span></div>
        <p class="text-muted mb-0">Masuk ke panel administrator</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger py-2">
            <i class="bi bi-exclamation-circle me-2"></i>
            {{ $errors->first() }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success py-2">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   placeholder="admin@xiaomistore.com" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="••••••••" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label text-muted" for="remember" style="font-size:.9rem">
                    Ingat saya
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-login w-100 mb-3">
            <i class="bi bi-lock me-2"></i>Masuk
        </button>
    </form>

    <div class="text-center">
        <a href="{{ route('shop.index') }}" class="back-link">
            <i class="bi bi-arrow-left me-1"></i>Kembali ke Toko
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
