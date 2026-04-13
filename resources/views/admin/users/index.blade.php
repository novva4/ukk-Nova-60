@extends('layouts.app')
@section('title', 'Data Anggota')
@section('page-title', 'Data Anggota')

@section('content')
<div class="card">
    <div class="card-header-custom">
        <span class="card-title-custom">Daftar Anggota</span>
        <a href="{{ route('users.create') }}" class="btn-primary-custom">
            <i class="bi bi-person-plus"></i> Tambah Anggota
        </a>
    </div>
    <div class="card-body-custom" style="padding-top:16px;">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Identitas Anggota</th>
                    <th>Email</th>
                    <th>Bergabung</th>
                    <th style="text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td style="color:var(--text-muted); font-size:12px;">{{ $user->id }}</td>
                    <td>
                        <div style="display:flex; align-items:center; gap:10px;">
                            <div style="width:34px;height:34px;border-radius:50%;background:var(--primary-faint);color:var(--primary);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:13px;flex-shrink:0;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <span style="font-weight:600; font-size:14px;">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td style="color:var(--text-muted); font-size:13px;">{{ $user->email }}</td>
                    <td style="color:var(--text-muted); font-size:13px;">{{ $user->created_at->format('d M Y') }}</td>
                    <td style="text-align:right;">
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="button" class="btn-icon del" title="Hapus Anggota"
                                data-swal-confirm
                                data-swal-title="Hapus Anggota?"
                                data-swal-text="Akun {{ addslashes($user->name) }} akan dihapus dari sistem."
                                data-swal-icon="warning"
                                data-swal-confirm="Ya, Hapus!"
                            ><i class="bi bi-trash3"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">
                        <div class="empty-state"><i class="bi bi-people"></i><p>Belum ada data anggota.</p></div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div style="margin-top:20px;">{{ $users->links('pagination::bootstrap-5') }}</div>
@endsection
