@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@php
    $bookCount = \App\Models\Book::count();
    $userCount = \App\Models\User::where('role', 'user')->count();
    $borrowCount = \App\Models\Transaction::where('status', 'borrowed')->count();
@endphp

@section('content')
    <div style="margin-bottom:28px;">
        <h2 style="font-size:22px; font-weight:800; color:var(--text-main); margin:0 0 4px;">Ringkasan Perpustakaan</h2>
        <p style="color:var(--text-muted); font-size:14px; margin:0;">Selamat datang kembali. Berikut ringkasan aktivitas
            hari ini.</p>
    </div>

    {{-- Stat Cards --}}
    <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:20px; margin-bottom:32px;">
        <div class="stat-card">
            <div class="stat-icon primary"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-book-icon lucide-book">
                    <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20" />
                </svg></div>
            <div>
                <div class="stat-value">{{ $bookCount }}</div>
                <div class="stat-label">Total Koleksi Buku</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon success"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-user-round-icon lucide-user-round">
                    <circle cx="12" cy="8" r="5" />
                    <path d="M20 21a8 8 0 0 0-16 0" />
                </svg></div>
            <div>
                <div class="stat-value">{{ $userCount }}</div>
                <div class="stat-label">Anggota Aktif</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon warning"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-clipboard-clock-icon lucide-clipboard-clock">
                    <path d="M16 14v2.2l1.6 1" />
                    <path d="M16 4h2a2 2 0 0 1 2 2v.832" />
                    <path d="M8 4H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h2" />
                    <circle cx="16" cy="16" r="6" />
                    <rect x="8" y="2" width="8" height="4" rx="1" />
                </svg></div>
            <div>
                <div class="stat-value">{{ $borrowCount }}</div>
                <div class="stat-label">Buku Sedang Dipinjam</div>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div
        style="margin-bottom:12px; font-size:13px; font-weight:700; color:var(--text-muted); text-transform:uppercase; letter-spacing:.7px;">
        Aksi Cepat</div>
    <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:16px;">
        <a href="{{ route('books.create') }}"
            style="background:var(--white); border:1px solid var(--border); border-radius:14px; padding:24px; display:flex; align-items:center; gap:16px; text-decoration:none; transition: all .2s;"
            onmouseover="this.style.borderColor='var(--primary)'" onmouseout="this.style.borderColor='var(--border)'">
            <div
                style="width:46px;height:46px;background:var(--primary-faint);border-radius:12px;display:flex;align-items:center;justify-content:center;color:var(--primary);font-size:20px;flex-shrink:0;">
                <i class="bi bi-plus-circle"></i>
            </div>
            <div>
                <div style="font-size:14px; font-weight:700; color:var(--text-main);">Tambah Buku Baru</div>
                <div style="font-size:12px; color:var(--text-muted); margin-top:2px;">Input koleksi baru</div>
            </div>
        </a>
        <a href="{{ route('users.create') }}"
            style="background:var(--white); border:1px solid var(--border); border-radius:14px; padding:24px; display:flex; align-items:center; gap:16px; text-decoration:none; transition: all .2s;"
            onmouseover="this.style.borderColor='var(--primary)'" onmouseout="this.style.borderColor='var(--border)'">
            <div
                style="width:46px;height:46px;background:#ecfdf5;border-radius:12px;display:flex;align-items:center;justify-content:center;color:var(--success);font-size:20px;flex-shrink:0;">
                <i class="bi bi-person-plus"></i>
            </div>
            <div>
                <div style="font-size:14px; font-weight:700; color:var(--text-main);">Daftarkan Anggota</div>
                <div style="font-size:12px; color:var(--text-muted); margin-top:2px;">Tambah siswa baru</div>
            </div>
        </a>
        <a href="{{ route('admin.transactions.index') }}"
            style="background:var(--white); border:1px solid var(--border); border-radius:14px; padding:24px; display:flex; align-items:center; gap:16px; text-decoration:none; transition: all .2s;"
            onmouseover="this.style.borderColor='var(--primary)'" onmouseout="this.style.borderColor='var(--border)'">
            <div
                style="width:46px;height:46px;background:#fffbeb;border-radius:12px;display:flex;align-items:center;justify-content:center;color:var(--warning);font-size:20px;flex-shrink:0;">
                <i class="bi bi-clipboard-check"></i>
            </div>
            <div>
                <div style="font-size:14px; font-weight:700; color:var(--text-main);">Cek Peminjaman</div>
                <div style="font-size:12px; color:var(--text-muted); margin-top:2px;">Proses pengembalian</div>
            </div>
        </a>
    </div>
@endsection
