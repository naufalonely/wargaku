@extends('layouts.app')

@section('title', 'Edit Pelayanan')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Pelayanan Dukcapil</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('pelayanan.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('pelayanan.update', $pelayanan) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nomor_permohonan" class="form-label">Nomor Permohonan</label>
                        <input type="text" class="form-control" id="nomor_permohonan" value="{{ $pelayanan->nomor_permohonan }}" readonly>
                        <div class="form-text">Nomor permohonan tidak dapat diubah</div>
                    </div>

                    <div class="mb-3">
                        <label for="penduduk_id" class="form-label">Nama Pemohon <span class="text-danger">*</span></label>
                        <select class="form-select @error('penduduk_id') is-invalid @enderror" id="penduduk_id" name="penduduk_id" required>
                            <option value="">Pilih Pemohon</option>
                            @foreach($penduduks as $penduduk)
                                <option value="{{ $penduduk->id }}" {{ old('penduduk_id', $pelayanan->penduduk_id) == $penduduk->id ? 'selected' : '' }}>
                                    {{ $penduduk->nama }} ({{ $penduduk->nik }})
                                </option>
                            @endforeach
                        </select>
                        @error('penduduk_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jenis_pelayanan" class="form-label">Jenis Pelayanan <span class="text-danger">*</span></label>
                        <select class="form-select @error('jenis_pelayanan') is-invalid @enderror" id="jenis_pelayanan" name="jenis_pelayanan" required>
                            <option value="">Pilih Jenis Pelayanan</option>
                            <option value="Pendaftaran Kelahiran" {{ old('jenis_pelayanan', $pelayanan->jenis_pelayanan) == 'Pendaftaran Kelahiran' ? 'selected' : '' }}>Pendaftaran Kelahiran</option>
                            <option value="Pendaftaran Kematian" {{ old('jenis_pelayanan', $pelayanan->jenis_pelayanan) == 'Pendaftaran Kematian' ? 'selected' : '' }}>Pendaftaran Kematian</option>
                            <option value="Pindah Datang" {{ old('jenis_pelayanan', $pelayanan->jenis_pelayanan) == 'Pindah Datang' ? 'selected' : '' }}>Pindah Datang</option>
                            <option value="Pindah Keluar" {{ old('jenis_pelayanan', $pelayanan->jenis_pelayanan) == 'Pindah Keluar' ? 'selected' : '' }}>Pindah Keluar</option>
                            <option value="Penerbitan KTP" {{ old('jenis_pelayanan', $pelayanan->jenis_pelayanan) == 'Penerbitan KTP' ? 'selected' : '' }}>Penerbitan KTP</option>
                            <option value="Penerbitan KK" {{ old('jenis_pelayanan', $pelayanan->jenis_pelayanan) == 'Penerbitan KK' ? 'selected' : '' }}>Penerbitan KK</option>
                            <option value="Perubahan Data" {{ old('jenis_pelayanan', $pelayanan->jenis_pelayanan) == 'Perubahan Data' ? 'selected' : '' }}>Perubahan Data</option>
                        </select>
                        @error('jenis_pelayanan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                  id="keterangan" name="keterangan" rows="4" required>{{ old('keterangan', $pelayanan->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tanggal_permohonan" class="form-label">Tanggal Permohonan <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_permohonan') is-invalid @enderror"
                                   id="tanggal_permohonan" name="tanggal_permohonan" value="{{ old('tanggal_permohonan', $pelayanan->tanggal_permohonan->format('Y-m-d')) }}" required>
                            @error('tanggal_permohonan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">Pilih Status</option>
                                <option value="Diajukan" {{ old('status', $pelayanan->status) == 'Diajukan' ? 'selected' : '' }}>Diajukan</option>
                                <option value="Diproses" {{ old('status', $pelayanan->status) == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="Selesai" {{ old('status', $pelayanan->status) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="Ditolak" {{ old('status', $pelayanan->status) == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan</label>
                        <textarea class="form-control @error('catatan') is-invalid @enderror"
                                  id="catatan" name="catatan" rows="3" placeholder="Tambahkan catatan jika diperlukan...">{{ old('catatan', $pelayanan->catatan) }}</textarea>
                        <div class="form-text">Catatan akan ditampilkan kepada pemohon</div>
                        @error('catatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('pelayanan.index') }}" class="btn btn-secondary me-md-2">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update Permohonan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-header">
                <h6>Status Saat Ini</h6>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <span class="badge bg-{{
                        $pelayanan->status == 'Selesai' ? 'success' :
                        ($pelayanan->status == 'Diproses' ? 'warning' :
                        ($pelayanan->status == 'Ditolak' ? 'danger' : 'primary'))
                    }} fs-6 px-3 py-2">
                        {{ $pelayanan->status }}
                    </span>
                </div>
                <hr>
                <table class="table table-borderless table-sm mb-0">
                    <tr>
                        <th>Dibuat</th>
                        <td>{{ $pelayanan->created_at->format('d F Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Diperbarui</th>
                        <td>{{ $pelayanan->updated_at->format('d F Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Petugas</th>
                        <td>{{ $pelayanan->pegawai ? $pelayanan->pegawai->nama : 'Belum ditugaskan' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h6>Data Pemohon Saat Ini</h6>
            </div>
            <div class="card-body">
                <p class="mb-1"><strong>Nama:</strong> {{ $pelayanan->penduduk->nama }}</p>
                <p class="mb-1"><strong>NIK:</strong> {{ $pelayanan->penduduk->nik }}</p>
                <p class="mb-1"><strong>Alamat:</strong> {{ $pelayanan->penduduk->alamat }}</p>
                <p class="mb-1"><strong>No. Telepon:</strong> {{ $pelayanan->penduduk->no_telepon ?: '-' }}</p>
                <p class="mb-0"><strong>Status:</strong>
                    <span class="badge bg-{{ $pelayanan->penduduk->status == 'Aktif' ? 'success' : 'warning' }}">
                        {{ $pelayanan->penduduk->status }}
                    </span>
                </p>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6>Tips Status</h6>
            </div>
            <div class="card-body">
                <small class="text-muted">
                    <strong>Diajukan:</strong> Permohonan baru masuk<br>
                    <strong>Diproses:</strong> Sedang diverifikasi/dikerjakan<br>
                    <strong>Selesai:</strong> Permohonan berhasil diselesaikan<br>
                    <strong>Ditolak:</strong> Permohonan tidak dapat diproses
                </small>
            </div>
        </div>
    </div>
</div>
@endsection
