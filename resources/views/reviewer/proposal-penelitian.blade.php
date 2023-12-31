@extends('template')

@section('title')
<title>Proposal Penelitian</title>
@endsection

@section('content')
<h1 class="mt-4">Proposal Penelitian</h1>
<div class="nav-scroller py-1 mb-3 border-bottom">
</div>

<div class="card mb-4">
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    @foreach($table_headers as $header)
                    @if ($header == 'Aksi')
                    <th data-sortable="false">{{ $header }}</th>
                    @elseif ($header == 'Status')
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
                @foreach($proposals as $proposal)
                <tr>
                    <!-- Display relevant data columns -->
                    <td>{{ $proposal->judul }}</td>
                    <td>{{ $proposal->ketua_peneliti }}</td>
                    <td>{{ $proposal->semester }}</td>
                    <td>{{ $proposal->tahun_akademik }}</td>
                    <td>

                    </td>
                    <td>
                        <form action="{{ route('proposalpenelitian.delete', $proposal->id) }}" method="POST"
                            style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>

                        <form action="{{ route('proposalpenelitian.download', $proposal->id) }}" method="GET"
                            style="display: inline;">
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