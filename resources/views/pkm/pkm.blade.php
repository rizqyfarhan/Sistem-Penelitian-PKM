@extends('template')

@section('title')
<title>PKM</title>
@endsection

@section('sidenav')
<div class="sb-sidenav-menu">
    <div class="nav">
        <div class="sb-sidenav-menu-heading">Menu</div>
        <a class="nav-link collapsed" href="{{ route('dashboard') }}" aria-expanded="false">
            <div class="sb-nav-link-icon"><i class="fa-solid fa-table-cells"></i></div>
            Dashboard
        </a>
        <a class="nav-link collapsed" href="{{ route('penelitian') }}" aria-expanded="false">
            <div class="sb-nav-link-icon"><i class="fa-solid fa-flask"></i></div>
            Penelitian
        </a>
        <a class="nav-link collapsed" href="{{ route('pkm') }}" aria-expanded="false">
            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
            PKM
        </a>
        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="nav-scroller py-1 mb-3 border-bottom">
    <nav class="nav nav-underline justify-content-start">
        <a class="nav-item nav-link link-body-emphasis active" href="{{ route('pkm') }}">Upload</a>
        <a class="nav-item nav-link link-body-emphasis" href="{{ route('show.pkm') }}">Upload Saya</a>
    </nav>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h1 class="mt-4">Proposal PKM</h1>
        <div class="nav-scroller py-1 mb-3 border-bottom">
            <nav class="nav nav-underline justify-content-start">
            </nav>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="container">
                    <form action="{{ route('store.proposalpkm') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="JudulPKM">Judul PKM:</label>
                            <input type="text" class="form-control" id="JudulPKM" name="judul" required>
                        </div>

                        <div class="form-group">
                            <label for="NamaPelaksana">Nama Pelaksana:</label>
                            <input type="text" class="form-control" id="NamaPelaksana" name="nama_pelaksana">
                        </div>

                        <div class="form-group">
                            <label for="NIK">NIDN:</label>
                            <input type="text" class="form-control" id="NIK" name="nidn">
                        </div>

                        <div class="form-group">
                            <label for="NIM">NRK:</label>
                            <input type="text" class="form-control" id="NIM" name="nrk">
                        </div>

                        <div class="form-group">
                            <label for="ProgramStudi">Program Studi:</label>
                            <select class="form-control" id="ProgramStudi" name="program_studi">
                                <option value="Pilih">Pilih...</option>
                                <option value="Informatika">Teknik Informatika</option>
                                <option value="Industri">Teknik Industri</option>
                                <option value="SI">Sistem Informasi</option>
                                <option value="Elektro">Teknik Elektro</option>
                                <option value="Mesin">Teknik Mesin</option>
                                <option value="Sipil">Teknik Sipil</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Semester">Semester:</label>
                            <select class="form-control" id="pemilihanSemester" name="semester">
                                <option value="Pilih">Pilih...</option>
                                <option value="ganjil">Ganjil</option>
                                <option value="genap">Genap</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="TahunAkademik">Tahun Akademik:</label>
                            <select class="form-control" id="TahunAkademik" name="tahun_akademik">
                                <option value="Pilih">Pilih...</option>
                                <?php
                        $currentYear = date('Y');
                        for ($i = $currentYear - 5; $i <= $currentYear; $i++) {
                            $academicYear = $i . '/' . ($i + 1);
                            echo "<option value=\"$academicYear\">$academicYear</option>";
                        }
                        ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="NamaMitra">Nama Mitra:</label>
                            <input type="text" class="form-control" id="NamaMitra" name="nama_mitra">
                        </div>

                        <div class="form-group">
                            <label for="AlamatMitra">Alamat Mitra:</label>
                            <input type="text" class="form-control" id="AlamatMitra" name="alamat_mitra">
                        </div>

                        <div class="form-group mb-2">
                            <label for="file">Proposal PKM:</label>
                            <input type="file" class="form-control" id="file" name="file">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h1 class="mt-4">Laporan Kemajuan PKM</h1>
        <div class="nav-scroller py-1 mb-3 border-bottom">
            <nav class="nav nav-underline justify-content-start">
            </nav>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="container">
                    <form action="{{ route('store.kemajuanpkm') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="JudulPKM">Judul PKM:</label>
                            <input type="text" class="form-control" id="JudulPKM" name="judul" required>
                        </div>

                        <div class="form-group">
                            <label for="NamaPelaksana">Nama Pelaksana:</label>
                            <input type="text" class="form-control" id="NamaPelaksana" name="nama_pelaksana">
                        </div>

                        <div class="form-group">
                            <label for="NIK">NIDN:</label>
                            <input type="text" class="form-control" id="NIK" name="nidn">
                        </div>

                        <div class="form-group">
                            <label for="NIM">NRK:</label>
                            <input type="text" class="form-control" id="NIM" name="nrk">
                        </div>

                        <div class="form-group">
                            <label for="ProgramStudi">Program Studi:</label>
                            <select class="form-control" id="ProgramStudi" name="program_studi">
                                <option value="Pilih">Pilih...</option>
                                <option value="Informatika">Teknik Informatika</option>
                                <option value="Industri">Teknik Industri</option>
                                <option value="SI">Sistem Informasi</option>
                                <option value="Elektro">Teknik Elektro</option>
                                <option value="Mesin">Teknik Mesin</option>
                                <option value="Sipil">Teknik Sipil</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Semester">Semester:</label>
                            <select class="form-control" id="pemilihanSemester" name="semester">
                                <option value="Pilih">Pilih...</option>
                                <option value="ganjil">Ganjil</option>
                                <option value="genap">Genap</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="TahunAkademik">Tahun Akademik:</label>
                            <select class="form-control" id="TahunAkademik" name="tahun_akademik">
                                <option value="Pilih">Pilih...</option>
                                <?php
                        $currentYear = date('Y');
                        for ($i = $currentYear - 5; $i <= $currentYear; $i++) {
                            $academicYear = $i . '/' . ($i + 1);
                            echo "<option value=\"$academicYear\">$academicYear</option>";
                        }
                        ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="NamaMitra">Nama Mitra:</label>
                            <input type="text" class="form-control" id="NamaMitra" name="nama_mitra">
                        </div>

                        <div class="form-group">
                            <label for="AlamatMitra">Alamat Mitra:</label>
                            <input type="text" class="form-control" id="AlamatMitra" name="alamat_mitra">
                        </div>

                        <div class="form-group mb-2">
                            <label for="file">File:</label>
                            <input type="file" class="form-control" id="file" name="file">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h1 class="mt-4">Laporan Akhir PKM</h1>
        <div class="nav-scroller py-1 mb-3 border-bottom">
            <nav class="nav nav-underline justify-content-start">
            </nav>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="container">
                    <form action="{{ route('lapkempenelitian.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="JudulPKM">Judul PKM:</label>
                            <input type="text" class="form-control" id="JudulPKM" name="JudulPKM" required>
                        </div>

                        <div class="form-group">
                            <label for="NamaPelaksana">Nama Pelaksana:</label>
                            <input type="text" class="form-control" id="NamaPelaksana" name="NamaPelaksana">
                        </div>

                        <div class="form-group">
                            <label for="NIK">NIDN:</label>
                            <input type="text" class="form-control" id="NIK" name="NIK">
                        </div>

                        <div class="form-group">
                            <label for="NIM">NRK:</label>
                            <input type="text" class="form-control" id="NIM" name="NIM">
                        </div>

                        <div class="form-group">
                            <label for="ProgramStudi">Program Studi:</label>
                            <select class="form-control" id="ProgramStudi" name="ProgramStudi">
                                <option value="Pilih">Pilih...</option>
                                <option value="Informatika">Teknik Informatika</option>
                                <option value="Industri">Teknik Industri</option>
                                <option value="SI">Sistem Informasi</option>
                                <option value="Elektro">Teknik Elektro</option>
                                <option value="Mesin">Teknik Mesin</option>
                                <option value="Sipil">Teknik Sipil</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Semester">Semester:</label>
                            <select class="form-control" id="pemilihanSemester" name="Semester">
                                <option value="Pilih">Pilih...</option>
                                <option value="ganjil">Ganjil</option>
                                <option value="genap">Genap</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="TahunAkademik">Tahun Akademik:</label>
                            <select class="form-control" id="TahunAkademik" name="TahunAkademik">
                                <option value="Pilih">Pilih...</option>
                                <?php
                        $currentYear = date('Y');
                        for ($i = $currentYear - 5; $i <= $currentYear; $i++) {
                            $academicYear = $i . '/' . ($i + 1);
                            echo "<option value=\"$academicYear\">$academicYear</option>";
                        }
                        ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="NamaMitra">Nama Mitra:</label>
                            <input type="text" class="form-control" id="NamaMitra" name="NamaMitra">
                        </div>

                        <div class="form-group">
                            <label for="AlamatMitra">Alamat Mitra:</label>
                            <input type="text" class="form-control" id="AlamatMitra" name="AlamatMitra">
                        </div>

                        <div class="form-group mb-2">
                            <label for="file">File:</label>
                            <input type="file" class="form-control" id="file" name="file">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h1 class="mt-4">Upload Jurnal PKM</h1>
        <div class="nav-scroller py-1 mb-3 border-bottom">
            <nav class="nav nav-underline justify-content-start">
            </nav>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="container">
                    <form action="{{ route('store.jurnalpkm') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="Judul Jurnal">Judul Jurnal:</label>
                            <input type="text" id="Judul Jurnal" class="form-control" name="judul">
                        </div>

                        <div class="form-group mb-2">
                            <label for="Penerbit">Penerbit:</label>
                            <input type="text" id="Penerbit" class="form-control" name="penerbit">
                        </div>

                        <div class="form-group mb-2">
                            <label for="Tahun">Tahun</label>
                            <select id="Tahun" name="tahun" class="form-control w-25">
                                <option value="Pilih">Pilih...</option>
                                <?php
                        $currentYear = date('Y');
                        for ($i = $currentYear - 5; $i <= $currentYear; $i++) {
                            $academicYear = $i . '/' . ($i + 1);
                            echo "<option value=\"$academicYear\">$academicYear</option>";
                        }
                        ?>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="Volume">Volume</label>
                            <input type="number" id="Volume" min="1" max="9999" value="1" class="form-control w-25"
                                name="volume">
                        </div>
                        <div class="form-group mb-2">
                            <label for="Nomor">Nomor</label>
                            <input type="number" id="Nomor" min="1" max="9999" value="1" class="form-control w-25"
                                name="nomor">
                        </div>
                        <div class="form-group mb-2">
                            <label for=" Jumlah Halaman">Halaman</label>
                            <input type="text" id="Jumlah Halaman" class="form-control" name="halaman">

                        </div>
                        <div class="form-group mb-2">
                            <label for=" Link URL">Link URL:</label>
                            <input id="Link URL" class="form-control" name="url">
                        </div>
                        <div class="form-group mb-2">
                            <label for="file">file</label>
                            <input type="file" id="file" name="file">
                        </div>
                        <div class="w3-bar">
                            <input type="submit" button class="btn btn-primary"></button>
                            <input type="reset" button class="btn btn-secondary"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h1 class="mt-4">Upload Media Massa</h1>
        <div class="nav-scroller py-1 mb-3 border-bottom">
            <nav class="nav nav-underline justify-content-start">
            </nav>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="container">
                    <form action="{{ route('store.mediapkm') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="Judul Jurnal">Judul :</label>
                            <input type="text" id="Judul Jurnal" class="form-control" name="judul">
                        </div>

                        <div class="form-group mb-2">
                            <label for="Nama Medai Massa">Nama Media Massa :</label>
                            <input type="text" id="Nama Media Massa" class="form-control" name="nama_media">
                        </div>

                        <label for="Bulan Terbit">Bulan Terbit</label>
                        <select id="Bulan Terbit" class="form-control w-25 mb-2" name="bulan_terbit">
                            <option value="">Pilih...</option>
                            <option value="Januari"> Januari</option>
                            <option value="Februari">Februari</option>
                            <option value="Maret">Maret</option>
                            <option value="April">April</option>
                            <option value="Mei">Mei</option>
                            <option value="Juni">Juni</option>
                            <option value="Juli">Juli</option>
                            <option value="Agustus">Agustus</option>
                            <option value="September">September</option>
                            <option value="Oktober">Oktober</option>
                            <option value="November">November</option>
                            <option value="Desember">Desember</option>
                        </select>

                        <label for="TahunTerbit">Tahun Terbit</label>
                        <select class="form-control w-25" id="TahunTerbit" name="tahun_terbit">
                            <option value="Pilih">Pilih...</option>
                            <?php
                        $currentYear = date('Y');
                        for ($i = $currentYear - 5; $i <= $currentYear; $i++) {
                            $academicYear = $i . '/' . ($i + 1);
                            echo "<option value=\"$academicYear\">$academicYear</option>";
                        }
                        ?>
                        </select>

                        <div class="form-group mb-2">
                            <label for="Link URL">Link URL:</label>
                            <input id="Link URL" class="form-control" name="url">
                        </div>

                        <div class="w3-bar">
                            <input type="submit" button class="btn btn-primary"></button>
                            <input type="reset" button class="btn btn-secondary"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h1 class="mt-4">HKI PKM</h1>
        <div class="nav-scroller py-1 mb-3 border-bottom">
            <nav class="nav nav-underline justify-content-start">
            </nav>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="container">
                    <form action="{{ route('store.hkipkm') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="Judul Jurnal">Judul Yang Di HKI:</label>
                            <input type="text" id="Judul Jurnal" class="form-control" name="judul">
                        </div>

                        <div class="form-group mb-2">
                            <label for="Penerbit">Nama Pemegang:</label>
                            <input type="text" id="Nama-Pemegang" class="form-control" name="nama_pemegang">
                        </div>

                        <div class="form-group mb-3">
                            <label for="Nomor">Nomor Sertifikat:</label>
                            <input type="text" id="Nomor-Sertifikat" class="form-control" name="nomor_sertifikat">
                        </div>
                        <div class="form-group mb-3">
                            <label for=" file">Bukti HKI:</label>
                            <input type="file" id="file" name="file">
                        </div>

                        <div class="w3-bar">
                            <input type="submit" button class="btn btn-primary"></button>
                            <input type="reset" button class="btn btn-secondary"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection