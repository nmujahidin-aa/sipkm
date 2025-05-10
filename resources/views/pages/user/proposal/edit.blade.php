@extends('layouts.app')

@section('title')
    {{ isset($proposal) ? 'Ubah Mahasiswa: ' . $proposal->name : 'Tambah Mahasiswa' }}
@endsection
@section('style')
<style>
    @media (max-width: 576px) {
        .custom-input {
            width: 80vw !important;
        }
    }
</style>
@endsection
@section('breadcumb')
<div class="page-title d-flex flex-column me-5">
    <!--begin::Title-->
    <h1 class="d-flex flex-column text-dark fw-bolder fs-3 mb-0">Data Proposal</h1>
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
            <a href="{{route('proposal.index')}}" class="text-muted text-hover-primary">Data Proposal</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">
            {{ isset($proposal) ? 'Ubah Data Proposal: ' : 'Tambah Proposal' }}
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
                <a href="{{ route('proposal.index') }}" class="btn btn-white">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div class="ms-3">
                    <h3 class="card-header-title mb-1">
                        <i class="bi-book me-2 fs-3"></i>
                        {{ isset($proposal) ? 'Ubah' : 'Tambah' }} Proposal
                    </h3>
                    <p class="mb-0">Mohon isi data dengan benar dan teliti</p>
                </div>
            </div>
            @isset($proposal)
            @if ($proposal->status == "reviewed")
            <div class="alert alert-primary fade show mb-5 d-flex align-items-center" role="alert">
                <i class="bi bi-info-circle fs-1 me-3 alert-heading"></i>
                <div>
                    <h4 class="alert-heading mb-1">Tahap Peninjauan</h4>
                    <p class="mb-0">Proposal Anda saat ini sedang dalam proses peninjauan. Mohon bersabar dan tetap semangat. Semoga hasilnya yang terbaik untuk Anda!</p>
                </div>
            </div>
            @elseif ($proposal->status == "rejected")
            <div class="alert alert-danger fade show mb-5 d-flex align-items-center" role="alert">
                <i class="bi bi-x-circle fs-1 me-3 alert-heading"></i>
                <div>
                    <h4 class="alert-heading mb-1">Mohon Maaf !!</h4>
                    <p class="mb-0">Mohon maaf, proposal Anda belum memenuhi kriteria untuk melanjutkan ke tahap selanjutnya. Jangan patah semangat, perbaiki proposal Anda dan coba lagi!</p>
                </div>
            </div>
            @elseif (in_array($proposal->status, ['upload', 'funded', 'pimnas']))
            <div class="alert alert-success fade show mb-5 d-flex align-items-center" role="alert">
                <i class="bi bi-check-circle fs-1 me-3 alert-heading"></i>
                <div>
                    <h4 class="alert-heading mb-1">Selamat !!</h4>
                    <p class="mb-0">Proposal Anda telah memenuhi kriteria untuk melanjutkan ke tahap selanjutnya. Jangan lupa untuk menghubungi mentor guna mendapatkan pendampingan lebih lanjut.</p>
                </div>
            </div>
            @else

            @endif
            @endisset


            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row">

                <!--begin::Content-->
                <div class="flex-column flex-lg-row-auto w-100 mb-10">
                    <!--begin:::Tab content-->
                    <div class="tab-content" id="myTabContent">
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade show active" id="kt_user_view_overview_security" role="tabpanel">
                            <!--begin::Card-->
                            <form action="{{route('proposal.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card pt-4 mb-6 mb-xl-9">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Data Proposal</h2>
                                        </div>
                                    </div>

                                    @if (isset($proposal))
                                        <input type="hidden" name="id" value="{{ $proposal->id }}" autocomplete="off">
                                    @endif

                                    <div class="card-body pt-5 pb-5">
                                        <!-- Nama Ketua -->
                                        <div class="row mb-4 align-items-center">
                                            <label class="col-lg-3 col-form-label">Nama Ketua</label>
                                            <div class="col-lg-9">
                                                <input type="text" disabled class="form-control" value="{{ $proposal->leader->name ?? Auth::user()->name }}">
                                                <input type="hidden" name="leader_id" value="{{ $proposal->leader_id ?? Auth::user()->id }}">
                                            </div>
                                        </div>

                                        <!-- Fakultas Ketua -->
                                        <div class="row mb-4 align-items-center">
                                            <label class="col-lg-3 col-form-label">Fakultas Ketua</label>
                                            <div class="col-lg-9">
                                                <input type="text" disabled class="form-control" value="{{ $proposal->leader->faculty->name ?? Auth::user()->faculty->name }}">
                                                <input type="hidden" name="faculty_id" value="{{ $proposal->faculty_id ?? Auth::user()->faculty->id }}">
                                            </div>
                                        </div>

                                        <!-- Nama Tim -->
                                        <div class="row mb-4 align-items-center">
                                            <label class="col-lg-3 col-form-label">Nama Tim <span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <input type="text" name="team_name" class="form-control @error('team_name') is-invalid @enderror" value="{{ old('team_name') ?: ($proposal->team_name ?? '') }}">
                                                <div class="invalid-feedback">@error('team_name') {{ $message }} @enderror</div>
                                            </div>
                                        </div>

                                        <!-- Judul -->
                                        <div class="row mb-4 align-items-center">
                                            <label class="col-lg-3 col-form-label">Judul <span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') ?: ($proposal->title ?? '') }}">
                                                <div class="invalid-feedback">@error('title') {{ $message }} @enderror</div>
                                            </div>
                                        </div>

                                        <!-- Skim -->
                                        <div class="row mb-4 align-items-center">
                                            <label class="col-lg-3 col-form-label">Skim <span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <select name="scheme" class="form-select @error('scheme') is-invalid @enderror" data-control="select2" data-placeholder="Select an option">
                                                    <option></option>
                                                    @foreach ($scheme as $index => $row)
                                                        <option class="text-dark" value="{{ $row }}" {{ old('scheme') == $row || (isset($proposal) && $proposal->scheme == $row) ? 'selected' : '' }}>PKM-{{ $row }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">@error('scheme') {{ $message }} @enderror</div>
                                            </div>
                                        </div>

                                        <!-- File Proposal -->
                                        <div class="row mb-4 align-items-center">
                                            <label class="col-lg-3 col-form-label">File Proposal <span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                                                @isset($proposal)
                                                    <small>Kosongkan jika tidak diubah. <a href="{{ asset('storage/' . $proposal->file) }}" target="_blank">Lihat Proposal</a></small>
                                                @endisset
                                                <div class="invalid-feedback">@error('file') {{ $message }} @enderror</div>
                                            </div>
                                        </div>

                                        <!-- Dosen Pembimbing -->
                                        <div class="row mb-4 align-items-center custom-input">
                                            <label class="col-lg-3 col-form-label">Dosen Pembimbing <span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <select name="advisors" class="form-select @error('advisors') is-invalid @enderror" data-control="select2" data-placeholder="Select an option">
                                                    <option></option>
                                                    @foreach ($advisors as $advisor)
                                                        <option class="text-dark" value="{{ $advisor->id }}" {{ old('advisors') == $advisor->id || (isset($proposal) && $proposal->advisor->user->id == $advisor->id) ? 'selected' : '' }}>{{ $advisor->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">@error('advisors') {{ $message }} @enderror</div>
                                            </div>
                                        </div>

                                        <!-- Anggota Tim -->
                                        <div class="row mb-4 align-items-center">
                                            <label class="col-lg-3 col-form-label">Anggota Tim <span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <select name="members[]" class="form-select @error('members') is-invalid @enderror" data-control="select2" data-placeholder="Select an option" multiple="multiple" id="membersSelect">
                                                    <option></option>
                                                    @foreach ($members as $member)
                                                        <option value="{{ $member->id }}" {{ in_array($member->id, old('members', isset($proposal) ? $proposal->members->pluck('user_id')->toArray() : [])) ? 'selected' : '' }}>{{ $member->name }}/{{ $member->nim }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">@error('members') {{ $message }} @enderror</div>
                                            </div>
                                        </div>

                                        <div class="row mb-4 align-items-center">
                                            <label class="col-lg-3 col-form-label">Catatan <span class="text-secondary">(opsional)</span></label>
                                            <div class="col-lg-9">
                                                <textarea class="form-control" name="note" id="note">{{ isset($proposal->note) ? $proposal->note : " " }}</textarea>
                                                <div class="invalid-feedback">@error('note') {{ $message }} @enderror</div>
                                            </div>
                                        </div>
                                    </div>

                                    

                                    <div class="card-footer text-end">
                                        <button type="submit" class="btn btn-primary" @if(isset($proposal) && $proposal->status == "rejected") disabled @endif>Simpan</button>
                                    </div>
                                </div>
                            </form>

                            @isset($proposal)
                            <div class="alert alert-success fade show mb-5 d-flex align-items-center" role="alert">
                                <i class="bi bi-info-circle fs-1 me-3 alert-heading"></i>
                                <div>
                                    <h4 class="alert-heading mb-1">Log Catatan</h4>
                                    <p class="mb-0">Berikut merupakan catatan, evaluasi, atau instruksi kepada kelompok {{isset($proposal) ? $proposal->team_name : '-'}} dari Dosen Pendamping / Dosen Penalaran / PKM Center.</p>
                                </div>
                            </div>
                            <div class="card">
                                <!--begin::Card header-->
                                <div class="card-header border-0 pt-6">
                                    <div class="card-title">
                                        <div class="d-flex align-items-center position-relative my-1">
                                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                                </svg>
                                            </span>
                                            <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid custom-input ps-14" placeholder="Cari Catatan" />
                                        </div>
                                    </div>
                                    <div class="card-toolbar">
                                        <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                                            <div class="fw-bolder me-5">
                                                <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected
                                            </div>
                                            <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Delete Selected</button>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Table-->
                                    <table class="table align-top table-striped table-row-dashed fs-6 gy-5" id="kt_table_users">
                                        <!--begin::Table head-->
                                        <thead>
                                            <!--begin::Table row-->
                                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                <th class="min-w-250px">Judul Catatan</th>
                                                <th class="min-w-250px">Tanggapan</th>
                                                <th class="w-250px">Reviewer</th>
                                                <th class="w-150px">Status</th>
                                                <th class="w-100px">Aksi</th>
                                                <th></th>
                                            </tr>
                                            <!--end::Table row-->
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->
                                        <tbody class="text-gray-600 fw-bold">
                                            @foreach ($proposalReview as $index => $row)
                                            <!--begin::Table row-->
                                            <tr>
                                                <td>
                                                    <div class="d-flex flex-column" style="line-height: 1.2;">
                                                        {{$row->title ? $row->title : '-'}}
                                                    </div>
                                                </td>
                                                <td>
                                                    {{$row->feedback ? $row->feedback : '-'}}
                                                </td>
                                                <td>
                                                    {{$row->reviewer->name}}
                                                </td>
                                                <td>
                                                    <div class="mb-3">
                                                        @if ($row->status == 0)
                                                            <span class="badge badge-warning" data-bs-toggle="tooltip" title="Belum ada tanggapan tim">
                                                                <span class="svg-icon svg-icon-2 svg-icon-gray-900">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <path d="M14.5 20.7259C14.6 21.2259 14.2 21.826 13.7 21.926C13.2 22.026 12.6 22.0259 12.1 22.0259C9.5 22.0259 6.9 21.0259 5 19.1259C1.4 15.5259 1.09998 9.72592 4.29998 5.82592L5.70001 7.22595C3.30001 10.3259 3.59999 14.8259 6.39999 17.7259C8.19999 19.5259 10.8 20.426 13.4 19.926C13.9 19.826 14.4 20.2259 14.5 20.7259ZM18.4 16.8259L19.8 18.2259C22.9 14.3259 22.7 8.52593 19 4.92593C16.7 2.62593 13.5 1.62594 10.3 2.12594C9.79998 2.22594 9.4 2.72595 9.5 3.22595C9.6 3.72595 10.1 4.12594 10.6 4.02594C13.1 3.62594 15.7 4.42595 17.6 6.22595C20.5 9.22595 20.7 13.7259 18.4 16.8259Z" fill="black"/>
                                                                        <path opacity="0.3" d="M2 3.62592H7C7.6 3.62592 8 4.02592 8 4.62592V9.62589L2 3.62592ZM16 14.4259V19.4259C16 20.0259 16.4 20.4259 17 20.4259H22L16 14.4259Z" fill="white"/>
                                                                    </svg>
                                                                </span>
                                                            </span>
                                                        @elseif($row->status == 1)
                                                            <span class="badge badge-success" data-bs-toggle="tooltip" title="Tim sudah menanggapi hasil review ini">
                                                                <span class="svg-icon svg-icon-2 svg-icon-light">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <path opacity="0.3" d="M10.3 14.3L11 13.6L7.70002 10.3C7.30002 9.9 6.7 9.9 6.3 10.3C5.9 10.7 5.9 11.3 6.3 11.7L10.3 15.7C9.9 15.3 9.9 14.7 10.3 14.3Z" fill="black"/>
                                                                        <path d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM11.7 15.7L17.7 9.70001C18.1 9.30001 18.1 8.69999 17.7 8.29999C17.3 7.89999 16.7 7.89999 16.3 8.29999L11 13.6L7.70001 10.3C7.30001 9.89999 6.69999 9.89999 6.29999 10.3C5.89999 10.7 5.89999 11.3 6.29999 11.7L10.3 15.7C10.5 15.9 10.8 16 11 16C11.2 16 11.5 15.9 11.7 15.7Z" fill="black"/>
                                                                    </svg>
                                                                </span>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </td>

                                                <td>
                                                    <a href="{{ route('proposal.review', ['proposal_id'=>$row->proposal_id, 'id'=>$row->id]) }}" class="btn btn-sm btn-primary"><i class="bi @if ($row->status == 0) bi-pencil-square @else bi-eye @endif"></i></a>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <!--end::Table row-->
                                            @endforeach
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            @endisset

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
<script src="{{URL::to('/')}}/assets/plugins/custom/datatables/datatables.bundle.js"></script>
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{URL::to('/')}}/assets/js/custom/apps/user-management/users/list/table.js"></script>
<script>
$(document).ready(function () {
    var maxSelections = 4;
    let selectedOrder = []; 

    $('#membersSelect').select2({
        placeholder: "Select an option",
        multiple: true,
        closeOnSelect: false,
        sorter: function(data) {
            return data;
        }
    });

    function initializeSelectedOrder() {
        var initialValues = $('#membersSelect').val();
        if (initialValues) {
            selectedOrder = initialValues;
        }
        updateSelection();
    }

    function toggleOptions() {
        var options = $('#membersSelect option');
        if (selectedOrder.length >= maxSelections) {
            options.each(function () {
                if (!selectedOrder.includes($(this).val())) {
                    $(this).prop('disabled', true);
                }
            });
        } else {
            options.prop('disabled', false); 
        }
        $('#membersSelect').trigger('change');
    }

    $('#membersSelect').on('select2:select', function (e) {
        var selectedId = e.params.data.id;
        if (selectedOrder.length < maxSelections && !selectedOrder.includes(selectedId)) {
            selectedOrder.push(selectedId);
        } else {
            $('#membersSelect').val(selectedOrder).trigger('change');
        }
        updateSelection();
    });

    $('#membersSelect').on('select2:unselect', function (e) {
        var removedId = e.params.data.id;
        selectedOrder = selectedOrder.filter(id => id !== removedId);
        updateSelection();
    });

    function updateSelection() {
        $('#membersSelect').val(selectedOrder).trigger('change.select2');
        $('#membersOrder').val(selectedOrder.join(','));
        toggleOptions();
    }

    initializeSelectedOrder();
});
</script>
@endsection
