@extends('template')

@section('title')
<title>Profile</title>
@endsection

@section('sidenav')
<div class="sb-sidenav-menu">
    <div class="nav">
        <div class="sb-sidenav-menu-heading">Menu</div>
        <a class="nav-link collapsed" href="{{ route('dashboard') }}" aria-expanded="false">
            <div class="sb-nav-link-icon"><i class="fa-solid fa-table-cells"></i></div>
            Dashboard
        </a>
        @if(Auth::user()->role == 'admin')
        <a class="nav-link collapsed" href="{{ route('admin.upload') }}" aria-expanded="false">
            <div class="sb-nav-link-icon"><i class="fa-solid fa-upload"></i></div>
            Upload
        </a>
        @endif
        @if(Auth::user()->role == 'dosen')
            <a class="nav-link collapsed" href="{{ route('penelitian') }}" aria-expanded="false">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-flask"></i></div>
                Penelitian
            </a>
        @elseif(Auth::user()->role == 'admin')
            <a class="nav-link collapsed" href="{{ route('index.proposaladmin') }}" aria-expanded="false">    
                <div class="sb-nav-link-icon"><i class="fa-solid fa-flask"></i></div>
                Penelitian
            </a>
        @endif    
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

@section('profile')
    @if ($role == 'dosen')
        <li><a class="dropdown-item" href="{{ route('index.dosenprofile') }}">Profile</a></li>
    @elseif ($role == 'reviewer')
        <li><a class="dropdown-item" href="{{ route('index.reviewerprofile') }}">Profile</a></li>
    @elseif ($role == 'admin')
        <li><a class="dropdown-item" href="{{ route('index.adminprofile') }}">Profile</a></li>
    @endif
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>NRK:</strong> {{ Auth::user()->nrk }}</p>
                    <p><strong>Role:</strong> {{ Auth::user()->role }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection