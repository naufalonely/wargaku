@extends('layouts.app')

@section('title', 'Detail Pegawai')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detail Pegawai</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('pegawai.index') }}" class="btn btn-outline-secondary me-2">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
        @if(auth('pegawai')->check() && auth('pegawai')->user()->level === 'admin')
            <a href="{{ route('pegawai.edit', $pegawai) }}" class="btn btn-primary">
                <i class="fas fa-edit me-1"></i> Edit
            </a>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-user-tie me-2"></i>
                    Informasi Pegawai
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="150">NIP</th>
                                <td>{{ $pegawai->nip }}</td>
                            </tr>
                            <tr>
                                <th>Nama Lengkap</th>
                                <td>{{ $pegawai->nama }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $pegawai->email }}</td>
                            </tr>
                            <tr>
                                <th>Jabatan</th>
                                <td>{{ $pegawai->jabatan }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="150">Level</th>
                                <td>
                                    <span class="badge bg-{{ $pegawai->level == 'admin' ? 'danger' : 'primary' }}">
                                        {{ ucfirst($pegawai->level) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <span class="badge bg-{{ $pegawai->is_active ? 'success' : 'secondary' }}">
                                        {{ $pegawai->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Data Dibuat</th>
                                <td>{{ $pegawai->created_at->locale('id')->translatedFormat('d F Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Terakhir Update</th>
                                <td>{{ $pegawai->updated_at->locale('id')->translatedFormat('d F Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
