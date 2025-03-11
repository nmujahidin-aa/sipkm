@extends('layouts.app')
@section('title', 'Dashboard | SIPKM-UM')
@section('style')
<style>
    .image-container {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .image-container img {
        position: absolute;
        top: 100px;
        left: 50%;
        transform: translateX(-50%);
        opacity: 0;
        animation: fade 9s infinite;
        height: 40vh;
        width: auto;
    }
    .image-container img:nth-child(1) {
        animation-delay: 0s;
    }
    .image-container img:nth-child(2) {
        animation-delay: 3s;
    }
    .image-container img:nth-child(3) {
        animation-delay: 6s;
    }
    .quotes {
        margin-top: 1000px;
        font-size: 1.5rem;
        font-style: italic;
        color: #333;
        opacity: 0;
        animation: fadeQuotes 9s infinite;
    }
    @keyframes fade {
        0%, 33.33% {
            opacity: 1;
        }
        33.34%, 100% {
            opacity: 0;
        }
    }
    @keyframes fadeQuotes {
        0%, 100% {
            opacity: 1;
        }
    }
</style>
@endsection
@section('breadcumb')
<div class="page-title d-flex flex-column me-5">
    <!--begin::Title-->
    <h1 class="d-flex flex-column text-dark fw-bolder fs-3 mb-0">Dashboard</h1>
    <!--end::Title-->
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 pt-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
            <a href="" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-dark">Default</li>
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
        <div id="kt_content_container" class="container-xxl d-flex justify-content-center align-items-center min-vh-80">
            <div class="text-center image-container">
                <img src="{{URL::to('/')}}/assets/media/cakra/1.png" alt="cakra-1">
                <img src="{{URL::to('/')}}/assets/media/cakra/2.png" alt="cakra-1">
                <img src="{{URL::to('/')}}/assets/media/cakra/3.png" alt="cakra-1">
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
@endsection
