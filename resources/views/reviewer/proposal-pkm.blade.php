@extends('template')

@section('title')
<title>Proposal PKM</title>
@endsection

@section('sidenav')
<div class="sb-sidenav-menu">
    <div class="nav">
        <div class="sb-sidenav-menu-heading">Menu</div>
        <a class="nav-link collapsed" href="{{ route('dashboard') }}" aria-expanded="false">
            <div class="sb-nav-link-icon"><i class="fa-solid fa-table-cells"></i></div>
            Dashboard
        </a>
        <a class="nav-link collapsed" href="{{ route('review.penelitian') }}" aria-expanded="false">
            <div class="sb-nav-link-icon"><i class="fa-solid fa-flask"></i></div>
            Penelitian
        </a>
        <a class="nav-link collapsed" href="{{ route('review.pkm') }}" aria-expanded="false">
            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
            PKM
        </a>
        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="card mb-4 mt-2">
    <div class="card-body">
        <h1 class="mt-4">Proposal PKM</h1>
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
                            <td>{{ $proposal->judul }}</td>
                            <td>{{ $proposal->nama_pelaksana }}</td>
                            <td>{{ $proposal->semester }}</td>
                            <td>{{ $proposal->tahun_akademik }}</td>
                            <td>
                                <form action="{{ route('proposalpenelitian.updateStatus', $proposal->id) }}"
                                    method="POST" class="d-flex align-items-center">
                                    @csrf
                                    <select class="form-select w-50" name="status" id="statusSelect">
                                        <option value="review" @if($proposal->status == 'review') selected @endif>Review
                                        </option>
                                        <option value="accept" @if($proposal->status == 'accept') selected @endif>Accept
                                        </option>
                                        <option value="reject" @if($proposal->status == 'reject') selected @endif>Reject
                                        </option>
                                    </select>
                                    <button type="submit" class="btn btn-primary btn-sm ml-2">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('download.reviewPKM', $proposal->file) }}" method="GET"
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
    </div>
</div>
@endsection