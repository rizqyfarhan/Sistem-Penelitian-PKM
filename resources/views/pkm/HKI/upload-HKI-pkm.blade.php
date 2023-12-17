@extends('template')

@section('title')
<title>Upload HKI PKM</title>
@endsection

@section('content')
<h1 class="mt-4">HKI PKM</h1>
<div class="nav-scroller py-1 mb-3 border-bottom">
    <nav class="nav nav-underline justify-content-start">
        <a class="nav-item nav-link link-body-emphasis active" href="/upload-HKI-pkm">Upload</a>
        <a class="nav-item nav-link link-body-emphasis" href="/lihat-HKI-pkm">Lihat</a>
    </nav>
</div>

<div class="card mb-4">
    <div class="card-body">
        <div class="container">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">File Upload</h5>
                            </div>
                            <div class="card-body">
                                <form action="upload.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="file">Choose File</label>
                                        <input type="file" class="form-control-file" id="file" name="file"
                                            accept=".pdf, .doc, .docx">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection