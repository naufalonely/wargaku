@extends('layouts.app')

@section('title', 'Data Penduduk')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Penduduk</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('penduduk.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Tambah Penduduk
        </a>
    </div>
</div>

<!-- Search and Filter Form -->
<div class="row mb-3">
    <div class="col-md-8">
        <form method="GET" action="{{ route('penduduk.index') }}">
            <div class="input-group">
                <input type="text" class="form-control" name="search"
                       value="{{ request('search') }}" placeholder="Cari berdasarkan nama, NIK, atau alamat...">
                <select class="form-select" name="status" style="max-width: 150px;">
                    <option value="">Semua Status</option>
                    <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Pindah" {{ request('status') == 'Pindah' ? 'selected' : '' }}>Pindah</option>
                    <option value="Meninggal" {{ request('status') == 'Meninggal' ? 'selected' : '' }}>Meninggal</option>
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
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>TTL</th>
                        <th>JK</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penduduks as $penduduk)
                    <tr>
                        <td>{{ $penduduk->nik }}</td>
                        <td>{{ $penduduk->nama }}</td>
                        <td>{{ $penduduk->tempat_lahir }}, {{ $penduduk->tanggal_lahir->format('d-m-Y') }}</td>
                        <td>{{ $penduduk->jenis_kelamin }}</td>
                        <td>{{ $penduduk->alamat }} RT {{ $penduduk->rt }} RW {{ $penduduk->rw }}</td>
                        <td>
                            <span class="badge bg-{{ $penduduk->status == 'Aktif' ? 'success' : ($penduduk->status == 'Pindah' ? 'warning' : 'danger') }}">
                                {{ $penduduk->status }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('penduduk.show', $penduduk) }}" class="btn btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('penduduk.edit', $penduduk) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('penduduk.destroy', $penduduk) }}"
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
                        <td colspan="7" class="text-center">Tidak ada data penduduk</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $penduduks->links() }}
    </div>
</div>
@endsection
