@extends('template')

@section('title')
<title>PKM</title>
@endsection

@section('content')
<div class="nav-scroller py-1 mb-3 border-bottom">
    <nav class="nav nav-underline justify-content-start">
        <a class="nav-item nav-link link-body-emphasis active" href="/upload-proposal-penelitian">Upload</a>
        <a class="nav-item nav-link link-body-emphasis" href="/lihat-proposal-penelitian">Upload Saya</a>
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
                    <form action="{{ route('lapkempkm.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="JudulPKM">Judul PKM:</label>
                            <input type="text" class="form-control" id="JudulPKM" name="Judul" required>
                        </div>

                        <div class="form-group">
                            <label for="NamaPelaksana">Nama Pelaksana:</label>
                            <input type="text" class="form-control" id="NamaPelaksana" name="nama_pelaksana">
                        </div>

                        <div class="form-group">
                            <label for="NIK">NIK:</label>
                            <input type="text" class="form-control" id="NIK" name="nidn">
                        </div>

                        <div class="form-group">
                            <label for="NIM">NIM:</label>
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
                            <input type="text" class="form-control" id="TahunAkademik" name="tahun_akademik">
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
                    <form action="{{ route('lapkempkm.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="JudulPKM">Judul PKM:</label>
                            <input type="text" class="form-control" id="JudulPKM" name="Judul" required>
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
                                <option value="2015/2016">2015/2016</option>
                                <option value="2016/2017">2016/2017</option>
                                <option value="2017/2018">2017/2018</option>
                                <option value="2018/2019">2018/2019</option>
                                <option value="2019/2020">2019/2020</option>
                                <option value="2020/2021">2020/2021</option>
                                <option value="2021/2022">2021/2022</option>
                                <option value="2022/2023">2022/2023</option>
                                <option value="2023/2024">2023/2024</option>
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
                                <option value="2015/2016">2015/2016</option>
                                <option value="2016/2017">2016/2017</option>
                                <option value="2017/2018">2017/2018</option>
                                <option value="2018/2019">2018/2019</option>
                                <option value="2019/2020">2019/2020</option>
                                <option value="2020/2021">2020/2021</option>
                                <option value="2021/2022">2021/2022</option>
                                <option value="2022/2023">2022/2023</option>
                                <option value="2023/2024">2023/2024</option>
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
                    <form action="database.php" method="POST" enctype="multipart/form-datav">
                        <br>
                        <div class="form-group">
                            <label for="Judul Jurnal">Judul Jurnal:</label>
                            <input type="text" id="Judul Jurnal" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="Penerbit">Penerbit:</label>
                            <input type="text" id="Penerbit" class="form-control">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="Tahun">Tahun</label>
                            <select id="Tahun">
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                            </select>
                        </div>
                        <br>
                        <label for="Volume">Volume</label>
                        <input type="number" id="Volume" min="1" max="99" value="1" class="form-control">
                        <br>
                        <label for="Nomor">Nomor</label>
                        <input type="number" id="Nomor" min="1" max="99" value="1">
                        <br>
                        <br>
                        <label for="Jumlah Halaman">Jumlah Halaman</label>
                        <input type="number" id="Jumlah Halaman" min="1" max="99" value="1">
                        <br>
                        <br>
                        <label for="Link URL">Link URL:</label>
                        <input id="Link URL" class="form-control"></input>
                        <br>
                        <label for="file">file</label>
                        <input type="file" id="file">
                        <br>
                        <br>

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
                    <form action="database.php" method="POST" enctype="multipart/form-datav">

                        <br>
                        <div class="form-group">
                            <label for="Judul Jurnal">Judul :</label>
                            <input type="text" id="Judul Jurnal" class="form-control">
                        </div>

                        <br>
                        <div class="form-group">
                            <label for="Nama Medai Massa">Nama Media Massa :</label>
                            <input type="text" id="Nama Media Massa" class="form-control">
                        </div>

                        <br>
                        <label for="Bulan Terbit">Bulan Terbit</label>
                        <select id="Bulan Terbit">
                            <option value="Januari">Januari</option>
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

                        <br>
                        <br>
                        <label for="Tahun Terbit">Tahun Terbit</label>
                        <select id="Tahun Terbit">
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                        </select>

                        <br>
                        <br>
                        <div class="form-group">
                            <label for="Link URL">Link URL:</label>
                            <input id="Link URL" class="form-control"></input>
                        </div>

                        <br>


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
                    <form action="{{ route('artikeljurnal.store') }}" method="POST" enctype="multipart/form-datav">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="Judul Jurnal">Judul Yang Di HKI:</label>
                            <input type="text" id="Judul Jurnal" class="form-control" name="judul">
                        </div>

                        <div class="form-group mb-2">
                            <label for="Penerbit">Nama Pemegang:</label>
                            <input type="text" id="Nama-Pemegang" class="form-control" name="Nama-Pemegang">
                        </div>

                        <div class="form-group mb-3">
                            <label for="Nomor">Nomor Sertifikat:</label>
                            <input type="text" id="Nomor-Sertifikat" class="form-control" name="Nomor-Sertifikat">
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