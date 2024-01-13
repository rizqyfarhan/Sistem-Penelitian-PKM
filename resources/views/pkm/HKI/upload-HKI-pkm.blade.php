@extends('template')

@section('title')
<title>HKI Penelitian</title>
@endsection

@section('content')
<h1 class="mt-4">HKI PKM</h1>
<div class="nav-scroller py-1 mb-3 border-bottom">
    <nav class="nav nav-underline justify-content-start">
        <a class="nav-item nav-link link-body-emphasis active" href="/upload-HKI-pkm">Upload</a>
        <a class="nav-item nav-link link-body-emphasis" href="/lihat-HKI-pkm">Upload Saya</a>
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


@endsection