@extends('layouts.app')

@section('title', 'Buat Surat')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Buat Surat</h1>
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
                <form method="POST" action="{{ route('surat.store') }}">
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
                            <label for="jenis_surat" class="form-label">Jenis Surat <span class="text-danger">*</span></label>
                            <select class="form-select @error('jenis_surat') is-invalid @enderror" id="jenis_surat" name="jenis_surat" required>
                                <option value="">Pilih Jenis Surat</option>
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
                                <option value="Surat Keterangan Domisili" {{ old('jenis_surat') == 'Surat Keterangan Domisili' ? 'selected' : '' }}>Surat Keterangan Domisili</option>
                            </select>
                            @error('jenis_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="tanggal_surat" class="form-label">Tanggal Surat <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_surat') is-invalid @enderror"
                                   id="tanggal_surat" name="tanggal_surat" value="{{ old('tanggal_surat', date('Y-m-d')) }}" required>
                            @error('tanggal_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="keperluan" class="form-label">Keperluan <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('keperluan') is-invalid @enderror"
                                      id="keperluan" name="keperluan" rows="4" required>{{ old('keperluan') }}</textarea>
                            @error('keperluan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('surat.index') }}" class="btn btn-secondary me-md-2">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Buat Surat
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
