@extends('layouts.app')
@section('title', 'Beranda Saya')
@section('page-title', 'Beranda')

@php
    $activeBorrows = \App\Models\Transaction::where('user_id', Auth::id())->where('status', 'borrowed')->count();
    $totalBorrows = \App\Models\Transaction::where('user_id', Auth::id())->count();
@endphp

@section('content')
    {{-- Greeting --}}
    <div
        style="background:linear-gradient(135deg, var(--primary-dark), var(--primary)); border-radius:16px; padding:28px 32px; color:#fff; margin-bottom:28px; display:flex; align-items:center; justify-content:space-between;">
        <div>
            <div style="font-size:13px; font-weight:600; color:rgba(255,255,255,.7); margin-bottom:6px;">Selamat datang
                kembali <i class="fa-solid fa-hand-wave"></i></div>
            <div style="font-size:24px; font-weight:800;">{{ Auth::user()->name }}</div>
            <div style="font-size:13px; color:rgba(255,255,255,.7); margin-top:6px;">Anggota Perpustakaan Digital SMK</div>
        </div>
        <i class="fa-solid fa-book-open" style="font-size:64px; opacity:.2;"></i>
    </div>

    {{-- Stats --}}
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:28px;">
        <div class="stat-card">
            <div class="stat-icon primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-book-icon lucide-book">
                    <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20" />
                </svg></i></div>
            <div>
                <div class="stat-value">{{ $activeBorrows }}</div>
                <div class="stat-label">Sedang Dipinjam</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-book-copy-icon lucide-book-copy">
                    <path d="M5 7a2 2 0 0 0-2 2v11" />
                    <path d="M5.803 18H5a2 2 0 0 0 0 4h9.5a.5.5 0 0 0 .5-.5V21" />
                    <path d="M9 15V4a2 2 0 0 1 2-2h9.5a.5.5 0 0 1 .5.5v14a.5.5 0 0 1-.5.5H11a2 2 0 0 1 0-4h10" />
                </svg></div>
            <div>
                <div class="stat-value">{{ $totalBorrows }}</div>
                <div class="stat-label">Total Riwayat Pinjam</div>
            </div>
        </div>
    </div>

    {{-- Limit info --}}
    @if ($activeBorrows >= 3)
        <div class="alert-custom alert-error">
            <i class="bi bi-exclamation-triangle-fill"></i>
            Batas peminjaman telah tercapai (3/3). Kembalikan buku aktif Anda sebelum dapat meminjam lagi.
        </div>
    @else
        <div class="alert-custom alert-success" style="margin-bottom:28px;">
            <i class="fa-solid fa-circle-check"></i>
            Anda masih dapat meminjam <strong>{{ 3 - $activeBorrows }} buku lagi</strong>. Kunjungi katalog untuk memilih.
        </div>
    @endif

    {{-- Quick Links --}}
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
        <a href="{{ route('user.catalog') }}"
            style="background:var(--white); border:1px solid var(--border); border-radius:14px; padding:24px; display:flex; align-items:center; gap:16px; text-decoration:none; transition: all .2s;"
            onmouseover="this.style.borderColor='var(--primary)'" onmouseout="this.style.borderColor='var(--border)'">
            <div
                style="width:46px;height:46px;background:var(--primary-faint);border-radius:12px;display:flex;align-items:center;justify-content:center;color:var(--primary);font-size:22px;flex-shrink:0;">
                <i class="bi bi-collection"></i>
            </div>
            <div>
                <div style="font-size:14px; font-weight:700; color:var(--text-main);">Katalog Buku</div>
                <div style="font-size:12px; color:var(--text-muted); margin-top:2px;">Telusuri & pinjam koleksi</div>
            </div>
        </a>
        <a href="{{ route('user.transactions.history') }}"
            style="background:var(--white); border:1px solid var(--border); border-radius:14px; padding:24px; display:flex; align-items:center; gap:16px; text-decoration:none; transition: all .2s;"
            onmouseover="this.style.borderColor='var(--primary)'" onmouseout="this.style.borderColor='var(--border)'">
            <div
                style="width:46px;height:46px;background:#ecfdf5;border-radius:12px;display:flex;align-items:center;justify-content:center;color:var(--success);font-size:22px;flex-shrink:0;">
                <i class="bi bi-clock-history"></i>
            </div>
            <div>
                <div style="font-size:14px; font-weight:700; color:var(--text-main);">Riwayat Pinjam</div>
                <div style="font-size:12px; color:var(--text-muted); margin-top:2px;">Cek status peminjaman</div>
            </div>
        </a>
    </div>
@endsection
