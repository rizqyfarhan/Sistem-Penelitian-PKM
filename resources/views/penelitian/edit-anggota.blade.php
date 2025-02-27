<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Edit Anggota Penelitian</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('css/template.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed d-flex flex-column h-100">
    <h1 class="text-center mb-4">Edit Anggota Penelitian</h1>

    <div class="row justify-content-center mt-5">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('update.anggota', $anggota->nrk) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-2">
                                <label for="JudulPenelitian">Judul Penelitian</label>
                                <select class="form-control" id="JudulPenelitian" name="judul" required>
                                    <option value="">Pilih...</option>
                                    @foreach($judulPenelitians as $id => $judulPenelitian)
                                    <option value="{{ $id }}" {{ $anggota->proposal_id == $id ? 'selected' : '' }}>
                                        {{ $judulPenelitian }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Nama">Nama</label>
                                <input type="text" class="form-control" id="Nama" name="nama" value="{{ old('nama', $anggota->nama) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="nidn">NIDN</label>
                                <input type="text" class="form-control" id="nidn" name="nidn" value="{{ old('nidn', $anggota->nidn) }}" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="nrk">NRK</label>
                                <input type="text" class="form-control" id="nrk" name="nrk" value="{{ old('nrk', $anggota->nrk) }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/template.js') }}"></script>
</body>

</html>
