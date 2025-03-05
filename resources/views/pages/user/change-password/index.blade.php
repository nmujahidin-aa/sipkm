@extends('layouts.app')
@section('title','Profile | SIPKM-UM')
@section('style')
<style>
    .password-strength .progress {
        height: 8px;
        margin-top: 5px;
        background-color: #e9ecef;
    }

    .password-strength .progress-bar {
        transition: width 0.3s ease;
    }

    .password-strength #password-strength-text {
        margin-top: 5px;
        font-size: 0.875rem;
    }
</style>
@endsection
@section('breadcumb')
<div class="page-title d-flex flex-column me-5">
    <!--begin::Title-->
    <h1 class="d-flex flex-column text-dark fw-bolder fs-3 mb-0">Ubah Password</h1>
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
        <li class="breadcrumb-item text-dark">
            Ubah Password
        </li>
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

            <div class="d-flex align-items-center mb-3">
                <div class="ms-3">
                    <h3 class="card-header-title mb-1">
                        <i class="bi-people me-2 fs-3"></i>
                        Ubah Password
                    </h3>
                    <p class="mb-0">Mohon isi data dengan benar dan teliti</p>
                </div>
            </div>

            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row">

                <!--begin::Content-->
                <div class="flex-column flex-lg-row-auto w-100 mb-10">
                    <!--begin:::Tab content-->
                    <div class="tab-content" id="myTabContent">
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade show active" id="kt_user_view_overview_security" role="tabpanel">
                            <!--begin::Card-->
                            <form action="{{ route('change-password.update') }}" method="POST">
                                @csrf
                                <div class="card pt-4 mb-6 mb-xl-9">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Ubah Password</h2>
                                        </div>
                                    </div>

                                    <div class="card-body pt-5 pb-5">
                                        <!-- Password Lama -->
                                        <div class="row mb-4 align-items-center">
                                            <label class="col-lg-3 col-form-label">Password Lama <span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror">
                                                <div class="invalid-feedback">@error('current_password') {{ $message }} @enderror</div>
                                            </div>
                                        </div>

                                        <!-- Password Baru -->
                                        <div class="row mb-4 align-items-center">
                                            <label class="col-lg-3 col-form-label">Password Baru <span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <input type="password" name="new_password" id="new_password" class="form-control @error('new_password') is-invalid @enderror">
                                                <div class="invalid-feedback">@error('new_password') {{ $message }} @enderror</div>

                                                <!-- Indikator Kekuatan Password -->
                                                <div class="password-strength mt-2">
                                                    <div class="progress">
                                                        <div id="password-strength-bar" class="progress-bar" role="progressbar" style="width: 0%;"></div>
                                                    </div>
                                                    <small id="password-strength-text" class="form-text text-muted"></small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Konfirmasi Password Baru -->
                                        <div class="row mb-4 align-items-center">
                                            <label class="col-lg-3 col-form-label">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <input type="password" name="new_password_confirmation" class="form-control @error('new_password_confirmation') is-invalid @enderror">
                                                <div class="invalid-feedback">@error('new_password_confirmation') {{ $message }} @enderror</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer text-end">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--end:::Tab pane-->
                    </div>
                    <!--end:::Tab content-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Layout-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.getElementById('new_password');
        const strengthBar = document.getElementById('password-strength-bar');
        const strengthText = document.getElementById('password-strength-text');

        passwordInput.addEventListener('input', function () {
            const password = passwordInput.value;
            const result = zxcvbn(password); // Hitung kekuatan password

            // Update progress bar dan teks
            const strength = result.score; // Skor kekuatan (0-4)
            const width = (strength + 1) * 25; // Konversi skor ke persentase (0-100%)

            strengthBar.style.width = `${width}%`;

            // Update warna dan teks berdasarkan skor
            switch (strength) {
                case 0:
                    strengthBar.style.backgroundColor = '#dc3545'; // Merah
                    strengthText.textContent = 'Sangat Lemah';
                    break;
                case 1:
                    strengthBar.style.backgroundColor = '#ffc107'; // Kuning
                    strengthText.textContent = 'Lemah';
                    break;
                case 2:
                    strengthBar.style.backgroundColor = '#ffc107'; // Kuning
                    strengthText.textContent = 'Sedang';
                    break;
                case 3:
                    strengthBar.style.backgroundColor = '#28a745'; // Hijau
                    strengthText.textContent = 'Kuat';
                    break;
                case 4:
                    strengthBar.style.backgroundColor = '#28a745'; // Hijau
                    strengthText.textContent = 'Sangat Kuat';
                    break;
                default:
                    strengthBar.style.backgroundColor = '#e9ecef'; // Default
                    strengthText.textContent = '';
            }
        });
    });
</script>
@endsection
