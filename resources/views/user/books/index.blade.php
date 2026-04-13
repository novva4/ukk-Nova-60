@extends('layouts.app')
@section('title', 'Katalog Buku')
@section('page-title', 'Katalog Buku')

@section('content')
{{-- Flash Message untuk Feedback --}}
@if(session('success'))
    <div style="padding:12px 16px; background:#dcfce7; color:#166534; border-radius:8px; margin-bottom:20px; border:1px solid #bbf7d0;">
        <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="padding:12px 16px; background:#fee2e2; color:#991b1b; border-radius:8px; margin-bottom:20px; border:1px solid #fecaca;">
        <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
    </div>
@endif

<div style="margin-bottom:24px;">
    <h2 style="font-size:20px; font-weight:800; color:var(--text-main); margin:0 0 4px;">Koleksi Perpustakaan</h2>
    <p style="color:var(--text-muted); font-size:13.5px; margin:0;">Pilih buku yang ingin Anda pinjam. Stok ditampilkan secara real-time.</p>
</div>

<div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap:20px;">
    @forelse($books as $book)
    <div class="book-card" style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:12px; display:flex; flex-direction:column; transition: transform 0.2s; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">

        {{-- Cover Buku --}}
        <div class="book-thumb" style="height:260px; border-radius:8px; overflow:hidden; background:#f3f4f6; margin-bottom:12px; position:relative;">
            {{-- Logic Gambar: Cek database, kalau kosong pake placeholder --}}
            @if($book->cover)
                <img src="{{ asset('storage/' . $book->cover) }}"
                     alt="{{ $book->title }}"
                     style="width:100%; height:100%; object-fit:cover;">
            @else
                <div style="width:100%; height:100%; display:flex; flex-direction:column; align-items:center; justify-content:center; color:#9ca3af; background:#f9fafb;">
                    <i class="bi bi-image" style="font-size:2rem;"></i>
                    <span style="font-size:10px; margin-top:4px;">No Cover</span>
                </div>
            @endif

            {{-- Overlay kalau stok habis --}}
            @if($book->stock <= 0)
                <div style="position:absolute; inset:0; background:rgba(255,255,255,0.7); display:flex; align-items:center; justify-content:center; font-weight:700; color:#ef4444; text-transform:uppercase; letter-spacing:1px; backdrop-filter: blur(2px);">
                    Habis
                </div>
            @endif
        </div>

        <div class="book-info" style="flex-grow:1;">
            <div class="book-title" style="font-weight:700; font-size:15px; color:var(--text-main); margin-bottom:4px; line-height:1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 42px;">
                {{ $book->title }}
            </div>
            <div class="book-author" style="color:var(--text-muted); font-size:13px; margin-bottom:12px;">
                {{ $book->author }} &middot; {{ $book->year }}
            </div>
        </div>

        <div class="book-footer" style="display:flex; align-items:center; justify-content:space-between; gap:8px; margin-top:auto; padding-top:12px; border-top:1px solid #f3f4f6;">
            <span class="badge-custom" style="font-size:11px; padding:4px 8px; border-radius:4px; font-weight:600; background:{{ $book->stock > 0 ? '#f0fdf4' : '#f9fafb' }}; color:{{ $book->stock > 0 ? '#166534' : '#6b7280' }}; border: 1px solid {{ $book->stock > 0 ? '#bbf7d0' : '#e5e7eb' }};">
                {{ $book->stock }} stok
            </span>

            <form action="{{ route('user.borrow', $book->id) }}" method="POST" style="margin:0;">
                @csrf
                @if($book->stock > 0)
                    <button type="button" class="btn-primary-custom" style="padding:6px 12px; font-size:12px; border-radius:6px; cursor:pointer; display:flex; align-items:center; gap:4px;"
                        data-swal-confirm
                        data-swal-title="Konfirmasi Pinjam"
                        data-swal-text="Pinjam buku &quot;{{ addslashes($book->title) }}&quot;? Tenggat pengembalian 7 hari."
                        data-swal-icon="question"
                        data-swal-confirm-btn="Pinjam Sekarang">
                        <i class="bi bi-box-arrow-down"></i> Pinjam
                    </button>
                @else
                    <button type="button" disabled style="padding:6px 12px; font-size:12px; border-radius:6px; background:#f3f4f6; color:#9ca3af; border:1px solid #e5e7eb; cursor:not-allowed;">
                        <i class="bi bi-x-circle"></i> Habis
                    </button>
                @endif
            </form>
        </div>
    </div>
    @empty
    <div style="grid-column:1/-1; padding:60px 0;">
        <div class="empty-state" style="text-align:center;">
            <i class="bi bi-book" style="font-size:48px; color:#d1d5db;"></i>
            <p style="color:var(--text-muted); margin-top:12px;">Tidak ada buku yang tersedia saat ini.</p>
        </div>
    </div>
    @endforelse
</div>

<div style="margin-top:28px;">
    {{ $books->links('pagination::bootstrap-5') }}
</div>
@endsection
