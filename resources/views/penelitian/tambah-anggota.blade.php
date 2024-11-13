<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Tambah Anggota</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Tambah Anggota
                    </div>
                    <div class="card-body">
                        <form action="{{ route('anggota.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="JudulPenelitian">Judul Penelitian</label>
                                <select class="form-control" id="JudulPenelitian" name="judul" required>
                                    <option value="">Pilih...</option>
                                    @foreach($judulPenelitians as $id => $judulPenelitian)
                                    <option value="{{  $judulPenelitian }}">{{ $judulPenelitian }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Nama">Nama</label>
                                <input type="text" class="form-control" id="Nama" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="nidn">NIDN</label>
                                <input type="text" class="form-control" id="nidn" name="nidn" required>
                            </div>
                            <div class="form-group">
                                <label for="nrk">NRK</label>
                                <input type="text" class="form-control" id="nrk" name="nrk" required>
                            </div>
                            <div>
                                <p><a href="{{ route('penelitian') }}">kembali</a></p>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>