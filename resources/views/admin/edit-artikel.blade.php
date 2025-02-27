<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Artikel Jurnal</title>
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('css/template.css') }}" rel="stylesheet" />
    <script src="{{ asset('https://use.fontawesome.com/releases/v6.3.0/js/all.js') }}" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed d-flex flex-column h-100">
    <h1 class="text-center mb-4">Edit Artikel Jurnal</h1>

    <div class="row justify-content-center mt-5">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('update.artikeladmin', $artikel_jurnal->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <div class=" form-group mb-2">
                                    <label for="judul">Judul Jurnal:</label>
                                    <input type="text" class="form-control" id="judul" name="judul"
                                        value="{{ old('judul', $artikel_jurnal->judul) }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class=" form-group mb-2">
                                    <label for="penerbit">Penerbit:</label>
                                    <input type="text" class="form-control" id="penerbit" name="penerbit"
                                        value="{{ old('penerbit', $artikel_jurnal->penerbit) }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tahun">Tahun:</label>
                                <select class="form-control" id="tahun" name="tahun">
                                <option value="" {{ old('tahun', $artikel_jurnal->tahun) == '' ? 'selected' : '' }}>Pilih...
                                </option>
                                <?php
                                    $currentYear = date('Y');
                                    for ($i = $currentYear - 5; $i <= $currentYear; $i++) {
                                        $academicYear = $i . '/' . ($i + 1);
                                        $selected = $artikel_jurnal->tahun == $academicYear ? 'selected' : '';
                                        echo "<option value=\"$academicYear\" $selected>$academicYear</option>";
                                    }
                                ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <div class=" form-group mb-2">
                                    <label for="volume">Volume:</label>
                                    <input type="number" class="form-control w-25" id="volume" min="0" max="9999"
                                        name="volume"
                                        value="{{ old('volume', $artikel_jurnal->volume) }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class=" form-group mb-2">
                                    <label for="nomor">Nomor:</label>
                                    <input type="number" class="form-control w-25" id="nomor" min="0" max="9999"
                                        name="nomor"
                                        value="{{ old('nomor', $artikel_jurnal->nomor) }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class=" form-group mb-2">
                                    <label for="halaman">Halaman:</label>
                                    <input type="text" class="form-control" id="halaman" name="halaman"
                                        value="{{ old('halaman', $artikel_jurnal->halaman) }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class=" form-group mb-2">
                                    <label for="url">URL:</label>
                                    <input type="text" class="form-control" id="url" name="url"
                                        value="{{ old('url', $artikel_jurnal->url) }}">
                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <label for="file">Artikel Jurnal:</label>
                                <input type="file" class="form-control" id="file" name="file">
                                @if($artikel_jurnal->file)
                                <p class="mt-2">Current File: {{ $artikel_jurnal->file }}</p>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cd.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/template.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>