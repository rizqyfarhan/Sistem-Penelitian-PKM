@extends('template')

@section('title')
<title>Upload Laporan Akhir PKM</title>
@endsection

@section('content')
<h1 class="mt-4">Laporan Akhir PKM</h1>
<div class="nav-scroller py-1 mb-3 border-bottom">
    <nav class="nav nav-underline justify-content-start">
        <a class="nav-item nav-link link-body-emphasis active" href="/upload-lap-akhir-pkm">Upload</a>
        <a class="nav-item nav-link link-body-emphasis" href="/lihat-lap-akhir-pkm">Upload Saya</a>
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
@endsection