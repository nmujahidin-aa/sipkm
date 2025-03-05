@extends('layouts.app')

@section('title', 'Review Proposal')
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
            <a href="{{route('dosen.proposal.index')}}" class="text-muted text-hover-primary">Data Proposal</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{route('dosen.proposal.edit',$proposal_id)}}" class="text-muted text-hover-primary">Detail Proposal</a>
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
                <a href="{{ route('dosen.proposal.edit', $proposal_id) }}" class="btn btn-white">
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

            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row">
                <!--begin::Content-->
                <div class="flex-lg-row-fluid ">
                    <!--begin:::Tab content-->
                    <div class="tab-content" id="myTabContent">
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade show active" id="kt_user_view_overview_security" role="tabpanel">
                            <!--begin::Card-->
                            <form action="{{route('dosen.proposal.storeReview', $proposal_id)}}" method="POST">
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
                                    @if (!isset($proposalReview))
                                        <input type="hidden" name="reviewer_id" value="{{ Auth::user()->id }}" autocomplete="off">
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
                                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ? old('title') : (isset($proposalReview) ? $proposalReview->title : '') }} " @if(isset($proposalReview) && $proposalReview->status == 1) disabled @endif>
                                                <div class="invalid-feedback">@error('title'){{ $message }}@enderror</div>
                                            </div>
                                        </div>
                                        <div class="row mb-3 align-items-center">
                                            <label class="col-lg-3 col-form-label fw-bolder text-dark">Catatan</label>
                                            <div class="col-lg-9">
                                                <textarea class="form-control @error('comment') is-invalid @enderror" name="comment" id="comment" rows="3" @if(isset($proposalReview) && $proposalReview->status == 1) disabled @endif>{{isset($proposalReview) ? $proposalReview->comment : ''}}</textarea>
                                                <div class="invalid-feedback">@error('comment'){{ $message }}@enderror</div>
                                            </div>
                                        </div>

                                        @if (isset($proposalReview) && $proposalReview->status == 1)
                                        <div class="row mb-3 align-items-center">
                                            <label class="col-lg-3 col-form-label fw-bolder text-dark">Balasan</label>
                                            <div class="col-lg-9">
                                                <textarea class="form-control" id="note" rows="3" disabled>{{isset($proposalReview) ? $proposalReview->feedback : ''}}</textarea>
                                            </div>
                                        </div>

                                        <div class="row mb-3 align-items-center">
                                            <label class="col-lg-3 col-form-label fw-bolder text-dark">Dibuat pada</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" value="{{isset($proposalReview) ? \App\Helpers\Timezone::display($proposalReview->updated_at, true) : '-'}}" disabled>
                                            </div>
                                        </div>
                                        @endif
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
<script src="{{URL::to('/')}}/assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js"></script>
<script>
    document.querySelectorAll('#comment').forEach(element => {
        ClassicEditor
            .create(element, {
                ckfinder: {
                    uploadUrl: "{{ route('dosen.proposal.reviewUpload', ['_token' => csrf_token()]) }}"
                }
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>
@endsection
