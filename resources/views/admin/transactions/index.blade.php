@extends('layouts.app')
@section('title', 'Sirkulasi Peminjaman')
@section('page-title', 'Sirkulasi Peminjaman')

@section('content')
<div class="card">
    <div class="card-header-custom">
        <span class="card-title-custom">Semua Transaksi Peminjaman</span>
    </div>
    <div class="card-body-custom" style="padding-top:16px;">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Peminjam</th>
                    <th>Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Batas Kembali</th>
                    <th>Status</th>
                    <th style="text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $trx)
                <tr>
                    <td style="color:var(--text-muted); font-size:12px;">{{ $trx->id }}</td>
                    <td>
                        <div style="font-weight:600; font-size:13.5px;">{{ $trx->user->name }}</div>
                        <div style="font-size:11.5px; color:var(--text-muted);">{{ $trx->user->email }}</div>
                    </td>
                    <td style="font-size:13px; max-width:180px;">{{ Str::limit($trx->book->title, 35) }}</td>
                    <td style="font-size:13px; color:var(--text-muted);">{{ \Carbon\Carbon::parse($trx->borrow_date)->format('d M Y') }}</td>
                    <td style="font-size:13px; color:var(--text-muted);">{{ \Carbon\Carbon::parse($trx->return_date)->format('d M Y') }}</td>
                    <td>
                        @if($trx->status === 'borrowed')
                            <span class="badge-custom badge-borrowed">Dipinjam</span>
                        @elseif($trx->status === 'returned')
                            <span class="badge-custom badge-returned">Dikembalikan</span>
                        @else
                            <span class="badge-custom badge-late">Terlambat</span>
                        @endif
                    </td>
                    <td style="text-align:right;">
                        @if($trx->status === 'borrowed')
                        <form action="{{ route('admin.transactions.return', $trx->id) }}" method="POST">
                            @csrf
                            <button type="button" class="btn-primary-custom" style="padding:7px 14px; font-size:12px; border-radius:7px;"
                                data-swal-confirm
                                data-swal-title="Konfirmasi Pengembalian"
                                data-swal-text="Proses pengembalian buku dari {{ addslashes($trx->user->name) }}?"
                                data-swal-icon="question"
                                data-swal-confirm="Ya, Terima Kembali"
                            ><i class="bi bi-check2"></i> Terima Kembali</button>
                        </form>
                        @else
                            <span style="font-size:12px; color:var(--text-muted);">—</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state"><i class="bi bi-arrow-left-right"></i><p>Belum ada transaksi peminjaman.</p></div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div style="margin-top:20px;">{{ $transactions->links('pagination::bootstrap-5') }}</div>
@endsection
