@extends('layouts.app')

@section('title', 'Review Proposal')
@section('style')
<style>
    img{
        max-width: 100%;
        height: auto;
    }
</style>
@endsection
@section('breadcumb')
<div class="page-title d-flex flex-column me-5">
    <!--begin::Title-->
    <h1 class="d-flex flex-column text-dark fw-bolder fs-3 mb-0">Log Catatan Proposal</h1>
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
        <li class="breadcrumb-item text-muted">
            <a href="{{route('admin.proposal.index')}}" class="text-muted text-hover-primary">Data Proposal</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{route('admin.proposal.edit',$proposal_id)}}" class="text-muted text-hover-primary">Detail Proposal</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">
            Log Catatan
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
                <a href="{{ route('proposal.edit', $proposal_id) }}" class="btn btn-white">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div class="ms-3">
                    <h3 class="card-header-title mb-1">
                        <i class="bi-people me-2 fs-3"></i>
                        Log Catatan Proposal
                    </h3>
                    <p class="mb-0">Kelompok {{isset($proposal_id) ? $proposal->team_name : '-'}}
                    </p>
                </div>
            </div>

            <div class="alert alert-primary fade show mb-5 d-flex align-items-center" role="alert">
                <i class="bi bi-info-circle fs-1 me-3 alert-heading"></i>
                <div>
                    <h4 class="alert-heading mb-1">Perhatian </h4>
                    <p class="mb-0">Setelah memberikan tanggapan, lakukan revisi pada proposal untuk perbaikan melalui menu edit.</p>
                </div>
            </div>

            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row">
                <!--begin::Content-->
                <div class="flex-lg-row-fluid ">
                    <!--begin:::Tab content-->
                    <div class="tab-content" id="myTabContent">
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade show active" id="kt_user_view_overview_security" role="tabpanel">
                            <!--begin::Card-->
                            <form action="{{route('proposal.storeReview', $proposal_id)}}" method="POST">
                                @csrf
                                <div class="card pt-4 mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2>Log Catatan</h2>
                                        </div>
                                        <!--end::Card title-->
                                    </div>
                                    @if (isset($proposalReview))
                                        <input type="hidden" name="id" value="{{ $proposalReview->id }}" autocomplete="off">
                                    @endif
                                    <div class="card-body pt-5 pb-5">
                                        <div class="row mb-3 align-items-center">
                                            <label class="col-lg-3 col-form-label fw-bolder text-dark">Nama Tim</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" value="{{isset($proposal_id) ? $proposal->team_name : '-'}}" disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-3 align-items-center">
                                            <label class="col-lg-3 col-form-label fw-bolder text-dark">Judul</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" value="{{isset($proposal_id) ? $proposal->title : '-'}}" disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-3 align-items-center">
                                            <label class="col-lg-3 col-form-label fw-bolder text-dark">Judul Catatan</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" value="{{ old('title') ? old('title') : (isset($proposalReview) ? $proposalReview->title : '') }} " disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-3 align-items-start">
                                            <label class="col-lg-3 col-form-label fw-bolder text-dark">Catatan</label>
                                            <div class="col-lg-9">
                                                {!! isset($proposalReview) ? $proposalReview->comment : '' !!}
                                            </div>
                                        </div>


                                        <div class="row mb-3 align-items-center">
                                            <label class="col-lg-3 col-form-label fw-bolder text-dark">Tanggapan <span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <input
                                                    type="text"
                                                    name="feedback"
                                                    class="form-control @error('feedback') is-invalid @enderror"
                                                    placeholder="misal: Siap kak, segera kami revisi!"
                                                    value="{{ old('feedback') ?? ($proposalReview->feedback ?? '') }}"
                                                    @if(isset($proposalReview) && $proposalReview->status == 1) disabled @endif
                                                >
                                                <div class="invalid-feedback">@error('feedback'){{ $message }}@enderror</div>
                                            </div>
                                        </div>


                                        <div class="row mb-3 align-items-center">
                                            <label class="col-lg-3 col-form-label fw-bolder text-dark">Dibuat pada</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" value="{{isset($proposalReview) ? \App\Helpers\Timezone::display($proposalReview->updated_at, true) : '-'}}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Card body-->
                                    <div class="card-footer text-end">
                                        <button type="submit" class="btn btn-primary" @if(isset($proposalReview) && $proposalReview->status == 1) disabled @endif>Simpan</button>
                                    </div>
                                </div>
                            </form>
                            <!--end::Card-->
                        </div>
                        <!--end:::Tab pane-->
                    </div>
                    <!--end:::Tab content-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Layout-->
            <!--end::Modals-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
@endsection

@section('script')

@endsection
