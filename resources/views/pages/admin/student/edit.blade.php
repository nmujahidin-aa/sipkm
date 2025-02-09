@extends('layouts.app')

@section('title')
    {{ isset($students) ? 'Ubah Mahasiswa: ' . $students->name : 'Tambah Mahasiswa' }}
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
    <h1 class="d-flex flex-column text-dark fw-bolder fs-3 mb-0">Data Mahasiswa</h1>
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
            <a href="{{route('admin.student.index')}}" class="text-muted text-hover-primary">Data Mahasiswa</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">
            {{ isset($students) ? 'Ubah Data Mahasiswa: ' : 'Tambah Mahasiswa' }}
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
                <a href="{{ route('admin.student.index') }}" class="btn btn-white">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div class="ms-3">
                    <h3 class="card-header-title mb-1">
                        <i class="bi-people me-2 fs-3"></i>
                        {{ isset($students) ? 'Ubah' : 'Tambah' }} Mahasiswa
                    </h3>
                    <p class="mb-0">Mohon isi data dengan benar dan teliti</p>
                </div>
            </div>

            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row">
                <!--begin::Sidebar-->
                <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
                    <!--begin::Card-->

                    @isset($students)
                    <div class="card mb-5 mb-xl-8 pt-4">
                        <div class="card-header">
                            <div class="card-title" style="display: block;">
                                <h3 class=""><b>Foto Mahasiswa</b></h3>
                                <small class="d-block text-muted mt-1">Foto ini akan digunakan sebagai foto profil Mahasiswa</small>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-center flex-column py-5">
                                <div class="symbol symbol-100px mb-7" style="position: relative; overflow: hidden; width: 50%;">
                                    <img src="{{$students->getPhoto()}}" alt="image" style="object-fit: cover; object-position: top; width: 100%; height: 100%; display: block;"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endisset

                    <!--begin::Connected Accounts-->
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
                                        <div class="fs-6 text-gray-700">Isi data dengan benar dan teliti. Pastikan nama mahasiswa, NIM, dan program studi sudah sesuai dengan data di SIAKAD.</div>
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
                            <form action="{{route('admin.student.store')}}" method="POST">
                                @csrf
                                <div class="card pt-4 mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2>Data Mahasiswa</h2>
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
                                                    @if (isset($students))
                                                        <input type="hidden" name="id" value="{{ $students->id }}" autocomplete="off">
                                                    @endif
                                                    @if (!isset($students))
                                                        <input type="hidden" name="password" value="{{ bcrypt('12345678') }}" autocomplete="off">
                                                    @endif
                                                    <tr>
                                                        <td class="fixed-width-30">Nama Lengkap <span class="text-danger">*</span></td>
                                                        <td class="fixed-width-70">
                                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ? old('name') : (isset($students) ? $students->name : '') }}">
                                                            <div class="invalid-feedback">
                                                                @error('name')
                                                                {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fixed-width-30">NIM <span class="text-danger">*</span></td>
                                                        <td class="fixed-width-70">
                                                            <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" value="{{ old('nim') ? old('nim') : (isset($students) ? $students->nim : '') }}">
                                                            <div class="invalid-feedback">
                                                                @error('nim')
                                                                {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fixed-width-30">Email <span class="text-danger">*</span></td>
                                                        <td class="fixed-width-70">
                                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') ? old('email') : (isset($students) ? $students->email : '') }}">
                                                            <div class="invalid-feedback">
                                                                @error('email')
                                                                {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fixed-width-30">Program Studi <span class="text-danger">*</span></td>
                                                        <td class="fixed-width-70">
                                                            <select name="study_program_id" class="form-select @error('study_program_id') is-invalid @enderror" data-control="select2" data-placeholder="Select an option">
                                                                <option></option>
                                                                @foreach ($studyPrograms as $program)
                                                                    <option value="{{ $program->id }}" {{ old('study_program_id') == $program->id || (isset($students) && $students->study_program_id == $program->id) ? 'selected' : '' }}>
                                                                        {{ $program->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                @error('study_program_id')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @if (Auth::user()->current_role_id == 1)
                                                    <tr>
                                                        <td class="fixed-width-30">Role <span class="text-secondary">(opsional)</span></td>
                                                        <td class="fixed-width-70">
                                                            <select name="roles[]" class="form-select @error('roles') is-invalid @enderror" data-control="select2" data-placeholder="Select an option" multiple="multiple">
                                                                <option></option>
                                                                @foreach ($roles as $role)
                                                                    <option value="{{ $role->id }}"
                                                                        {{ in_array($role->name, old('roles', isset($students) ? $students->roles->pluck('name')->toArray() : [])) ? 'selected' : '' }}>
                                                                        {{ $role->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                @error('roles')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    <tr>
                                                        <td class="fixed-width-30">Bank <span class="text-secondary">(opsional)</span></td>
                                                        <td class="fixed-width-70">
                                                            <div class="input-group">
                                                                <div class="fixed-width-30">
                                                                    <select name="bank_name" class="form-select @error('bank_name') is-invalid @enderror rounded-end-0" data-control="select2" data-placeholder="Pilih Bank">
                                                                        <option value="">Pilih Bank</option>
                                                                        @foreach ($banks as $bank)
                                                                            <option value="{{ $bank }}" {{ old('bank_name') == $bank || (isset($students) && $students->bank_name == $bank) ? 'selected' : '' }}>{{ $bank }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <input type="text" name="bank_number" class="fixed-width-70 form-control @error('bank_number') is-invalid @enderror" placeholder="Masukkan nomor rekening" value="{{ old('bank_number') ? old('bank_number') : (isset($students) ? $students->bank_number : '') }}">
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                @error('bank_number')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="fixed-width-30">No. Handphone <span class="text-secondary">(opsional)</span></td>
                                                        <td class="fixed-width-70">
                                                            <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') ? old('phone') : (isset($students) ? $students->phone : '') }}">
                                                            <div class="invalid-feedback">
                                                                @error('phone')
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

                            @isset($students)
                            <!--begin::Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title flex-column">
                                        <h2>Riwayat Pengajuan Proposal</h2>
                                        <div class="fs-6 fw-bold text-muted">Berikut merupakan riwayat pengajuan proposal anda</div>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body">
                                    <div class="d-flex">
                                        <label class="form-check-label" for="kt_modal_update_email_notification_0">
                                            <div class="fw-bolder">2024 - Trans-SIBI <span class="badge badge-light-primary">PKM-KI</span> </div>
                                            <div class="text-gray-600">Inovasi Penerjemah Sistem Isyarat Bahasa Indonesia Berbasis Artificial Intelligence sebagai Media Komunikasi Interaktif Penyandang Disabilitas Tunarungu di Era Society 5.0</div>
                                        </label>
                                    </div>
                                    <div class='separator separator-dashed my-5'></div>
                                    <div class="d-flex">
                                        <label class="form-check-label" for="kt_modal_update_email_notification_0">
                                            <div class="fw-bolder">2023 - CHEMTRO <span class="badge badge-light-success">PKM-K</span></div>
                                            <div class="text-gray-600">CHEMTRO: Media Edukasi Multiple Representation Berbasis Kearifan Lokal Terintegrasi Augmented Reality sebagai Upaya Meningkatkan Kompetensi 4C dan Pelestarian Budaya</div>
                                        </label>
                                    </div>
                                    <div class='separator separator-dashed my-5'></div>
                                </div>
                                <!--end::Card body-->
                                <!--begin::Card footer-->
                                <!--end::Card footer-->
                            </div>
                            @endisset
                            <!--end::Card-->
                            @isset($students)
                            <!--begin::Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title flex-column">
                                        <h2 class="mb-1">Detail akun</h2>
                                        <div class="fs-6 fw-bold text-muted">Berikut merupakan detail akun anda</div>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pb-5">
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle gy-3" id="kt_table_users_login_session">
                                            <!--begin::Table body-->
                                            <tbody class="fs-6 fw-bold text-gray-600">
                                                <tr>
                                                    <td class="fixed-width-30">Email</td>
                                                    <td class="fixed-width-70">
                                                        {{$students->email}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fixed-width-30">Tanggal Registrasi</td>
                                                    <td class="fixed-width-70">
                                                        {{ \App\Helpers\Timezone::display($students->created_at, true) }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
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

