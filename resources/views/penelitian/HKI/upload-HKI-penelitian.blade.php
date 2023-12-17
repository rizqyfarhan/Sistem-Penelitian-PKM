@extends('template')

@section('title')
<title>HKI Penelitian</title>
@endsection

@section('content')
<h1 class="mt-4">HKI Penelitian</h1>
<div class="nav-scroller py-1 mb-3 border-bottom">
    <nav class="nav nav-underline justify-content-start">
        <a class="nav-item nav-link link-body-emphasis active" href="/upload-HKI-penelitian">Upload</a>
        <a class="nav-item nav-link link-body-emphasis" href="/lihat-HKI-penelitian">Upload Saya</a>
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
                                <form action="{{ route('hkipenelitian.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
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