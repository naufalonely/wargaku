@extends('layouts.app')

@section('title', 'Detail Pelayanan')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detail Pelayanan Dukcapil</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('pelayanan.index') }}" class="btn btn-outline-secondary me-2">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
        <a href="{{ route('pelayanan.edit', $pelayanan) }}" class="btn btn-primary">
            <i class="fas fa-edit me-1"></i> Edit
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-clipboard-list me-2"></i>
                    Informasi Permohonan
                </h5>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="180">Nomor Permohonan</th>
                                <td>{{ $pelayanan->nomor_permohonan }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Pelayanan</th>
                                <td><strong>{{ $pelayanan->jenis_pelayanan }}</strong></td>
                            </tr>
                            <tr>
                                <th>Tanggal Permohonan</th>
                                <td>{{ $pelayanan->tanggal_permohonan->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <span class="badge bg-{{
                                        $pelayanan->status == 'Selesai' ? 'success' :
                                        ($pelayanan->status == 'Diproses' ? 'warning' :
                                        ($pelayanan->status == 'Ditolak' ? 'danger' : 'primary'))
                                    }} fs-6">
                                        {{ $pelayanan->status }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="150">Petugas</th>
                                <td>{{ $pelayanan->pegawai ? $pelayanan->pegawai->nama : '-' }}</td>
                            </tr>
                            <tr>
                                <th>Jabatan</th>
                                <td>{{ $pelayanan->pegawai ? $pelayanan->pegawai->jabatan : '-' }}</td>
                            </tr>
                            <tr>
                                <th>Dibuat</th>
                                <td>{{ $pelayanan->created_at->format('d F Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Diperbarui</th>
                                <td>{{ $pelayanan->updated_at->format('d F Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="mb-4">
                    <h6><strong>Keterangan Permohonan:</strong></h6>
                    <div class="bg-light p-3 rounded">
                        {{ $pelayanan->keterangan }}
                    </div>
                </div>

                @if($pelayanan->catatan)
                <div class="mb-4">
                    <h6><strong>Catatan:</strong></h6>
                    <div class="bg-info bg-opacity-10 p-3 rounded border border-info border-opacity-25">
                        {{ $pelayanan->catatan }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="fas fa-user me-2"></i>
                    Data Pemohon
                </h6>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <i class="fas fa-user fa-2x text-primary"></i>
                    </div>
                </div>
                <table class="table table-borderless table-sm">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $pelayanan->penduduk->nama }}</td>
                    </tr>
                    <tr>
                        <th>NIK</th>
                        <td>{{ $pelayanan->penduduk->nik }}</td>
                    </tr>
                    <tr>
                        <th>TTL</th>
                        <td>{{ $pelayanan->penduduk->tempat_lahir }}, {{ $pelayanan->penduduk->tanggal_lahir->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>{{ $pelayanan->penduduk->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $pelayanan->penduduk->alamat }} RT {{ $pelayanan->penduduk->rt }} RW {{ $pelayanan->penduduk->rw }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge bg-{{ $pelayanan->penduduk->status == 'Aktif' ? 'success' : 'warning' }}">
                                {{ $pelayanan->penduduk->status }}
                            </span>
                        </td>
                    </tr>
                </table>
                <div class="text-center mt-3">
                    <a href="{{ route('penduduk.show', $pelayanan->penduduk) }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-eye me-1"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="fas fa-history me-2"></i>
                    Timeline Status
                </h6>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item {{ $pelayanan->status == 'Diajukan' ? 'active' : 'completed' }}">
                        <div class="timeline-marker bg-primary"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Diajukan</h6>
                            <small class="text-muted">{{ $pelayanan->created_at->format('d M Y H:i') }}</small>
                        </div>
                    </div>

                    <div class="timeline-item {{ $pelayanan->status == 'Diproses' ? 'active' : ($pelayanan->status == 'Selesai' || $pelayanan->status == 'Ditolak' ? 'completed' : '') }}">
                        <div class="timeline-marker bg-warning"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Diproses</h6>
                            <small class="text-muted">
                                @if(in_array($pelayanan->status, ['Diproses', 'Selesai', 'Ditolak']))
                                    {{ $pelayanan->updated_at->format('d M Y H:i') }}
                                @else
                                    Menunggu
                                @endif
                            </small>
                        </div>
                    </div>

                    <div class="timeline-item {{ $pelayanan->status == 'Selesai' ? 'active completed' : ($pelayanan->status == 'Ditolak' ? 'active rejected' : '') }}">
                        <div class="timeline-marker bg-{{ $pelayanan->status == 'Selesai' ? 'success' : ($pelayanan->status == 'Ditolak' ? 'danger' : 'secondary') }}"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">
                                {{ $pelayanan->status == 'Ditolak' ? 'Ditolak' : 'Selesai' }}
                            </h6>
                            <small class="text-muted">
                                @if(in_array($pelayanan->status, ['Selesai', 'Ditolak']))
                                    {{ $pelayanan->updated_at->format('d M Y H:i') }}
                                @else
                                    Menunggu
                                @endif
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.timeline {
    position: relative;
    padding-left: 20px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 12px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #dee2e6;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -8px;
    top: 2px;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    border: 2px solid #fff;
    z-index: 1;
}

.timeline-content {
    margin-left: 15px;
}

.timeline-item.active .timeline-marker {
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25);
}

.timeline-item.completed .timeline-marker {
    background: #198754 !important;
}

.timeline-item.rejected .timeline-marker {
    background: #dc3545 !important;
}
</style>
@endsection
