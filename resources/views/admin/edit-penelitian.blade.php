<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Proposal Penelitian</title>
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('css/template.css') }}" rel="stylesheet" />
    <script src="{{ asset('https://use.fontawesome.com/releases/v6.3.0/js/all.js') }}" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed d-flex flex-column h-100">
    <h1 class="text-center">Edit Proposal Penelitian</h1>

    <div class="card mb-4">
        <div class="card-body px-4">
            <div class="container">
                <form action="{{ route('update.proposalpenelitian', $proposal->nrk) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="JudulPenelitian">Judul Penelitian:</label>
                        <input type="text" class="form-control" id="JudulPenelitian" name="judul"
                            value="{{ old('judul', $proposal->judul) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="KetuaPeneliti">Ketua Peneliti:</label>
                        <input type="text" class="form-control" id="KetuaPeneliti" name="ketua_peneliti"
                            value="{{ old('ketua_peneliti', $proposal->ketua_peneliti) }}">
                    </div>

                    <div class="form-group">
                        <label for="nidn_1">NIDN:</label>
                        <input type="text" class="form-control" id="nidn_1" name="nidn"
                            value="{{ old('nidn', $proposal->nidn) }}">
                    </div>

                    <div class=" form-group mb-2">
                        <label for="nrk_1">NRK:</label>
                        <input type="text" class="form-control" id="nrk_1" name="nrk"
                            value="{{ old('nrk', $proposal->nrk) }}">
                    </div>

                    <div class="form-group">
                        <label for="ProgramStudi">Program Studi:</label>
                        <select class="form-control" id="ProgramStudi" name="program_studi">
                            @foreach(['Pilih', 'Informatika', 'Industri', 'SI', 'Elektro', 'Mesin', 'Sipil'] as $option)
                            <option value="{{ $option }}" {{ $proposal->program_studi == $option ? 'selected' : '' }}>
                                {{ $option === 'Pilih' ? 'Pilih...' : 'Teknik ' . $option }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Semester">Semester:</label>
                        <select class="form-control" id="Semester" name="semester">
                            <option value="Pilih" {{ $proposal->semester == 'Pilih' ? 'selected' : '' }}>Pilih...
                            </option>
                            <option value="Ganjil" {{ $proposal->semester == 'Ganjil' ? 'selected' : '' }}>Ganjil
                            </option>
                            <option value="Genap" {{ $proposal->semester == 'Genap' ? 'selected' : '' }}>Genap</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="TahunAkademik">Tahun Akademik:</label>
                        <select class="form-control" id="TahunAkademik" name="tahun_akademik">
                            <option value="Pilih" {{ $proposal->tahun_akademik == 'Pilih' ? 'selected' : '' }}>Pilih...
                            </option>
                            <?php
                                $currentYear = date('Y');
                                for ($i = $currentYear; $i <= $currentYear + 5; $i++) {
                                    $academicYear = $i . '/' . ($i + 1);
                                    $selected = $proposal->tahun_akademik == $academicYear ? 'selected' : '';
                                    echo "<option value=\"$academicYear\" $selected>$academicYear</option>";
                                }
                            ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="Semester">Sumber Dana:</label>
                        <select class="form-control" id="SumberDana" name="sumber_dana"
                            value="{{ old('sumber_dana', $proposal->sumber_dana) }}">
                            <option value="">Pilih...</option>
                            <option value="pribadi" {{ old('sumber_dana', $proposal->sumber_dana) == 'pribadi' ? 'selected' : ''  }}>Pribadi</option>
                            <option value="internal" {{ old('sumber_dana', $proposal->sumber_dana) == 'internal' ? 'selected' : '' }}>Internal</option>
                            <option value="external" {{ old('sumber_dana', $proposal->sumber_dana) == 'external' ? 'selected' : ''  }}>External</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="NamaPendana">Nama Lembaga Pendana: </label>
                        <input type="text" class="form-control" id="nama_pendana" name="nama_pendana"
                            value="{{ old('nama_pendana', $proposal->nama_pendana) }}">
                    </div>

                    <div class="form-group">
                        <label for="JumlahDana">Jumlah Dana:</label>
                        <input type="text" class="form-control" id="JumlahDana" name="jumlah_dana"
                            value="{{ old('jumlah_dana', $proposal->jumlah_dana) }}">
                    </div>

                    <div class="form-group mb-2">
                        <label for="file">Proposal Penelitian:</label>
                        <input type="file" class="form-control" id="file" name="file">
                        @if($proposal->file)
                        <p class="mt-2">Current File: {{ $proposal->file }}</p>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>

                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
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