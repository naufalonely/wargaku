@extends('layouts.app')

@section('title', 'Edit Surat')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Surat Pengantar</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('surat.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('surat.update', $surat) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nomor_surat" class="form-label">Nomor Surat</label>
                        <input type="text" class="form-control" id="nomor_surat" value="{{ $surat->nomor_surat }}" readonly>
                        <div class="form-text">Nomor surat tidak dapat diubah</div>
                    </div>

                    <div class="mb-3">
                        <label for="penduduk_id" class="form-label">Nama Pemohon <span class="text-danger">*</span></label>
                        <select class="form-select @error('penduduk_id') is-invalid @enderror" id="penduduk_id" name="penduduk_id" required>
                            <option value="">Pilih Pemohon</option>
                            @foreach($penduduks as $penduduk)
                                <option value="{{ $penduduk->id }}" {{ old('penduduk_id', $surat->penduduk_id) == $penduduk->id ? 'selected' : '' }}>
                                    {{ $penduduk->nama }} ({{ $penduduk->nik }})
                                </option>
                            @endforeach
                        </select>
                        @error('penduduk_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jenis_surat" class="form-label">Jenis Surat <span class="text-danger">*</span></label>
                        <select class="form-select @error('jenis_surat') is-invalid @enderror" id="jenis_surat" name="jenis_surat" required>
                            <option value="">Pilih Jenis Surat</option>
                            <option value="Kartu Keluarga" {{ old('jenis_surat') == 'Kartu Keluarga' ? 'selected' : '' }}>Kartu Keluarga</option>
                            <option value="Kartu Tanda Penduduk" {{ old('jenis_surat') == 'Kartu Tanda Penduduk' ? 'selected' : '' }}>Kartu Tanda Penduduk</option>
                            <option value="Kartu Identitas Anak" {{ old('jenis_surat') == 'Kartu Identitas Anak' ? 'selected' : '' }}>Kartu Identitas Anak</option>
                            <option value="Surat Keterangan Pindah" {{ old('jenis_surat') == 'Surat Keterangan Pindah' ? 'selected' : '' }}>Surat Keterangan Pindah</option>
                            <option value="Surat Keterangan Pindah Luar Negeri" {{ old('jenis_surat') == 'Surat Keterangan Pindah Luar Negeri' ? 'selected' : '' }}>Surat Keterangan Pindah Luar Negeri</option>
                            <option value="Surat Keterangan Tempat Tinggal" {{ old('jenis_surat') == 'Surat Keterangan Tempat Tinggal' ? 'selected' : '' }}>Surat Keterangan Tempat Tinggal</option>
                            <option value="Surat Keterangan Lahir Mati" {{ old('jenis_surat') == 'Surat Keterangan Lahir Mati' ? 'selected' : '' }}>Surat Keterangan Lahir Mati</option>
                            <option value="Surat Keterangan Pembatalan Perkawinan" {{ old('jenis_surat') == 'Surat Keterangan Pembatalan Perkawinan' ? 'selected' : '' }}>Surat Keterangan Pembatalan Perkawinan</option>
                            <option value="Surat Keterangan Pembatalan Perceraian" {{ old('jenis_surat') == 'Surat Keterangan Pembatalan Perceraian' ? 'selected' : '' }}>Surat Keterangan Pembatalan Perceraian</option>
                            <option value="Surat Keterangan Pengangkatan Anak" {{ old('jenis_surat') == 'Surat Keterangan Pengangkatan Anak' ? 'selected' : '' }}>Surat Keterangan Pengangkatan Anak</option>
                            <option value="Surat Keterangan Pelepasan Kewarganegaraan Indonesia" {{ old('jenis_surat') == 'Surat Keterangan Pelepasan Kewarganegaraan Indonesia' ? 'selected' : '' }}>Surat Keterangan Pelepasan Kewarganegaraan Indonesia</option>
                            <option value="Surat Keterangan Pengganti Tanda Identitas" {{ old('jenis_surat') == 'Surat Keterangan Pengganti Tanda Identitas' ? 'selected' : '' }}>Surat Keterangan Pengganti Tanda Identitas</option>
                            <option value="Surat Keterangan Pencatatan Sipil" {{ old('jenis_surat') == 'Surat Keterangan Pencatatan Sipil' ? 'selected' : '' }}>Surat Keterangan Pencatatan Sipil</option>
                            <option value="Akta Kelahiran" {{ old('jenis_surat') == 'Akta Kelahiran' ? 'selected' : '' }}>Akta Kelahiran</option>
                            <option value="Akta Kematian" {{ old('jenis_surat') == 'Akta Kematian' ? 'selected' : '' }}>Akta Kematian</option>
                            <option value="Akta Perkawinan" {{ old('jenis_surat') == 'Akta Perkawinan' ? 'selected' : '' }}>Akta Perkawinan</option>
                            <option value="Akta Perceraian" {{ old('jenis_surat') == 'Akta Perceraian' ? 'selected' : '' }}>Akta Perceraian</option>
                            <option value="Akta Pengakuan Anak" {{ old('jenis_surat') == 'Akta Pengakuan Anak' ? 'selected' : '' }}>Akta Pengakuan Anak</option>
                            <option value="Akta Pengesahan Anak" {{ old('jenis_surat') == 'Akta Pengesahan Anak' ? 'selected' : '' }}>Akta Pengesahan Anak</option>
                            <option value="Surat Keterangan Domisili" {{ old('jenis_surat') == 'Surat Keterangan Domisili' ? 'selected' : '' }}>Surat Keterangan Domisili</option>
                        </select>
                        @error('jenis_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="keperluan" class="form-label">Keperluan <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('keperluan') is-invalid @enderror"
                                  id="keperluan" name="keperluan" rows="4" required>{{ old('keperluan', $surat->keperluan) }}</textarea>
                        @error('keperluan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tanggal_surat" class="form-label">Tanggal Surat <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_surat') is-invalid @enderror"
                                   id="tanggal_surat" name="tanggal_surat" value="{{ old('tanggal_surat', $surat->tanggal_surat->format('Y-m-d')) }}" required>
                            @error('tanggal_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">Pilih Status</option>
                                <option value="Draft" {{ old('status', $surat->status) == 'Draft' ? 'selected' : '' }}>Draft</option>
                                <option value="Diterbitkan" {{ old('status', $surat->status) == 'Diterbitkan' ? 'selected' : '' }}>Diterbitkan</option>
                                <option value="Dibatalkan" {{ old('status', $surat->status) == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('surat.index') }}" class="btn btn-secondary me-md-2">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update Surat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6>Informasi Surat</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr>
                        <th>Nomor Surat</th>
                        <td>{{ $surat->nomor_surat }}</td>
                    </tr>
                    <tr>
                        <th>Status Saat Ini</th>
                        <td>
                            <span class="badge bg-{{ $surat->status == 'Diterbitkan' ? 'success' : ($surat->status == 'Draft' ? 'warning' : 'danger') }}">
                                {{ $surat->status }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Dibuat oleh</th>
                        <td>{{ $surat->pegawai->nama }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal dibuat</th>
                        <td>{{ $surat->created_at->format('d F Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Terakhir diupdate</th>
                        <td>{{ $surat->updated_at->format('d F Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6>Data Pemohon Saat Ini</h6>
            </div>
            <div class="card-body">
                <p class="mb-1"><strong>Nama:</strong> {{ $surat->penduduk->nama }}</p>
                <p class="mb-1"><strong>NIK:</strong> {{ $surat->penduduk->nik }}</p>
                <p class="mb-1"><strong>Alamat:</strong> {{ $surat->penduduk->alamat }}</p>
                <p class="mb-0"><strong>Status:</strong>
                    <span class="badge bg-{{ $surat->penduduk->status == 'Aktif' ? 'success' : 'warning' }}">
                        {{ $surat->penduduk->status }}
                    </span>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
