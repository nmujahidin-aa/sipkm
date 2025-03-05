@extends('layouts.app')
@section('title', 'Data Dosen | SIPKM UM')
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
    <h1 class="d-flex flex-column text-dark fw-bolder fs-3 mb-0">Data Dosen</h1>
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
        <li class="breadcrumb-item text-dark">Data Dosen</li>
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
                <!--begin::Card header-->
                <x-organisms.card-header filter="true" add="true" addHref="{{ route('admin.lecturer.edit') }}" />
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <div id="lecturersTable">
                        @include('pages.admin.lecturer.table')
                    </div>
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
                    <span class="text-cap fw-bold fs-6">Role</span>
                    <div class="d-grid gap-2" id="filter_role_container">
                        <div class="form-check">
                            <input type="radio" name="filter_role" id="filter_role_dosen" value="{{ \App\Enums\RoleEnum::DOSEN }}" class="form-check-input form-check-input-sm">
                            <label class="form-check-label" for="filter_role_dosen">Dosen</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="filter_role" id="filter_role_penalaran" value="{{ \App\Enums\RoleEnum::PENALARAN }}" class="form-check-input form-check-input-sm">
                            <label class="form-check-label" for="filter_role_penalaran">Dosen Penalaran</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="filter_role" id="filter_role_administrator" value="{{ \App\Enums\RoleEnum::ADMINISTRATOR }}" class="form-check-input form-check-input-sm">
                            <label class="form-check-label" for="filter_role_administrator">Administrator</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="filter_role" id="filter_role_all" value="all" class="form-check-input form-check-input-sm" checked>
                            <label class="form-check-label" for="filter_role_all">Semua</label>
                        </div>
                    </div>
                </div>

                <div class="separator my-8"></div>

                <div class="d-grid gap-2 mb-2">
                    <span class="text-cap fw-bold fs-6">Fakultas</span>
                    <div class="d-grid gap-2" id="filter_faculty_container">
                        <!-- Opsi "Semua Fakultas" -->
                        <div class="form-check">
                            <input type="radio" name="filter_faculty" id="filter_faculty_all" value="all"
                                   class="form-check-input form-check-input-sm"
                                   {{ request('filter_faculty') === 'all' || !request('filter_faculty') ? 'checked' : '' }}>
                            <label class="form-check-label" for="filter_faculty_all">Semua Fakultas</label>
                        </div>

                        <!-- Opsi Fakultas -->
                        @foreach ($faculty as $index => $row)
                        <div class="form-check">
                            <input type="radio" name="filter_faculty" id="filter_faculty_{{$row->id}}" value="{{$row->id}}"
                                   class="form-check-input form-check-input-sm"
                                   {{ request('filter_faculty') == $row->id ? 'checked' : '' }}>
                            <label class="form-check-label" for="filter_faculty_{{$row->id}}">{{$row->name}}</label>
                        </div>
                        @endforeach
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

<form id="frmDelete" method="POST">
    @csrf
    @method('DELETE')
    <input type="hidden" name="id"/>
</form>
@endsection


@section('script')
{{-- <script src="{{URL::to('/')}}/assets/plugins/custom/datatables/datatables.bundle.js"></script> --}}
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{URL::to('/')}}/assets/js/custom/apps/user-management/users/list/table.js"></script>
<script src="{{URL::to('/')}}/assets/js/custom/apps/user-management/users/list/export-users.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function(){
        $(document).on("click", ".btn-delete", function(){
            let id = $(this).data("id");

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan. Apakah Anda tetap ingin melanjutkan?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#frmDelete").attr("action", "{{ route('admin.lecturer.single_destroy', '_id_') }}".replace("_id_", id));
                    $("#frmDelete").find('input[name="id"]').val(id);
                    $("#frmDelete").submit();
                }
            })
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Ambil parameter filter dari URL
        const urlParams = new URLSearchParams(window.location.search);

        // Atur radio button role
        const selectedRole = urlParams.get('filter_role');
        if (selectedRole) {
            $(`input[name="filter_role"][value="${selectedRole}"]`).prop('checked', true);
        }

        // Atur radio button faculty
        const selectedFaculty = urlParams.get('filter_faculty');
        if (selectedFaculty) {
            $(`input[name="filter_faculty"][value="${selectedFaculty}"]`).prop('checked', true);
        }

        // Fungsi untuk mengambil data dengan AJAX
        function fetchData(url) {
            $.ajax({
                url: url,
                success: function(data) {
                    $('#studentsTable').html(data); // Perbarui tabel dengan data baru
                }
            });
        }

        // AJAX Search
        $('#searchInput').on('keyup', function() {
            let search = $(this).val();
            let url = "{{ route('admin.student.index') }}?";
            const params = new URLSearchParams();

            const role = $('input[name="filter_role"]:checked').val();
            if (role && role !== 'all') {
                params.append('filter_role', role);
            }

            const facultyId = $('input[name="filter_faculty"]:checked').val();
            if (facultyId && facultyId !== 'all') {
                params.append('filter_faculty', facultyId);
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
            const role = $('input[name="filter_role"]:checked').val();
            if (role && role !== 'all') {
                params.set('filter_role', role);
            }

            const facultyId = $('input[name="filter_faculty"]:checked').val();
            if (facultyId && facultyId !== 'all') {
                params.set('filter_faculty', facultyId);
            }

            // Update URL dengan parameter filter
            url = url.split('?')[0] + '?' + params.toString();
            fetchData(url);
        });

        // Submit Filter
        $('#kt_explore_submit').on('click', function() {
            // Ambil data dari form
            const role = $('input[name="filter_role"]:checked').val();
            const facultyId = $('input[name="filter_faculty"]:checked').val();

            // Redirect ke route admin.lecturer.index dengan parameter filter
            const url = "{{ route('admin.lecturer.index') }}";
            const params = new URLSearchParams({
                filter_role: role,
                filter_faculty: facultyId,
            });

            window.location.href = `${url}?${params.toString()}`;
        });

        // Reset Filter
        $('#kt_explore_reset').on('click', function() {
            // Redirect ke route admin.lecturer.index tanpa parameter filter
            const url = "{{ route('admin.lecturer.index') }}";
            window.location.href = url;
        });
    });
</script>
@endsection
