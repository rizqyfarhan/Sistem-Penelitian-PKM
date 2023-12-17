@extends('template')

@section('title')
<title>Proposal Penelitian</title>
@endsection

@section('content')
<h1 class="mt-4">Proposal Penelitian</h1>
<div class="nav-scroller py-1 mb-3 border-bottom">
    <nav class="nav nav-underline justify-content-start">
        <a class="nav-item nav-link link-body-emphasis active" href="/upload-proposal-penelitian">Upload</a>
        <a class="nav-item nav-link link-body-emphasis" href="/lihat-proposal-penelitian">Upload Saya</a>
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
                @foreach($proposal_penelitian as $item)
                <tr>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->ketua_peneliti }}</td>
                    <td>{{ $item->semester }}</td>
                    <td>{{ $item->tahun_akademik }}</td>
                    <td>
                        <!-- <form action="{{ route('proposalpenelitian.delete', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> 
                            </button>
                        </form>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa-solid fa-file-arrow-down"></i> 
                        </button> -->
                        <form action="{{ route('proposalpenelitian.delete', $item->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> 
                        </button>
                    </form>

<form action="{{ route('proposalpenelitian.delete', $item->id) }}" method="GET" style="display: inline;">
    <button type="submit" class="btn btn-primary btn-sm">
        <i class="fa-solid fa-file-arrow-down"></i> 
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