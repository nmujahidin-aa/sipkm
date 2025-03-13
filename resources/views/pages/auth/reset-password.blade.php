@extends('layouts.auth')
@section('title','Masuk | SIPKM-UM')
@section('content')
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <!--begin::Logo-->
            <a href="#" class="mb-12">
                <img alt="Logo" src="{{URL::to('/')}}/assets/media/logos/logo-1.svg" class="h-100px" />
            </a>
            <!--end::Logo-->
            <!--begin::Wrapper-->
            <div class="">
                <!--begin::Form-->
                <form class="form w-100" action="{{route('auth.reset-password.validation')}}" method="POST">
                    @csrf
                    <!--begin::Heading-->
                    <div class="text-center mb-10">
                        <!--begin::Title-->
                        <h1 class="text-dark mb-3">Lupa Kata Sandi</h1>
                        <!--end::Title-->
                        <!--begin::Link-->
                        <div class="text-gray-500 fs-5">Sudah ingat kata sandi? <a href="{{route('auth.login.index')}}" class="text-primary">Masuk</a> </div>
                        <!--end::Link-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                        <input class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror w-400px" type="text" name="email" value="{{ old('email') }}" autocomplete="off" placeholder="Masukkan Email @um.ac.id anda"/>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                            <span class="indicator-label">Masuk</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <div class="d-flex flex-center flex-column-auto pb-10">
                <div class="d-flex align-items-center fw-bold fs-8">
                    <a class="text-muted text-hover-primary px-2">&copy; 2025 - {{ date('Y') }} PKM CENTER UNIVERSITAS NEGERI MALANG</a>
                </div>
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
        <!--begin::Footer-->
        <!--end::Footer-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
@endsection
