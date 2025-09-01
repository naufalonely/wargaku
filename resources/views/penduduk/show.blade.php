@extends('layouts.app')

@section('title', 'Detail Penduduk')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detail Penduduk</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('penduduk.index') }}" class="btn btn-outline-secondary me-2">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
        <a href="{{ route('penduduk.edit', $penduduk) }}" class="btn btn-primary">
            <i class="fas fa-edit me-1"></i> Edit
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-user me-2"></i>
                    Informasi Penduduk
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="150">NIK</th>
                                <td>{{ $penduduk->nik }}</td>
                            </tr>
                            <tr>
                                <th>Nama Lengkap</th>
                                <td>{{ $penduduk->nama }}</td>
                            </tr>
                            <tr>
                                <th>Tempat Lahir</th>
                                <td>{{ $penduduk->tempat_lahir }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir</th>
                                <td>{{ $penduduk->tanggal_lahir->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Umur</th>
                                <td>{{ $penduduk->umur }} tahun</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>{{ $penduduk->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            </tr>
                            <tr>
                                <th>Agama</th>
                                <td>{{ $penduduk->agama }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="150">Status Perkawinan</th>
                                <td>{{ $penduduk->status_perkawinan }}</td>
                            </tr>
                            <tr>
                                <th>Pekerjaan</th>
                                <td>{{ $penduduk->pekerjaan }}</td>
                            </tr>
                            <tr>
                                <th>Kewarganegaraan</th>
                                <td>{{ $penduduk->kewarganegaraan }}</td>
                            </tr>
                            <tr>
                                <th>No. Telepon</th>
                                <td>{{ $penduduk->no_telepon ?: '-' }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <span class="badge bg-{{ $penduduk->status == 'Aktif' ? 'success' : ($penduduk->status == 'Pindah' ? 'warning' : 'danger') }}">
                                        {{ $penduduk->status }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Data Dibuat</th>
                                <td>{{ $penduduk->created_at->format('d F Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Terakhir Update</th>
                                <td>{{ $penduduk->updated_at->format('d F Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="fas fa-map-marker-alt me-2"></i>
                    Alamat
                </h6>
            </div>
            <div class="card-body">
                <p class="mb-2"><strong>Alamat:</strong></p>
                <p>{{ $penduduk->alamat }}</p>
                <div class="row">
                    <div class="col-6">
                        <p class="mb-1"><strong>RT:</strong> {{ $penduduk->rt }}</p>
                    </div>
                    <div class="col-6">
                        <p class="mb-1"><strong>RW:</strong> {{ $penduduk->rw }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Riwayat Surat -->
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="fas fa-file-alt me-2"></i>
                    Riwayat Surat
                </h6>
            </div>
            <div class="card-body">
                @forelse($penduduk->surats()->latest()->take(5)->get() as $surat)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <small class="fw-bold">{{ $surat->jenis_surat }}</small><br>
                            <small class="text-muted">{{ $surat->created_at->format('d M Y') }}</small>
                        </div>
                        <span class="badge bg-{{ $surat->status == 'Diterbitkan' ? 'success' : 'warning' }}">
                            {{ $surat->status }}
                        </span>
                    </div>
                    @if(!$loop->last)<hr class="my-2">@endif
                @empty
                    <p class="text-muted mb-0">Belum ada surat yang dibuat</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
