@extends('layouts.app')
@section('title','Profile | SIPKM-UM')

@section('breadcumb')
<div class="page-title d-flex flex-column me-5">
    <!--begin::Title-->
    <h1 class="d-flex flex-column text-dark fw-bolder fs-3 mb-0">Profile</h1>
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
        <li class="breadcrumb-item text-dark">
            Profile
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
                <div class="ms-3">
                    <h3 class="card-header-title mb-1">
                        <i class="bi-people me-2 fs-3"></i>
                        Ubah Profil
                    </h3>
                    <p class="mb-0">Mohon isi data dengan benar dan teliti</p>
                </div>
            </div>

            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row">

                <!--begin::Content-->
                <div class="flex-column flex-lg-row-auto w-100 mb-10">
                    <!--begin:::Tab content-->
                    <div class="tab-content" id="myTabContent">
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade show active" id="kt_user_view_overview_security" role="tabpanel">
                            <!--begin::Card-->
                            <form action="{{route('profile.update')}}" method="POST">
                                @csrf
                                <div class="card pt-4 mb-6 mb-xl-9">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Biodata User</h2>
                                        </div>
                                    </div>


                                <div class="card-body pt-5 pb-5">
                                    <!-- Nama -->
                                    <div class="row mb-4 align-items-center">
                                        <label class="col-lg-3 col-form-label">Nama <span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?: ($user->name ?? '') }}">
                                            <div class="invalid-feedback">@error('name') {{ $message }} @enderror</div>
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="row mb-4 align-items-center">
                                        <label class="col-lg-3 col-form-label">Email <span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') ?: ($user->email ?? '') }}">
                                            <div class="invalid-feedback">@error('email') {{ $message }} @enderror</div>
                                        </div>
                                    </div>

                                    <!-- NIM -->
                                    @use('App\Enums\RoleEnum')
                                    @if (auth()->user()->hasRole(RoleEnum::MAHASISWA))
                                    <div class="row mb-4 align-items-center">
                                        <label class="col-lg-3 col-form-label">NIM <span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" value="{{ old('nim') ?: ($user->nim ?? '') }}">
                                            <div class="invalid-feedback">@error('nim') {{ $message }} @enderror</div>
                                        </div>
                                    </div>
                                    @elseif (auth()->user()->hasRole(RoleEnum::DOSEN))
                                    <div class="row mb-4 align-items-center">
                                        <label class="col-lg-3 col-form-label">NIDN <span class="text-secondary">(opsional)</span></label>
                                        <div class="col-lg-9">
                                            <input type="text" name="nidn" class="form-control @error('nidn') is-invalid @enderror" value="{{ old('nidn') ?: ($user->nidn ?? '') }}">
                                            <div class="invalid-feedback">@error('nidn') {{ $message }} @enderror</div>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <label class="col-lg-3 col-form-label">NIP <span class="text-secondary">(opsional)</span></label>
                                        <div class="col-lg-9">
                                            <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') ?: ($user->nip ?? '') }}">
                                            <div class="invalid-feedback">@error('nip') {{ $message }} @enderror</div>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <label class="col-lg-3 col-form-label">NUPTK <span class="text-secondary">(opsional)</span></label>
                                        <div class="col-lg-9">
                                            <input type="text" name="nuptk" class="form-control @error('nuptk') is-invalid @enderror" value="{{ old('nuptk') ?: ($user->nuptk ?? '') }}">
                                            <div class="invalid-feedback">@error('nuptk') {{ $message }} @enderror</div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="row mb-4 align-items-center">
                                        <label class="col-lg-3 col-form-label">Kesalahan <span class="text-secondary">(opsional)</span></label>
                                        <div class="col-lg-9">
                                            <input type="text" disabled class="form-control" value="Role tidak dikenali">
                                        </div>
                                    </div>
                                    @endif


                                    <div class="row mb-4 align-items-center">
                                        <label class="col-lg-3 col-form-label">Program Studi <span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <select name="study_program_id" class="form-select @error('study_program_id') is-invalid @enderror" data-control="select2" data-placeholder="Select an option">
                                                <option></option>
                                                @foreach ($studyPrograms as $program)
                                                    <option value="{{ $program->id }}" {{ old('study_program_id') == $program->id || (isset($user) && $user->study_program_id == $program->id) ? 'selected' : '' }}>
                                                        {{ $program->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">@error('study_program_id'){{ $message }} @enderror </div>
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="row mb-4 align-items-center">
                                        <label class="col-lg-3 col-form-label">Nomor HP <span class="text-secondary">(opsional)</span></label>
                                        <div class="col-lg-9">
                                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') ?: ($user->phone ?? '') }}">
                                            <div class="invalid-feedback">@error('phone') {{ $message }} @enderror</div>
                                        </div>
                                    </div>

                                    <div class="row mb-4 align-items-center">
                                        <label class="col-lg-3 col-form-label">Bank <span class="text-secondary">(opsional)</span></label>
                                        <div class="col-lg-9">
                                            <div class="row">
                                                <div class="col-3">
                                                    <select name="bank_name" class="form-select @error('bank_name') is-invalid @enderror rounded-end-0" data-control="select2" data-placeholder="Pilih Bank">
                                                        <option value="">Pilih Bank</option>
                                                        @foreach ($banks as $bank)
                                                            <option value="{{ $bank }}" {{ old('bank_name') == $bank || (isset($user) && $user->bank_name == $bank) ? 'selected' : '' }}>{{ $bank }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" name="bank_number" class="fixed-width-70 form-control @error('bank_number') is-invalid @enderror" placeholder="Masukkan nomor rekening" value="{{ old('bank_number') ? old('bank_number') : (isset($user) ? $user->bank_number : '') }}">
                                                </div>
                                            </div>
                                            <div class="invalid-feedback">@error('bank_number') {{ $message }} @enderror</div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="card-footer text-end">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--end:::Tab pane-->
                    </div>
                    <!--end:::Tab content-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Layout-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
@endsection
