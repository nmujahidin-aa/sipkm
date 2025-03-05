@extends('layouts.app')
@section('title', 'Pengaturan Web | SIPKM UM')
@section('style')
<style>
</style>
@endsection
@section('breadcumb')
<div class="page-title d-flex flex-column me-5">
    <!--begin::Title-->
    <h1 class="d-flex flex-column text-dark fw-bolder fs-3 mb-0">Pengaturan Web</h1>
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
        <li class="breadcrumb-item text-dark">Pengaturan</li>
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
            <!--begin::Card-->
            <form action="{{route('admin.setting.store')}}" method="POST">
                @csrf
                <div class="card pt-4 mb-6 mb-xl-9">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>Kontrol Fitur</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    @if (isset($setting))
                        <input type="hidden" name="id" value="{{ $setting->id }}" autocomplete="off">
                    @endif
                    <div class="card-body pt-5 pb-5">
                        <div class="row mb-4 align-items-center">
                            <label class="col-lg-3 col-form-label">Fitur Register <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <div class="form-check form-switch form-check-custom form-check-solid me-10">
                                    <!-- Input Hidden untuk nilai default (0) -->
                                    <input type="hidden" name="is_registration_open" value="0">

                                    <!-- Input Checkbox -->
                                    <input name="is_registration_open"
                                           class="form-check-input h-20px w-50px"
                                           type="checkbox"
                                           value="1"
                                           id="flexSwitch30x50"
                                           {{ isset($setting) && $setting->is_registration_open ? 'checked' : '' }} />

                                    <!-- Label -->
                                    <label class="form-check-label" for="flexSwitch30x50">
                                        @if (isset($setting))
                                            {{ $setting->is_registration_open ? 'Sedang Aktif' : 'Sedang Tidak Aktif' }}
                                        @else
                                            -
                                        @endif
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4 align-items-center">
                            <label class="col-lg-3 col-form-label">Fitur Upload Proposal <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <div class="form-check form-switch form-check-custom form-check-solid me-10">
                                    <!-- Input Hidden untuk nilai default (0) -->
                                    <input type="hidden" name="is_proposal_submission_open" value="0">

                                    <!-- Input Checkbox -->
                                    <input name="is_proposal_submission_open"
                                           class="form-check-input h-20px w-50px"
                                           type="checkbox"
                                           value="1"
                                           id="flexSwitch30x50"
                                           {{ isset($setting) && $setting->is_proposal_submission_open ? 'checked' : '' }} />

                                    <!-- Label -->
                                    <label class="form-check-label" for="flexSwitch30x50">
                                        @if (isset($setting))
                                            {{ $setting->is_proposal_submission_open ? 'Sedang Aktif' : 'Sedang Tidak Aktif' }}
                                        @else
                                            -
                                        @endif
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4 align-items-center">
                            <label class="col-lg-3 col-form-label">Tahun Pengumpulan <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="proposal_submission_year" class="form-control @error('proposal_submission_year') is-invalid @enderror" value="{{ old('proposal_submission_year') ? old('proposal_submission_year') : (isset($setting) ? $setting->proposal_submission_year : '') }}">
                                <div class="invalid-feedback">@error('proposal_submission_year'){{ $message }}@enderror</div>
                            </div>
                        </div>
                    </div>
                    <!--end::Card body-->
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
@endsection


@section('script')
@endsection
