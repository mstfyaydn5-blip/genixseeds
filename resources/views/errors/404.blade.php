<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Inter:wght@400;600;700&family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    @if(app()->getLocale() === 'ar')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="d-flex align-items-center justify-content-center" style="min-height:100vh;background:var(--agri-cream);">
    <div class="text-center px-3">
        <i class="bi bi-flower1 text-green" style="font-size:4rem;"></i>
        <h1 class="display-3 fw-bold mt-3 mb-2">404</h1>
        <p class="text-muted fs-5 mb-4">{{ app()->getLocale() === 'ar' ? 'عذراً، الصفحة التي تبحث عنها غير موجودة.' : "Sorry, the page you're looking for doesn't exist." }}</p>
        <a href="{{ url('/' . app()->getLocale()) }}" class="btn-agri">{{ app()->getLocale() === 'ar' ? 'العودة للرئيسية' : 'Back to Home' }} <i class="bi bi-arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}"></i></a>
    </div>
</body>
</html>
