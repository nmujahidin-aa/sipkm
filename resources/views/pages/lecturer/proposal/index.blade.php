@extends('layouts.app')
@section('title', 'Data Proposal | SIPKM UM')
@section('style')
<style>
    #kt_explore {
        height: 100vh; /* Tinggi penuh viewport */
        display: flex;
        flex-direction: column;
    }

    /* Card */
    .card-custom {
        display: flex;
        flex-direction: column;
        height: 100%; /* Tinggi penuh container */
    }

    /* Card Header */
    .card-header {
        flex-shrink: 0; /* Header tidak akan menyusut */
    }

    /* Card Body */
    .card-body {
        flex: 1; /* Body akan mengambil sisa ruang yang tersedia */
        overflow-y: auto; /* Aktifkan scroll vertikal */
        padding: 0; /* Hapus padding default */
    }

    /* Scrollable Content */
    #kt_explore_scroll {
        height: 100%; /* Tinggi penuh card-body */
        overflow-y: auto; /* Aktifkan scroll vertikal */
        padding: 1.25rem; /* Tambahkan padding untuk konten */
    }

    /* Card Footer */
    .card-footer {
        flex-shrink: 0; /* Footer tidak akan menyusut */
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
        <li class="breadcrumb-item text-dark">Data Proposal Bimbingan</li>
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
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center mb-3">
                    <div class="ms-3">
                        <h3 class="card-header-title mb-1">
                            Riwayat Proposal Bimbingan
                        </h3>
                        <p class="mb-0">Berikut merupakan list proposal bimbingan anda</p>
                    </div>
                </div>
            </div>
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Cari Proposal" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end align-items-center" data-kt-user-table-toolbar="base">
                            <!--begin::Filter Skema-->
                            <button type="button" id="kt_explore_toggle" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="black"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->Filter
                            </button>
                            <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_export_users">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="black"></rect>
                                        <path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="black"></path>
                                        <path d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="#C4C4C4"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->Ekspor
                            </button>
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Group actions-->
                        <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                            <div class="fw-bolder me-5">
                                <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected
                            </div>
                            <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Delete Selected</button>
                        </div>
                    </div>
                    <!--end::Card toolbar-->
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
                                <th class="w-250px">Ketua Tim</th>
                                <th class="min-w-500px">Judul</th>
                                <th class="w-150px">Skema</th>
                                <th class="w-150px">Status</th>
                                <th class="w-100px">Aksi</th>
                                <th></th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="text-gray-600 fw-bold">
                            @foreach ($proposal as $index => $row)
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::User=-->
                                <td class="d-flex align-items-center">
                                    <!--begin::User details-->
                                    <div class="d-flex flex-column" style="line-height: 1.2;">
                                        <a href="#" class="text-gray-800 text-hover-primary fw-bold mb-1" style="margin-bottom: 0.25rem !important;">
                                            {{$row->leader->name}}
                                        </a>
                                        <small class="text-muted" style="font-size: 12px; margin-bottom: 0.25rem !important;">NIM. {{$row->leader->nim ?: '-'}}</small>
                                        <div class="d-flex flex-wrap gap-1 mt-1">
                                            <span class="badge fw-bolder text-{{$row->leader->faculty->theme()}}"
                                                style="background-color: {{$row->leader->faculty->color}}; font-size: 10px; padding: 0.25rem 0.5rem;">
                                              {{$row->leader->studyProgram->name}}
                                          </span>
                                        </div>
                                    </div>
                                    <!--begin::User details-->
                                </td>
                                <td>
                                    <div class="d-flex flex-column" style="line-height: 1.2;">
                                        <span class="text-dark" style="margin-bottom: 0.25rem !important;">{{$row->title}}</span>
                                        <small>Pendamping:
                                            @if (isset($advisor[$row->id]) && $advisor[$row->id]->isNotEmpty())
                                                @php $advisorData = $advisor[$row->id]->first(); @endphp
                                                {{ $advisorData->user->name ?? 'Tidak ada advisor' }} - {{ $advisorData->user->nidn ?? ' NIDN belum diatur ' }}
                                            @else
                                                <small class="text-danger">Belum diatur</small>
                                            @endif
                                        </small>
                                    </div>
                                </td>

                                <td>
                                    PKM-{{$row->scheme}}
                                </td>

                                <td>
                                    <div class="mb-3">
                                        @if ($row->status == 'reviewed')
                                            <span class="badge badge-primary">Ditinjau</span>
                                        @elseif ($row->status == 'accepted')
                                            <span class="badge badge-success">Lolos</span>
                                        @elseif ($row->status == 'rejected')
                                            <span class="badge badge-danger">Gagal</span>
                                        @endif
                                    </div>
                                </td>

                                <td>
                                    <a href="{{ route('dosen.proposal.edit', $row->id) }}" class="btn btn-sm btn-light btn-active-light-primary"><i class="bi bi-pencil"></i></a>
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
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--begin::Exolore drawer toggle-->
<!--begin::Exolore drawer-->
<div id="kt_explore" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="explore" data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'350px', 'lg': '475px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_explore_toggle" data-kt-drawer-close="#kt_explore_close">
    <!--begin::Card-->
    <div class="card card-custom shadow-none rounded-0 w-100">
        <!--begin::Header-->
        <div class="card-header" id="kt_explore_header">
            <h3 class="card-title fw-bolder text-gray-700">Filter Data</h3>
            <div class="card-toolbar">
                <button type="button" class="btn btn-sm btn-icon btn-active-light-primary me-n5" id="kt_explore_close">
                    <!-- Icon close -->
                </button>
            </div>
        </div>
        <!--end::Header-->

        <!--begin::Body-->
        <div class="card-body" id="kt_explore_body">
            <!--begin::Content-->
            <div id="kt_explore_scroll" class="scroll-y me-n5 pe-5">
                <div>
                    Skema
                </div>
            </div>
            <!--end::Content-->
        </div>
        <!--end::Body-->

        <!--begin::Footer-->
        <div class="card-footer">
            <div class="d-flex justify-content-end">
                <button type="reset" class="btn btn-light btn-active-light-primary me-2" id="kt_explore_reset">Reset</button>
                <button type="submit" class="btn btn-primary" id="kt_explore_submit">Terapkan</button>
            </div>
        </div>
        <!--end::Footer-->
    </div>
    <!--end::Card-->
</div>
<!--end::Exolore drawer-->
<form id="frmDelete" method="POST">
    @csrf
    @method('DELETE')
    <input type="hidden" name="id"/>
</form>
@endsection


@section('script')
<script src="{{URL::to('/')}}/assets/plugins/custom/datatables/datatables.bundle.js"></script>
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{URL::to('/')}}/assets/js/custom/apps/user-management/users/list/table.js"></script>

@endsection
