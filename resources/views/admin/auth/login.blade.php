<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('site.sign_in') }} | {{ __('site.admin_panel') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body { min-height: 100vh; display:flex; align-items:center; background: linear-gradient(120deg, var(--agri-green-950), var(--agri-green-700)); }
        .login-card { background:#fff; border-radius: 20px; box-shadow: var(--shadow-strong); overflow:hidden; }
        .login-side { background: linear-gradient(160deg, var(--agri-green-800), var(--agri-green-600)); color:#fff; padding: 3rem; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="login-card row g-0">
                <div class="col-md-5 login-side d-none d-md-flex flex-column justify-content-center">
                    <i class="bi bi-flower1 fs-1 mb-3"></i>
                    <h3 class="fw-bold">Genix Seeds</h3>
                    <p class="opacity-75">Admin Dashboard — manage your agricultural website content securely.</p>
                </div>
                <div class="col-md-7 p-5">
                    <h4 class="fw-bold mb-1">{{ __('site.sign_in') }}</h4>
                    <p class="text-muted mb-4">Enter your credentials to access the dashboard.</p>
                    @include('partials.alerts')
                    <form method="POST" action="{{ route('admin.login.submit') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label small" for="remember">Remember me</label>
                        </div>
                        <button class="btn-agri w-100 justify-content-center">{{ __('site.sign_in') }} <i class="bi bi-box-arrow-in-right"></i></button>
                        <p class="text-muted small mt-3 mb-0">Demo credentials: admin@agriwebsite.test / Password123!</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
