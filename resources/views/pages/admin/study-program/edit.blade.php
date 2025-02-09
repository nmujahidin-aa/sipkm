@extends('layouts.app')

@section('title')
    {{ isset($studyPrograms) ? 'Ubah Program Studi: ' . $studyPrograms->name : 'Tambah Program Studi' }}
@endsection

@section('style')
<style>
    .fixed-width-30 {
        width: 20%;
    }
    .fixed-width-70 {
        width: 80%;
    }
</style>
@endsection

@section('breadcumb')
<div class="page-title d-flex flex-column me-5">
    <!--begin::Title-->
    <h1 class="d-flex flex-column text-dark fw-bolder fs-3 mb-0">Data Program Studi</h1>
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
            <a href="{{route('admin.study-program.index')}}" class="text-muted text-hover-primary">Data Program Studi</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">
            {{ isset($studyPrograms) ? 'Ubah Data Program Studi: ' : 'Tambah Program Studi' }}
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
                <a href="{{ route('admin.study-program.index') }}" class="btn btn-white">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div class="ms-3">
                    <h3 class="card-header-title mb-1">
                        <i class="bi-people me-2 fs-3"></i>
                        {{ isset($studyPrograms) ? 'Ubah' : 'Tambah' }} Program Studi
                    </h3>
                    <p class="mb-0">Mohon isi data dengan benar dan teliti</p>
                </div>
            </div>

            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row">
                <!--begin::Sidebar-->
                <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
                    <!--begin::Card-->
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="fw-bolder m-0">Mohon Diperhatikan !</h3>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-2">
                            <!--begin::Notice-->
                            <div class="notice d-flex bg-light-danger rounded border-danger border border-dashed mb-9 p-6">
                                <!--begin::Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/art/art006.svg-->
                                <span class="svg-icon svg-icon-1tx svg-icon-danger me-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M5.78001 21.115L3.28001 21.949C3.10897 22.0059 2.92548 22.0141 2.75004 21.9727C2.57461 21.9312 2.41416 21.8418 2.28669 21.7144C2.15923 21.5869 2.06975 21.4264 2.0283 21.251C1.98685 21.0755 1.99507 20.892 2.05201 20.7209L2.886 18.2209L7.22801 13.879L10.128 16.774L5.78001 21.115Z" fill="black"/>
                                        <path d="M21.7 8.08899L15.911 2.30005C15.8161 2.2049 15.7033 2.12939 15.5792 2.07788C15.455 2.02637 15.3219 1.99988 15.1875 1.99988C15.0531 1.99988 14.92 2.02637 14.7958 2.07788C14.6717 2.12939 14.5589 2.2049 14.464 2.30005L13.74 3.02295C13.548 3.21498 13.4402 3.4754 13.4402 3.74695C13.4402 4.01849 13.548 4.27892 13.74 4.47095L14.464 5.19397L11.303 8.35498C10.1615 7.80702 8.87825 7.62639 7.62985 7.83789C6.38145 8.04939 5.2293 8.64265 4.332 9.53601C4.14026 9.72817 4.03256 9.98855 4.03256 10.26C4.03256 10.5315 4.14026 10.7918 4.332 10.984L13.016 19.667C13.208 19.859 13.4684 19.9668 13.74 19.9668C14.0115 19.9668 14.272 19.859 14.464 19.667C15.3575 18.77 15.9509 17.618 16.1624 16.3698C16.374 15.1215 16.1932 13.8383 15.645 12.697L18.806 9.53601L19.529 10.26C19.721 10.452 19.9814 10.5598 20.253 10.5598C20.5245 10.5598 20.785 10.452 20.977 10.26L21.7 9.53601C21.7952 9.44108 21.8706 9.32825 21.9221 9.2041C21.9737 9.07995 22.0002 8.94691 22.0002 8.8125C22.0002 8.67809 21.9737 8.54505 21.9221 8.4209C21.8706 8.29675 21.7952 8.18392 21.7 8.08899Z" fill="black"/>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <!--end::Icon-->
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-grow-1">
                                    <!--begin::Content-->
                                    <div class="fw-bold">
                                        <div class="fs-6 text-gray-700">Isi data dengan benar dan teliti. Pastikan nama prodi, dan singkatan prodi sudah sesuai dengan data di SIAKAD.</div>
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Notice-->
                            <div><span class="text-danger">*</span> Wajib diisi</div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Connected Accounts-->
                </div>
                <!--end::Sidebar-->

                <!--begin::Content-->
                <div class="flex-lg-row-fluid ms-lg-15">
                    <!--begin:::Tab content-->
                    <div class="tab-content" id="myTabContent">
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade show active" id="kt_user_view_overview_security" role="tabpanel">
                            <!--begin::Card-->
                            <form action="{{route('admin.study-program.store')}}" method="POST">
                                @csrf
                                <div class="card pt-4 mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2>Data Program Studi</h2>
                                        </div>
                                        <!--end::Card title-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0 pb-5">
                                        <!--begin::Table wrapper-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table align-middle gy-3" id="kt_table_users_login_session">
                                                <!--begin::Table body-->
                                                <tbody class="fs-6 fw-bold text-gray-600">
                                                    @if (isset($studyPrograms))
                                                        <input type="hidden" name="id" value="{{ $studyPrograms->id }}" autocomplete="off">
                                                    @endif

                                                    <tr>
                                                        <td class="fixed-width-30">Fakultas <span class="text-danger">*</span></td>
                                                        <td class="fixed-width-70">
                                                            <select name="faculty_id" class="form-select @error('faculty_id') is-invalid @enderror" data-control="select2" data-placeholder="Select an option">
                                                                <option></option>
                                                                @foreach ($faculties as $faculty)
                                                                    <option value="{{ $faculty->id }}" {{ old('faculty_id') == $faculty->id || (isset($studyPrograms) && $studyPrograms->faculty_id == $faculty->id) ? 'selected' : '' }}>
                                                                        {{ $faculty->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                @error('faculty_id')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="fixed-width-30">Nama <span class="text-danger">*</span></td>
                                                        <td class="fixed-width-70">
                                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ? old('name') : (isset($studyPrograms) ? $studyPrograms->name : '') }}" placeholder="Contoh: S1 Pendidikan Teknik Informatika">
                                                            <div class="invalid-feedback">
                                                                @error('name')
                                                                {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fixed-width-30">Singakatan Nama <span class="text-danger">*</span></td>
                                                        <td class="fixed-width-70">
                                                            <input type="text" name="short_name" class="form-control @error('short_name') is-invalid @enderror" value="{{ old('short_name') ? old('short_name') : (isset($studyPrograms) ? $studyPrograms->short_name : '') }}" placeholder="Contoh: PTI">
                                                            <div class="invalid-feedback">
                                                                @error('short_name')
                                                                {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Table wrapper-->
                                    </div>
                                    <!--end::Card body-->
                                    <div class="card-footer text-end">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
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

