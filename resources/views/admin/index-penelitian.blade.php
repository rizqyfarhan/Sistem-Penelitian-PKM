@extends('admin.template-adm')

@section('adm-content')
<div class="nav-scroller py-1 mb-3 border-bottom">
    <nav class="nav nav-underline justify-content-start">
        <a class="nav-item nav-link link-body-emphasis active" href="{{ route('upload.proposaladmin') }}">Upload</a>
        <a class="nav-item nav-link link-body-emphasis" href="{{ route('index.proposaladmin') }}">Upload
            Saya</a>
    </nav>
</div>

<div class="card mb-4 mt-2">
    <div class="card-body">
        <h1 class="mt-4">Proposal Penelitian</h1>
        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            @foreach($headers_proposal as $header)
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
                            @foreach($headers_proposal as $header)
                            @if ($header == 'Aksi')
                            <th data-sortable="false">{{ $header }}</th>
                            @elseif ($header == 'Status')
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
                                {{ $item->status }}
                            </td>
                            <td>
                                <a href="{{ route('download.proposalpenelitian', ['filename' => $item->file]) }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-file-arrow-down"></i>
                                </a>

                                <a href="{{ route('view.proposalpenelitian', ['filename' => $item->file]) }}"
                                    class="btn btn-info btn-sm" target="_blank">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <a href="{{ route('edit.proposalpenelitian', $item->id) }}"
                                    class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-edit"></i>
                                </a>

                                <form action="{{ route('delete.proposalpenelitian', $item->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE') <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
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

<div class="card mb-4 mt-2">
    <div class="card-body">
        <h1 class="mt-4">Laporan Kemajuan Penelitian</h1>

        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimpleKemajuan">
                    <thead>
                        <tr>
                            @foreach($headers_kemajuan_penelitian as $header)
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
                            @foreach($headers_kemajuan_penelitian as $header)
                            @if ($header == 'Aksi')
                            <th data-sortable="false">{{ $header }}</th>
                            @elseif ($header == 'Status')
                            <th data-sortable="false">{{ $header }}</th>
                            @else
                            <th>{{ $header }}</th>
                            @endif
                            @endforeach
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($laporan_kemajuan as $item)
                        <tr>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->proposalPenelitian->ketua_peneliti }}</td>
                            <td>{{ $item->proposalPenelitian->semester }}</td>
                            <td>{{ $item->proposalPenelitian->tahun_akademik }}</td>
                            <td>{{ $item->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('download.kemajuanpenelitian', ['filename' => $item->file]) }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-file-arrow-down"></i>
                                </a>

                                <a href="{{ route('view.kemajuanpenelitian', ['filename' => $item->file]) }}"
                                    class="btn btn-info btn-sm" target="_blank">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <a href="{{ route('edit.kemajuanpenelitian', $item->id) }}"
                                    class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-edit"></i>
                                </a>

                                <form action="{{ route('delete.kemajuanpenelitian', $item->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method(' DELETE') <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
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

<div class="card mb-4 mt-2">
    <div class="card-body">
        <h1 class="mt-4">Laporan Akhir Penelitian</h1>

        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimpleMedia">
                    <thead>
                        <tr>
                            @foreach($headers_akhir_penelitian as $header)
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
                            @foreach($headers_akhir_penelitian as $header)
                            @if ($header == 'Aksi')
                            <th data-sortable="false">{{ $header }}</th>
                            @elseif ($header == 'Status')
                            <th data-sortable="false">{{ $header }}</th>
                            @else
                            <th>{{ $header }}</th>
                            @endif
                            @endforeach
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($laporan_akhir as $item)
                        <tr>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->proposalPenelitian->ketua_peneliti }}</td>
                            <td>{{ $item->proposalPenelitian->semester }}</td>
                            <td>{{ $item->proposalPenelitian->tahun_akademik }}</td>
                            <td>
                                <a href="{{ route('download.akhirpenelitian', ['filename' => $item->file]) }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-file-arrow-down"></i>
                                </a>

                                <a href="{{ route('view.akhirpenelitian', ['filename' => $item->file]) }}"
                                    class="btn btn-info btn-sm" target="_blank">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <form action="{{ route('delete.akhirpenelitian', $item->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method(' DELETE') <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
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

<div class="card mb-4 mt-2">
    <div class="card-body">
        <h1 class="mt-4">Artikel Jurnal</h1>

        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimpleArtikel">
                    <thead>
                        <tr>
                            @foreach($headers_artikel as $header)
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
                            @foreach($headers_artikel as $header)
                            @if ($header == 'Aksi')
                            <th data-sortable="false">{{ $header }}</th>
                            @elseif ($header == 'Status')
                            <th data-sortable="false">{{ $header }}</th>
                            @else
                            <th>{{ $header }}</th>
                            @endif
                            @endforeach
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($artikel_jurnal as $item)
                        <tr>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->tahun }}</td>
                            <td>{{ $item->volume }}</td>
                            <td>{{ $item->nomor }}</td>
                            <td>
                                <a href="{{ route('download.artikeljurnal', ['filename' => $item->file]) }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-file-arrow-down"></i>
                                </a>

                                <a href="{{ route('view.artikeljurnal', ['filename' => $item->file]) }}"
                                    class="btn btn-info btn-sm" target="_blank">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <a href="{{ route('edit.artikeljurnal', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-edit"></i>
                                </a>

                                <form action="{{ route('delete.artikeljurnal', $item->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method(' DELETE') <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
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

<div class="card mb-4 mt-2">
    <div class="card-body">
        <h1 class="mt-4">HKI Penelitian</h1>

        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimpleHKI">
                    <thead>
                        <tr>
                            @foreach($headers_hki as $header)
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
                            @foreach($headers_hki as $header)
                            @if ($header == 'Aksi')
                            <th data-sortable="false">{{ $header }}</th>
                            @elseif ($header == 'Status')
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
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->nama_pemegang }}</td>
                            <td>{{ $item->nomor_sertifikat }}</td>
                            <td>
                                <a href="{{ route('download.hkipenelitian', ['filename' => $item->file]) }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-file-arrow-down"></i>
                                </a>

                                <a href="{{ route('view.hkipenelitian', ['filename' => $item->file]) }}"
                                    class="btn btn-info btn-sm" target="_blank">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <a href="{{ route('edit.hkipenelitian', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-edit"></i>
                                </a>

                                <form action="{{ route('delete.hkipenelitian', $item->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE') <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
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