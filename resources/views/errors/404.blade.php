@extends('layouts.app')
@section('title', '404 Not Found')

@section('content')
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - 404 Page-->
    <div class="d-flex flex-column flex-center flex-column-fluid p-10">
        <!--begin::Illustration-->
        <img src="{{URL::to('/')}}/assets/media/illustrations/sketchy-1/5-dark.png" alt="" class="mw-100 mb-10 h-lg-350px" />
        <!--end::Illustration-->
        <!--begin::Message-->
        <h1 class="fw-bold" style="color: #000">Maap!!</h1>
        <h1 class="fw-light fs-3 mb-10" style="color: #A3A3C7">Halaman yang kamu cari tidak ada.</h1>
        <!--end::Message-->
        <!--begin::Link-->
        <a href="{{route('dashboard.index')}}" class="btn btn-primary">Ke Dashboard</a>
        <!--end::Link-->
    </div>
    <!--end::Authentication - 404 Page-->
</div>
@endsection
