@extends('admin.template-adm')

@section('adm-content')
<main>
    <div class="container-fluid px-4">
        <div class="card mb-4 mt-2">
            <div class="card-body">
                <h1 class="mt-4">Upload Pengumuman</h1>
                <div class="nav-scroller py-1 mb-3 border-bottom">
                    <nav class="nav nav-underline justify-content-start">
                    </nav>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="container">
                            <form action="{{ route('admin.uploadPengumuman') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-2">
                                    <label for="JumlahDana">Judul Pengumuman:</label>
                                    <input type="text" class="form-control" id="JudulPengumuman"
                                        name="judul_pengumuman">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="IsiPengumuman" class="form-label">Isi Pengumuman:</label>
                                    <textarea class="form-control" id="IsiPengumuman" name="isi_pengumuman"
                                        rows="4"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Upload</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4 mt-2">
            <div class="card-body">
                <h1 class="mt-4">Upload File</h1>
                <div class="nav-scroller py-1 mb-3 border-bottom">
                    <nav class="nav nav-underline justify-content-start">
                    </nav>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="container">
                            <form action="{{ route('admin.uploadFile') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-2">
                                    <label for="file">File:</label>
                                    <input type="file" class="form-control" id="file" name="file">
                                </div>
                                <button type="submit" class="btn btn-primary">Upload</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection