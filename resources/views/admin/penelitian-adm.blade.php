@extends('admin.template-adm')

@section('adm-content')
<div class="nav-scroller py-1 mb-3 border-bottom">
    <nav class="nav nav-underline justify-content-start">
        <a class="nav-item nav-link link-body-emphasis active" href="{{ route('upload.proposaladmin') }}">Upload</a>
        <a class="nav-item nav-link link-body-emphasis" href="{{ route('index.proposaladmin') }}">Upload Saya</a>
    </nav>
</div>

<div class="card mb-4 mt-2">
    <div class="card-body">
        <h1 class="mt-4">Proposal Penelitian</h1>
        <div class="nav-scroller py-1 mb-2 border-bottom">
            <nav class="nav nav-underline justify-content-start">
            </nav>
        </div>
        <nav class="nav justify-content-start">
            <a href="{{ route('anggota.showadmin') }}" class="text-decoration-none nav-item nav-link link-body-emphasis active">Tambah Anggota</a>
            <a href="{{ route('anggota.indexadmin') }}" class="text-decoration-none nav-item nav-link link-body-emphasis">Anggota Saya</a>
        </nav>

        <div class="card mb-4">
            <div class="card-body">
                <div class="container">
                    <form action="{{ route('store.proposaladmin') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="JudulPenelitian">Judul Penelitian:</label>
                            <input type="text" class="form-control" id="JudulPenelitian" name="judul" required>
                        </div>

                        <div class="form-group">
                            <label for="KetuaPeneliti">Ketua Peneliti:</label>
                            <input type="text" class="form-control" id="KetuaPeneliti" name="ketua_peneliti">
                        </div>

                        <div class="form-group">
                            <label for="nidn_1">NIDN:</label>
                            <input type="text" class="form-control" id="nidn_1" name="nidn">
                        </div>

                        <div class="form-group mb-2">
                            <label for="nrk_1">NRK:</label>
                            <input type="text" class="form-control" id="nrk_1" name="nrk">
                        </div>

                        <div class="form-group">
                            <label for="ProgramStudi">Program Studi:</label>
                            <select class="form-control" id="ProgramStudi" name="program_studi">
                                <option value="">Pilih...</option>
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
                            <select class="form-control" id="Semester" name="semester">
                                <option value="">Pilih...</option>
                                <option value="Ganjil">Ganjil</option>
                                <option value="Genap">Genap</option>
                            </select>
                        </div>

                        <div class="form-group">
                        <label for="TahunAkademik">Tahun Akademik:</label>
                            <select class="form-control" id="TahunAkademik" name="tahun_akademik">
                                <option value="">Pilih...</option>
                                <?php
                                    $currentYear = date('Y');
                                    for ($i = $currentYear; $i <= $currentYear + 5; $i++) {
                                        $academicYear = $i . '/' . ($i + 1);
                                        echo "<option value=\"$academicYear\">$academicYear</option>";
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Semester">Sumber Dana:</label>
                            <select class="form-control" id="SumberDana" name="sumber_dana"
                                onchange="toggleLembagaPendana()">
                                <option value="">Pilih...</option>
                                <option value="pribadi">Pribadi</option>
                                <option value="internal">Internal</option>
                                <option value="external">External</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="LembagaPendana" id="LabelLembagaPendana">Nama Lembaga Pendana: </label>
                            <input type="text" class="form-control" id="LembagaPendana" name="lembaga_pendana">
                        </div>

                        <div class="form-group">
                            <label for="JumlahDana">Jumlah Dana:</label>
                            <input type="text" class="form-control" id="JumlahDana" name="jumlah_dana">
                        </div>

                        <div class="form-group mb-2">
                            <label for="file">Proposal Penelitian:</label>
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
        <h1 class="mt-4">Laporan Kemajuan Penelitian</h1>
        <div class="nav-scroller py-1 mb-3 border-bottom">
            <nav class="nav nav-underline justify-content-start">
            </nav>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="container">
                    <form action="{{ route('store.kemajuanpenelitian') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="JudulPenelitian">Judul Penelitian:</label>
                            <select class="form-control" id="JudulPenelitian" name="judul" required>
                                <option value="">Pilih...</option>
                                @foreach($judulPenelitians as $id => $judulPenelitian)
                                <option value="{{  $judulPenelitian }}">{{ $judulPenelitian }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label for="file">Laporan Kemajuan:</label>
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
        <h1 class="mt-4">Laporan Akhir Penelitian</h1>
        <div class="nav-scroller py-1 mb-3 border-bottom">
            <nav class="nav nav-underline justify-content-start">
            </nav>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="container">
                    <form action="{{ route('store.akhirpenelitian') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="JudulPenelitian">Judul Penelitian:</label>
                            <select class="form-control" id="JudulPenelitian" name="judul" required>
                                <option value="">Pilih...</option>
                                @foreach($judulPenelitians as $id => $judulPenelitian)
                                <option value="{{  $judulPenelitian }}">{{ $judulPenelitian }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label for="file">Laporan Kemajuan:</label>
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
        <h1 class="mt-4">Artikel Jurnal</h1>
        <div class="nav-scroller py-1 mb-3 border-bottom">
            <nav class="nav nav-underline justify-content-start">
            </nav>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="container">
                    <form action="{{ route('store.artikeljurnal') }}" method="POST" enctype="multipart/form-data">
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
                            <label for="TahunAkademik">Tahun Akademik:</label>
                            <select class="form-control w-25" id="TahunAkademik" name="tahun">
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
                            <input type="number" id="Volume" min="0" max="9999" value="1" class="form-control w-25"
                                name="volume">
                        </div>
                        <div class="form-group mb-2">
                            <label for="Nomor">Nomor</label>
                            <input type="number" id="Nomor" min="0" max="9999" value="1" class="form-control w-25"
                                name="nomor">
                        </div>
                        <div class="form-group mb-2">
                            <label for="Jumlah Halaman">Halaman</label>
                            <input type="text" id="Jumlah Halaman" class="form-control" name="halaman">
                        </div>
                        <div class="form-group mb-2">
                            <label for="Link URL">Link URL:</label>
                            <input id="Link URL" class="form-control" name="url"></input>
                        </div>
                        <div class="form-group mb-2">
                            <label for=" file">Artikel Jurnal:</label>
                            <input type="file" class="form-control" id="file" name="file">
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
        <h1 class="mt-4">HKI Penelitian</h1>
        <div class="nav-scroller py-1 mb-3 border-bottom">
            <nav class="nav nav-underline justify-content-start">
            </nav>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="container">
                    <form action="{{ route('store.hkipenelitian') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="JudulJurnal">Judul Yang Di HKI:</label>
                            <input type="text" id="JudulJurnal" class="form-control" name="judul">
                        </div>

                        <div class="form-group mb-2">
                            <label for="NamaPemegang">Nama Pemegang:</label>
                            <input type="text" id="NamaPemegang" class="form-control" name="nama_pemegang">
                        </div>

                        <div class="form-group mb-2">
                            <label for="NomorSertifikat">Nomor Sertifikat:</label>
                            <input type="text" id="NomorSertifikat" class="form-control" name="nomor_sertifikat">
                        </div>

                        <div class="form-group mb-2">
                            <label for=" File">Bukti HKI:</label>
                            <input type="file" class="form-control" id="File" name="file">
                        </div>
                        <div class="w3-bar">
                            <button type="submit" button class="btn btn-primary">Submit</button>
                            <button type="reset" button class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection