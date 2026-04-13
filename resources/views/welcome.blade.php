@extends('layouts.app')

@section('content')
<div style="max-width: 1100px; margin: 0 auto;">

    {{-- Hero --}}
    <div style="text-align:center; padding: 60px 20px 40px;">
        <div style="display:inline-flex;align-items:center;gap:8px; background:var(--primary-faint); color:var(--primary); font-size:12px; font-weight:700; padding:6px 14px; border-radius:20px; margin-bottom:20px; letter-spacing:.5px;">
            <i class="fa-solid fa-book-open"></i> PERPUSTAKAAN SEKOLAH DIGITAL
        </div>
        <h1 style="font-size: 3rem; font-weight:800; color:var(--text-main); line-height:1.2; margin-bottom:16px;">
            Jelajahi Ribuan Buku<br>
            <span style="color: var(--primary);">Hanya dengan Satu Klik</span>
        </h1>
        <p style="color:var(--text-muted); font-size:16px; max-width:520px; margin:0 auto 32px; line-height:1.7;">
            Platform manajemen perpustakaan modern untuk memudahkan peminjaman, pencarian, dan pengembalian buku sekolah secara efisien.
        </p>
        <div style="display:flex;justify-content:center;gap:12px; flex-wrap:wrap;">
            <a href="{{ route('register') }}" class="btn-primary-custom" style="padding: 12px 28px; font-size:15px; border-radius:10px;">
                <i class="bi bi-person-plus"></i> Daftar Gratis
            </a>
            <a href="{{ route('login') }}" class="btn-secondary-custom" style="padding: 12px 28px; font-size:15px; border-radius:10px;">
                <i class="bi bi-box-arrow-in-right"></i> Masuk ke Akun
            </a>
        </div>
    </div>

    {{-- Stats --}}
    <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:16px; margin-bottom:64px;">
        <div style="background:var(--white); border:1px solid var(--border); border-radius:14px; padding:24px; text-align:center;">
            <div style="font-size:36px; font-weight:800; color:var(--primary);">{{ $bookCount ?? 0 }}</div>
            <div style="font-size:13px; color:var(--text-muted); font-weight:500; margin-top:4px;">Koleksi Buku</div>
        </div>
        <div style="background:var(--white); border:1px solid var(--border); border-radius:14px; padding:24px; text-align:center;">
            <div style="font-size:36px; font-weight:800; color:var(--success);">{{ $userCount ?? 0 }}</div>
            <div style="font-size:13px; color:var(--text-muted); font-weight:500; margin-top:4px;">Siswa Terdaftar</div>
        </div>
        <div style="background:var(--primary); border:1px solid var(--border); border-radius:14px; padding:24px; text-align:center;">
            <div style="font-size:36px; font-weight:800; color:#fff;">7</div>
            <div style="font-size:13px; color:rgba(255,255,255,.7); font-weight:500; margin-top:4px;">Hari Batas Pinjam</div>
        </div>
    </div>

    {{-- How it works --}}
    <div style="text-align:center; margin-bottom:32px;">
        <h2 style="font-size:22px; font-weight:800; color:var(--text-main); margin-bottom:8px;">Cara Kerja Sistem</h2>
        <p style="color:var(--text-muted); font-size:14px;">Tiga langkah mudah untuk mulai meminjam buku</p>
    </div>

    <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:20px; margin-bottom:64px;">
        @foreach([
            ['icon'=>'fa-solid fa-circle-user','step'=>'01','title'=>'Buat Akun','desc'=>'Registrasikan diri menggunakan email aktif sekolah Anda untuk mendapatkan akses ke seluruh koleksi perpustakaan.'],
            ['icon'=>'fa-solid fa-magnifying-glass','step'=>'02','title'=>'Cari & Pinjam Buku','desc'=>'Telusuri katalog buku, cek ketersediaan stok, dan ajukan peminjaman langsung dari browser Anda.'],
            ['icon'=>'fa-solid fa-circle-check','step'=>'03','title'=>'Kembalikan Tepat Waktu','desc'=>'Kembalikan buku fisik ke perpustakaan maksimal 7 hari dari tanggal peminjaman untuk menghindari status terlambat.'],
        ] as $step)
        <div style="background:var(--white); border:1px solid var(--border); border-radius:14px; padding:28px;">
            <div style="display:flex; align-items:center; gap:12px; margin-bottom:16px;">
                <div style="width:44px;height:44px;background:var(--primary-faint);border-radius:10px;display:flex;align-items:center;justify-content:center;color:var(--primary);font-size:20px;">
                    <i class="{{ $step['icon'] }}"></i>
                </div>
                <span style="font-size:13px; font-weight:700; color:var(--primary); letter-spacing:1px;">LANGKAH {{ $step['step'] }}</span>
            </div>
            <h4 style="font-size:16px; font-weight:700; margin-bottom:8px;">{{ $step['title'] }}</h4>
            <p style="color:var(--text-muted); font-size:13px; line-height:1.7; margin:0;">{{ $step['desc'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- Footer --}}
    <div style="text-align:center; padding:24px 0; border-top:1px solid var(--border); color:var(--text-muted); font-size:13px;">
        &copy; {{ date('Y') }} Perpustakaan Digital SMK &mdash; Dibangun untuk Uji Kompetensi Keahlian
    </div>
</div>
@endsection
