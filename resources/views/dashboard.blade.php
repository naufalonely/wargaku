@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <span class="badge bg-primary">{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}</span>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('penduduk.index') }}" class="card border-left-primary shadow h-100 py-2 text-decoration-none">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Penduduk
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($data['totalPenduduk']) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('surat.index') }}" class="card border-left-primary shadow h-100 py-2 text-decoration-none">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Surat Bulan Ini
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($data['totalSurat']) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-alt fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('pelayanan.index') }}" class="card border-left-primary shadow h-100 py-2 text-decoration-none">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Pelayanan Bulan Ini
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($data['totalPelayanan']) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('pegawai.index') }}" class="card border-left-primary shadow h-100 py-2 text-decoration-none">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Pegawai
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($data['totalPegawai']) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-tie fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- Map Card -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Visualisasi Data Penduduk Jawa Barat</h6>
        <div class="dropdown">
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="mapDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <span id="selectedMapLayer">Jumlah Penduduk</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="mapDropdown">
                <li><a class="dropdown-item active" href="#" data-map-layer="total_penduduk">Jumlah Penduduk</a></li>
                <li><a class="dropdown-item" href="#" data-map-layer="jenis_kelamin">Jenis Kelamin</a></li>
                <li><a class="dropdown-item" href="#" data-map-layer="kelompok_usia">Kelompok Usia</a></li>
                <li><a class="dropdown-item" href="#" data-map-layer="agama">Agama</a></li>
                <li><a class="dropdown-item" href="#" data-map-layer="pekerjaan">Pekerjaan</a></li>
                <li><a class="dropdown-item" href="#" data-map-layer="disabilitas">Disabilitas</a></li>
                <li><a class="dropdown-item" href="#" data-map-layer="pendidikan">Tingkat Pendidikan</a></li>
                <li><a class="dropdown-item" href="#" data-map-layer="migrasi_datang">Migrasi Datang</a></li>
                <li><a class="dropdown-item" href="#" data-map-layer="migrasi_pindah">Migrasi Pindah</a></li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        <div style="position:relative;">
            <div id="map" style="height: 500px; border-radius: 8px;"></div>
            <div id="mapLegend" style="position:absolute;top:10px;right:10px;z-index:700;background:rgba(255,255,255,0.95);padding:8px;border-radius:6px;box-shadow:0 1px 4px rgba(0,0,0,0.2);font-size:12px;line-height:18px;min-width:140px;"></div>
        </div>
    </div>
</div>

