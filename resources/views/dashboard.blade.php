@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <span class="badge bg-primary">{{ date('d F Y') }}</span>
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
        </div>
    </a>
</div>

<!-- Map Card -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Visualisasi Data Penduduk Jawa Barat</h6>
            <div class="dropdown">
                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="mapDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Pilih Data
                </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="mapDropdown">
                        <li><a class="dropdown-item" href="#" data-map-layer="total_penduduk">Jumlah Penduduk</a></li>
                        <li><a class="dropdown-item" href="#" data-map-layer="jenis_kelamin">Jenis Kelamin</a></li>                            <li><a class="dropdown-item" href="#" data-map-layer="agama">Agama</a></li>
                        <li><a class="dropdown-item" href="#" data-map-layer="pekerjaan">Pekerjaan</a></li>
                        <li><a class="dropdown-item" href="#" data-map-layer="kesehatan">Kesehatan</a></li>
                        <li><a class="dropdown-item" href="#" data-map-layer="pendidikan">Pendidikan</a></li>
                        <li><a class="dropdown-item" href="#" data-map-layer="industri">Industri</a></li>
                        <li><a class="dropdown-item" href="#" data-map-layer="perkawinan">Perkawinan</a></li>
                        <li><a class="dropdown-item" href="#" data-map-layer="migrasi">Migrasi</a></li>
                        <li><a class="dropdown-item" href="#" data-map-layer="disabilitas">Disabilitas</a></li>
                    </ul>
                </div>
            </div>
        <div class="card-body">
        <div id="map" style="height: 500px; border-radius: 8px;"></div>
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
                        <i class="fas fa-file me-2"></i>Tambah Surat Baru
                    </a>
                    <a href="{{ route('pelayanan.create') }}" class="btn btn-info">
                        <i class="fas fa-clipboard-check me-2"></i>Buat Permohonan Baru
                    </a>
                    <a href="{{ route('pegawai.create') }}" class="btn btn-warning">
                        <i class="fas fa-user-plus me-2"></i>Tambah Pegawai Baru
                    </a>
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
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<script>
var map = L.map('map').setView([-6.889836, 107.640312], 8);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

    const geojsonPath = '{{ url('/geojson/jawa_barat.geojson') }}';

    fetch(geojsonPath)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                const geojsonLayer = L.geoJSON(data, {
                    style: function (feature) {
                        return {
                            color: "",
                            weight: 3,
                            opacity: 0.8,
                            fillColor: "transparent",
                            fillOpacity: 0.2
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        if (feature.properties && feature.properties.name) {
                            layer.bindPopup(feature.properties.name);
                        }
                    }
                }).addTo(map);

                map.fitBounds(geojsonLayer.getBounds());

            })
            .catch(error => {
                console.error('There has been a problem with your fetch operation:', error);
            });
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
