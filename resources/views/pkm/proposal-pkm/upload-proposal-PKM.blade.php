@extends('template')

@section('title')
<title>Upload Proposal PKM</title>
@endsection

@section('content')
<h1 class="mt-4">Proposal PKM</h1>
<div class="nav-scroller py-1 mb-3 border-bottom">
    <nav class="nav nav-underline justify-content-start">
        <a class="nav-item nav-link link-body-emphasis active" href="/upload-proposal-PKM">Upload</a>
        <a class="nav-item nav-link link-body-emphasis" href="/lihat-proposal-PKM">Upload Saya</a>
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
@endsection