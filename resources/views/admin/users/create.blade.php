@extends('layouts.app')
@section('title', 'Tambah Anggota')
@section('page-title', 'Tambah Anggota Baru')

@section('content')
<div style="max-width:480px;">
    <div class="card">
        <div class="card-header-custom">
            <span class="card-title-custom">Data Anggota Baru</span>
        </div>
        <div class="card-body-custom">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label-custom">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control-custom" required>
                </div>
                <div class="form-group">
                    <label class="form-label-custom">Alamat Email</label>
                    <input type="email" name="email" class="form-control-custom" required>
                </div>
                <div class="form-group" style="margin-bottom:24px;">
                    <label class="form-label-custom">Password Default</label>
                    <input type="password" name="password" class="form-control-custom" required>
                </div>
                <div style="display:flex; gap:10px;">
                    <button type="submit" class="btn-primary-custom"><i class="bi bi-check-lg"></i> Simpan</button>
                    <a href="{{ route('users.index') }}" class="btn-secondary-custom"><i class="bi bi-arrow-left"></i> Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
