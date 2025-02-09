@extends('layouts.auth')
@section('content')
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-column-fluid bgi-overlay">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <!--begin::Logo-->
            <a href="#" class="mb-12">
                <img alt="Logo" src="{{URL::to('/')}}/assets/media/logos/logo-1.svg" class="h-100px" />
            </a>
            <!--end::Logo-->
            <!--begin::Wrapper-->
            <div class="w-sm-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <!--begin::Form-->
                <form class="form w-100" action="{{route('auth.login.post')}}" method="POST">
                    @csrf
                    <!--begin::Heading-->
                    <div class="text-center mb-10">
                        <!--begin::Title-->
                        <h1 class="text-dark mb-3">Masuk ke SIPKM</h1>
                        <!--end::Title-->
                        <!--begin::Link-->
                        <div class="text-gray-400 fw-bold fs-4">Sistem Informasi PKM UM</div>
                        <!--end::Link-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Email/NIM/NIDN/NUPTK</label>
                        <input class="form-control form-control-lg form-control-solid @error('username') is-invalid @enderror" type="text" name="username" value="{{ old('username') }}" autocomplete="off" placeholder="Masukkan Email/NIM/NIDN/NUPTK anda"/>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--end::Input group-->
                    <div class="fv-row mb-10">
                        <div class="d-flex flex-stack mb-2">
                            <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                            <a href="#" class="link-primary fs-6 fw-bolder">Lupa Password ?</a>
                        </div>
                        <input class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror" type="password" name="password" autocomplete="off" placeholder="Masukkan Password"/>
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

                    <span class="form-label fs-6">Belum punya akun? <a href="{{route('auth.register.index')}}" class="text-primary">Daftar</a> </span>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
        <!--begin::Footer-->
        <div class="d-flex flex-center flex-column-auto pb-10">
            <div class="d-flex align-items-center fw-bold fs-8">
                <a class="text-muted text-hover-primary px-2">&copy; 2025 - {{ date('Y') }} PKM CENTER UNIVERSITAS NEGERI MALANG</a>
            </div>
        </div>
        <!--end::Footer-->
        <!--begin::Background Images-->
        <img src="{{URL::to('/')}}/assets/media/illustrations/sketchy-1/2.png" class="background-image-left" alt="Background Left" />
        <img src="{{URL::to('/')}}/assets/media/illustrations/sketchy-1/1.png" class="background-image-right" alt="Background Right" />
        <!--end::Background Images-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
@endsection