<!-- Charts -->
<div class="row mb-4">
    <div class="col-xl-6 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Distribusi Jenis Kelamin</h6>
            </div>
            <div class="card-body">
                <canvas id="genderChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pintasan Cepat</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('penduduk.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Warga Baru
                    </a>
                    <a href="{{ route('surat.create') }}" class="btn btn-success">
                        <i class="fas fa-envelope me-2"></i>Tambah Surat Baru
                    </a>
                    <a href="{{ route('pelayanan.create') }}" class="btn btn-info">
                        <i class="fas fa-clipboard-check me-2"></i>Buat Permohonan Baru
                    </a>
                    @if(auth('pegawai')->check() && auth('pegawai')->user()->level === 'admin')
                        <a href="{{ route('pegawai.create') }}" class="btn btn-warning">
                            <i class="fas fa-user-plus me-2"></i>Tambah Pegawai Baru
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Data -->
<div class="row">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Dokumen Terbaru</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless table-hover">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data['suratTerbaru'] as $surat)
                            <tr>
                                <td>{{ $surat->nomor_surat }}</td>
                                <td>{{ $surat->penduduk->nama }}</td>
                                <td>
                                    <span class="badge bg-success">{{ $surat->jenis_surat }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">Belum ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pelayanan Terbaru</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless table-hover">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Nama</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data['pelayananTerbaru'] as $pelayanan)
                            <tr>
                                <td>{{ $pelayanan->nomor_permohonan }}</td>
                                <td>{{ $pelayanan->penduduk->nama }}</td>
                                <td>
                                    <span class="badge bg-{{ $pelayanan->status == 'Selesai' ? 'success' : 'warning' }}">
                                        {{ $pelayanan->status }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">Belum ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    const statistik = @json($statistik);
</script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script>
    const staticStatistik = {
        'bogor' : {
            total_penduduk: 5809790,
            laki_laki: 2974061,
            perempuan: 2835729,
            kelompok_usia: {'0-6': 580979, '7-12': 697174, '13-15': 348588, '16-18': 348588, '19-24': 870000, '25-54': 2033426, '55+': 290035},
            agama: { islam: 5228811, kristen: 290489, katholik: 116196, hindu: 58097, budha: 58097, khonghucu: 11619, kepercayaan: 0 },
            pekerjaan: { belum_tidak_bekerja: 290489, aparatur: 58098, pengajar: 116196, wiraswasta: 1161958, pertanian: 1161958, nelayan: 174294, agama: 58097, pelajar: 870000, kesehatan: 116196, pensiunan: 290489, lainnya: 406473 },
            disabilitas: { fisik: 29049, netra: 5809, rungu: 5809, mental: 5809, fisik_mental: 2905, lain: 46486 },
            pendidikan: { tidak_sekolah: 116196, belum_tamat_sd: 290489, tamat_sd: 1161958, sltp: 1452445, slta: 870000, d1d2: 174294, d3: 290489, s1: 348588, s2: 116196, s3: 58098 },
            pengangguran: 87000,
            migrasi_datang: 200,
            migrasi_pindah: 150
        },
        'sukabumi' : {
            total_penduduk: 2638825,
            laki_laki: 1458705,
            perempuan: 1410238,
            kelompok_usia: {'0-6': 580979, '7-12': 697174, '13-15': 348588, '16-18': 348588, '19-24': 870000, '25-54': 2033426, '55+': 290035},
            agama: { islam: 5228811, kristen: 290489, katholik: 116196, hindu: 58097, budha: 58097, khonghucu: 11619, kepercayaan: 0 },
            pekerjaan: { belum_tidak_bekerja: 290489, aparatur: 58098, pengajar: 116196, wiraswasta: 1161958, pertanian: 1161958, nelayan: 174294, agama: 58097, pelajar: 870000, kesehatan: 116196, pensiunan: 290489, lainnya: 406473 },
            disabilitas: { fisik: 29049, netra: 5809, rungu: 5809, mental: 5809, fisik_mental: 2905, lain: 46486 },
            pendidikan: { tidak_sekolah: 116196, belum_tamat_sd: 290489, tamat_sd: 1161958, sltp: 1452445, slta: 870000, d1d2: 174294, d3: 290489, s1: 348588, s2: 116196, s3: 58098 },
            pengangguran: 87000,
            migrasi_datang: 200,
            migrasi_pindah: 150
        },
        'cianjur' : {
            total_penduduk: 2638825,
            laki_laki: 1350395,
            perempuan: 1288430,
            kelompok_usia: {'0-6': 351924, '7-12': 422309, '13-15': 211154, '16-18': 211154, '19-24': 528886, '25-54': 1231735, '55+': 58781},
            agama: { islam: 3167319, kristen: 175962, katholik: 70385, hindu: 35192, budha: 35192, khonghucu: 7038, kepercayaan: 350 },
            pekerjaan: { belum_tidak_bekerja: 175962, aparatur: 35192, pengajar: 70385, wiraswasta: 703849, pertanian: 703849, nelayan: 105577, agama: 35192, pelajar: 528886, kesehatan: 70385, pensiunan: 175962, lainnya: 245 },
            disabilitas: { fisik: 17596, netra: 3519, rungu: 3519, mental: 3519, fisik_mental: 1759, lain: 28106 },
            pendidikan: { tidak_sekolah: 70385, belum_tamat_sd: 175962, tamat_sd: 703849, sltp: 879811, slta: 703849, d1d2: 105577, d3: 175962, s1: 211154, s2: 70385, s3: 35192 },
            pengangguran: 70000,
            migrasi_datang: 150,
            migrasi_pindah: 130
        },
        'bandung' : {
            total_penduduk: 3839721,
            laki_laki: 1953971,
            perempuan: 1885750,
            kelompok_usia: {'0-6': 351924, '7-12': 422309, '13-15': 211154, '16-18': 211154, '19-24': 528886, '25-54': 1231735, '55+': 58781},
            agama: { islam: 3167319, kristen: 175962, katholik: 70385, hindu: 35192, budha: 35192, khonghucu: 7038, kepercayaan: 350 },
            pekerjaan: { belum_tidak_bekerja: 175962, aparatur: 35192, pengajar: 70385, wiraswasta: 703849, pertanian: 703849, nelayan: 105577, agama: 35192, pelajar: 528886, kesehatan: 70385, pensiunan: 175962, lainnya: 245 },
            disabilitas: { fisik: 17596, netra: 3519, rungu: 3519, mental: 3519, fisik_mental: 1759, lain: 28106 },
            pendidikan: { tidak_sekolah: 70385, belum_tamat_sd: 175962, tamat_sd: 703849, sltp: 879811, slta: 703849, d1d2: 105577, d3: 175962, s1: 211154, s2: 70385, s3: 35192 },
            pengangguran: 70000,
            migrasi_datang: 150,
            migrasi_pindah: 130
        },
        'garut' : {
            total_penduduk: 2851877,
            laki_laki: 1459601,
            perempuan: 1392276,
            kelompok_usia: {'0-6': 580979, '7-12': 697174, '13-15': 348588, '16-18': 348588, '19-24': 870000, '25-54': 2033426, '55+': 290035},
            agama: { islam: 5228811, kristen: 290489, katholik: 116196, hindu: 58097, budha: 58097, khonghucu: 11619, kepercayaan: 0 },
            pekerjaan: { belum_tidak_bekerja: 290489, aparatur: 58098, pengajar: 116196, wiraswasta: 1161958, pertanian: 1161958, nelayan: 174294, agama: 58097, pelajar: 870000, kesehatan: 116196, pensiunan: 290489, lainnya: 406473 },
            disabilitas: { fisik: 29049, netra: 5809, rungu: 5809, mental: 5809, fisik_mental: 2905, lain: 46486 },
            pendidikan: { tidak_sekolah: 116196, belum_tamat_sd: 290489, tamat_sd: 1161958, sltp: 1452445, slta: 870000, d1d2: 174294, d3: 290489, s1: 348588, s2: 116196, s3: 58098 },
            pengangguran: 87000,
            migrasi_datang: 200,
            migrasi_pindah: 150
        },
        'tasikmalaya' : {
            total_penduduk: 1996059,
            laki_laki: 1016563,
            perempuan: 979496,
            kelompok_usia: {'0-6': 580979, '7-12': 697174, '13-15': 348588, '16-18': 348588, '19-24': 870000, '25-54': 2033426, '55+': 290035},
            agama: { islam: 5228811, kristen: 290489, katholik: 116196, hindu: 58097, budha: 58097, khonghucu: 11619, kepercayaan: 0 },
            pekerjaan: { belum_tidak_bekerja: 290489, aparatur: 58098, pengajar: 116196, wiraswasta: 1161958, pertanian: 1161958, nelayan: 174294, agama: 58097, pelajar: 870000, kesehatan: 116196, pensiunan: 290489, lainnya: 406473 },
            disabilitas: { fisik: 29049, netra: 5809, rungu: 5809, mental: 5809, fisik_mental: 2905, lain: 46486 },
            pendidikan: { tidak_sekolah: 116196, belum_tamat_sd: 290489, tamat_sd: 1161958, sltp: 1452445, slta: 870000, d1d2: 174294, d3: 290489, s1: 348588, s2: 116196, s3: 58098 },
            pengangguran: 87000,
            migrasi_datang: 200,
            migrasi_pindah: 150
        },
        'ciamis' : {
            total_penduduk: 1297783,
            laki_laki: 651625,
            perempuan: 646158,
            kelompok_usia: {'0-6': 351924, '7-12': 422309, '13-15': 211154, '16-18': 211154, '19-24': 528886, '25-54': 1231735, '55+': 58781},
            agama: { islam: 3167319, kristen: 175962, katholik: 70385, hindu: 35192, budha: 35192, khonghucu: 7038, kepercayaan: 350 },
            pekerjaan: { belum_tidak_bekerja: 175962, aparatur: 35192, pengajar: 70385, wiraswasta: 703849, pertanian: 703849, nelayan: 105577, agama: 35192, pelajar: 528886, kesehatan: 70385, pensiunan: 175962, lainnya: 245 },
            disabilitas: { fisik: 17596, netra: 3519, rungu: 3519, mental: 3519, fisik_mental: 1759, lain: 28106 },
            pendidikan: { tidak_sekolah: 70385, belum_tamat_sd: 175962, tamat_sd: 703849, sltp: 879811, slta: 703849, d1d2: 105577, d3: 175962, s1: 211154, s2: 70385, s3: 35192 },
            pengangguran: 70000,
            migrasi_datang: 150,
            migrasi_pindah: 130
        },
        'kuningan' : {
            total_penduduk: 1239999,
            laki_laki: 629774,
            perempuan: 610225,
            kelompok_usia: {'0-6': 580979, '7-12': 697174, '13-15': 348588, '16-18': 348588, '19-24': 870000, '25-54': 2033426, '55+': 290035},
            agama: { islam: 5228811, kristen: 290489, katholik: 116196, hindu: 58097, budha: 58097, khonghucu: 11619, kepercayaan: 0 },
            pekerjaan: { belum_tidak_bekerja: 290489, aparatur: 58098, pengajar: 116196, wiraswasta: 1161958, pertanian: 1161958, nelayan: 174294, agama: 58097, pelajar: 870000, kesehatan: 116196, pensiunan: 290489, lainnya: 406473 },
            disabilitas: { fisik: 29049, netra: 5809, rungu: 5809, mental: 5809, fisik_mental: 2905, lain: 46486 },
            pendidikan: { tidak_sekolah: 116196, belum_tamat_sd: 290489, tamat_sd: 1161958, sltp: 1452445, slta: 870000, d1d2: 174294, d3: 290489, s1: 348588, s2: 116196, s3: 58098 },
            pengangguran: 87000,
            migrasi_datang: 200,
            migrasi_pindah: 150
        },
        'cirebon' : {
            total_penduduk: 2489046,
            laki_laki: 1263071,
            perempuan: 1225975,
            kelompok_usia: {'0-6': 295123, '7-12': 354148, '13-15': 177074, '16-18': 177074, '19-24': 442685, '25-54': 1150169, '55+': 29561},
            agama: { islam: 2656110, kristen: 147562, katholik: 59024, hindu: 29512, budha: 29512, khonghucu: 5902, kepercayaan: 0 },
            pekerjaan: { belum_tidak_bekerja: 147562, aparatur: 29512, pengajar: 59024, wiraswasta: 590246, pertanian: 590246, nelayan: 88537, agama: 29512, pelajar: 442685, kesehatan: 59024, pensiunan: 147562, lainnya: 500 },
            disabilitas: { fisik: 14756, netra: 2951, rungu: 2951, mental: 2951, fisik_mental: 1475, lain: 23500 },
            pendidikan: { tidak_sekolah: 59024, belum_tamat_sd: 147562, tamat_sd: 590246, sltp: 737808, slta: 590246, d1d2: 88537, d3: 147562, s1: 177074, s2: 59024, s3: 29512 },
            pengangguran: 65000,
            migrasi_datang: 130,
            migrasi_pindah: 110
        },
        'majalengka' : {
            total_penduduk: 1369569,
            laki_laki: 689351,
            perempuan: 680218,
            kelompok_usia: {'0-6': 580979, '7-12': 697174, '13-15': 348588, '16-18': 348588, '19-24': 870000, '25-54': 2033426, '55+': 290035},
            agama: { islam: 5228811, kristen: 290489, katholik: 116196, hindu: 58097, budha: 58097, khonghucu: 11619, kepercayaan: 0 },
            pekerjaan: { belum_tidak_bekerja: 290489, aparatur: 58098, pengajar: 116196, wiraswasta: 1161958, pertanian: 1161958, nelayan: 174294, agama: 58097, pelajar: 870000, kesehatan: 116196, pensiunan: 290489, lainnya: 406473 },
            disabilitas: { fisik: 29049, netra: 5809, rungu: 5809, mental: 5809, fisik_mental: 2905, lain: 46486 },
            pendidikan: { tidak_sekolah: 116196, belum_tamat_sd: 290489, tamat_sd: 1161958, sltp: 1452445, slta: 870000, d1d2: 174294, d3: 290489, s1: 348588, s2: 116196, s3: 58098 },
            pengangguran: 87000,
            migrasi_datang: 200,
            migrasi_pindah: 150
        },
        'sumedang' : {
            total_penduduk: 1226660,
            laki_laki: 619513,
            perempuan: 607147,
            kelompok_usia: {'0-6': 580979, '7-12': 697174, '13-15': 348588, '16-18': 348588, '19-24': 870000, '25-54': 2033426, '55+': 290035},
            agama: { islam: 5228811, kristen: 290489, katholik: 116196, hindu: 58097, budha: 58097, khonghucu: 11619, kepercayaan: 0 },
            pekerjaan: { belum_tidak_bekerja: 290489, aparatur: 58098, pengajar: 116196, wiraswasta: 1161958, pertanian: 1161958, nelayan: 174294, agama: 58097, pelajar: 870000, kesehatan: 116196, pensiunan: 290489, lainnya: 406473 },
            disabilitas: { fisik: 29049, netra: 5809, rungu: 5809, mental: 5809, fisik_mental: 2905, lain: 46486 },
            pendidikan: { tidak_sekolah: 116196, belum_tamat_sd: 290489, tamat_sd: 1161958, sltp: 1452445, slta: 870000, d1d2: 174294, d3: 290489, s1: 348588, s2: 116196, s3: 58098 },
            pengangguran: 87000,
            migrasi_datang: 200,
            migrasi_pindah: 150
        },
        'indramayu' : {
            total_penduduk: 1980080,
            laki_laki: 997493,
            perempuan: 982587,
            kelompok_usia: {'0-6': 580979, '7-12': 697174, '13-15': 348588, '16-18': 348588, '19-24': 870000, '25-54': 2033426, '55+': 290035},
            agama: { islam: 5228811, kristen: 290489, katholik: 116196, hindu: 58097, budha: 58097, khonghucu: 11619, kepercayaan: 0 },
            pekerjaan: { belum_tidak_bekerja: 290489, aparatur: 58098, pengajar: 116196, wiraswasta: 1161958, pertanian: 1161958, nelayan: 174294, agama: 58097, pelajar: 870000, kesehatan: 116196, pensiunan: 290489, lainnya: 406473 },
            disabilitas: { fisik: 29049, netra: 5809, rungu: 5809, mental: 5809, fisik_mental: 2905, lain: 46486 },
            pendidikan: { tidak_sekolah: 116196, belum_tamat_sd: 290489, tamat_sd: 1161958, sltp: 1452445, slta: 870000, d1d2: 174294, d3: 290489, s1: 348588, s2: 116196, s3: 58098 },
            pengangguran: 87000,
            migrasi_datang: 200,
            migrasi_pindah: 150
        },
        'subang' : {
            total_penduduk: 1677628,
            laki_laki: 838911,
            perempuan: 838717,
            kelompok_usia: {'0-6': 580979, '7-12': 697174, '13-15': 348588, '16-18': 348588, '19-24': 870000, '25-54': 2033426, '55+': 290035},
            agama: { islam: 5228811, kristen: 290489, katholik: 116196, hindu: 58097, budha: 58097, khonghucu: 11619, kepercayaan: 0 },
            pekerjaan: { belum_tidak_bekerja: 290489, aparatur: 58098, pengajar: 116196, wiraswasta: 1161958, pertanian: 1161958, nelayan: 174294, agama: 58097, pelajar: 870000, kesehatan: 116196, pensiunan: 290489, lainnya: 406473 },
            disabilitas: { fisik: 29049, netra: 5809, rungu: 5809, mental: 5809, fisik_mental: 2905, lain: 46486 },
            pendidikan: { tidak_sekolah: 116196, belum_tamat_sd: 290489, tamat_sd: 1161958, sltp: 1452445, slta: 870000, d1d2: 174294, d3: 290489, s1: 348588, s2: 116196, s3: 58098 },
            pengangguran: 87000,
            migrasi_datang: 200,
            migrasi_pindah: 150
        },
        'purwakarta' : {
            total_penduduk: 1063932,
            laki_laki: 539514,
            perempuan: 524418,
            kelompok_usia: {'0-6': 580979, '7-12': 697174, '13-15': 348588, '16-18': 348588, '19-24': 870000, '25-54': 2033426, '55+': 290035},
            agama: { islam: 5228811, kristen: 290489, katholik: 116196, hindu: 58097, budha: 58097, khonghucu: 11619, kepercayaan: 0 },
            pekerjaan: { belum_tidak_bekerja: 290489, aparatur: 58098, pengajar: 116196, wiraswasta: 1161958, pertanian: 1161958, nelayan: 174294, agama: 58097, pelajar: 870000, kesehatan: 116196, pensiunan: 290489, lainnya: 406473 },
            disabilitas: { fisik: 29049, netra: 5809, rungu: 5809, mental: 5809, fisik_mental: 2905, lain: 46486 },
            pendidikan: { tidak_sekolah: 116196, belum_tamat_sd: 290489, tamat_sd: 1161958, sltp: 1452445, slta: 870000, d1d2: 174294, d3: 290489, s1: 348588, s2: 116196, s3: 58098 },
            pengangguran: 87000,
            migrasi_datang: 200,
            migrasi_pindah: 150
        },
        'karawang' : {
            total_penduduk: 2612065,
            laki_laki: 1321284,
            perempuan: 1290781,
            kelompok_usia: {'0-6': 580979, '7-12': 697174, '13-15': 348588, '16-18': 348588, '19-24': 870000, '25-54': 2033426, '55+': 290035},
            agama: { islam: 5228811, kristen: 290489, katholik: 116196, hindu: 58097, budha: 58097, khonghucu: 11619, kepercayaan: 0 },
            pekerjaan: { belum_tidak_bekerja: 290489, aparatur: 58098, pengajar: 116196, wiraswasta: 1161958, pertanian: 1161958, nelayan: 174294, agama: 58097, pelajar: 870000, kesehatan: 116196, pensiunan: 290489, lainnya: 406473 },
            disabilitas: { fisik: 29049, netra: 5809, rungu: 5809, mental: 5809, fisik_mental: 2905, lain: 46486 },
            pendidikan: { tidak_sekolah: 116196, belum_tamat_sd: 290489, tamat_sd: 1161958, sltp: 1452445, slta: 870000, d1d2: 174294, d3: 290489, s1: 348588, s2: 116196, s3: 58098 },
            pengangguran: 87000,
            migrasi_datang: 200,
            migrasi_pindah: 150
        },
        'bekasi' : {
            total_penduduk: 3387601,
            laki_laki: 1711222,
            perempuan: 1676379,
            kelompok_usia: {'0-6': 310234, '7-12': 372281, '13-15': 186140, '16-18': 186140, '19-24': 465351, '25-54': 1083878, '55+': 31063},
            agama: { islam: 2792100, kristen: 155117, katholik: 62046, hindu: 31023, budha: 31023, khonghucu: 6205, kepercayaan: 0 },
            pekerjaan: { belum_tidak_bekerja: 155117, aparatur: 31023, pengajar: 62046, wiraswasta: 620468, pertanian: 620468, nelayan: 93070, agama: 31023, pelajar: 465351, kesehatan: 62046, pensiunan: 155117, lainnya: 483 },
            disabilitas: { fisik: 15511, netra: 3102, rungu: 3102, mental: 3102, fisik_mental: 1551, lain: 248 },
            pendidikan: { tidak_sekolah: 62046, belum_tamat_sd: 155117, tamat_sd: 620468, sltp: 775586, slta: 620468, d1d2: 93070, d3: 155117, s1: 186140, s2: 62046, s3: 31023 },
            pengangguran: 60000,
            migrasi_datang: 140,
            migrasi_pindah: 120
        },
        'bandung barat' : {
            total_penduduk: 1911661,
            laki_laki: 974016,
            perempuan: 937645,
            kelompok_usia: {'0-6': 580979, '7-12': 697174, '13-15': 348588, '16-18': 348588, '19-24': 870000, '25-54': 2033426, '55+': 290035},
            agama: { islam: 5228811, kristen: 290489, katholik: 116196, hindu: 58097, budha: 58097, khonghucu: 11619, kepercayaan: 0 },
            pekerjaan: { belum_tidak_bekerja: 290489, aparatur: 58098, pengajar: 116196, wiraswasta: 1161958, pertanian: 1161958, nelayan: 174294, agama: 58097, pelajar: 870000, kesehatan: 116196, pensiunan: 290489, lainnya: 406473 },
            disabilitas: { fisik: 29049, netra: 5809, rungu: 5809, mental: 5809, fisik_mental: 2905, lain: 46486 },
            pendidikan: { tidak_sekolah: 116196, belum_tamat_sd: 290489, tamat_sd: 1161958, sltp: 1452445, slta: 870000, d1d2: 174294, d3: 290489, s1: 348588, s2: 116196, s3: 58098 },
            pengangguran: 87000,
            migrasi_datang: 200,
            migrasi_pindah: 150
        },
        'pangandaran' : {
            total_penduduk: 447272,
            laki_laki: 224519,
            perempuan: 222753,
            kelompok_usia: {'0-6': 580979, '7-12': 697174, '13-15': 348588, '16-18': 348588, '19-24': 870000, '25-54': 2033426, '55+': 290035},
            agama: { islam: 5228811, kristen: 290489, katholik: 116196, hindu: 58097, budha: 58097, khonghucu: 11619, kepercayaan: 0 },
            pekerjaan: { belum_tidak_bekerja: 290489, aparatur: 58098, pengajar: 116196, wiraswasta: 1161958, pertanian: 1161958, nelayan: 174294, agama: 58097, pelajar: 870000, kesehatan: 116196, pensiunan: 290489, lainnya: 406473 },
            disabilitas: { fisik: 29049, netra: 5809, rungu: 5809, mental: 5809, fisik_mental: 2905, lain: 46486 },
            pendidikan: { tidak_sekolah: 116196, belum_tamat_sd: 290489, tamat_sd: 1161958, sltp: 1452445, slta: 870000, d1d2: 174294, d3: 290489, s1: 348588, s2: 116196, s3: 58098 },
            pengangguran: 87000,
            migrasi_datang: 200,
            migrasi_pindah: 150
        },
        'kota bogor' : {
            total_penduduk: 1144108,
            laki_laki: 578674,
            perempuan: 565434,
            kelompok_usia: {'0-6': 580979, '7-12': 697174, '13-15': 348588, '16-18': 348588, '19-24': 870000, '25-54': 2033426, '55+': 290035},
            agama: { islam: 5228811, kristen: 290489, katholik: 116196, hindu: 58097, budha: 58097, khonghucu: 11619, kepercayaan: 0 },
            pekerjaan: { belum_tidak_bekerja: 290489, aparatur: 58098, pengajar: 116196, wiraswasta: 1161958, pertanian: 1161958, nelayan: 174294, agama: 58097, pelajar: 870000, kesehatan: 116196, pensiunan: 290489, lainnya: 406473 },
            disabilitas: { fisik: 29049, netra: 5809, rungu: 5809, mental: 5809, fisik_mental: 2905, lain: 46486 },
            pendidikan: { tidak_sekolah: 116196, belum_tamat_sd: 290489, tamat_sd: 1161958, sltp: 1452445, slta: 870000, d1d2: 174294, d3: 290489, s1: 348588, s2: 116196, s3: 58098 },
            pengangguran: 87000,
            migrasi_datang: 200,
            migrasi_pindah: 150
        },
        'kota sukabumi' : {
            total_penduduk: 370096,
            laki_laki: 186135,
            perempuan: 183961,
            kelompok_usia: {'0-6': 580979, '7-12': 697174, '13-15': 348588, '16-18': 348588, '19-24': 870000, '25-54': 2033426, '55+': 290035},
            agama: { islam: 5228811, kristen: 290489, katholik: 116196, hindu: 58097, budha: 58097, khonghucu: 11619, kepercayaan: 0 },
            pekerjaan: { belum_tidak_bekerja: 290489, aparatur: 58098, pengajar: 116196, wiraswasta: 1161958, pertanian: 1161958, nelayan: 174294, agama: 58097, pelajar: 870000, kesehatan: 116196, pensiunan: 290489, lainnya: 406473 },
            disabilitas: { fisik: 29049, netra: 5809, rungu: 5809, mental: 5809, fisik_mental: 2905, lain: 46486 },
            pendidikan: { tidak_sekolah: 116196, belum_tamat_sd: 290489, tamat_sd: 1161958, sltp: 1452445, slta: 870000, d1d2: 174294, d3: 290489, s1: 348588, s2: 116196, s3: 58098 },
            pengangguran: 87000,
            migrasi_datang: 200,
            migrasi_pindah: 150
        },
        'kota bandung' : {
            total_penduduk: 2591763,
            laki_laki: 1298551,
            perempuan: 1293212,
            kelompok_usia: {'0-6': 239488, '7-12': 287385, '13-15': 143692, '16-18': 143692, '19-24': 359231, '25-54': 940000, '55+': 35487},
            agama: { islam: 2155387, kristen: 119744, katholik: 47897, hindu: 23948, budha: 23948, khonghucu: 4789, kepercayaan: 0 },
            pekerjaan: { belum_tidak_bekerja: 119744, aparatur: 23948, pengajar: 47897, wiraswasta: 478975, pertanian: 478975, nelayan: 71846, agama: 23948, pelajar: 359231, kesehatan: 47897, pensiunan: 119744, lainnya: 1230 },
            disabilitas: { fisik: 11974, netra: 2394, rungu: 2394, mental: 2394, fisik_mental: 1197, lain: 19137 },
            pendidikan: { tidak_sekolah: 47897, belum_tamat_sd: 119744, tamat_sd: 478975, sltp: 598737, slta: 478975, d1d2: 71846, d3: 119744, s1: 143692, s2: 47897, s3: 23948 },
            pengangguran: 35000,
            migrasi_datang: 60,
            migrasi_pindah: 50
        },
        'kota cirebon' : {
            total_penduduk: 356629,
            laki_laki: 178969,
            perempuan: 177660,
            kelompok_usia: {'0-6': 580979, '7-12': 697174, '13-15': 348588, '16-18': 348588, '19-24': 870000, '25-54': 2033426, '55+': 290035},
            agama: { islam: 5228811, kristen: 290489, katholik: 116196, hindu: 58097, budha: 58097, khonghucu: 11619, kepercayaan: 0 },
            pekerjaan: { belum_tidak_bekerja: 290489, aparatur: 58098, pengajar: 116196, wiraswasta: 1161958, pertanian: 1161958, nelayan: 174294, agama: 58097, pelajar: 870000, kesehatan: 116196, pensiunan: 290489, lainnya: 406473 },
            disabilitas: { fisik: 29049, netra: 5809, rungu: 5809, mental: 5809, fisik_mental: 2905, lain: 46486 },
            pendidikan: { tidak_sekolah: 116196, belum_tamat_sd: 290489, tamat_sd: 1161958, sltp: 1452445, slta: 870000, d1d2: 174294, d3: 290489, s1: 348588, s2: 116196, s3: 58098 },
            pengangguran: 87000,
            migrasi_datang: 200,
            migrasi_pindah: 150
        },
        'kota bekasi' : {
            total_penduduk: 2572209,
            laki_laki: 1285093,
            perempuan: 1287116,
            kelompok_usia: {'0-6': 580979, '7-12': 697174, '13-15': 348588, '16-18': 348588, '19-24': 870000, '25-54': 2033426, '55+': 290035},
            agama: { islam: 5228811, kristen: 290489, katholik: 116196, hindu: 58097, budha: 58097, khonghucu: 11619, kepercayaan: 0 },
            pekerjaan: { belum_tidak_bekerja: 290489, aparatur: 58098, pengajar: 116196, wiraswasta: 1161958, pertanian: 1161958, nelayan: 174294, agama: 58097, pelajar: 870000, kesehatan: 116196, pensiunan: 290489, lainnya: 406473 },
            disabilitas: { fisik: 29049, netra: 5809, rungu: 5809, mental: 5809, fisik_mental: 2905, lain: 46486 },
            pendidikan: { tidak_sekolah: 116196, belum_tamat_sd: 290489, tamat_sd: 1161958, sltp: 1452445, slta: 870000, d1d2: 174294, d3: 290489, s1: 348588, s2: 116196, s3: 58098 },
            pengangguran: 87000,
            migrasi_datang: 200,
            migrasi_pindah: 150
        },
        'depok' : {
            total_penduduk: 2010912,
            laki_laki: 1008092,
            perempuan: 1002820,
            kelompok_usia: {'0-6': 580979, '7-12': 697174, '13-15': 348588, '16-18': 348588, '19-24': 870000, '25-54': 2033426, '55+': 290035},
            agama: { islam: 5228811, kristen: 290489, katholik: 116196, hindu: 58097, budha: 58097, khonghucu: 11619, kepercayaan: 0 },
            pekerjaan: { belum_tidak_bekerja: 290489, aparatur: 58098, pengajar: 116196, wiraswasta: 1161958, pertanian: 1161958, nelayan: 174294, agama: 58097, pelajar: 870000, kesehatan: 116196, pensiunan: 290489, lainnya: 406473 },
            disabilitas: { fisik: 29049, netra: 5809, rungu: 5809, mental: 5809, fisik_mental: 2905, lain: 46486 },
            pendidikan: { tidak_sekolah: 116196, belum_tamat_sd: 290489, tamat_sd: 1161958, sltp: 1452445, slta: 870000, d1d2: 174294, d3: 290489, s1: 348588, s2: 116196, s3: 58098 },
            pengangguran: 87000,
            migrasi_datang: 200,
            migrasi_pindah: 150
        },
        'cimahi' : {
            total_penduduk: 581994,
            laki_laki: 292434,
            perempuan: 289560,
            kelompok_usia: {'0-6': 580979, '7-12': 697174, '13-15': 348588, '16-18': 348588, '19-24': 870000, '25-54': 2033426, '55+': 290035},
            agama: { islam: 5228811, kristen: 290489, katholik: 116196, hindu: 58097, budha: 58097, khonghucu: 11619, kepercayaan: 0 },
            pekerjaan: { belum_tidak_bekerja: 290489, aparatur: 58098, pengajar: 116196, wiraswasta: 1161958, pertanian: 1161958, nelayan: 174294, agama: 58097, pelajar: 870000, kesehatan: 116196, pensiunan: 290489, lainnya: 406473 },
            disabilitas: { fisik: 29049, netra: 5809, rungu: 5809, mental: 5809, fisik_mental: 2905, lain: 46486 },
            pendidikan: { tidak_sekolah: 116196, belum_tamat_sd: 290489, tamat_sd: 1161958, sltp: 1452445, slta: 870000, d1d2: 174294, d3: 290489, s1: 348588, s2: 116196, s3: 58098 },
            pengangguran: 87000,
            migrasi_datang: 200,
            migrasi_pindah: 150
        },
        'kota tasikmalaya' : {
            total_penduduk: 770839,
            laki_laki: 391746,
            perempuan: 379093,
            kelompok_usia: {'0-6': 580979, '7-12': 697174, '13-15': 348588, '16-18': 348588, '19-24': 870000, '25-54': 2033426, '55+': 290035},
            agama: { islam: 5228811, kristen: 290489, katholik: 116196, hindu: 58097, budha: 58097, khonghucu: 11619, kepercayaan: 0 },
            pekerjaan: { belum_tidak_bekerja: 290489, aparatur: 58098, pengajar: 116196, wiraswasta: 1161958, pertanian: 1161958, nelayan: 174294, agama: 58097, pelajar: 870000, kesehatan: 116196, pensiunan: 290489, lainnya: 406473 },
            disabilitas: { fisik: 29049, netra: 5809, rungu: 5809, mental: 5809, fisik_mental: 2905, lain: 46486 },
            pendidikan: { tidak_sekolah: 116196, belum_tamat_sd: 290489, tamat_sd: 1161958, sltp: 1452445, slta: 870000, d1d2: 174294, d3: 290489, s1: 348588, s2: 116196, s3: 58098 },
            pengangguran: 87000,
            migrasi_datang: 200,
            migrasi_pindah: 150
        },
        'banjar' : {
            total_penduduk: 209317,
            laki_laki: 105511,
            perempuan: 103806,
            kelompok_usia: {'0-6': 580979, '7-12': 697174, '13-15': 348588, '16-18': 348588, '19-24': 870000, '25-54': 2033426, '55+': 290035},
            agama: { islam: 5228811, kristen: 290489, katholik: 116196, hindu: 58097, budha: 58097, khonghucu: 11619, kepercayaan: 0 },
            pekerjaan: { belum_tidak_bekerja: 290489, aparatur: 58098, pengajar: 116196, wiraswasta: 1161958, pertanian: 1161958, nelayan: 174294, agama: 58097, pelajar: 870000, kesehatan: 116196, pensiunan: 290489, lainnya: 406473 },
            disabilitas: { fisik: 29049, netra: 5809, rungu: 5809, mental: 5809, fisik_mental: 2905, lain: 46486 },
            pendidikan: { tidak_sekolah: 116196, belum_tamat_sd: 290489, tamat_sd: 1161958, sltp: 1452445, slta: 870000, d1d2: 174294, d3: 290489, s1: 348588, s2: 116196, s3: 58098 },
            pengangguran: 87000,
            migrasi_datang: 200,
            migrasi_pindah: 150
        },
    };

    function ensureStatDefaults(stat) {
        if (!stat) return null;
        const total = Number(stat.total_penduduk || 0);

        stat.laki_laki = stat.laki_laki ?? Math.round(total * 0.505);
        stat.perempuan = stat.perempuan ?? Math.max(0, total - stat.laki_laki);

        // kelompok usia
        if (!stat.kelompok_usia || Object.keys(stat.kelompok_usia).length === 0) {
            const a0 = Math.round(total * 0.10);
            const a1 = Math.round(total * 0.12);
            const a2 = Math.round(total * 0.06);
            const a3 = Math.round(total * 0.06);
            const a4 = Math.round(total * 0.15);
            const a5 = Math.round(total * 0.35);
            const a6 = Math.max(0, total - (a0+a1+a2+a3+a4+a5));
            stat.kelompok_usia = {'0-6': a0, '7-12': a1, '13-15': a2, '16-18': a3, '19-24': a4, '25-54': a5, '55+': a6};
        }

        // agama
        if (!stat.agama || Object.keys(stat.agama).length === 0) {
            stat.agama = { islam: Math.round(total * 0.90), kristen: Math.round(total * 0.05), katholik: Math.round(total * 0.02), hindu: Math.round(total * 0.01), budha: Math.round(total * 0.01), khonghucu: Math.round(total * 0.002), kepercayaan: Math.max(0, total - Math.round(total * 0.99)) };
        }

        // pekerjaan
        if (!stat.pekerjaan || Object.keys(stat.pekerjaan).length === 0) {
            stat.pekerjaan = {
                belum_tidak_bekerja: Math.round(total * 0.05),
                aparatur: Math.round(total * 0.01),
                pengajar: Math.round(total * 0.02),
                wiraswasta: Math.round(total * 0.20),
                pertanian: Math.round(total * 0.20),
                nelayan: Math.round(total * 0.03),
                agama: Math.round(total * 0.01),
                pelajar: Math.round(total * 0.15),
                kesehatan: Math.round(total * 0.02),
                pensiunan: Math.round(total * 0.05),
                lainnya: Math.max(0, total - Math.round(total * 0.74))
            };
        }

        // disabilitas
        if (!stat.disabilitas || Object.keys(stat.disabilitas).length === 0) {
            stat.disabilitas = { fisik: Math.round(total * 0.005), netra: Math.round(total * 0.001), rungu: Math.round(total * 0.001), mental: Math.round(total * 0.001), fisik_mental: Math.round(total * 0.0005), lain: Math.max(0, Math.round(total * 0.008)) };
        }

        // pendidikan
        if (!stat.pendidikan || Object.keys(stat.pendidikan).length === 0) {
            stat.pendidikan = {
                tidak_sekolah: Math.round(total * 0.02),
                belum_tamat_sd: Math.round(total * 0.05),
                tamat_sd: Math.round(total * 0.20),
                sltp: Math.round(total * 0.25),
                slta: Math.round(total * 0.20),
                d1d2: Math.round(total * 0.03),
                d3: Math.round(total * 0.05),
                s1: Math.round(total * 0.06),
                s2: Math.round(total * 0.02),
                s3: Math.round(total * 0.01)
            };
        }

        // migrasi
        stat.migrasi_datang = Number(stat.migrasi_datang || 0);
        stat.migrasi_pindah = Number(stat.migrasi_pindah || 0);

        return stat;
    }

    let currentMapLayer = 'total_penduduk';

    const normalize = s => String(s || '')
        .toLowerCase()
        .replace(/\./g,'')
        .replace(/\s+/g,' ')
        .trim()
        .replace(/^kabupaten\s+/, '')
        .replace(/^kota\s+/, '');

    function findStatByKabkot(name) {
        if (!name) return null;
        const n = normalize(name);
        return staticStatistik[n] || null;
    }

    function valueForFeature(feature, layerKey) {
        const propName = feature.properties && (feature.properties.KABKOT || feature.properties.NAME || feature.properties.NAME_2);
        const stat = findStatByKabkot(propName);
        if (!stat) return 0;
        const s = ensureStatDefaults(Object.assign({}, stat));
        switch (layerKey) {
            case 'total_penduduk':
                return parseInt(s.total_penduduk || 0);
            case 'jenis_kelamin':
                return parseInt(s.laki_laki || 0);
            case 'kelompok_usia':
                return parseInt(s.kelompok_usia?.['19-24'] || 0);
            case 'agama':
                return parseInt(s.agama?.islam || 0);
            case 'pekerjaan':
                return parseInt(s.pekerjaan?.wiraswasta || 0);
            case 'disabilitas':
                return parseInt(Object.values(s.disabilitas || {}).reduce((a,b)=>a+Number(b),0));
            case 'pendidikan':
                return parseInt(s.pendidikan?.s1 || 0);
            default:
                return parseInt(s[layerKey] || 0);
        }
    }

    const layerPalettes = {
        'total_penduduk': {
            thresholds: [0, 10000, 50000, 100000, 300000, 800000, 2000000],
            colors: ['#f2f0f7', '#dadaeb', '#bcbddc', '#9e9ac8', '#807dba', '#6a51a3', '#4a1486']
        },
        'jenis_kelamin': {
            thresholds: [0, 10000, 50000, 100000, 300000, 800000, 2000000],
            colors: ['#f7fbff', '#deebf7', '#c6dbef', '#9ecae1', '#6baed6', '#3182bd', '#08519c']
        },
        'kelompok_usia': {
            thresholds: [0, 10000, 50000, 100000, 200000, 400000, 800000],
            colors: ['#fff7fb', '#ece7f2', '#d0d1e6', '#a6bddb', '#67a9cf', '#3690c0', '#016c9c']
        },
        'agama': {
            thresholds: [0, 10000, 50000, 100000, 200000, 400000, 800000],
            colors: ['#fffef0', '#fff7d9', '#fff0b2', '#ffe082', '#ffc107', '#ff9800', '#ff6f00']
        },
        'pekerjaan': {
            thresholds: [0, 5000, 20000, 50000, 100000, 200000, 500000],
            colors: ['#f7fcf5', '#e5f5e0', '#c7e9c0', '#a1d99b', '#74c476', '#31a354', '#006d2c']
        },
        'disabilitas': {
            thresholds: [0, 50, 200, 500, 1000, 3000, 10000],
            colors: ['#fff5f0', '#fee6e0', '#fcbba1', '#fc9272', '#fb6a4a', '#de2d26', '#a50f15']
        },
        'pendidikan': {
            thresholds: [0, 5000, 20000, 50000, 100000, 200000, 500000],
            colors: ['#f7fbff', '#deebf7', '#c6dbef', '#9ecae1', '#6baed6', '#3182bd', '#08519c']
        },
        'migrasi_datang': {
            thresholds: [0, 10, 50, 100, 200, 500, 1000],
            colors: ['#fff5f0', '#fee0d2', '#fcbba1', '#fc9272', '#fb6a4a', '#de2d26', '#a50f15']
        },
        'migrasi_pindah': {
            thresholds: [0, 10, 50, 100, 200, 500, 1000],
            colors: ['#f7fbff', '#deebf7', '#c6dbef', '#9ecae1', '#6baed6', '#3182bd', '#08519c']
        }
    };

    function getPalette(layerKey) {
        return layerPalettes[layerKey] || layerPalettes['total_penduduk'];
    }

    function getColor(value, layerKey) {
        const pal = getPalette(layerKey);
        const thresholds = pal.thresholds;
        const colors = pal.colors;
        for (let i = thresholds.length - 1; i >= 0; i--) {
            if (value >= thresholds[i]) return colors[i];
        }
        return colors[0];
    }

    function updateGeoStyle(geojsonLayer) {
        geojsonLayer.eachLayer(function(layer) {
            const val = valueForFeature(layer.feature, currentMapLayer);
            layer.setStyle({ fillColor: getColor(val, currentMapLayer), fillOpacity: 0.7 });
            const propName = layer.feature.properties && (layer.feature.properties.KABKOT || layer.feature.properties.NAME || layer.feature.properties.NAME_2);
            const stat = findStatByKabkot(propName);
            const popup = getPopupContent(propName, stat, currentMapLayer);
            layer.bindPopup(popup);
        });
        updateLegend(currentMapLayer);
    }

    document.addEventListener('click', function(e) {
        const target = e.target.closest('.dropdown-item[data-map-layer]');
        if (!target) return;
        e.preventDefault();
        currentMapLayer = target.getAttribute('data-map-layer') || 'total_penduduk';
        document.getElementById('selectedMapLayer').textContent = target.textContent.trim();

        document.querySelectorAll('.dropdown-item[data-map-layer]').forEach(i => i.classList.remove('active'));
        target.classList.add('active');

        if (window._geojsonLayer) updateGeoStyle(window._geojsonLayer);
    });

    function updateLegend(layerKey) {
        const pal = getPalette(layerKey);
        const thresholds = pal.thresholds;
        const colors = pal.colors;
        const legend = document.getElementById('mapLegend');
        if (!legend) return;
        let html = `<strong style="display:block;margin-bottom:6px;font-size:13px;">${document.getElementById('selectedMapLayer').textContent}</strong>`;
        for (let i = thresholds.length - 1; i >= 0; i--) {
            const from = thresholds[i];
            const to = (i < thresholds.length -1) ? thresholds[i+1]-1 : '+';
            const label = to === '+' ? `${from}+` : `${from} - ${to}`;
            html += `<div style="display:flex;align-items:center;margin-bottom:4px;"><span style="display:inline-block;width:18px;height:12px;background:${colors[i]};margin-right:8px;border:1px solid rgba(0,0,0,0.1);"></span><span>${label}</span></div>`;
        }
        legend.innerHTML = html;
    }
</script>

<script>
    // Map Initialization
    var map = L.map('map').setView([-6.953, 107.704], 8);
    map.createPane('labels');
    map.getPane('labels').style.zIndex = 650;
    map.getPane('labels').style.pointerEvents = 'none';

    var positron = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}.png', {
        attribution: '©OpenStreetMap, ©CartoDB'
    }).addTo(map);

    var positronLabels = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_only_labels/{z}/{x}/{y}.png', {
        attribution: '©OpenStreetMap, ©CartoDB',
        pane: 'labels'
    }).addTo(map);

    let activeMarker = null;

    const fmt = new Intl.NumberFormat('id-ID');
    const formatNumber = n => (n === null || n === undefined) ? '0' : fmt.format(Number(n));

    function getPopupContent(kabkotName, stat = {}, layerKey = 'total_penduduk') {
        if (!stat) return `<b>${kabkotName}</b><br>Data tidak tersedia`;

        switch (layerKey) {
            case 'total_penduduk':
                return `<b>${kabkotName}</b><br>Jumlah: ${formatNumber(stat.total_penduduk || 0)}`;

            case 'jenis_kelamin':
                return `<b>${kabkotName}</b><br>
                        Laki-laki: ${formatNumber(stat.laki_laki || 0)}<br>
                        Perempuan: ${formatNumber(stat.perempuan || 0)}`;

            case 'kelompok_usia':
                return `<b>${kabkotName}</b><br>
                        0-6 tahun: ${formatNumber(stat.kelompok_usia?.['0-6'] || 0)}<br>
                        7-12 tahun: ${formatNumber(stat.kelompok_usia?.['7-12'] || 0)}<br>
                        13-15 tahun: ${formatNumber(stat.kelompok_usia?.['13-15'] || 0)}<br>
                        16-18 tahun: ${formatNumber(stat.kelompok_usia?.['16-18'] || 0)}<br>
                        19-24 tahun: ${formatNumber(stat.kelompok_usia?.['19-24'] || 0)}`;

            case 'agama':
                return `<b>${kabkotName}</b><br>
                        Islam: ${formatNumber(stat.agama?.islam || 0)}<br>
                        Kristen: ${formatNumber(stat.agama?.kristen || 0)}<br>
                        Katolik: ${formatNumber(stat.agama?.katholik || 0)}<br>
                        Hindu: ${formatNumber(stat.agama?.hindu || 0)}<br>
                        Buddha: ${formatNumber(stat.agama?.budha || 0)}<br>
                        Khonghucu: ${formatNumber(stat.agama?.khonghucu || 0)}<br>
                        Kepercayaan: ${formatNumber(stat.agama?.kepercayaan || 0)}`;

            case 'pekerjaan':
                return `<b>${kabkotName}</b><br>
                        Belum/Tidak Bekerja: ${formatNumber(stat.pekerjaan?.belum_tidak_bekerja || 0)}<br>
                        Aparatur/Pejabat Negara: ${formatNumber(stat.pekerjaan?.aparatur || 0)}<br>
                        Tenaga Pengajar: ${formatNumber(stat.pekerjaan?.pengajar || 0)}<br>
                        Wiraswasta: ${formatNumber(stat.pekerjaan?.wiraswasta || 0)}<br>
                        Pertanian/Peternakan: ${formatNumber(stat.pekerjaan?.pertanian || 0)}<br>
                        Nelayan: ${formatNumber(stat.pekerjaan?.nelayan || 0)}<br>
                        Agama dan Kepercayaan: ${formatNumber(stat.pekerjaan?.agama || 0)}<br>
                        Pelajar/Mahasiswa: ${formatNumber(stat.pekerjaan?.pelajar || 0)}<br>
                        Tenaga Kesehatan: ${formatNumber(stat.pekerjaan?.kesehatan || 0)}<br>
                        Pensiunan: ${formatNumber(stat.pekerjaan?.pensiunan || 0)}<br>
                        Lainnya: ${formatNumber(stat.pekerjaan?.lainnya || 0)}`;

            case 'disabilitas':
                return `<b>${kabkotName}</b><br>
                        Disabilitas Fisik: ${formatNumber(stat.disabilitas?.fisik || 0)}<br>
                        Disabilitas Netra/Buta: ${formatNumber(stat.disabilitas?.netra || 0)}<br>
                        Disabilitas Rungu/Wicara: ${formatNumber(stat.disabilitas?.rungu || 0)}<br>
                        Disabilitas Mental/Jiwa: ${formatNumber(stat.disabilitas?.mental || 0)}<br>
                        Disabilitas Fisik & Mental: ${formatNumber(stat.disabilitas?.fisik_mental || 0)}<br>
                        Disabilitas Lainnya: ${formatNumber(stat.disabilitas?.lain || 0)}`;

            case 'pendidikan':
                return `<b>${kabkotName}</b><br>
                        Tidak/Belum Sekolah: ${formatNumber(stat.pendidikan?.tidak_sekolah || 0)}<br>
                        Belum Tamat SD/Sederajat: ${formatNumber(stat.pendidikan?.belum_tamat_sd || 0)}<br>
                        Tamat SD/Sederajat: ${formatNumber(stat.pendidikan?.tamat_sd || 0)}<br>
                        SLTP/Sederajat: ${formatNumber(stat.pendidikan?.sltp || 0)}<br>
                        SLTA/Sederajat: ${formatNumber(stat.pendidikan?.slta || 0)}<br>
                        Diploma I/II: ${formatNumber(stat.pendidikan?.d1d2 || 0)}<br>
                        Akademi/Diploma III: ${formatNumber(stat.pendidikan?.d3 || 0)}<br>
                        Diploma IV/Strata I: ${formatNumber(stat.pendidikan?.s1 || 0)}<br>
                        Strata II: ${formatNumber(stat.pendidikan?.s2 || 0)}<br>
                        Strata III: ${formatNumber(stat.pendidikan?.s3 || 0)}`;

            case 'migrasi_datang':
                return `<b>${kabkotName}</b><br>Jumlah: ${formatNumber(stat.migrasi_datang || 0)}`;

            case 'migrasi_pindah':
                return `<b>${kabkotName}</b><br>Jumlah: ${formatNumber(stat.migrasi_pindah || 0)}`;

            default:
                return `<b>${kabkotName}</b><br>
                        Jumlah: ${formatNumber(stat.total_penduduk || 0)}<br>
                        Laki-laki: ${formatNumber(stat.laki_laki || 0)}<br>
                        Perempuan: ${formatNumber(stat.perempuan || 0)}`;
        }
    }

    fetch('/jawa_barat.geojson')
            .then(r => r.json())
            .then(data => {
                window._geojsonLayer = L.geoJson(data, {
                    style: function(feature) {
                        const val = valueForFeature(feature, currentMapLayer);
                        return {
                            color: '#3388ff',
                            weight: 1,
                            opacity: 1,
                            fillColor: getColor(val, currentMapLayer),
                            fillOpacity: 0.7
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        const propName = feature.properties && (feature.properties.KABKOT || feature.properties.NAME || feature.properties.NAME_2) || 'Wilayah Tidak Diketahui';
                        const stat = findStatByKabkot(propName);
                        const popup = getPopupContent(propName, stat, currentMapLayer);
                        layer.bindPopup(popup);
                    }
                 }).addTo(map);

            map.fitBounds(window._geojsonLayer.getBounds());
            updateLegend(currentMapLayer);
            })
    .catch(err => console.error(err));
</script>

<script>
    // Gender Distribution Chart
    const ctx = document.getElementById('genderChart').getContext('2d');
    const genderChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                data: [{{ $data['pendudukPria'] }}, {{ $data['pendudukWanita'] }}],
                backgroundColor: [
                    '#4e73df',
                    '#1cc88a'
                ],
                hoverBackgroundColor: [
                    '#2e59d9',
                    '#17a673'
                ],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: true
            },
            cutoutPercentage: 80,
        },
    });
</script>
@endsection
