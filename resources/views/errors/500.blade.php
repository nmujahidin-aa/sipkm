@extends('layouts.app')
@section('title', '500 Internal Server Error')

@section('content')
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - Error 500 -->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Content-->
        <div class="d-flex flex-column flex-column-fluid text-center p-10 py-lg-15">
            <!--begin::Logo-->
            <a href="{{route('dashboard.index')}}" class="mb-10 pt-lg-10">
                <img alt="Logo" src="{{URL::to('/')}}/assets/media/illustrations/sketchy-1/5-dark.png" class="mw-100 mb-10 h-lg-350px" />
            </a>
            <!--end::Logo-->
            <!--begin::Wrapper-->
            <div class="pt-lg-10 mb-10">
                <!--begin::Logo-->
                <h1 class="fw-bolder fs-2qx text-gray-800 mb-10">Sistemnya lagi error</h1>
                <!--end::Logo-->
                <!--begin::Message-->
                <div class="fw-bold fs-3 text-muted mb-15">Maaf, sepertinya ada masalah dengan sistem kami
                <br />Coba lagi nanti.</div>
                <!--end::Message-->
                <!--begin::Action-->
                <div class="text-center">
                    <a href="{{route('dashboard.index')}}" class="btn btn-lg btn-primary fw-bolder">Ke Dashboard</a>
                </div>
                <!--end::Action-->
            </div>
            <!--end::Wrapper-->
            <!--begin::Illustration-->
            <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px" style="background-image: url(assets/media/illustrations/sketchy-1/17.png"></div>
            <!--end::Illustration-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Authentication - Error 500-->
</div>
@endsection
