@extends('layouts.app')
@section('title', 'Data Proposal | SIPKM UM')
@section('style')
<link href="{{URL::to('/')}}/assets/css/custom.css" rel="stylesheet" type="text/css" />
<style>
    .form-check {
        display: flex;
        align-items: center
    }

    .form-check-input {
        align-self: center;
    }
    .form-check-input-sm {
        width: 1.2rem;
        height: 1.2rem;
        margin-right: 0.5rem;
    }

    .form-checkbox-input-sm {
        width: 1.2rem;
        height: 1.2rem;
        margin-right: 0.5rem;
        border-radius: 0;
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
        <li class="breadcrumb-item text-dark">Data Proposal</li>
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
            <div class="card">
                <x-organisms.card-header filter="true" export="true" btnExport="{{ route('admin.proposal.export', request()->query()) }}" />
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <div id="proposalTable">
                        @include('pages.admin.proposal.table')
                    </div>
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
                <div class="d-grid gap-2 mb-2">
                    <span class="text-cap fw-bold fs-6">Skema</span>
                    <div class="d-grid gap-2" id="filter_scheme_container" style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                        @foreach($scheme as $row)
                            <div class="form-check">
                                <input type="checkbox" name="filter_scheme" id="filter_scheme_{{ $row }}" value="{{ $row }}" class="form-check-input form-checkbox-input-sm">
                                <label class="form-check-label" for="filter_scheme_{{ $row }}">PKM-{{ $row }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="separator my-8"></div>

                <div class="d-grid gap-2 mb-2">
                    <span class="text-cap fw-bold fs-6">Status</span>
                    <div class="d-grid gap-2" id="filter_status_container">

                        <div class="form-check">
                            <input type="radio" name="filter_status" id="filter_status_reviewed" value="reviewed" class="form-check-input form-check-input-sm">
                            <label class="form-check-label" for="filter_status_reviewed">Ditinjau</label>
                        </div>

                        <!-- Opsi Accepted -->
                        <div class="form-check">
                            <input type="radio" name="filter_status" id="filter_status_accepted" value="accepted" class="form-check-input form-check-input-sm">
                            <label class="form-check-label" for="filter_status_accepted">Lolos</label>
                        </div>

                        <!-- Opsi Rejected -->
                        <div class="form-check">
                            <input type="radio" name="filter_status" id="filter_status_rejected" value="rejected" class="form-check-input form-check-input-sm">
                            <label class="form-check-label" for="filter_status_rejected">Tidak Lolos</label>
                        </div>

                        <div class="form-check">
                            <input type="radio" name="filter_status" id="filtr_status_all" value="all" class="form-check-input form-check-input-sm" checked>
                            <label class="form-check-label" for="filtr_status_all">Semua</label>
                        </div>
                    </div>
                </div>

                <div class="separator my-8"></div>

                <div class="d-grid gap-2 mb-2">
                    <span class="text-cap fw-bold fs-6">Fakultas</span>
                    <div class="d-grid gap-2" id="filter_faculty_container">
                        <!-- Select Option dengan opsi "Semua Fakultas" -->
                        <select name="filter_faculty" id="filter_faculty" class="form-select" data-control="select2">
                            <option value="all">Semua Fakultas</option> <!-- Opsi "Semua Fakultas" -->
                            @foreach($faculty as $row)
                                <option value="{{ $row->id }}">{{ $row->short_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
            <!--end::Content-->
        </div>
        <!--end::Body-->

        <!--begin::Footer-->
        <div class="card-footer">
            <div class="d-flex justify-content-end">
                <button type="reset" class="btn btn-light btn-active-light-primary me-2" id="kt_explore_reset">Reset Filter</button>
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
{{-- <script src="{{URL::to('/')}}/assets/plugins/custom/datatables/datatables.bundle.js"></script> --}}
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{URL::to('/')}}/assets/js/custom/apps/user-management/users/list/table.js"></script>

<script>
    $(document).ready(function() {
        // Ambil parameter filter dari URL
        const urlParams = new URLSearchParams(window.location.search);

        // Atur checkbox skema
        const selectedSchemes = urlParams.get('filter_scheme');
        if (selectedSchemes) {
            const schemesArray = selectedSchemes.split(','); // Ubah string menjadi array
            schemesArray.forEach(scheme => {
                $(`input[name="filter_scheme"][value="${scheme}"]`).prop('checked', true);
            });
        }

        // Atur dropdown fakultas
        const selectedFaculty = urlParams.get('filter_faculty');
        if (selectedFaculty) {
            $('#filter_faculty').val(selectedFaculty).trigger('change');
        }

        // Atur radio button status
        const selectedStatus = urlParams.get('filter_status');
        if (selectedStatus) {
            $(`input[name="filter_status"][value="${selectedStatus}"]`).prop('checked', true);
        }

        // Fungsi untuk mengambil data dengan AJAX
        function fetchData(url) {
            $.ajax({
                url: url,
                success: function(data) {
                    $('#proposalTable').html(data); // Hanya reload tabel tanpa mengubah URL
                }
            });
        }

        // AJAX Search
        $('#searchInput').on('keyup', function() {
            let search = $(this).val();
            let url = "{{ route('admin.proposal.index') }}?";
            const params = new URLSearchParams();

            // Tambahkan parameter filter
            const schemes = [];
            $('input[name="filter_scheme"]:checked').each(function() {
                schemes.push($(this).val());
            });
            if (schemes.length > 0) {
                params.append('filter_scheme', schemes.join(','));
            }

            const facultyId = $('#filter_faculty').val();
            if (facultyId) {
                params.append('filter_faculty', facultyId);
            }

            const status = $('input[name="filter_status"]:checked').val();
            if (status) {
                params.append('filter_status', status);
            }

            // Tambahkan parameter search
            if (search) {
                params.append('search', search);
            }

            url += params.toString();
            fetchData(url);
        });

        // AJAX Pagination
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            let url = $(this).attr('href');
            const params = new URLSearchParams(url.split('?')[1]);

            // Tambahkan parameter filter ke URL pagination
            const schemes = [];
            $('input[name="filter_scheme"]:checked').each(function() {
                schemes.push($(this).val());
            });
            if (schemes.length > 0) {
                params.set('filter_scheme', schemes.join(','));
            }

            const facultyId = $('#filter_faculty').val();
            if (facultyId) {
                params.set('filter_faculty', facultyId);
            }

            const status = $('input[name="filter_status"]:checked').val();
            if (status) {
                params.set('filter_status', status);
            }

            // Update URL dengan parameter filter
            url = url.split('?')[0] + '?' + params.toString();
            fetchData(url);
        });

        // Submit Filter
        $('#kt_explore_submit').on('click', function() {
            // Ambil data dari form
            const schemes = [];
            $('input[name="filter_scheme"]:checked').each(function() {
                schemes.push($(this).val());
            });

            const facultyId = $('#filter_faculty').val();
            const status = $('input[name="filter_status"]:checked').val();

            // Redirect ke route admin.proposal.index dengan parameter filter
            const url = "{{ route('admin.proposal.index') }}";
            const params = new URLSearchParams({
                filter_scheme: schemes.join(','), // Gabungkan skema menjadi string
                filter_faculty: facultyId,
                filter_status: status,
            });

            window.location.href = `${url}?${params.toString()}`;
        });

        // Reset Filter
        $('#kt_explore_reset').on('click', function() {
            // Redirect ke route admin.proposal.index tanpa parameter filter
            const url = "{{ route('admin.proposal.index') }}";
            window.location.href = url;
        });
    });
</script>
@endsection
