@extends('template')

@section('title')
<title>Upload Laporan Kemajuan PKM</title>
@endsection

@section('content')
<h1 class="mt-4">Laporan Kemajuan PKM</h1>
<div class="nav-scroller py-1 mb-3 border-bottom">
    <nav class="nav nav-underline justify-content-start">
        <a class="nav-item nav-link link-body-emphasis active" href="/upload-lap-kemajuan-pkm">Upload</a>
        <a class="nav-item nav-link link-body-emphasis" href="/lihat-lap-kemajuan-pkm">Upload Saya</a>
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
                @foreach($lap_kemajuan_pkm as $item)
                <tr>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->nama_pelaksana }}</td>
                    <td>{{ $item->program_studi }}</td>
                    <td>{{ $item->semester }}</td>
                    <td>{{ $item->tahun_akademik }}</td>
                    <td>{{ $item->nama_mitra }}</td>
                    <td>
                        <form action="{{ route('lapkempkm.delete', $item->id) }}" method="POST">
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