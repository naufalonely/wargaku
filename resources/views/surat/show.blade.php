@extends('layouts.app')

@section('title', 'Detail Surat')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detail Surat</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('surat.index') }}" class="btn btn-outline-secondary me-2">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
        <button onclick="window.print()" class="btn btn-success">
            <i class="fas fa-print me-1"></i> Cetak
        </button>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body" id="surat-content">
                <div class="text-center mb-4">
                    <h5>PEMERINTAH PROVINSI JAWA BARAT</h5>
                    <h3>DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</h3>
                    <p>Jalan Ciumbuleuit No.2 Telp. (022) 2031004-2031045 Fax. 2031045
                    <br>website: https://disdukcapil.jabarprov.go.id, e-mail: dukcapil@jabarprov.go.id
                    <br>Bandung - 40132</p>
                    <hr>
                </div>

                <div class="text-center mb-4">
                    <h5><u>{{ $surat->jenis_surat }}</u></h5>
                    <p>Nomor: {{ $surat->nomor_surat }}</p>
                </div>

                <div class="mb-4">
                    <p>Yang bertanda tangan di bawah ini, menerangkan bahwa:</p>

                    <table class="table table-borderless" style="margin-left: 2rem;">
                        <tr>
                            <td width="150">Nama</td>
                            <td width="20">:</td>
                            <td>{{ $surat->penduduk->nama }}</td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>:</td>
                            <td>{{ $surat->penduduk->nik }}</td>
                        </tr>
                        <tr>
                            <td>Tempat, Tgl Lahir</td>
                            <td>:</td>
                            <td>{{ $surat->penduduk->tempat_lahir }}, {{ $surat->penduduk->tanggal_lahir->format('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td>{{ $surat->penduduk->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ $surat->penduduk->alamat }} RT {{ $surat->penduduk->rt }} RW {{ $surat->penduduk->rw }}</td>
                        </tr>
                        <tr>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td>{{ $surat->penduduk->pekerjaan }}</td>
                        </tr>
                        <tr>
                            <td>Keperluan</td>
                            <td>:</td>
                            <td>{{ $surat->keperluan }}</td>
                        </tr>
                    </table>

                    <p>Demikian surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.</p>
                </div>

                <div class="row mt-5">
                    <div class="col-6"></div>
                    <div class="col-6 text-center">
                        <p>Bandung, {{ $surat->tanggal_surat->format('d F Y') }}</p>
                        <p>KEPALA DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL PROVINSI JAWA BARAT.</p>
                        <br><br><br>
                        <p><u>{{ $surat->pegawai->nama }}</u></p>
                        <p>{{ $surat->pegawai->jabatan }}</p>
                    </div>
                </div>
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
                        <th>Status</th>
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
                </table>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .btn-toolbar, .card-header, .border-bottom, nav, .col-md-4 {
        display: none !important;
    }
    .card {
        border: none !important;
        box-shadow: none !important;
    }
    .col-md-8 {
        width: 100% !important;
    }
}
</style>
@endsection
