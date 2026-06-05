<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/mku-logo.png') }}?v=2">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/mku-logo.png') }}?v=2">
    <title>MKU - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-slate-100 text-slate-900">

@php
    $adminName = session('user_name') ?? 'Admin HRD';
    $nameParts = preg_split('/\s+/', trim($adminName));

    if (count($nameParts) >= 2) {
        $initials = strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1));
    } else {
        $initials = strtoupper(substr($adminName, 0, 1));
    }

    $menus = [
        [
            'label' => 'Dashboard',
            'url' => '/admin/dashboard',
            'active' => request()->is('admin/dashboard'),
        ],
        [
            'label' => 'Data Karyawan',
            'url' => '/admin/karyawan',
            'active' => request()->is('admin/karyawan') || request()->is('admin/karyawan/*'),
        ],
        [
            'label' => 'Pinjaman',
            'url' => '/admin/pinjaman',
            'active' => request()->is('admin/pinjaman') || request()->is('admin/pinjaman/*'),
        ],
        [
            'label' => 'Angsuran',
            'url' => '/admin/angsuran',
            'active' => request()->is('admin/angsuran') || request()->is('admin/angsuran/*'),
        ],
        [
            'label' => 'Pengajuan Cuti',
            'url' => '/admin/cuti',
            'active' => request()->is('admin/cuti') || request()->is('admin/cuti/*'),
        ],
        [
            'label' => 'Izin Kerja',
            'url' => '/admin/izin',
            'active' => request()->is('admin/izin') || request()->is('admin/izin/*'),
        ],
    ];
@endphp

<div class="flex min-h-screen">

    <!-- Desktop Sidebar -->
    <aside class="sticky top-0 hidden h-screen w-72 shrink-0 flex-col border-r border-slate-200 bg-white px-5 py-6 lg:flex">

        <!-- Logo Company -->
        <div class="mb-8">
            <a href="/admin/dashboard" class="flex items-center gap-3">
                <img
                    src="{{ asset('images/mku-logo.png') }}"
                    alt="PT Multi Karya Usaha Logo"
                    class="h-12 w-auto object-contain">

                <div>
                    <h1 class="text-base font-bold leading-tight text-slate-900">
                        PT Multi Karya Usaha
                    </h1>
                    <p class="text-xs font-medium text-slate-500">
                        Koperasi Karyawan
                    </p>
                </div>
            </a>

            <div class="mt-5 rounded-2xl bg-blue-50 px-4 py-3">
                <p class="text-sm font-semibold text-blue-700">
                    HRD Portal
                </p>
                <p class="mt-1 text-xs text-blue-500">
                    Admin / HRD Panel
                </p>
            </div>
        </div>

        <!-- Menu -->
        <nav class="flex-1 space-y-2 text-sm font-medium">
            @foreach ($menus as $menu)
                <a href="{{ $menu['url'] }}"
                   class="block rounded-2xl px-4 py-3 transition
                   {{ $menu['active']
                        ? 'bg-slate-900 text-white shadow-sm'
                        : 'text-slate-700 hover:bg-slate-100 hover:text-slate-900' }}">
                    {{ $menu['label'] }}
                </a>
            @endforeach
        </nav>

        <!-- Logout -->
        <div class="mt-auto pt-4">
            <a href="/logout"
               class="block rounded-2xl bg-slate-900 px-4 py-3 text-center text-sm font-semibold text-white transition hover:bg-slate-700">
                Logout
            </a>
        </div>

    </aside>

    <!-- Main Wrapper -->
    <div class="flex min-w-0 flex-1 flex-col">

        <!-- Mobile Header -->
        <header class="border-b border-slate-200 bg-white px-4 py-3 shadow-sm shadow-slate-200 lg:hidden">
            <div class="flex items-center justify-between gap-3">

                <a href="/admin/dashboard" class="flex min-w-0 items-center gap-3">
                    <img
                        src="{{ asset('images/mku-logo.png') }}"
                        alt="PT Multi Karya Usaha Logo"
                        class="h-8 w-auto shrink-0 object-contain">

                    <div class="min-w-0">
                        <h1 class="truncate text-sm font-bold leading-tight text-slate-900">
                            PT Multi Karya Usaha
                        </h1>
                        <p class="truncate text-xs font-medium text-slate-500">
                            HRD Portal
                        </p>
                    </div>
                </a>

                <div class="flex shrink-0 items-center gap-2">
                    <div class="flex h-9 w-9 items-center justify-center rounded-2xl bg-blue-50 text-xs font-bold text-blue-700">
                        {{ $initials }}
                    </div>

                    <details class="relative">
                        <summary class="list-none cursor-pointer rounded-2xl bg-slate-900 px-4 py-2 text-xs font-semibold text-white">
                            Menu
                        </summary>

                        <div class="absolute right-0 z-50 mt-3 w-64 rounded-3xl border border-slate-200 bg-white p-3 shadow-xl shadow-slate-200">
                            <div class="mb-3 border-b border-slate-100 px-3 pb-3">
                                <p class="text-sm font-semibold text-slate-900">
                                    {{ $adminName }}
                                </p>
                                <p class="text-xs text-slate-500">
                                    Admin / HRD Panel
                                </p>
                            </div>

                            <div class="space-y-1">
                                @foreach ($menus as $menu)
                                    <a href="{{ $menu['url'] }}"
                                       class="block rounded-2xl px-4 py-3 text-sm font-semibold transition
                                       {{ $menu['active']
                                            ? 'bg-slate-900 text-white'
                                            : 'text-slate-700 hover:bg-slate-100' }}">
                                        {{ $menu['label'] }}
                                    </a>
                                @endforeach

                                <a href="/logout"
                                   class="mt-2 block rounded-2xl bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700 transition hover:bg-rose-100">
                                    Logout
                                </a>
                            </div>
                        </div>
                    </details>
                </div>

            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 p-4 md:p-6">

            <!-- Top Header -->
            <header class="mb-6 rounded-3xl bg-white p-5 shadow-sm shadow-slate-200">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <h1 class="text-xl font-semibold text-slate-900">
                            @yield('page-title', 'Dashboard')
                        </h1>

                        <p class="mt-1 text-sm text-slate-500">
                            Selamat datang, {{ $adminName }}
                        </p>
                    </div>

                    <div class="hidden items-center gap-3 sm:flex">
                        <div class="text-right">
                            <p class="text-sm font-semibold text-slate-800">
                                PT Multi Karya Usaha
                            </p>
                            <p class="text-xs text-slate-500">
                                Admin / HRD Panel
                            </p>
                        </div>

                        <img
                            src="{{ asset('images/mku-logo.png') }}"
                            alt="PT Multi Karya Usaha Logo"
                            class="h-9 w-auto rounded-xl bg-white object-contain">
                    </div>

                </div>
            </header>

            <!-- Content -->
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

