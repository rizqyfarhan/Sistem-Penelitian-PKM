<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Proposal Penelitian</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/template.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed d-flex flex-column h-100">
    <nav class="sb-topnav navbar navbar-expand navbar-dark navbar-custom">
    </nav>

    <main class="flex-grow-1 mt-5">
        <div class="container-fluid px-4 mt-4">

            <div class="row">
                <div class="col-md-6">
                    <h1 class="mt-4">Dashboard</h1>
                </div>
                <div class="col-md-6 text-end mt-4">
                    @auth
                    @if(auth()->user()->role == 'admin')
                    <a class="btn btn-primary" href="{{ route('admin.upload') }}">Admin</a>
                    @elseif(auth()->user()->role == 'dosen')
                    <a class="btn btn-primary" href="{{ route('penelitian') }}">Dosen</a>
                    @elseif(auth()->user()->role == 'reviewer')
                    <a class="btn btn-primary" href="{{ route('review.penelitian') }}">Reviewer</a>
                    @endif
                    @else
                    <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
                    @endauth
                </div>

            </div>

            <div class="nav-scroller py-1 mb-3 border-bottom">
                <nav class="nav nav-underline justify-content-start">
                </nav>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="container-{width: 100%}">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Jumlah Proposal Penelitian</th>
                                    <th scope="col">Jumlah Proposal PKM</th>
                                    <th scope="col">Jumlah Proposal yang Disetujui</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $count_penelitian }}</td>
                                    <td>0</td>
                                    <td>{{ $total_records }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="container-{width: 100%}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title fw-bold"><i class="fa-solid fa-flag"></i> PENGUMUMAN</h5>
                            </div>

                            @foreach($pengumuman as $p)
                            <div class="card m-2">
                                <div class="card-body">
                                    <h6 class="card-title fw-bold">{{ $p->header }}</h6>
                                    <p class="card-text">{{ $p->paragraph }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title fw-bold"><i class="fa-solid fa-file"></i> DOWNLOAD FILE</h5>
                            </div>
                            @foreach($files as $file)
                            <div class="card m-2">
                                <div class="card-body">
                                    <a href="{{ route('download.file', ['filename' => $file->path]) }}"
                                        download>{{ $file->path }}</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="py-4 bg-light">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Your Website 2023</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/template.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>