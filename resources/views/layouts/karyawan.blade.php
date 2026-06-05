<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/mku-logo.png') }}?v=2">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/mku-logo.png') }}?v=2">
    <title>MKU - Portal Karyawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-slate-100 text-slate-900">

@php
    $userName = session('user_name') ?? 'Karyawan';
    $nameParts = preg_split('/\s+/', trim($userName));

    if (count($nameParts) >= 2) {
        $initials = strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1));
    } else {
        $initials = strtoupper(substr($userName, 0, 1));
    }

    $menus = [
        [
            'label' => 'Dashboard',
            'url' => '/karyawan/dashboard',
            'active' => request()->is('karyawan/dashboard'),
        ],
        [
            'label' => 'Pinjaman Saya',
            'url' => '/karyawan/pinjaman',
            'active' => request()->is('karyawan/pinjaman') || request()->is('karyawan/pinjaman/*'),
        ],
        [
            'label' => 'Cuti Saya',
            'url' => '/karyawan/cuti',
            'active' => request()->is('karyawan/cuti') || request()->is('karyawan/cuti/*'),
        ],
        [
            'label' => 'Izin Kerja',
            'url' => '/karyawan/izin',
            'active' => request()->is('karyawan/izin') || request()->is('karyawan/izin/*'),
        ],
    ];
@endphp

<div class="flex min-h-screen flex-col">

    <!-- Top Navbar -->
    <header class="border-b border-slate-200 bg-white px-4 py-3 shadow-sm shadow-slate-200 md:px-6">
        <div class="flex items-center justify-between gap-3">

            <a href="/karyawan/dashboard" class="flex min-w-0 items-center gap-3">
                <img
                    src="{{ asset('images/mku-logo.png') }}"
                    alt="PT Multi Karya Usaha Logo"
                    class="h-8 w-auto shrink-0 object-contain md:h-11">

                <div class="min-w-0">
                    <h1 class="truncate text-sm font-bold leading-tight text-slate-900 md:text-base">
                        PT Multi Karya Usaha
                    </h1>
                    <p class="truncate text-xs font-medium text-slate-500">
                        Koperasi Karyawan
                    </p>
                </div>

                <div class="hidden h-10 w-px bg-slate-200 md:block"></div>

                <div class="hidden md:block">
                    <p class="text-sm font-semibold text-indigo-700">Employee Portal</p>
                    <p class="text-xs text-slate-500">Panel karyawan</p>
                </div>
            </a>

            <div class="flex shrink-0 items-center gap-2 md:gap-3">

                <div class="hidden text-right sm:block">
                    <p class="text-sm font-semibold leading-tight text-slate-900">
                        {{ $userName }}
                    </p>
                    <p class="text-xs text-slate-500">
                        Karyawan
                    </p>
                </div>

                <div class="flex h-9 w-9 items-center justify-center rounded-2xl bg-indigo-50 text-xs font-bold text-indigo-700 md:h-10 md:w-10 md:text-sm">
                    {{ $initials }}
                </div>

                <a href="/logout"
                   class="rounded-2xl bg-slate-900 px-3 py-2 text-xs font-semibold text-white transition hover:bg-slate-700 md:px-4 md:text-sm">
                    Logout
                </a>

            </div>

        </div>
    </header>

    <main class="flex-1 p-4 md:p-6">

        <!-- Page Header + Menu -->
        <div class="mb-6 rounded-3xl bg-white p-5 shadow-sm shadow-slate-200">

            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                <div>
                    <h1 class="text-xl font-semibold text-slate-900">
                        @yield('page-title', 'Dashboard')
                    </h1>
                    <p class="mt-1 text-sm text-slate-500">
                        Kelola layanan karyawan Anda.
                    </p>
                </div>

                <!-- Desktop Menu -->
                <nav class="hidden flex-wrap gap-2 text-sm md:flex">
                    @foreach ($menus as $menu)
                        <a href="{{ $menu['url'] }}"
                           class="rounded-2xl px-4 py-3 font-semibold transition
                           {{ $menu['active']
                                ? 'bg-slate-900 text-white'
                                : 'bg-white text-slate-700 ring-1 ring-slate-200 hover:bg-slate-50' }}">
                            {{ $menu['label'] }}
                        </a>
                    @endforeach
                </nav>

                <!-- Mobile Menu -->
                <details class="md:hidden">
                    <summary class="cursor-pointer rounded-2xl bg-slate-900 px-4 py-3 text-center text-sm font-semibold text-white">
                        Menu
                    </summary>

                    <div class="mt-3 grid gap-2">
                        @foreach ($menus as $menu)
                            <a href="{{ $menu['url'] }}"
                               class="rounded-2xl px-4 py-3 text-sm font-semibold
                               {{ $menu['active']
                                    ? 'bg-slate-900 text-white'
                                    : 'bg-white text-slate-700 ring-1 ring-slate-200' }}">
                                {{ $menu['label'] }}
                            </a>
                        @endforeach
                    </div>
                </details>

            </div>

        </div>

        <div class="space-y-6">

            @if (session('success'))
                <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')

        </div>

    </main>

</div>

</body>
</html>