</div>

<!-- Custom Confirm Modal -->
<div id="confirmModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-slate-900/50 px-4 backdrop-blur-sm">
    <div class="w-full max-w-md rounded-3xl bg-white p-6 shadow-2xl shadow-slate-900/20">

        <div class="flex items-start gap-4">

            <div id="confirmIcon" class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-amber-50 text-2xl">
                ⚠️
            </div>

            <div class="min-w-0 flex-1">
                <h3 id="confirmTitle" class="text-lg font-bold text-slate-900">
                    Konfirmasi Aksi
                </h3>

                <p id="confirmMessage" class="mt-2 text-sm leading-relaxed text-slate-500">
                    Apakah Anda yakin ingin melanjutkan aksi ini?
                </p>
            </div>

        </div>

        <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

            <button
                type="button"
                id="confirmCancel"
                class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                Batal
            </button>

            <button
                type="button"
                id="confirmOk"
                class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">
                Ya, Lanjutkan
            </button>

        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('confirmModal');
        const title = document.getElementById('confirmTitle');
        const message = document.getElementById('confirmMessage');
        const icon = document.getElementById('confirmIcon');
        const btnCancel = document.getElementById('confirmCancel');
        const btnOk = document.getElementById('confirmOk');

        if (!modal || !title || !message || !icon || !btnCancel || !btnOk) {
            return;
        }

        let pendingAction = null;

        function setButtonType(type) {
            btnOk.className = 'rounded-2xl px-5 py-3 text-sm font-semibold text-white transition';

            if (type === 'danger') {
                icon.innerText = '🛑';
                icon.className = 'flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-rose-50 text-2xl';
                btnOk.className += ' bg-rose-600 hover:bg-rose-700';
            } else if (type === 'success') {
                icon.innerText = '✅';
                icon.className = 'flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-50 text-2xl';
                btnOk.className += ' bg-emerald-600 hover:bg-emerald-700';
            } else {
                icon.innerText = '⚠️';
                icon.className = 'flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-amber-50 text-2xl';
                btnOk.className += ' bg-slate-900 hover:bg-slate-700';
            }
        }

        function openConfirm(options, action) {
            title.innerText = options.title || 'Konfirmasi Aksi';
            message.innerText = options.message || 'Apakah Anda yakin ingin melanjutkan aksi ini?';
            btnOk.innerText = options.button || 'Ya, Lanjutkan';

            setButtonType(options.type || 'default');

            pendingAction = action;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeConfirm() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            pendingAction = null;
        }

        document.addEventListener('click', function (event) {
            const trigger = event.target.closest('[data-confirm]');

            if (!trigger) {
                return;
            }

            if (trigger.tagName.toLowerCase() !== 'a') {
                return;
            }

            event.preventDefault();

            openConfirm({
                title: trigger.dataset.confirmTitle,
                message: trigger.dataset.confirm,
                button: trigger.dataset.confirmButton,
                type: trigger.dataset.confirmType,
            }, function () {
                window.location.href = trigger.href;
            });
        });

        document.addEventListener('submit', function (event) {
            const form = event.target;

            if (!form.matches('[data-confirm]')) {
                return;
            }

            event.preventDefault();

            openConfirm({
                title: form.dataset.confirmTitle,
                message: form.dataset.confirm,
                button: form.dataset.confirmButton,
                type: form.dataset.confirmType,
            }, function () {
                HTMLFormElement.prototype.submit.call(form);
            });
        });

        btnCancel.addEventListener('click', closeConfirm);

        btnOk.addEventListener('click', function () {
            if (pendingAction) {
                pendingAction();
            }

            closeConfirm();
        });

        modal.addEventListener('click', function (event) {
            if (event.target === modal) {
                closeConfirm();
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeConfirm();
            }
        });
    });
</script>

</body>
</html>