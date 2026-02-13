@extends('layouts.app')

@section('title', 'Edit Penduduk')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Penduduk</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('penduduk.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('penduduk.update', $penduduk) }}">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nik" class="form-label">NIK <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                   id="nik" name="nik" value="{{ old('nik', $penduduk->nik) }}" maxlength="16" required>
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                   id="nama" name="nama" value="{{ old('nama', $penduduk->nama) }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <select class="form-select @error('tempat_lahir_type') is-invalid @enderror" id="tempat_lahir_type" name="tempat_lahir_type" style="max-width: 140px;">
                                        <option value="">Pilih</option>
                                        <option value="Kota" {{ old('tempat_lahir_type', $penduduk->tempat_lahir_type) == 'Kota' ? 'selected' : '' }}>Kota</option>
                                        <option value="Kabupaten" {{ old('tempat_lahir_type', $penduduk->tempat_lahir_type) == 'Kabupaten' ? 'selected' : '' }}>Kabupaten</option>
                                    </select>
                                    <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                           id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $penduduk->tempat_lahir) }}" required>
                                </div>
                                @error('tempat_lahir_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @error('tempat_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        <div class="col-md-6">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                   id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $penduduk->tanggal_lahir->format('Y-m-d')) }}" required>
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select class="form-select @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="agama" class="form-label">Agama <span class="text-danger">*</span></label>
                            <select class="form-select @error('agama') is-invalid @enderror" id="agama" name="agama" required>
                                <option value="">Pilih Agama</option>
                                <option value="Islam" {{ old('agama', $penduduk->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama', $penduduk->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('agama', $penduduk->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama', $penduduk->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama', $penduduk->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ old('agama', $penduduk->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                            </select>
                            @error('agama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror"
                                      id="alamat" name="alamat" rows="3" required>{{ old('alamat', $penduduk->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-2">
                            <label for="rt" class="form-label">RT <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('rt') is-invalid @enderror"
                                   id="rt" name="rt" value="{{ old('rt', $penduduk->rt) }}" maxlength="3" required>
                            @error('rt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-2">
                            <label for="rw" class="form-label">RW <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('rw') is-invalid @enderror"
                                   id="rw" name="rw" value="{{ old('rw', $penduduk->rw) }}" maxlength="3" required>
                            @error('rw')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="kabupaten_kota" class="form-label">Kabupaten/Kota <span class="text-danger">*</span></label>
                            <select class="form-select @error('kabupaten_kota') is-invalid @enderror" id="kabupaten_kota" name="kabupaten_kota" required>
                                <option value="">Pilih Kabupaten/Kota</option>
                            </select>
                            @error('kabupaten_kota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="kecamatan" class="form-label">Kecamatan <span class="text-danger">*</span></label>
                            <select class="form-select @error('kecamatan') is-invalid @enderror" id="kecamatan" name="kecamatan" required>
                                <option value="">Pilih Kecamatan</option>
                            </select>
                            @error('kecamatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="kelurahan" class="form-label">Kelurahan <span class="text-danger">*</span></label>
                            <select class="form-select @error('kelurahan') is-invalid @enderror" id="kelurahan" name="kelurahan" required>
                                <option value="">Pilih Kelurahan</option>
                            </select>
                            @error('kelurahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="status_perkawinan" class="form-label">Status Perkawinan <span class="text-danger">*</span></label>
                            <select class="form-select @error('status_perkawinan') is-invalid @enderror" id="status_perkawinan" name="status_perkawinan" required>
                                <option value="">Pilih Status</option>
                                <option value="Belum Kawin" {{ old('status_perkawinan', $penduduk->status_perkawinan) == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                <option value="Kawin" {{ old('status_perkawinan', $penduduk->status_perkawinan) == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                <option value="Cerai Hidup" {{ old('status_perkawinan', $penduduk->status_perkawinan) == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                <option value="Cerai Mati" {{ old('status_perkawinan', $penduduk->status_perkawinan) == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                            </select>
                            @error('status_perkawinan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="pekerjaan" class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror"
                                   id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $penduduk->pekerjaan) }}" required>
                            @error('pekerjaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="kewarganegaraan" class="form-label">Kewarganegaraan <span class="text-danger">*</span></label>
                            <select class="form-select @error('kewarganegaraan') is-invalid @enderror" id="kewarganegaraan" name="kewarganegaraan" required>
                                <option value="">Pilih Kewarganegaraan</option>
                                <option value="WNI" {{ old('kewarganegaraan', $penduduk->kewarganegaraan) == 'WNI' ? 'selected' : '' }}>WNI</option>
                                <option value="WNA" {{ old('kewarganegaraan', $penduduk->kewarganegaraan) == 'WNA' ? 'selected' : '' }}>WNA</option>
                            </select>
                            @error('kewarganegaraan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="no_telepon" class="form-label">No. Telepon</label>
                            <input type="text" class="form-control @error('no_telepon') is-invalid @enderror"
                                   id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $penduduk->no_telepon) }}">
                            @error('no_telepon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">Pilih Status</option>
                                <option value="Aktif" {{ old('status', $penduduk->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Pindah" {{ old('status', $penduduk->status) == 'Pindah' ? 'selected' : '' }}>Pindah</option>
                                <option value="Meninggal" {{ old('status', $penduduk->status) == 'Meninggal' ? 'selected' : '' }}>Meninggal</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('penduduk.index') }}" class="btn btn-secondary me-md-2">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update
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
console.log('=== Edit script loaded ===');
document.addEventListener('DOMContentLoaded', function() {
    const kabSelect = document.getElementById('kabupaten_kota');
    const kecSelect = document.getElementById('kecamatan');
    const kelSelect = document.getElementById('kelurahan');
    const oldKec = @json(old('kecamatan', $penduduk->kecamatan));
    const oldKel = @json(old('kelurahan', $penduduk->kelurahan));
    const OLD_KAB = @json(old('kabupaten_kota', $penduduk->kabupaten_kota));

    const WILAYAH_REGENCIES = '/api/wilayah/regencies/32';
    const WILAYAH_DISTRICT_URL = id => `/api/wilayah/districts/${id}`;
    const WILAYAH_VILLAGE_URL = id => `/api/wilayah/villages/${id}`;

    function clearSelect(select, placeholder) {
        if (!select) return;
        select.innerHTML = '';
        const opt = document.createElement('option'); opt.value = ''; opt.textContent = placeholder; select.appendChild(opt);
    }

    function populate(select, items, selectedValue) {
        if (!select) return;
        clearSelect(select, select===kecSelect? 'Pilih Kecamatan' : 'Pilih Kelurahan');
        items.forEach(item => {
            const id = item.id ?? item.kode ?? null;
            const name = item.name ?? item.nama ?? String(item);
            if (!name) return;
            const opt = document.createElement('option'); opt.value = name; opt.textContent = name; if (id) opt.dataset.id = id; if (selectedValue && selectedValue==name) opt.selected = true; select.appendChild(opt);
        });
    }

    async function fetchWilayahDistrictsByRegencyId(regId, targetSelect, selectedValue) {
        if (!regId) return clearSelect(targetSelect, 'Pilih Kecamatan');
        try {
            const res = await fetch(WILAYAH_DISTRICT_URL(regId));
            const items = await res.json();
            let dataArray = items;
            if (items && !Array.isArray(items)) dataArray = items.data || items.results || [];
            populate(targetSelect, dataArray, selectedValue);
        } catch (e) { clearSelect(targetSelect, 'Pilih Kecamatan'); }
    }

    async function fetchWilayahVillagesByDistrictId(districtId, targetSelect, selectedValue) {
        if (!districtId) return clearSelect(targetSelect, 'Pilih Kelurahan');
        try {
            const res = await fetch(WILAYAH_VILLAGE_URL(districtId));
            const items = await res.json();
            let dataArray = items;
            if (items && !Array.isArray(items)) dataArray = items.data || items.results || [];
            populate(targetSelect, dataArray, selectedValue);
        } catch (e) { clearSelect(targetSelect, 'Pilih Kelurahan'); }
    }

    async function fetchRegenciesForProvince() {
        try {
            clearSelect(kabSelect, 'Memuat Kabupaten/Kota...');
            const res = await fetch(WILAYAH_REGENCIES);
            const items = await res.json();
            let dataArray = items;
            if (items && !Array.isArray(items)) dataArray = items.data || items.results || [];
            clearSelect(kabSelect, 'Pilih Kabupaten/Kota');
            dataArray.forEach(it => {
                const opt = document.createElement('option'); const name = it.name || it.nama || String(it); opt.value = name; opt.textContent = name; if (it.id) opt.dataset.id = it.id; if (OLD_KAB && OLD_KAB==name) opt.selected = true; kabSelect.appendChild(opt);
            });
            if (OLD_KAB && !Array.from(kabSelect.options).some(o=>o.selected)) { const opt = document.createElement('option'); opt.value=OLD_KAB; opt.textContent=OLD_KAB; opt.selected=true; kabSelect.appendChild(opt); }
            if (kabSelect.value) kabSelect.dispatchEvent(new Event('change'));
        } catch (e) { clearSelect(kabSelect, 'Pilih Kabupaten/Kota'); }
    }

    kabSelect && kabSelect.addEventListener('change', function() {
        const selectedOpt = kabSelect.options[kabSelect.selectedIndex];
        const regId = selectedOpt ? selectedOpt.dataset.id : null;
        clearSelect(kecSelect, 'Memuat kecamatan...'); clearSelect(kelSelect, 'Pilih Kelurahan');
        if (regId) fetchWilayahDistrictsByRegencyId(regId, kecSelect, oldKec);
    });

    kecSelect && kecSelect.addEventListener('change', function() {
        const selectedOpt = kecSelect.options[kecSelect.selectedIndex];
        const districtId = selectedOpt ? selectedOpt.dataset.id : null;
        clearSelect(kelSelect, 'Memuat kelurahan...');
        fetchWilayahVillagesByDistrictId(districtId, kelSelect, oldKel);
    });

    fetchRegenciesForProvince();

    // enforce numeric nik
    const nikInput = document.getElementById('nik');
    if (nikInput) {
        nikInput.addEventListener('input', function() { this.value = this.value.replace(/\D+/g, ''); });
    }
});
</script>
@endsection
