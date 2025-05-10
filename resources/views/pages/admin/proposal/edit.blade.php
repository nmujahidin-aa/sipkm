@extends('layouts.app')

@section('title', 'Review Proposal')
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
    <h1 class="d-flex flex-column text-dark fw-bolder fs-3 mb-0">Detail Pengajuan Proposal</h1>
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
        <li class="breadcrumb-item text-dark">
            Detail
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
                <a href="{{ route('admin.proposal.index') }}" class="btn btn-white">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div class="ms-3">
                    <h3 class="card-header-title mb-1">
                        <i class="bi-people me-2 fs-3"></i>
                        Detail Proposal
                    </h3>
                    <p class="mb-0">Kelompok {{isset($proposal) ? $proposal->team_name : '-'}}
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
                            <form action="{{route('admin.proposal.store')}}" method="POST">
                                @csrf
                                <div class="card pt-4 mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2>Data Proposal</h2>
                                        </div>
                                        <!--end::Card title-->
                                    </div>
                                    @if (isset($proposal))
                                        <input type="hidden" name="id" value="{{ $proposal->id }}" autocomplete="off">
                                    @endif
                                    <div class="card-body pt-5 pb-5">
                                        <div class="row mb-1 align-items-center">
                                            <label class="col-lg-3 col-form-label fw-bolder text-dark">Nama Tim</label>
                                            <div class="col-lg-9">
                                                {{isset($proposal) ? $proposal->team_name : '-'}}
                                            </div>
                                        </div>
                                        <div class="row mb-1 align-items-center">
                                            <label class="col-lg-3 col-form-label fw-bolder text-dark">Judul</label>
                                            <div class="col-lg-9">
                                                {{isset($proposal) ? $proposal->title : '-'}}
                                            </div>
                                        </div>
                                        <div class="row mb-1 align-items-center">
                                            <label class="col-lg-3 col-form-label fw-bolder text-dark">Skema</label>
                                            <div class="col-lg-9">
                                                PKM-{{isset($proposal) ? $proposal->scheme : '-'}}
                                            </div>
                                        </div>
                                        <div class="row mb-1 align-items-center">
                                            <label class="col-lg-3 col-form-label fw-bolder text-dark">Fakultas</label>
                                            <div class="col-lg-9">
                                                {{isset($proposal) ? $proposal->faculty->name : '-'}}
                                            </div>
                                        </div>
                                        <div class="row mb-1 align-items-center">
                                            <label class="col-lg-3 col-form-label fw-bolder text-dark">File Proposal</label>
                                            <div class="col-lg-9">
                                                @isset($proposal )
                                                    <div><a href="{{ asset('storage/' . $proposal->file) }}" target="_blank" class="badge badge-primary fw-bolder text-light">LIHAT FILE PROPOSAL <i class="bi bi-box-arrow-up-right fs-7 text-light fw-bolder" style="margin-left: 5px;"></i> </a></div>
                                                    <small class="text-primary"><b>Terakhir diperbarui: </b>{{ \App\Helpers\Timezone::display($proposal->updated_at, true) }}</small>
                                                @endisset
                                            </div>
                                        </div>
                                        @if (Auth::user()->current_role_id != 4)
                                        <div class="row mb-4 align-items-center">
                                            <label class="col-lg-3 col-form-label fw-bolder text-dark">Status</label>
                                            <div class="col-lg-9">
                                                <select name="status" class="form-select @error('status') is-invalid @enderror rounded-end-0" data-control="select2" data-placeholder="Pilih Status">
                                                    <option value="">Pilih Status</option>
                                                    @foreach ($status as $key => $label)
                                                        <option value="{{ $key }}" {{ old('status') == $key || (isset($proposal) && $proposal->status == $key) ? 'selected' : '' }}>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">@error('status') {{ $message }} @enderror</div>
                                            </div>
                                        </div>
                                        <!-- <div class="row mb-1 align-items-center">
                                            <label class="col-lg-3 col-form-label fw-bolder text-dark">Status</label>
                                            <div class="col-lg-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status" id="reviewed" value="reviewed" {{ isset($proposal->status) && $proposal->status == 'reviewed' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="reviewed">Tahap Review</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status" id="accepted" value="accepted" {{ isset($proposal->status) && $proposal->status == 'accepted' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="accepted">Lolos</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status" id="rejected" value="rejected" {{ isset($proposal->status) && $proposal->status == 'rejected' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="rejected">Tidak Lolos</label>
                                                </div>
                                            </div>
                                        </div> -->
                                        @endif
                                    </div>
                                    <!--end::Card body-->
                                    <div class="card-footer text-end">
                                        @if (Auth::user()->current_role_id != 4)
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        @endif
                                    </div>
                                </div>
                            </form>
                            <!--end::Card-->

                            @isset($proposal)
                            <!--begin::Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title flex-column">
                                        <h2>Data Anggota</h2>
                                        <div class="fs-6 fw-bold text-muted">Berikut merupakan detail anggota tim {{$proposal ? $proposal->team_name : '-'}}</div>
                                    </div>
                                    <!--end::Card title-->
                                </div>

                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body">
                                    <div class="d-flex flex-wrap align-items-start row">
                                        <label class="form-check-label col-lg-6 col-sm-12">
                                            <div class="fw-bolder mb-3">Ketua Tim</div>
                                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <!--begin:: Avatar -->
                                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                        <a href="#">
                                                            <div class="symbol-label">
                                                                <img src="{{$proposal->leader->getPhoto()}}" alt="{{$proposal->leader->name}}" style="object-fit: cover; object-position: top; width: 100%; height: 100%; display: block;"/>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <!--end::Avatar-->
                                                    <!--begin::User details-->
                                                    <div class="d-flex flex-column" style="line-height: 1.2;">
                                                        <div class="text-gray-800 fw-bold mb-1" style="margin-bottom: 0.25rem !important;">
                                                            {{$proposal->leader->name}}
                                                        </div>
                                                        <small class="text-muted" style="font-size: 12px; margin-bottom: 0.25rem !important;">NIM. {{$proposal->leader->nim ?: '-'}}</small>
                                                        <div class="d-flex flex-wrap gap-1 mt-1">
                                                            <span class="badge fw-bolder text-{{$proposal->leader->faculty->theme()}}"
                                                                style="background-color: {{$proposal->leader->faculty->color}}; font-size: 10px; padding: 0.25rem 0.5rem;">
                                                                {{$proposal->leader->faculty->short_name}}
                                                            </span> |
                                                            <span class="badge fw-bolder text-{{$proposal->leader->faculty->theme()}}"
                                                                style="background-color: {{$proposal->leader->faculty->color}}; font-size: 10px; padding: 0.25rem 0.5rem;">
                                                                {{$proposal->leader->studyProgram->name}}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <!--begin::User details-->
                                                </div>
                                            </div>
                                        </label>
                                        <label class="form-check-label col-lg-6 col-sm-12">
                                            <div class="fw-bolder mb-3">Dosen Pendamping</div>
                                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <!--begin:: Avatar -->
                                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                        <a href="#">
                                                            <div class="symbol-label">
                                                                <img src="{{$proposal->advisor->user->getPhoto()}}" alt="{{$proposal->advisor->user->name}}" style="object-fit: cover; object-position: top; width: 100%; height: 100%; display: block;"/>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <!--end::Avatar-->
                                                    <!--begin::User details-->
                                                    <div class="d-flex flex-column" style="line-height: 1.2;">
                                                        <div class="text-gray-800 fw-bold mb-1" style="margin-bottom: 0.25rem !important;">
                                                            {{$proposal->advisor->user->name}}
                                                        </div>
                                                        <small class="text-muted" style="font-size: 12px; margin-bottom: 0.25rem !important;">
                                                            @if ($proposal->advisor->user->nidn)
                                                                NIDN. {{ $proposal->advisor->user->nidn }}
                                                            @elseif ($proposal->advisor->user->nuptk)
                                                                NUPTK. {{ $proposal->advisor->user->nuptk }}
                                                            @else
                                                                <small class="text-danger">NIDN/NUPTK belum diatur</small>
                                                            @endif
                                                        </small>
                                                        <div class="d-flex flex-wrap gap-1 mt-1">
                                                            <span class="badge fw-bolder text-{{$proposal->advisor->user->faculty->theme()}}"
                                                                style="background-color: {{$proposal->advisor->user->faculty->color}}; font-size: 10px; padding: 0.25rem 0.5rem;">
                                                                {{$proposal->advisor->user->faculty->short_name}}
                                                            </span> |
                                                            <span class="badge fw-bolder text-{{$proposal->advisor->user->faculty->theme()}}"
                                                                style="background-color: {{$proposal->advisor->user->faculty->color}}; font-size: 10px; padding: 0.25rem 0.5rem;">
                                                                {{$proposal->advisor->user->studyProgram->name}}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <!--begin::User details-->
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    <div class='separator separator-dashed my-5'></div>
                                    <div class="d-flex flex-wrap align-items-start row">
                                        @foreach ($proposal->members as $index => $member)
                                        <label class="form-check-label col-lg-6 col-sm-12">
                                            <div class="fw-bolder mb-3">Anggota {{$index+=1}}</div>
                                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <!--begin:: Avatar -->
                                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                        <a href="#">
                                                            <div class="symbol-label">
                                                                <img src="{{$member->user->getPhoto()}}" alt="{{$member->user->name}}" style="object-fit: cover; object-position: top; width: 100%; height: 100%; display: block;"/>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <!--end::Avatar-->
                                                    <!--begin::User details-->
                                                    <div class="d-flex flex-column" style="line-height: 1.2;">
                                                        <div class="text-gray-800 fw-bold mb-1" style="margin-bottom: 0.25rem !important;">
                                                            {{$member->user->name ?: '-'}}
                                                        </div>
                                                        <small class="text-muted" style="font-size: 12px; margin-bottom: 0.25rem !important;">NIM. {{$member->user->nim ?: '-'}}</small>
                                                        <div class="d-flex flex-wrap gap-1 mt-1">
                                                            @if($member->user->faculty && $member->user->studyProgram)
                                                            <span class="badge fw-bolder text-{{$member->user->faculty->theme()}}"
                                                                style="background-color: {{$member->user->faculty->color}}; font-size: 10px; padding: 0.25rem 0.5rem;">
                                                                {{$member->user->faculty->short_name}}
                                                            </span> |
                                                            <span class="badge fw-bolder text-{{$member->user->faculty->theme()}}"
                                                                style="background-color: {{$member->user->faculty->color}}; font-size: 10px; padding: 0.25rem 0.5rem;">
                                                                {{$member->user->studyProgram->name}}
                                                            </span>
                                                            @else
                                                            <span class="badge fw-bolder text-danger"
                                                                style="background-color: white; font-size: 10px; padding: 0.25rem 0.5rem;">
                                                                -
                                                            </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!--begin::User details-->
                                                </div>
                                            </div>
                                        </label>
                                        @endforeach
                                    </div>

                                    <div class="d-flex flex-wrap align-items-start row">
                                        <label class="form-check-label col-12">
                                            <div class="fw-bolder mb-3">Catatan</div>
                                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <p class="text-danger">{{$proposal->note}}</p>
                                                </div>
                                            </div>
                                        </label>
                                    </div>

                                
                                    @if(in_array($proposal->status, ['upload', 'reserve', 'funded', 'pimnas']))
                                        <div class="row flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visible">
                                            @php
                                                $filePath = $proposal->commitment->leader ?? null;
                                                $fileUrl = $filePath ? asset('storage/'.$filePath) : null;
                                            @endphp
                                            <div class="col-xl col-12 mb-3">
                                            <div class="border border-gray-300 border-dashed rounded min-w-200px h-100 p-3 position-relative {{ $fileUrl ? 'clickable-card' : '' }}"
                                                style="cursor: {{ $fileUrl ? 'pointer' : 'default' }};"
                                                @if($fileUrl) onclick="window.open('{{ $fileUrl }}', '_blank')" @endif>
                                                
                                                <!-- Konten utama -->
                                                <div class="text-center py-2">
                                                    <i class="bi bi-person-badge fs-1 {{ $filePath ? 'text-success' : 'text-danger' }}"></i>
                                                    <div class="mt-2 {{ $filePath ? 'text-success' : 'text-danger' }} fw-bold">
                                                        Ketua Tim
                                                    </div>
                                                    <small class="text-muted">{{ $filePath ? 'Sudah Upload' : 'Belum Upload' }}</small>
                                                </div>
                                                
                                                <!-- Indicator untuk file yang bisa diklik -->
                                                @if($filePath)
                                                    <div class="position-absolute bottom-0 end-0 p-2">
                                                        <i class="bi bi-box-arrow-up-right text-primary"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    
                                        @foreach($proposal->members as $index => $member)
                                            @php
                                                $memberIndex = $index + 1;
                                                $filePath = $proposal->commitment->{'member_'.$memberIndex} ?? null;
                                                $fileUrl = $filePath ? asset('storage/'.$filePath) : null;
                                            @endphp
                                            <div class="col-xl col-12 mb-3">
                                                <div class="border border-gray-300 border-dashed rounded min-w-200px h-100 p-3 position-relative {{ $fileUrl ? 'clickable-card' : '' }}"
                                                    style="cursor: {{ $fileUrl ? 'pointer' : 'default' }};"
                                                    @if($fileUrl) onclick="window.open('{{ $fileUrl }}', '_blank')" @endif>
                                                    
                                                    <!-- Konten utama -->
                                                    <div class="text-center py-2">
                                                        <i class="bi bi-people fs-1 {{ $filePath ? 'text-success' : 'text-danger' }}"></i>
                                                        <div class="mt-2 {{ $filePath ? 'text-success' : 'text-danger' }} fw-bold">
                                                            Anggota {{ $memberIndex }}
                                                        </div>
                                                        <small class="text-muted">{{ $filePath ? 'Sudah Upload' : 'Belum Upload' }}</small>
                                                    </div>
                                                    
                                                    <!-- Indicator untuk file yang bisa diklik -->
                                                    @if($filePath)
                                                        <div class="position-absolute bottom-0 end-0 p-2">
                                                            <i class="bi bi-box-arrow-up-right text-primary"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                        </div>
                                    @endif
                                
                                    
                                </div>
                                <!--end::Card body-->
                                <!--begin::Card footer-->
                                <!--end::Card footer-->
                            </div>
                            @endisset

                            @isset($proposal)
                            <div class="alert alert-success fade show mb-5 d-flex align-items-center" role="alert">
                                <i class="bi bi-info-circle fs-1 me-3 alert-heading"></i>
                                <div>
                                    <h4 class="alert-heading mb-1">Fitur Log Catatan</h4>
                                    <p class="mb-0">Fitur ini memudahkan Dosen Pendamping / Dosen Penalaran / PKM Center dalam memberikan catatan, evaluasi, atau instruksi kepada kelompok {{isset($proposal) ? $proposal->team_name : '-'}} secara terstruktur.</p>
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
                                        <div class="d-flex justify-content-end align-items-center" data-kt-user-table-toolbar="base">
                                            <a href="{{route('admin.proposal.review', $proposal->id)}}" class="btn btn-light-primary me-3 custom-input" data-kt-menu-placement="bottom-end">
                                                <span class="svg-icon svg-icon-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3" d="M11 13H7C6.4 13 6 12.6 6 12C6 11.4 6.4 11 7 11H11V13ZM17 11H13V13H17C17.6 13 18 12.6 18 12C18 11.4 17.6 11 17 11Z" fill="black"/>
                                                        <path d="M21 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H21C21.6 2 22 2.4 22 3V21C22 21.6 21.6 22 21 22ZM17 11H13V7C13 6.4 12.6 6 12 6C11.4 6 11 6.4 11 7V11H7C6.4 11 6 11.4 6 12C6 12.6 6.4 13 7 13H11V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V13H17C17.6 13 18 12.6 18 12C18 11.4 17.6 11 17 11Z" fill="black"/>
                                                    </svg>
                                                </span>
                                                Tambah Catatan
                                            </a>
                                        </div>
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
                                                <th class="w-150px">File</th>
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
                                                    @if ($row->file)
                                                        <a href="{{ asset('storage/' . $row->file) }}" target="_blank" class="badge badge-primary fw-bolder text-light">LIHAT FILE <i class="bi bi-box-arrow-up-right fs-7 text-light fw-bolder" style="margin-left: 5px;"></i> </a>
                                                    @else
                                                        -
                                                    @endif
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
                                                    <a href="{{ route('admin.proposal.review', ['proposal_id'=>$row->proposal_id, 'id'=>$row->id]) }}" class="btn btn-sm btn-primary"><i class="bi @if ($row->status == 0) bi-pencil-square @else bi-eye @endif"></i></a>
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
@endsection
