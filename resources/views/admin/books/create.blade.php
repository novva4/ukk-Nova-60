@extends('layouts.app')
@section('title', 'Tambah Buku')
@section('page-title', 'Tambah Buku Baru')

@section('content')
            <div style="max-width:640px;">
                        <div class="card">
                                    <div class="card-header-custom">
                                                <span class="card-title-custom">Form Buku Baru</span>
                                    </div>
                                    <div class="card-body-custom">
                                                <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div style="display:grid; grid-template-columns:1fr 1fr; gap:0 20px;">

                                                                        {{-- Input Cover Buku --}}
                                                                        <div class="form-group"
                                                                                    style="grid-column: span 2; margin-bottom: 15px;">
                                                                                    <label class="form-label-custom">Cover
                                                                                                Buku</label>
                                                                                    <input type="file" name="cover"
                                                                                                class="form-control-custom"
                                                                                                accept="image/*">
                                                                                    <small
                                                                                                style="color:var(--text-muted); font-size:11px;">Format:
                                                                                                JPG, PNG, WEBP (Max 2MB)</small>
                                                                                    @error('cover')
                                                                                                <div style="color:red; font-size:11px;">
                                                                                                            {{ $message }}</div>
                                                                                    @enderror
                                                                        </div>

                                                                        <div class="form-group">
                                                                                    <label class="form-label-custom">Judul
                                                                                                Buku</label>
                                                                                    <input type="text" name="title"
                                                                                                class="form-control-custom"
                                                                                                value="{{ old('title') }}"
                                                                                                required>
                                                                        </div>

                                                                        <div class="form-group">
                                                                                    <label class="form-label-custom">Penulis</label>
                                                                                    <input type="text" name="author"
                                                                                                class="form-control-custom"
                                                                                                value="{{ old('author') }}"
                                                                                                required>
                                                                        </div>

                                                                        <div class="form-group">
                                                                                    <label
                                                                                                class="form-label-custom">Penerbit</label>
                                                                                    <input type="text" name="publisher"
                                                                                                class="form-control-custom"
                                                                                                value="{{ old('publisher') }}"
                                                                                                required>
                                                                        </div>

                                                                        <div class="form-group">
                                                                                    <label class="form-label-custom">Tahun
                                                                                                Terbit</label>
                                                                                    <input type="number" name="year"
                                                                                                class="form-control-custom"
                                                                                                value="{{ old('year') }}"
                                                                                                required>
                                                                        </div>

                                                                        <div class="form-group" style="grid-column: span 2;">
                                                                                    <label class="form-label-custom">Jumlah
                                                                                                Stok</label>
                                                                                    <input type="number" name="stock"
                                                                                                class="form-control-custom"
                                                                                                value="{{ old('stock', 1) }}"
                                                                                                min="0" required>
                                                                        </div>
                                                            </div>

                                                            <div style="display:flex; gap:10px; margin-top:20px;">
                                                                        <button type="submit" class="btn-primary-custom">
                                                                                    <i class="bi bi-check-lg"></i> Simpan Buku
                                                                        </button>
                                                                        <a href="{{ route('books.index') }}"
                                                                                    class="btn-secondary-custom">
                                                                                    <i class="bi bi-arrow-left"></i> Batal
                                                                        </a>
                                                            </div>
                                                </form>
                                    </div>
                        </div>
            </div>
@endsection
