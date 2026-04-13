@extends('layouts.app')
@section('title', 'Riwayat Pinjaman')
@section('page-title', 'Riwayat Peminjaman')

@section('content')
<div class="card">
    <div class="card-header-custom">
        <span class="card-title-custom">Riwayat Pinjaman Saya</span>
    </div>
    <div class="card-body-custom" style="padding-top:16px;">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Batas Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $index => $trx)
                <tr>
                    <td style="color:var(--text-muted); font-size:12px;">{{ $index + 1 }}</td>
                    <td>
                        <div style="font-weight:600; font-size:14px; color:var(--text-main);">{{ $trx->book->title }}</div>
                        <div style="font-size:12px; color:var(--text-muted);">{{ $trx->book->author }}</div>
                    </td>
                    <td style="font-size:13px; color:var(--text-muted);">{{ \Carbon\Carbon::parse($trx->borrow_date)->format('d M Y') }}</td>
                    <td style="font-size:13px; color:var(--text-muted);">
                        {{ \Carbon\Carbon::parse($trx->return_date)->format('d M Y') }}
                        @if($trx->status === 'borrowed' && now()->gt($trx->return_date))
                            <div style="font-size:11px; color:var(--danger); font-weight:600;">⚠ Melewati batas!</div>
                        @endif
                    </td>
                    <td>
                        @if($trx->status === 'borrowed')
                            <span class="badge-custom badge-borrowed">Sedang Dipinjam</span>
                        @elseif($trx->status === 'returned')
                            <span class="badge-custom badge-returned">Sudah Dikembalikan</span>
                        @else
                            <span class="badge-custom badge-late">Terlambat</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <i class="bi bi-clock-history" style="font-size:48px;color:#d1d5db;"></i>
                            <p style="color:var(--text-muted);margin-top:12px;">Anda belum memiliki riwayat peminjaman.</p>
                            <a href="{{ route('user.catalog') }}" class="btn-primary-custom" style="margin-top:8px; justify-content:center;">
                                <i class="bi bi-collection"></i> Kunjungi Katalog
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
