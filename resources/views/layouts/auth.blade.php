<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/mku-logo.png') }}?v=2">
    <title>PT Multi Karya Usaha</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/mku-logo.png') }}?v=2">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
    <div class="flex min-h-screen items-center justify-center px-4 py-10">
        @yield('content')
    </div>
</body>
</html>
