@extends('layouts.app')
@section('title', 'Edit Buku')
@section('page-title', 'Edit Data Buku')

@section('content')
<div style="max-width:640px;">
    <div class="card">
        <div class="card-header-custom">
            <span class="card-title-custom">Edit: {{ Str::limit($book->title, 40) }}</span>
        </div>
        <div class="card-body-custom">
            <form action="{{ route('books.update', $book->id) }}" method="POST">
                @csrf @method('PUT')
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:0 20px;">
                    <div class="form-group">
                        <label class="form-label-custom">Judul Buku</label>
                        <input type="text" name="title" class="form-control-custom" value="{{ $book->title }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label-custom">Penulis</label>
                        <input type="text" name="author" class="form-control-custom" value="{{ $book->author }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label-custom">Penerbit</label>
                        <input type="text" name="publisher" class="form-control-custom" value="{{ $book->publisher }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label-custom">Tahun Terbit</label>
                        <input type="number" name="year" class="form-control-custom" value="{{ $book->year }}" required>
                    </div>
                    <div class="form-group" style="grid-column: span 2;">
                        <label class="form-label-custom">Jumlah Stok</label>
                        <input type="number" name="stock" class="form-control-custom" value="{{ $book->stock }}" min="0" required>
                    </div>
                </div>
                <div style="display:flex; gap:10px; margin-top:8px;">
                    <button type="submit" class="btn-primary-custom">
                        <i class="bi bi-save"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('books.index') }}" class="btn-secondary-custom">
                        <i class="bi bi-arrow-left"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
