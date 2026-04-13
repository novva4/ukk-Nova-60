<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Perpustakaan Digital')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <style>
        :root {
            --primary:       #682636;
            --primary-dark:  #4d1b27;
            --primary-light: #8a3347;
            --primary-faint: #f9f0f2;
            --sidebar-w:     260px;
            --topbar-h:      64px;
            --text-main:     #1a1a2e;
            --text-muted:    #6b7280;
            --border:        #e5e7eb;
            --bg-body:       #f5f6fa;
            --white:         #ffffff;
            --success:       #059669;
            --warning:       #d97706;
            --danger:        #dc2626;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-body);
            color: var(--text-main);
            margin: 0;
        }

        /* ═══════════ SIDEBAR ═══════════ */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--primary-dark);
            display: flex;
            flex-direction: column;
            z-index: 1000;
            transition: transform .3s ease;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            text-decoration: none;
        }

        .brand-logo {
            width: 42px; height: 42px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .brand-text { line-height: 1.2; }
        .brand-text .name { color: #fff; font-weight: 700; font-size: 14px; }
        .brand-text .sub { color: rgba(255,255,255,.45); font-size: 11px; font-weight: 400; }

        .sidebar-nav { flex: 1; padding: 16px 12px; overflow-y: auto; }

        .nav-section-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: rgba(255,255,255,.3);
            padding: 12px 10px 6px;
            margin-top: 8px;
        }

        .nav-link-custom {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px 12px;
            border-radius: 8px;
            color: rgba(255,255,255,.65);
            font-size: 13.5px;
            font-weight: 500;
            text-decoration: none;
            transition: all .2s;
            margin-bottom: 2px;
        }
        .nav-link-custom i { font-size: 16px; width: 20px; text-align: center; flex-shrink: 0; }
        .nav-link-custom:hover {
            background: rgba(255,255,255,.08);
            color: #fff;
        }
        .nav-link-custom.active {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 2px 8px rgba(104,38,54,.4);
        }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,.08);
        }
        .user-card {
            display: flex; align-items: center; gap: 10px;
            padding: 10px;
            border-radius: 10px;
            background: rgba(255,255,255,.06);
        }
        .user-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: var(--primary);
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; font-weight: 700; color: #fff;
            flex-shrink: 0;
        }
        .user-info .u-name { color: #fff; font-size: 13px; font-weight: 600; }
        .user-info .u-role { color: rgba(255,255,255,.4); font-size: 11px; text-transform: capitalize; }

        .btn-logout {
            display: flex; align-items: center; gap: 6px;
            background: none; border: none;
            color: rgba(255,255,255,.45);
            font-size: 13px; cursor: pointer;
            padding: 8px 10px;
            border-radius: 8px;
            width: 100%;
            margin-top: 6px;
            transition: all .2s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .btn-logout:hover { background: rgba(220,38,38,.15); color: #fca5a5; }

        /* ═══════════ MAIN ═══════════ */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            height: var(--topbar-h);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            position: sticky; top: 0; z-index: 100;
        }

        .topbar-title { font-size: 16px; font-weight: 700; color: var(--text-main); }
        .topbar-right { display: flex; align-items: center; gap: 12px; }

        .page-content { padding: 28px; flex: 1; }

        /* ═══════════ CARDS ═══════════ */
        .card {
            border: 1px solid var(--border) !important;
            border-radius: 14px !important;
            box-shadow: 0 1px 4px rgba(0,0,0,.04) !important;
            background: var(--white);
        }
        .card-header-custom {
            padding: 20px 24px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .card-title-custom {
            font-size: 16px; font-weight: 700; color: var(--text-main);
        }
        .card-body-custom { padding: 20px 24px 24px; }

        /* ═══════════ STAT CARDS ═══════════ */
        .stat-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .stat-icon {
            width: 52px; height: 52px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }
        .stat-icon.primary { background: var(--primary-faint); color: var(--primary); }
        .stat-icon.success { background: #ecfdf5; color: var(--success); }
        .stat-icon.warning { background: #fffbeb; color: var(--warning); }
        .stat-value { font-size: 26px; font-weight: 800; color: var(--text-main); line-height: 1; }
        .stat-label { font-size: 12px; color: var(--text-muted); margin-top: 4px; font-weight: 500; }

        /* ═══════════ TABLE ═══════════ */
        .table-custom { width: 100%; border-collapse: collapse; }
        .table-custom th {
            background: var(--bg-body);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .7px;
            color: var(--text-muted);
            padding: 12px 16px;
            border: none;
        }
        .table-custom td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border);
            font-size: 13.5px;
            vertical-align: middle;
        }
        .table-custom tbody tr:last-child td { border-bottom: none; }
        .table-custom tbody tr:hover { background: #fafafa; }

        /* ═══════════ BADGES ═══════════ */
        .badge-custom {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 600;
        }
        .badge-borrowed { background: #fff8e1; color: #b45309; }
        .badge-returned { background: #ecfdf5; color: #065f46; }
        .badge-late     { background: #fef2f2; color: #991b1b; }
        .badge-stock-ok { background: #ecfdf5; color: #065f46; }
        .badge-stock-empty { background: #fef2f2; color: #991b1b; }

        /* ═══════════ BUTTONS ═══════════ */
        .btn-primary-custom {
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 9px 18px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all .2s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .btn-primary-custom:hover {
            background: var(--primary-dark);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(104,38,54,.3);
        }
        .btn-secondary-custom {
            background: var(--bg-body);
            color: var(--text-muted);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 9px 18px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all .2s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .btn-secondary-custom:hover { background: #ebebeb; color: var(--text-main); }

        .btn-icon {
            width: 32px; height: 32px;
            border-radius: 7px;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 14px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all .2s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .btn-icon.edit { background: #fffbeb; color: #b45309; }
        .btn-icon.edit:hover { background: #fef3c7; }
        .btn-icon.del  { background: #fef2f2; color: #dc2626; }
        .btn-icon.del:hover  { background: #fee2e2; }
        .btn-icon.accent { background: var(--primary-faint); color: var(--primary); }
        .btn-icon.accent:hover { background: #f0dde2; }

        /* ═══════════ FORMS ═══════════ */
        .form-group { margin-bottom: 18px; }
        .form-label-custom {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 6px;
            display: block;
        }
        .form-control-custom {
            width: 100%;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 13.5px;
            color: var(--text-main);
            background: #fafafa;
            outline: none;
            transition: all .2s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .form-control-custom:focus {
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(104,38,54,.1);
        }

        /* ═══════════ ALERTS ═══════════ */
        .alert-custom {
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        .alert-success { background: #ecfdf5; color: #065f46; border-left: 4px solid var(--success); }
        .alert-error   { background: #fef2f2; color: #991b1b; border-left: 4px solid var(--danger); }

        /* ═══════════ BOOK CARD (USER) ═══════════ */
        .book-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
            transition: all .25s;
        }
        .book-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0,0,0,.09);
        }
        .book-thumb {
            height: 140px;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-light));
            display: flex; align-items: center; justify-content: center;
            font-size: 48px;
            color: rgba(255,255,255,.5);
        }
        .book-info { padding: 16px; }
        .book-title { font-size: 14px; font-weight: 700; color: var(--text-main); margin-bottom: 4px; line-height: 1.3; }
        .book-author { font-size: 12px; color: var(--text-muted); }
        .book-footer { padding: 12px 16px; border-top: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }

        /* ═══════════ PAGINATION ═══════════ */
        .pagination .page-link {
            border-radius: 8px !important;
            margin: 0 2px;
            border: 1px solid var(--border) !important;
            color: var(--text-muted);
            font-size: 13px;
            font-weight: 500;
        }
        .pagination .page-item.active .page-link {
            background: var(--primary) !important;
            border-color: var(--primary) !important;
            color: #fff;
        }

        /* ═══════════ EMPTY STATE ═══════════ */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }
        .empty-state i { font-size: 48px; color: #d1d5db; margin-bottom: 16px; }
        .empty-state p { color: var(--text-muted); font-size: 14px; }
    </style>
</head>
<body>

@auth
<div class="sidebar" id="sidebar">
    <a class="sidebar-brand" href="#">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="brand-logo">
        <div class="brand-text">
            <div class="name">Perpustakaan</div>
            <div class="sub">Digital SMK</div>
        </div>
    </a>

    <nav class="sidebar-nav">
        @if(Auth::user()->role === 'admin')
            <div class="nav-section-label">Utama</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link-custom {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-pie"></i> Dashboard
            </a>

            <div class="nav-section-label">Manajemen Data</div>
            <a href="{{ route('books.index') }}" class="nav-link-custom {{ request()->routeIs('books.*') ? 'active' : '' }}">
                <i class="fa-solid fa-book"></i> Koleksi Buku
            </a>
            <a href="{{ route('users.index') }}" class="nav-link-custom {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i> Data Anggota
            </a>

            <div class="nav-section-label">Sirkulasi</div>
            <a href="{{ route('admin.transactions.index') }}" class="nav-link-custom {{ request()->routeIs('admin.transactions.*') ? 'active' : '' }}">
                <i class="fa-solid fa-right-left"></i> Peminjaman
            </a>
        @else
            <div class="nav-section-label">Menu</div>
            <a href="{{ route('user.dashboard') }}" class="nav-link-custom {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i> Beranda
            </a>
            <a href="{{ route('user.catalog') }}" class="nav-link-custom {{ request()->routeIs('user.catalog') ? 'active' : '' }}">
                <i class="fa-solid fa-book"></i> Katalog Buku
            </a>

            <div class="nav-section-label">Peminjaman</div>
            <a href="{{ route('user.transactions.history') }}" class="nav-link-custom {{ request()->routeIs('user.transactions.*') ? 'active' : '' }}">
                <i class="fa-solid fa-clock-rotate-left"></i> Riwayat Pinjam
            </a>
        @endif
    </nav>

    <div class="sidebar-footer">
        <div class="user-card">
            <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div class="user-info" style="flex:1; min-width:0">
                <div class="u-name text-truncate">{{ Auth::user()->name }}</div>
                <div class="u-role">{{ Auth::user()->role }}</div>
            </div>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar dari Akun
            </button>
        </form>
    </div>
</div>

<div class="main-wrapper">
    <div class="topbar">
        <span class="topbar-title">@yield('page-title', 'Dashboard')</span>
        <div class="topbar-right">
            <span style="font-size:12px; color:var(--text-muted);">{{ now()->isoFormat('dddd, D MMMM YYYY') }}</span>
        </div>
    </div>

    <div class="page-content">
        @if(session('success'))
            <div class="alert-custom alert-success">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert-custom alert-error">
                <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>
</div>

@else

{{-- Public Layout (Landing, Login, Register) --}}
<div style="min-height:100vh; background: var(--bg-body);">
    <nav style="background:var(--white); border-bottom:1px solid var(--border); padding: 0 32px; height:64px; display:flex; align-items:center; justify-content:space-between; position:sticky; top:0; z-index:100;">
        <a href="/" style="display:flex; align-items:center; gap:10px; text-decoration:none;">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:36px; width:auto; object-fit:contain;">
            <span style="font-weight:700; color:var(--text-main); font-size:15px;">Readly</span>
        </a>
        <div style="display:flex; gap:8px;">
            <a href="{{ route('login') }}" class="btn-secondary-custom">Login</a>
            <a href="{{ route('register') }}" class="btn-primary-custom">Daftar</a>
        </div>
    </nav>
    <div style="padding: 36px 32px;">
        @yield('content')
    </div>
</div>

@endauth

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
    // Konfigurasi global SweetAlert2 sesuai tema #682636
    const SwalCustom = Swal.mixin({
        confirmButtonColor: '#682636',
        cancelButtonColor:  '#6b7280',
        customClass: {
            popup:         'swal-popup-custom',
            title:         'swal-title-custom',
            htmlContainer: 'swal-text-custom',
            confirmButton: 'swal-btn-confirm',
            cancelButton:  'swal-btn-cancel',
        }
    });

    // Ganti semua form dengan data-confirm menjadi SweetAlert
    document.addEventListener('DOMContentLoaded', function () {

        // Handler tombol hapus / konfirmasi
        document.querySelectorAll('[data-swal-confirm]').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const form    = btn.closest('form');
                const title   = btn.dataset.swalTitle   || 'Yakin?';
                const text    = btn.dataset.swalText    || 'Tindakan ini tidak dapat dibatalkan.';
                const icon    = btn.dataset.swalIcon    || 'warning';
                const confirm = btn.dataset.swalConfirm || 'Ya, Lanjutkan';

                SwalCustom.fire({
                    title:              title,
                    text:               text,
                    icon:               icon,
                    showCancelButton:   true,
                    confirmButtonText:  confirm,
                    cancelButtonText:   'Batal',
                    reverseButtons:     true,
                }).then(function (result) {
                    if (result.isConfirmed) form.submit();
                });
            });
        });

        // Flash message success
        @if(session('success'))
        Swal.fire({
            toast:            true,
            position:         'top-end',
            icon:             'success',
            title:            @json(session('success')),
            showConfirmButton: false,
            timer:            3000,
            timerProgressBar: true,
            customClass: { popup: 'swal-toast-custom' }
        });
        @endif

        // Flash message error
        @if(session('error'))
        Swal.fire({
            toast:            true,
            position:         'top-end',
            icon:             'error',
            title:            @json(session('error')),
            showConfirmButton: false,
            timer:            4000,
            timerProgressBar: true,
            customClass: { popup: 'swal-toast-custom' }
        });
        @endif
    });
</script>
<style>
    /* SweetAlert2 custom styling agar selaras dengan desain */
    .swal-popup-custom {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        border-radius: 18px !important;
        padding: 28px !important;
    }
    .swal-title-custom {
        font-size: 18px !important;
        font-weight: 800 !important;
        color: #1a1a2e !important;
    }
    .swal-text-custom {
        font-size: 14px !important;
        color: #6b7280 !important;
    }
    .swal-btn-confirm, .swal-btn-cancel {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        font-size: 13px !important;
        font-weight: 700 !important;
        border-radius: 8px !important;
        padding: 10px 20px !important;
    }
    .swal-toast-custom {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        border-radius: 12px !important;
        font-size: 13.5px !important;
        font-weight: 600 !important;
    }
</style>
</body>
</html>
