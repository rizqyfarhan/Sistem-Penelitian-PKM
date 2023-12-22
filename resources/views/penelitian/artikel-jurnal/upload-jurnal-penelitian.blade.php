@extends('template')

@section('title')
<title>Jurnal PKM</title>
@endsection

@section('content')
<h1 class="mt-4">Artikel Jurnal</h1>
<div class="nav-scroller py-1 mb-3 border-bottom">
    <nav class="nav nav-underline justify-content-start">
        <a class="nav-item nav-link link-body-emphasis active" href="/upload-jurnal-penelitian">Upload</a>
        <a class="nav-item nav-link link-body-emphasis" href="/lihat-jurnal-penelitian">Upload Saya</a>
    </nav>
</div>


<div class="card mb-4">
    <div class="card-body">
        <div class="container">
            <form action="{{ route('artikeljurnal.store') }}" method="POST" enctype="multipart/form-datav">
                @csrf
                <div class="form-group mb-3">
                    <label for="Judul Jurnal">Judul Jurnal:</label>
                    <input type="text" id="Judul Jurnal" class="form-control" name="judul">
                </div>
                <div class="form-group mb-3">
                    <label for="Penerbit">Penerbit:</label>
                    <input type="text" id="Penerbit" class="form-control" name="penerbit">
                </div>
                <div class="form-group mb-3">
                    <label for="Tahun">Tahun</label>
                    <select id="Tahun" name="tahun">
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="Volume">Volume</label>
                    <input type="number" id="Volume" min="1" max="99" value="1" class="form-control" name="volume">
                </div>
                <div class="form-group mb-3">
                    <label for="Nomor">Nomor</label>
                    <input type="number" id="Nomor" min="1" max="99" value="1" name="nomor">
                </div>
                <div class="form-group mb-3">
                    <label for="Jumlah Halaman">Jumlah Halaman</label>
                    <input type="number" id="Jumlah Halaman" min="1" max="99" value="1" name="jumlah_halaman">
                </div>
                <div class="form-group mb-3">
                    <label for="Link URL">Link URL:</label>
                    <input id="Link URL" class="form-control" name="url"></input>
                </div>
                <div class="form-group mb-3">
                    <label for=" file">Artikel Jurnal:</label>
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