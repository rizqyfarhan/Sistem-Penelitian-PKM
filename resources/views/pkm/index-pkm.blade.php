@extends('template')

@section('title')
<title>PKM</title>
@endsection

@section('sidenav')
<div class="sb-sidenav-menu">
    <div class="nav">
        <div class="sb-sidenav-menu-heading">Menu</div>
        <a class="nav-link collapsed" href="{{ route('dashboard') }}" aria-expanded="false">
            <div class="sb-nav-link-icon"><i class="fa-solid fa-table-cells"></i></div>
            Dashboard
        </a>
        <a class="nav-link collapsed" href="{{ route('penelitian') }}" aria-expanded="false">
            <div class="sb-nav-link-icon"><i class="fa-solid fa-flask"></i></div>
            Penelitian
        </a>
        <a class="nav-link collapsed" href="{{ route('pkm') }}" aria-expanded="false">
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
<div class="nav-scroller py-1 mb-3 border-bottom">
    <nav class="nav nav-underline justify-content-start">
        <a class="nav-item nav-link link-body-emphasis active" href="{{ route('pkm') }}">Upload</a>
        <a class="nav-item nav-link link-body-emphasis" href="{{ route('show.pkm') }}">Upload Saya</a>
    </nav>
</div>

<div class="card mb-4 mt-2">
    <div class="card-body">
        <h1 class="mt-4">Proposal PKM</h1>

        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            @foreach($headers_proposal_pkm as $header)
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
                            @foreach($headers_proposal_pkm as $header)
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
                        @foreach($proposal_pkm as $item)
                        <tr>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->nama_pelaksana }}</td>
                            <td>{{ $item->semester }}</td>
                            <td>{{ $item->tahun_akademik }}</td>
                            <td>
                                {{ $item->status }}
                            </td>
                            <td>
                                <a href="{{ route('download.proposalpkm', ['filename' => $item->file]) }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-file-arrow-down"></i>
                                </a>

                                <a href="{{ route('view.proposalpkm', ['filename' => $item->file]) }}"
                                    class="btn btn-info btn-sm" target="_blank">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <a href="{{ route('edit.proposalpkm', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-edit"></i>
                                </a>

                                <form action="{{ route('delete.proposalpkm', $item->id) }}" method="POST"
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
        <h1 class="mt-4">Laporan Kemajuan PKM</h1>

        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimpleKemajuan">
                    <thead>
                        <tr>
                            @foreach($headers_kemajuan_pkm as $header)
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
                            @foreach($headers_kemajuan_pkm as $header)
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
                            <td>{{ $item->proposalPKM->nama_pelaksana }}</td>
                            <td>{{ $item->proposalPKM->semester }}</td>
                            <td>{{ $item->proposalPKM->tahun_akademik }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <a href="{{ route('download.kemajuanpkm', ['filename' => $item->file]) }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-file-arrow-down"></i>
                                </a>

                                <a href="{{ route('view.kemajuanpkm', ['filename' => $item->file]) }}"
                                    class="btn btn-info btn-sm" target="_blank">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <a href="{{ route('edit.kemajuanpkm', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-edit"></i>
                                </a>

                                <form action="{{ route('delete.kemajuanpkm', $item->id) }}" method="POST"
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
        <h1 class="mt-4">Laporan Akhir PKM</h1>

        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimpleArtikel">
                    <thead>
                        <tr>
                            @foreach($headers_akhir_pkm as $header)
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
                            @foreach($headers_akhir_pkm as $header)
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
                            <td>{{ $item->proposalPKM->nama_pelaksana }}</td>
                            <td>{{ $item->proposalPKM->semester }}</td>
                            <td>{{ $item->proposalPKM->tahun_akademik }}</td>
                            <td>
                                <a href="{{ route('download.akhirpkm', ['filename' => $item->file]) }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-file-arrow-down"></i>
                                </a>

                                <a href="{{ route('view.akhirpkm', ['filename' => $item->file]) }}"
                                    class="btn btn-info btn-sm" target="_blank">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <form action="{{ route('delete.akhirpkm', $item->id) }}" method="POST"
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
        <h1 class="mt-4">Jurnal PKM</h1>

        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimpleJurnal">
                    <thead>
                        <tr>
                            @foreach($headers_jurnal_pkm as $header)
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
                            @foreach($headers_jurnal_pkm as $header)
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
                        @foreach($jurnal_pkm as $item)
                        <tr>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->penerbit }}</td>
                            <td>{{ $item->tahun }}</td>
                            <td>{{ $item->volume }}</td>
                            <td>{{ $item->nomor }}</td>
                            <td>
                                <a href="{{ route('download.jurnalpkm', ['filename' => $item->file]) }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-file-arrow-down"></i>
                                </a>

                                <a href="{{ route('view.jurnalpkm', ['filename' => $item->file]) }}"
                                    class="btn btn-info btn-sm" target="_blank">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <a href="{{ route('edit.jurnalpkm', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-edit"></i>
                                </a>

                                <form action="{{ route('delete.jurnalpkm', $item->id) }}" method="POST"
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
        <h1 class="mt-4">Media Massa</h1>

        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimpleMedia">
                    <thead>
                        <tr>
                            @foreach($headers_media as $header)
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
                            @foreach($headers_media as $header)
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
                        @foreach($media_massa as $item)
                        <tr>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->nama_media }}</td>
                            <td>{{ $item->bulan_terbit }}</td>
                            <td>{{ $item->tahun_terbit }}</td>
                            <td>{{ $item->url }}</td>
                            <td>
                                <form action="{{ route('delete.mediapkm', $item->id) }}" method="POST"
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
        <h1 class="mt-4">HKI PKM</h1>

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
                        @foreach($hki_pkm as $item)
                        <tr>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->nama_pemegang }}</td>
                            <td>{{ $item->nomor_sertifikat }}</td>
                            <td>
                                <a href="{{ route('download.hkipkm', ['filename' => $item->file]) }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-file-arrow-down"></i>
                                </a>

                                <a href="{{ route('view.hkipkm', ['filename' => $item->file]) }}"
                                    class="btn btn-info btn-sm" target="_blank">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <a href="{{ route('edit.hkipkm', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-edit"></i>
                                </a>

                                <form action="{{ route('delete.hkipkm', $item->id) }}" method="POST"
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
@endsection