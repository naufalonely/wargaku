@extends('layouts.app')

@section('title', 'Tambah Penduduk')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tambah Penduduk</h1>
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
                <form method="POST" action="{{ route('penduduk.store') }}">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nik" class="form-label">NIK <span class="text-danger">*</span></label>
                            <input type="text" inputmode="numeric" pattern="\d*" maxlength="16"
                                   class="form-control @error('nik') is-invalid @enderror"
                                   id="nik" name="nik" value="{{ old('nik') }}" required>
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                   id="nama" name="nama" value="{{ old('nama') }}" required>
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
                                    <option value="Kota" {{ old('tempat_lahir_type') == 'Kota' ? 'selected' : '' }}>Kota</option>
                                    <option value="Kabupaten" {{ old('tempat_lahir_type') == 'Kabupaten' ? 'selected' : '' }}>Kabupaten</option>
                                </select>
                                <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                       id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
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
                                   id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
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
                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="agama" class="form-label">Agama <span class="text-danger">*</span></label>
                            <select class="form-select @error('agama') is-invalid @enderror" id="agama" name="agama" required>
                                <option value="">Pilih Agama</option>
                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
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
                                      id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-2">
                            <label for="rt" class="form-label">RT <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('rt') is-invalid @enderror"
                                   id="rt" name="rt" value="{{ old('rt') }}" maxlength="3" required>
                            @error('rt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-2">
                            <label for="rw" class="form-label">RW <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('rw') is-invalid @enderror"
                                   id="rw" name="rw" value="{{ old('rw') }}" maxlength="3" required>
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
                                <option value="Belum Kawin" {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                <option value="Cerai Hidup" {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                <option value="Cerai Mati" {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                            </select>
                            @error('status_perkawinan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="pekerjaan" class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                            <select class="form-select @error('pekerjaan') is-invalid @enderror" id="pekerjaan" name="pekerjaan" required>
                                <option value="">Pilih Pekerjaan</option>
                                <option value="Belum/Tidak Bekerja" {{ old('pekerjaan') == 'Belum/Tidak Bekerja' ? 'selected' : '' }}>Belum/Tidak Bekerja</option>
                                <option value="Aparatur/Pejabat Negara" {{ old('pekerjaan') == 'Aparatur/Pejabat Negara' ? 'selected' : '' }}>Aparatur/Pejabat Negara</option>
                                <option value="Tenaga Pengajar" {{ old('pekerjaan') == 'Tenaga Pengajar' ? 'selected' : '' }}>Tenaga Pengajar</option>
                                <option value="Wiraswasta" {{ old('pekerjaan') == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                                <option value="Pertanian/Peternakan" {{ old('pekerjaan') == 'Pertanian/Peternakan' ? 'selected' : '' }}>Pertanian/Peternakan</option>
                                <option value="Nelayan" {{ old('pekerjaan') == 'Nelayan' ? 'selected' : '' }}>Nelayan</option>
                                <option value="Agama dan Kepercayaan" {{ old('pekerjaan') == 'Agama dan Kepercayaan' ? 'selected' : '' }}>Agama dan Kepercayaan</option>
                                <option value="Pelajar/Mahasiswa" {{ old('pekerjaan') == 'Pelajar/Mahasiswa' ? 'selected' : '' }}>Pelajar/Mahasiswa</option>
                                <option value="Tenaga Kesehatan" {{ old('pekerjaan') == 'Tenaga Kesehatan' ? 'selected' : '' }}>Tenaga Kesehatan</option>
                                <option value="Pensiunan" {{ old('pekerjaan') == 'Pensiunan' ? 'selected' : '' }}>Pensiunan</option>
                                <option value="Lainnya" {{ old('pekerjaan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('pekerjaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="kewarganegaraan" class="form-label">Kewarganegaraan <span class="text-danger">*</span></label>
                            <select class="form-select @error('kewarganegaraan') is-invalid @enderror" id="kewarganegaraan" name="kewarganegaraan" required>
                                <option value="">Pilih Kewarganegaraan</option>
                                <option value="WNI" {{ old('kewarganegaraan', 'WNI') == 'WNI' ? 'selected' : '' }}>WNI</option>
                                <option value="WNA" {{ old('kewarganegaraan') == 'WNA' ? 'selected' : '' }}>WNA</option>
                            </select>
                            @error('kewarganegaraan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="no_telepon" class="form-label">No. Telepon</label>
                            <input type="text" class="form-control @error('no_telepon') is-invalid @enderror"
                                   id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" maxlength="12">
                            @error('no_telepon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('penduduk.index') }}" class="btn btn-secondary me-md-2">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Simpan
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
console.log('=== Script loaded! ===');

// Immediate test: fetch regencies
fetch('/api/wilayah/regencies/32')
    .then(r => r.json())
    .then(data => console.log('Direct fetch success:', data))
    .catch(e => console.error('Direct fetch error:', e));

document.addEventListener('DOMContentLoaded', function() {
    console.log('=== DOMContentLoaded triggered ===');
    const kabSelect = document.getElementById('kabupaten_kota');
    const kecSelect = document.getElementById('kecamatan');
    const kelSelect = document.getElementById('kelurahan');
    console.log('kabSelect found?', !!kabSelect);
    console.log('kecSelect found?', !!kecSelect);
    console.log('kelSelect found?', !!kelSelect);
    const oldKec = @json(old('kecamatan'));
    const oldKel = @json(old('kelurahan'));
    console.log('oldKec:', oldKec, 'oldKel:', oldKel);

    // Use local server proxy for wilayah.id API (avoids CORS). Proxy routes are added at /api/wilayah/*
    const WILAYAH_REGENCIES = '/api/wilayah/regencies/32';
    const WILAYAH_DISTRICT_URL = id => `/api/wilayah/districts/${id}`;
    const WILAYAH_VILLAGE_URL = id => `/api/wilayah/villages/${id}`;

    // Fallback generic endpoints (if you have your own API) — otherwise ignored when USE_EMSIFA=true
    const KEC_ENDPOINT = '/api/kecamatan';
    const KEL_ENDPOINT = '/api/kelurahan';
    const KEC_QUERY_PARAM = 'kabupaten';
    const KEL_QUERY_PARAM = 'kecamatan';

    function clearSelect(select, placeholder) {
        select.innerHTML = '';
        const opt = document.createElement('option');
        opt.value = '';
        opt.textContent = placeholder;
        select.appendChild(opt);
    }

    function normalizeResponsePayload(res) {
        if (Array.isArray(res)) return res;
        if (!res) return [];
        return res.data || res.results || res.items || res.kecamatan || res.kelurahan || [];
    }

    function populate(select, items, selectedValue) {
        // keep option.value as human-readable name (to preserve existing backend expectations)
        clearSelect(select, select === kecSelect ? 'Pilih Kecamatan' : 'Pilih Kelurahan');
        items.forEach(item => {
            const isString = typeof item === 'string';
            const id = isString ? null : (item.id ?? item.kode ?? item.value ?? null);
            const name = isString ? item : (item.nama ?? item.name ?? item.kecamatan ?? item.kelurahan ?? id ?? '');
            if (!name) return;
            const opt = document.createElement('option');
            opt.value = name;
            opt.textContent = name;
            if (id) opt.dataset.id = id; // store numeric id for follow-up API calls
            if (selectedValue && selectedValue == name) opt.selected = true;
            select.appendChild(opt);
        });
        if (selectedValue && !Array.from(select.options).some(o=>o.selected)) {
            const opt = document.createElement('option'); opt.value = selectedValue; opt.textContent = selectedValue; opt.selected = true; select.appendChild(opt);
        }
    }

    function fetchAndPopulate(url, queryParamName, queryValue, targetSelect, selectedValue, loadingText) {
        // If USE_EMSIFA, we won't use generic endpoints; handled separately.
        clearSelect(targetSelect, loadingText || 'Memuat...');
        if (!queryValue) { clearSelect(targetSelect, targetSelect===kecSelect? 'Pilih Kecamatan' : 'Pilih Kelurahan'); return; }
        const q = `${url}?${encodeURIComponent(queryParamName)}=${encodeURIComponent(queryValue)}`;
        fetch(q)
            .then(r=>r.json())
            .then(data => {
                const items = normalizeResponsePayload(data);
                populate(targetSelect, items, selectedValue);
            })
            .catch(()=> clearSelect(targetSelect, targetSelect===kecSelect? 'Pilih Kecamatan' : 'Pilih Kelurahan'));
    }

    // --- EMSIFA integration helpers ---
    async function getRegencyIdByName(kabName) {
        try {
            const res = await fetch(WILAYAH_REGENCIES);
            const arr = await res.json();
            // kabName options may be like 'Kabupaten Bandung' or 'Kota Bandung' or just 'Bandung'
            let plain = (kabName || '').replace(/^Kabupaten\s+|^Kota\s+/i, '').trim();
            plain = plain.replace(/\.|,/g, '');
            const lowerPlain = plain.toLowerCase();

            // Try exact match first
            let found = arr.find(r => r.name.toLowerCase() === lowerPlain);
            if (found) return found.id;

            // Try contains
            found = arr.find(r => r.name.toLowerCase().includes(lowerPlain) || lowerPlain.includes(r.name.toLowerCase()));
            if (found) return found.id;

            // Try matching by words (best-effort)
            const parts = lowerPlain.split(/\s+/).filter(Boolean);
            found = arr.find(r => parts.every(p => r.name.toLowerCase().includes(p)));
            if (found) return found.id;

            console.warn('Regency not found for', kabName, 'searched plain:', plain, 'available count:', arr.length);
            return null;
        } catch (e) {
            console.error('Error fetching regencies list', e);
            return null;
        }
    }

    async function fetchWilayahDistrictsByRegencyName(kabName, targetSelect, selectedValue) {
        const regId = await getRegencyIdByName(kabName);
        if (!regId) {
            console.warn('No regency id found for', kabName);
            return clearSelect(targetSelect, 'Pilih Kecamatan');
        }
        try {
            console.log('Fetching districts for regency id', regId);
            const res = await fetch(WILAYAH_DISTRICT_URL(regId));
            const items = await res.json();
            console.log('Districts received', items && items.length);
            populate(targetSelect, items, selectedValue);
        } catch (e) {
            console.error('Error fetching districts', e);
            clearSelect(targetSelect, 'Pilih Kecamatan');
        }
    }

    async function fetchWilayahDistrictsByRegencyId(regId, targetSelect, selectedValue) {
        if (!regId) return clearSelect(targetSelect, 'Pilih Kecamatan');
        try {
            console.log('Fetching districts for regency id (direct)', regId);
            const res = await fetch(WILAYAH_DISTRICT_URL(regId));
            const items = await res.json();
            console.log('Districts raw response:', items);
            console.log('Is array?', Array.isArray(items));

            // Handle wrapped response
            let dataArray = items;
            if (items && !Array.isArray(items)) {
                dataArray = items.data || items.results || items.districts || items.items || [];
            }
            console.log('After unwrap, dataArray length:', dataArray.length);
            console.log('First few items:', dataArray.slice(0, 3));

            populate(targetSelect, dataArray, selectedValue);
        } catch (e) {
            console.error('Error fetching districts by id', e);
            clearSelect(targetSelect, 'Pilih Kecamatan');
        }
    }

    async function fetchWilayahVillagesByDistrictId(districtId, targetSelect, selectedValue) {
        if (!districtId) return clearSelect(targetSelect, 'Pilih Kelurahan');
        try {
            console.log('Fetching villages for district id', districtId);
            const res = await fetch(WILAYAH_VILLAGE_URL(districtId));
            const items = await res.json();
            console.log('Villages raw response:', items);

            // Handle wrapped response
            let dataArray = items;
            if (items && !Array.isArray(items)) {
                dataArray = items.data || items.results || items.villages || items.items || [];
            }
            console.log('After unwrap, villages length:', dataArray.length);

            populate(targetSelect, dataArray, selectedValue);
        } catch (e) {
            console.error('Error fetching villages', e);
            clearSelect(targetSelect, 'Pilih Kelurahan');
        }
    }

    async function fetchRegenciesForProvince(provinceId, targetSelect, selectedValue) {
        try {
            clearSelect(targetSelect, 'Memuat Kabupaten/Kota...');
            const res = await fetch(WILAYAH_REGENCIES);
            const items = await res.json();
            // items are objects with id and name
            console.log('fetchRegenciesForProvince - raw response:', items);
            console.log('fetchRegenciesForProvince - is array?', Array.isArray(items));
            console.log('fetchRegenciesForProvince - length:', items ? items.length : 'null/undefined');

            // Handle response structure (could be {data: [...]}, direct array, etc.)
            let dataArray = items;
            if (items && !Array.isArray(items)) {
                dataArray = items.data || items.results || items.regencies || items.items || [];
            }
            if (!Array.isArray(dataArray)) {
                console.error('Response is not an array or wrappable:', dataArray);
                return clearSelect(targetSelect, 'Pilih Kabupaten/Kota');
            }

            clearSelect(targetSelect, 'Pilih Kabupaten/Kota');
            console.log('Populating with', dataArray.length, 'items');
            dataArray.forEach((it, idx) => {
                console.log(`Item ${idx}:`, it);
                const opt = document.createElement('option');
                const name = it.name || it.nama || String(it);
                opt.value = name;
                opt.textContent = name;
                if (it.id) opt.dataset.id = it.id;
                if (selectedValue && selectedValue == name) opt.selected = true;
                targetSelect.appendChild(opt);
            });

            if (selectedValue && !Array.from(targetSelect.options).some(o=>o.selected)) {
                const opt = document.createElement('option'); opt.value = selectedValue; opt.textContent = selectedValue; opt.selected = true; targetSelect.appendChild(opt);
            }
            // if we selected one, trigger change to load districts
            console.log('After populate, kabSelect.value:', targetSelect.value, 'options count:', targetSelect.options.length);
            if (targetSelect.value) {
                console.log('Auto-triggering change event for regency:', targetSelect.value);
                targetSelect.dispatchEvent(new Event('change'));
            }
        } catch (e) {
            console.error('Error fetching regencies:', e);
            console.error('Error stack:', e.stack);
            clearSelect(targetSelect, 'Pilih Kabupaten/Kota');
        }
    }

    kabSelect.addEventListener('change', function() {
        const val = this.value;
        const selectedOpt = kabSelect.options[kabSelect.selectedIndex];
        const regId = selectedOpt ? selectedOpt.dataset.id : null;
        console.log('Kabupaten/Kota selected:', val, 'regId:', regId);
        clearSelect(kecSelect, 'Memuat kecamatan...');
        clearSelect(kelSelect, 'Pilih Kelurahan');
        if (!val) return clearSelect(kecSelect, 'Pilih Kecamatan');
        if (regId) {
            fetchWilayahDistrictsByRegencyId(regId, kecSelect, oldKec);
        } else {
            fetchWilayahDistrictsByRegencyName(val, kecSelect, oldKec);
        }
    });

    kecSelect.addEventListener('change', function() {
        const val = this.value;
        console.log('Kecamatan selected (name):', val);
        clearSelect(kelSelect, 'Memuat kelurahan...');
        if (!val) return clearSelect(kelSelect, 'Pilih Kelurahan');
        const selectedOpt = kecSelect.options[kecSelect.selectedIndex];
        const districtId = selectedOpt ? selectedOpt.dataset.id : null;
        console.log('Kecamatan selected (data-id):', districtId);
        fetchWilayahVillagesByDistrictId(districtId, kelSelect, oldKel);
    });

    // Initialize when editing or after validation failure
    const initialKab = kabSelect.value;
    // Populate kabupaten/kota for Jawa Barat (province id 32). If user had old value, pass it.
    const OLD_KAB = @json(old('kabupaten_kota'));
    console.log('About to call fetchRegenciesForProvince, OLD_KAB:', OLD_KAB);
    console.log('WILAYAH_REGENCIES URL:', WILAYAH_REGENCIES);
    fetchRegenciesForProvince(32, kabSelect, OLD_KAB);

    if (oldKec) {
        // if kecamatan is old, ensure it'll be loaded after regencies and districts fetch
        // the flow: fetchRegencies -> selects regency and triggers change -> districts loaded -> mutation observer will fetch villages
        const obs = new MutationObserver(function() {
            if (kecSelect.querySelector(`option[value="${oldKec}"]`)) {
                const opt = kecSelect.querySelector(`option[value="${oldKec}"]`);
                const districtId = opt ? opt.dataset.id : null;
                if (districtId) fetchWilayahVillagesByDistrictId(districtId, kelSelect, oldKel);
                obs.disconnect();
            }
        });
        obs.observe(kecSelect, { childList: true });
    } else {
        if (oldKec) { const opt = document.createElement('option'); opt.value = oldKec; opt.textContent = oldKec; opt.selected = true; kecSelect.appendChild(opt); }
        if (oldKel) { const opt2 = document.createElement('option'); opt2.value = oldKel; opt2.textContent = oldKel; opt2.selected = true; kelSelect.appendChild(opt2); }
    }
    // Enforce numeric-only input for NIK
    const nikInput = document.getElementById('nik');
    if (nikInput) {
        nikInput.addEventListener('input', function(e) {
            const cleaned = this.value.replace(/\D+/g, '');
            if (this.value !== cleaned) this.value = cleaned;
        });
        nikInput.setAttribute('inputmode', 'numeric');
        nikInput.setAttribute('pattern', '\\d*');
    }

    // Optional: ensure tempat_lahir_type has a default when not provided
    const tempatType = document.getElementById('tempat_lahir_type');
    if (tempatType && !tempatType.value) {
        // keep empty until user chooses
    }
});
</script>
@endsection
