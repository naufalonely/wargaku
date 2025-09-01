@extends('layouts.app')

@section('title', 'Buat Permohonan')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Buat Permohonan Pelayanan Dukcapil</h1>
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
                <form method="POST" action="{{ route('pelayanan.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="penduduk_id" class="form-label">Nama Pemohon <span class="text-danger">*</span></label>
                        <select class="form-select @error('penduduk_id') is-invalid @enderror" id="penduduk_id" name="penduduk_id" required>
                            <option value="">Pilih Pemohon</option>
                            @foreach($penduduks as $penduduk)
                                <option value="{{ $penduduk->id }}" {{ old('penduduk_id') == $penduduk->id ? 'selected' : '' }}>
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
                            <option value="Pendaftaran Kematian" {{ old('jenis_pelayanan') == 'Pendaftaran Kematian' ? 'selected' : '' }}>Pendaftaran Kematian</option>
                            <option value="Pendaftaran Kelahiran" {{ old('jenis_pelayanan') == 'Pendaftaran Kelahiran' ? 'selected' : '' }}>Pendaftaran Kelahiran</option>
                            <option value="Pindah Datang" {{ old('jenis_pelayanan') == 'Pindah Datang' ? 'selected' : '' }}>Pindah Datang</option>
                            <option value="Pindah Keluar" {{ old('jenis_pelayanan') == 'Pindah Keluar' ? 'selected' : '' }}>Pindah Keluar</option>
                            <option value="Penerbitan KTP" {{ old('jenis_pelayanan') == 'Penerbitan KTP' ? 'selected' : '' }}>Penerbitan KTP</option>
                            <option value="Penerbitan KK" {{ old('jenis_pelayanan') == 'Penerbitan KK' ? 'selected' : '' }}>Penerbitan KK</option>
                            <option value="Perubahan Data" {{ old('jenis_pelayanan') == 'Perubahan Data' ? 'selected' : '' }}>Perubahan Data</option>
                        </select>
                        @error('jenis_pelayanan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                  id="keterangan" name="keterangan" rows="4" required>{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_permohonan" class="form-label">Tanggal Permohonan <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('tanggal_permohonan') is-invalid @enderror"
                               id="tanggal_permohonan" name="tanggal_permohonan" value="{{ old('tanggal_permohonan', date('Y-m-d')) }}" required>
                        @error('tanggal_permohonan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('pelayanan.index') }}" class="btn btn-secondary me-md-2">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Buat Permohonan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
