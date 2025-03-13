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
                <form class="form w-100" action="{{route('auth.login.post')}}" method="POST">
                    @csrf
                    <!--begin::Heading-->
                    <div class="text-center mb-10">
                        <!--begin::Title-->
                        <h1 class="text-dark mb-3">Masuk ke SIPKM UM</h1>
                        <!--end::Title-->
                        <!--begin::Link-->
                        <div class="text-gray-500 fs-5">Belum punya akun SIPKM UM? <a href="{{route('auth.register.index')}}" class="text-primary">Daftar sekarang</a> </div>
                        <!--end::Link-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Nama Pengguna</label>
                        <input class="form-control form-control-lg form-control-solid @error('username') is-invalid @enderror w-400px" type="text" name="username" value="{{ old('username') }}" autocomplete="off" placeholder="NIM/NIDN/NUPTK/Email @um.ac.id anda"/>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--end::Input group-->
                    <div class="fv-row mb-10">
                        <div class="d-flex flex-stack mb-2">
                            <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                            <a href="{{route('auth.reset-password.index')}}" class="link-primary fs-6 fw-bolder">Lupa Password ?</a>
                        </div>
                        <input class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror w-400px" type="password" name="password" autocomplete="off" placeholder="Masukkan Password"/>
                        @error('password')
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
