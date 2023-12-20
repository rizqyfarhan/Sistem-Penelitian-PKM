@extends('template')

@section('title')
<title>HKI Penelitian</title>
@endsection

@section('content')
<h1 class="mt-4">HKI Penelitian</h1>
<div class="nav-scroller py-1 mb-3 border-bottom">
    <nav class="nav nav-underline justify-content-start">
        <a class="nav-item nav-link link-body-emphasis active" href="/upload-HKI-penelitian">Upload</a>
        <a class="nav-link link-body-emphasis" href="/lihat-HKI-penelitian">Upload Saya</a>
    </nav>
</div>

<div class="card mb-4">
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    @foreach($table_headers as $header)
                    @if ($header == 'Aksi')
                    <th data-sortable="false">{{ $header }}</th>
                    @else
                    <th>{{ $header }}</th>
                    @endif
                    @endforeach
                </tr>
            </thead>
            <tfoot>
                <tr>
                    @foreach($table_headers as $header)
                    @if ($header == 'Aksi')
                    <th data-sortable="false">{{ $header }}</th>
                    @else
                    <th>{{ $header }}</th>
                    @endif
                    @endforeach
                </tr>
            </tfoot>
            <tbody>
                @foreach($hki_penelitian as $item)
                <tr>
                    <td>{{ basename($item->judul) }}</td>
                    <td>{{ basename($item->nama_pemegang) }}</td>
                    <td>{{ basename($item->nomor_sertifikat) }}</td>
                    <td>
                        <form action="{{ route('hkipenelitian.delete', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> <!-- Font Awesome trash icon -->
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection