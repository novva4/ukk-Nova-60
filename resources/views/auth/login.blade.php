@extends('layouts.app')

@section('content')
<div style="display:flex; align-items:center; justify-content:center; min-height: calc(100vh - 130px);">
    <div style="width:100%; max-width:420px;">
        <div style="background:var(--white); border:1px solid var(--border); border-radius:20px; padding:40px; box-shadow:0 4px 24px rgba(0,0,0,.06);">
            <div style="text-align:center; margin-bottom:32px;">
                <div style="width:56px;height:56px;background:var(--primary-faint);border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width:42px;height:42px;object-fit:contain;">
                </div>
                <h2 style="font-size:22px; font-weight:800; color:var(--text-main); margin:0 0 6px;">Selamat Datang</h2>
                <p style="color:var(--text-muted); font-size:14px; margin:0;">Masuk untuk mengakses perpustakaan digital</p>
            </div>

            @if($errors->any())
            <div class="alert-custom alert-error">
                <i class="bi bi-exclamation-triangle-fill"></i> Email atau password salah.
            </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label-custom">Alamat Email</label>
                    <input type="email" name="email" class="form-control-custom" placeholder="email@sekolah.com" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="form-group" style="margin-bottom:24px;">
                    <label class="form-label-custom">Password</label>
                    <input type="password" name="password" class="form-control-custom" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn-primary-custom" style="width:100%; justify-content:center; padding:12px; font-size:15px; border-radius:10px;">
                    Masuk ke Akun
                </button>
            </form>

            <div style="text-align:center; margin-top:24px; padding-top:20px; border-top:1px solid var(--border); font-size:13.5px; color:var(--text-muted);">
                Belum punya akun? <a href="{{ route('register') }}" style="color:var(--primary); font-weight:700; text-decoration:none;">Daftar sekarang</a>
            </div>
        </div>
    </div>
</div>
@endsection
