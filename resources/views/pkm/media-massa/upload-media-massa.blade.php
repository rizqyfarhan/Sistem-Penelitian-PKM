@extends('template')

@section('title')
<title>Upload Media Massa</title>
@endsection

@section('content')
<h1 class="mt-4">Upload Media Massa</h1>
<div class="nav-scroller py-1 mb-3 border-bottom">
    <nav class="nav nav-underline justify-content-start">
        <a class="nav-item nav-link link-body-emphasis active" href="/upload-media-massa">Upload</a>
        <a class="nav-item nav-link link-body-emphasis" href="/lihat-media-massa">Upload Saya</a>
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
@endsection


<div class="w3-bar">
    <input type="submit" button class="w3-button w3-black"></button>
    <input type="reset" button class="w3-button w3-black"></button>