@extends('layouts.app')
@section('title', 'Koleksi Buku')
@section('page-title', 'Koleksi Buku')

@section('content')
<div class="card">
    <div class="card-header-custom">
        <span class="card-title-custom">Daftar Buku</span>
        <a href="{{ route('books.create') }}" class="btn-primary-custom">
            <i class="bi bi-plus-lg"></i> Tambah Buku
        </a>
    </div>
    <div class="card-body-custom" style="padding-top:16px;">
        <table class="table-custom">
            <thead>
                <tr>
                    <th style="width:40px;">#</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th style="text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                <tr>
                    <td style="color:var(--text-muted); font-size:12px;">{{ $book->id }}</td>
                    <td>
                        <div style="font-weight:600; font-size:14px; color:var(--text-main);">{{ $book->title }}</div>
                    </td>
                    <td style="color:var(--text-muted); font-size:13px;">{{ $book->author }}</td>
                    <td style="color:var(--text-muted); font-size:13px;">{{ $book->publisher }}</td>
                    <td style="color:var(--text-muted); font-size:13px;">{{ $book->year }}</td>
                    <td>
                        @if($book->stock > 0)
                            <span class="badge-custom badge-stock-ok">{{ $book->stock }} tersedia</span>
                        @else
                            <span class="badge-custom badge-stock-empty">Habis</span>
                        @endif
                    </td>
                    <td style="text-align:right;">
                        <div style="display:flex; justify-content:flex-end; gap:6px;">
                            <a href="{{ route('books.edit', $book->id) }}" class="btn-icon edit" title="Edit Buku"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="button" class="btn-icon del" title="Hapus Buku"
                                    data-swal-confirm
                                    data-swal-title="Hapus Buku?"
                                    data-swal-text="Buku '{{ addslashes($book->title) }}' akan dihapus permanen."
                                    data-swal-icon="warning"
                                    data-swal-confirm="Ya, Hapus!"
                                ><i class="bi bi-trash3"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <i class="bi bi-book"></i>
                            <p>Belum ada data buku dalam sistem.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div style="margin-top:20px;">{{ $books->links('pagination::bootstrap-5') }}</div>
@endsection
