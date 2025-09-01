@extends('layouts.app')

@section('title', 'Pelayanan Dukcapil')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Pelayanan Dukcapil</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('pelayanan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Buat Permohonan Baru
        </a>
    </div>
</div>

<!-- Search and Filter Form -->
<div class="row mb-3">
    <div class="col-md-8">
        <form method="GET" action="{{ route('pelayanan.index') }}">
            <div class="input-group">
                <input type="text" class="form-control" name="search"
                       value="{{ request('search') }}" placeholder="Cari berdasarkan nomor, jenis pelayanan, atau nama...">
                <select class="form-select" name="status" style="max-width: 150px;">
                    <option value="">Semua Status</option>
                    <option value="Diajukan" {{ request('status') == 'Diajukan' ? 'selected' : '' }}>Diajukan</option>
                    <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
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
                        <th>Nomor Permohonan</th>
                        <th>Nama Pemohon</th>
                        <th>Jenis Pelayanan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Petugas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelayanan as $item)
                    <tr>
                        <td>{{ $item->nomor_permohonan }}</td>
                        <td>{{ $item->penduduk->nama }}</td>
                        <td>{{ $item->jenis_pelayanan }}</td>
                        <td>{{ $item->tanggal_permohonan->format('d-m-Y') }}</td>
                        <td>
                            <span class="badge bg-{{
                                $item->status == 'Selesai' ? 'success' :
                                ($item->status == 'Diproses' ? 'warning' :
                                ($item->status == 'Ditolak' ? 'danger' : 'primary'))
                            }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td>{{ $item->pegawai ? $item->pegawai->nama : '-' }}</td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('pelayanan.show', $item) }}" class="btn btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('pelayanan.edit', $item) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('pelayanan.destroy', $item) }}"
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
                        <td colspan="7" class="text-center">Tidak ada data pelayanan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $pelayanan->links() }}
    </div>
</div>
@endsection
