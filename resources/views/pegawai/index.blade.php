@extends('layouts.app')

@section('title', 'Data Pegawai')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Pegawai</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('pegawai.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Tambah Pegawai
        </a>
    </div>
</div>

<!-- Search Form -->
<div class="row mb-3">
    <div class="col-md-6">
        <form method="GET" action="{{ route('pegawai.index') }}">
            <div class="input-group">
                <input type="text" class="form-control" name="search"
                       value="{{ request('search') }}" placeholder="Cari berdasarkan nama, NIP, atau jabatan...">
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
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jabatan</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pegawais as $pegawai)
                    <tr>
                        <td>{{ $pegawai->nip }}</td>
                        <td>{{ $pegawai->nama }}</td>
                        <td>{{ $pegawai->email }}</td>
                        <td>{{ $pegawai->jabatan }}</td>
                        <td>
                            <span class="badge bg-{{ $pegawai->level == 'admin' ? 'danger' : 'primary' }}">
                                {{ ucfirst($pegawai->level) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $pegawai->is_active ? 'success' : 'secondary' }}">
                                {{ $pegawai->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('pegawai.show', $pegawai) }}" class="btn btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('pegawai.edit', $pegawai) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('pegawai.destroy', $pegawai) }}"
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
                        <td colspan="7" class="text-center">Tidak ada data pegawai</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $pegawais->links() }}
    </div>
</div>
@endsection
