@extends('layouts.app')
@section('title', 'Belmawa | SIPKM UM')

@section('breadcumb')
<div class="page-title d-flex flex-column me-5">
    <!--begin::Title-->
    <h1 class="d-flex flex-column text-dark fw-bolder fs-3 mb-0">Data Belmawa</h1>
    <!--end::Title-->
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 pt-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
            <a href="{{route('dashboard.index')}}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-dark">Data Belmawa</li>
        <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
</div>
@endsection

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <!--begin::Navbar-->
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center mb-3">
                    <div class="ms-3">
                        <h3 class="card-header-title mb-1">
                            Data Belmawa
                        </h3>
                        <p class="mb-0">Berikut merupakan data akun simbelmawa anda</p>
                    </div>
                </div>
            </div>
            <div class="separator my-2"></div>
            @if ($belmawa->isEmpty())
                <div class="alert alert-warning fade show mb-5 d-flex align-items-center" role="alert">
                    <i class="bi bi-info-circle fs-1 me-3 alert-heading"></i>
                    <div>
                        <h4 class="alert-heading mb-1">Tidak ada data</h4>
                        <p class="mb-0">Hanya ketua tim / dosen pendamping yang mendapatkan akun Simbelmawa</p>
                    </div>
                </div>
            @else
            <div class="card mb-6 mb-xl-9">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th class="text-start">Nama</th>
                                    <th class="text-start">Username</th>
                                    <th class="text-start">Password</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($belmawa as $index => $row)
                                    <tr>
                                        <td>{{ $row->user->name }}</td>
                                        <td>{{ $row->username }}</td>
                                        <td>{{ $row->password }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
@endsection
