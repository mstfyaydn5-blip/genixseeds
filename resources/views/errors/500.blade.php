<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Server Error</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="d-flex align-items-center justify-content-center" style="min-height:100vh;background:var(--agri-cream);">
    <div class="text-center px-3">
        <i class="bi bi-exclamation-triangle text-green" style="font-size:4rem;"></i>
        <h1 class="display-3 fw-bold mt-3 mb-2">500</h1>
        <p class="text-muted fs-5 mb-4">Something went wrong on our end. Please try again shortly.</p>
        <a href="{{ url('/en') }}" class="btn-agri">Back to Home <i class="bi bi-arrow-right"></i></a>
    </div>
</body>
</html>
