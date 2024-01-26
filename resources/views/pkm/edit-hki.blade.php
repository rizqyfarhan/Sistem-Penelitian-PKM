<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>HKI PKM</title>
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('css/template.css') }}" rel="stylesheet" />
    <script src="{{ asset('https://use.fontawesome.com/releases/v6.3.0/js/all.js') }}" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed d-flex flex-column h-100">
    <h1 class="text-center mb-4">Edit HKI PKM</h1>

    <div class="row justify-content-center mt-5">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('update.hkipkm', $hki->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <div class=" form-group mb-2">
                                    <label for="judul">Judul:</label>
                                    <input type="text" class="form-control" id="judul" name="judul"
                                        value="{{ old('judul', $hki->judul) }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class=" form-group mb-2">
                                    <label for="nama_pemegang">Nama Pemegang:</label>
                                    <input type="text" class="form-control" id="nama_pemegang" name="nama_pemegang"
                                        value="{{ old('nama_pemegang', $hki->nama_pemegang) }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class=" form-group mb-2">
                                    <label for="nomor_sertifikat">Nomor Sertifikat:</label>
                                    <input type="text" class="form-control" id="nomor_sertifikat"
                                        name="nomor_sertifikat"
                                        value="{{ old('nomor_sertifikat', $hki->nomor_sertifikat) }}">
                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <label for="file">HKI PKM:</label>
                                <input type="file" class="form-control" id="file" name="file">
                                @if($hki->file)
                                <p class="mt-2">Current File: {{ $hki->file }}</p>
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