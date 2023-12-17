@extends('template')

@section('title')
<title>Upload Media Massa</title>
@endsection

@section('content')
<h1 class="mt-4">Media Massa</h1>
<div class="nav-scroller py-1 mb-3 border-bottom">
    <nav class="nav nav-underline justify-content-start">
        <a class="nav-item nav-link link-body-emphasis active" href="/upload-media-massa">Upload</a>
        <a class="nav-item nav-link link-body-emphasis" href="/lihat-media-massa">Upload Saya</a>
    </nav>
</div>

<div class="card mb-4">
    <div class="card-body">
        <table id="datatablesSimple">
        <thead>
                <tr>
                    <th>Name</th>
                    <th>Name</th>
                    <th>Name</th>
                    <th>Name</th>
                    <th>Name</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Name</th>
                    <th>Name</th>
                    <th>Name</th>
                    <th>Name</th>
                    <th>Name</th>
                </tr>
            </tfoot>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@endsection