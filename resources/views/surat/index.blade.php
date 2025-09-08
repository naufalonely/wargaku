@extends('layouts.app')

@section('title', 'Dokumen Surat')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Surat Pengantar</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('surat.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Buat Surat Baru
        </a>
    </div>
</div>

<!-- Search Form -->
<div class="row mb-3">
    <div class="col-md-6">
        <form method="GET" action="{{ route('surat.index') }}">
            <div class="input-group">
                <input type="text" class="form-control" name="search"
                       value="{{ request('search') }}" placeholder="Cari berdasarkan nomor surat, jenis, atau nama...">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nomor Surat</th>
                        <th>Nama Pemohon</th>
                        <th>Jenis Surat</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Dibuat Oleh</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($surats as $surat)
                    <tr>
                        <td>{{ $surat->nomor_surat }}</td>
                        <td>{{ $surat->penduduk->nama }}</td>
                        <td>{{ $surat->jenis_surat }}</td>
                        <td>{{ $surat->tanggal_surat->format('d-m-Y') }}</td>
                        <td>
                            <span class="badge bg-{{ $surat->status == 'Diterbitkan' ? 'success' : ($surat->status == 'Draft' ? 'warning' : 'danger') }}">
                                {{ $surat->status }}
                            </span>
                        </td>
                        <td>{{ $surat->pegawai->nama }}</td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('surat.show', $surat) }}" class="btn btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('surat.edit', $surat) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('surat.destroy', $surat) }}"
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data surat</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $surats->links() }}
    </div>
</div>
@endsection
