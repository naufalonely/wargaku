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

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="penduduk_search" class="form-label">Nama Pemohon <span class="text-danger">*</span></label>
                            <div class="position-relative">
                                <input type="text" id="penduduk_search" class="form-control @error('penduduk_id') is-invalid @enderror" placeholder="Cari nama atau NIK" value="{{ old('penduduk_name', '') }}">
                                <input type="hidden" id="penduduk_id" name="penduduk_id" value="{{ old('penduduk_id') }}" required>
                                <div id="penduduk_results" class="list-group position-absolute w-100" style="z-index:1050;"></div>
                            </div>
                            @error('penduduk_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
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

                        <div class="col-md-6">
                            <label for="tanggal_permohonan" class="form-label">Tanggal Permohonan <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_permohonan') is-invalid @enderror"
                                   id="tanggal_permohonan" name="tanggal_permohonan" value="{{ old('tanggal_permohonan', date('Y-m-d')) }}" required>
                            @error('tanggal_permohonan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="keterangan" class="form-label">Keterangan <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                      id="keterangan" name="keterangan" rows="4" required>{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
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

@section('scripts')
<script>
    (function(){
        const searchInput = document.getElementById('penduduk_search');
        const resultsBox = document.getElementById('penduduk_results');
        const hiddenInput = document.getElementById('penduduk_id');
        let timeout = null;

        function clearResults(){ resultsBox.innerHTML = ''; }

        function renderResults(items){
            clearResults();
            if (!items.length) return;
            items.forEach(i => {
                const a = document.createElement('a');
                a.href = '#';
                a.className = 'list-group-item list-group-item-action';
                a.dataset.id = i.id;
                a.textContent = i.nama + ' (' + i.nik + ')';
                a.addEventListener('click', function(e){
                    e.preventDefault();
                    hiddenInput.value = this.dataset.id;
                    searchInput.value = this.textContent;
                    clearResults();
                });
                resultsBox.appendChild(a);
            });
        }

        searchInput.addEventListener('input', function(){
            const q = this.value.trim();
            hiddenInput.value = '';
            if (timeout) clearTimeout(timeout);
            if (q.length < 2) { clearResults(); return; }
            timeout = setTimeout(() => {
                fetch('/api/penduduk/search?q=' + encodeURIComponent(q))
                    .then(r => r.json())
                    .then(data => renderResults(data))
                    .catch(() => clearResults());
            }, 250);
        });

        document.addEventListener('click', function(e){
            if (!resultsBox.contains(e.target) && e.target !== searchInput) clearResults();
        });
    })();
</script>
@endsection
