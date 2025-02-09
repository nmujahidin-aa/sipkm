@extends('layouts.app')

@section('title')
    {{ isset($proposal) ? 'Ubah Mahasiswa: ' . $proposal->name : 'Tambah Mahasiswa' }}
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
                        {{ isset($students) ? 'Ubah' : 'Tambah' }} Proposal
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
                            <form action="{{route('proposal.store')}}" method="POST" enctype="multipart/form-data">
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
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0 pb-5">
                                        <!--begin::Table wrapper-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table align-middle gy-3" id="kt_table_users_login_session">
                                                <!--begin::Table body-->
                                                <tbody class="fs-6 fw-bold text-gray-600">
                                                    @if (isset($proposal))
                                                        <input type="hidden" name="id" value="{{ $proposal->id }}" autocomplete="off">
                                                    @endif
                                                    {{-- Data Ketua Tim --}}
                                                    <tr>
                                                        <td class="fixed-width-30">Nama Ketua <span class="text-danger"></span></td>
                                                        <td class="fixed-width-70">
                                                            <span>
                                                                <input type="text" disabled class="form-control" value="{{ $proposal->leader->name ?? Auth::user()->name }}">
                                                                <input type="hidden" name="leader_id" value="{{ $proposal->leader_id ?? Auth::user()->id }}">
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fixed-width-30">Fakultas Ketua <span class="text-danger"></span></td>
                                                        <td class="fixed-width-70">
                                                            <span>
                                                                <input type="text" disabled class="form-control" value="{{ $proposal->leader->faculty->name ?? Auth::user()->faculty->name }}">
                                                                <input type="hidden" name="faculty_id" value="{{ $proposal->faculty_id ?? Auth::user()->faculty->id }}">
                                                            </span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="fixed-width-30">Nama Tim <span class="text-danger">*</span></td>
                                                        <td class="fixed-width-70">
                                                            <input type="text" name="team_name" class="form-control @error('team_name') is-invalid @enderror" value="{{ old('team_name') ? old('team_name') : (isset($proposal) ? $proposal->team_name : '') }}">
                                                            <div class="invalid-feedback">
                                                                @error('team_name')
                                                                {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fixed-width-30">Judul <span class="text-danger">*</span></td>
                                                        <td class="fixed-width-70">
                                                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') ? old('title') : (isset($proposal) ? $proposal->title : '') }}">
                                                            <div class="invalid-feedback">
                                                                @error('title')
                                                                {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fixed-width-30">Skim <span class="text-danger">*</span></td>
                                                        <td class="fixed-width-70">
                                                            <select name="scheme" class="form-select @error('scheme') is-invalid @enderror" data-control="select2" data-placeholder="Select an option">
                                                                <option></option>
                                                                @foreach ($scheme as $index => $row)
                                                                    <option class="text-dark" value="{{ $row }}" {{ old('scheme') == $row || (isset($proposal) && $proposal->scheme == $row) ? 'selected' : '' }}>PKM-{{ $row }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                @error('scheme')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fixed-width-30">File Proposal <span class="text-danger">*</span></td>
                                                        <td class="fixed-width-70">
                                                            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" value="{{ old('file') ? old('file') : (isset($proposal) ? $proposal->file : '') }}">
                                                            @isset($proposal)
                                                            <span>Kosongkan jika tidak diubah <a href="{{ asset('storage/' . $proposal->file)}}" target="_blank">Lihat Proposal</a> </span>
                                                            @endisset
                                                            <div class="invalid-feedback">
                                                                @error('file')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fixed-width-30">Dosen Pembimbing <span class="text-danger">*</span></td>
                                                        <td class="fixed-width-70">
                                                            <select name="advisors" class="form-select @error('advisors') is-invalid @enderror" data-control="select2" data-placeholder="Select an option">
                                                                <option></option>
                                                                @foreach ($advisors as $advisor)
                                                                    <option class="text-dark" value="{{ $advisor->id }}" {{ old('advisors') == $advisor->id || (isset($proposal) && $proposal->advisor->user->id == $advisor->id) ? 'selected' : '' }}>
                                                                        {{ $advisor->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                @error('advisors')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fixed-width-30">Anggota Tim <span class="text-danger">*</span></td>
                                                        <td class="fixed-width-70">
                                                            <select name="members[]" class="form-select @error('members') is-invalid @enderror" data-control="select2" data-placeholder="Select an option" multiple="multiple" id="membersSelect">
                                                                <option></option>
                                                                @foreach ($members as $member)
                                                                    <option value="{{ $member->id }}"
                                                                        {{ in_array($member->id, old('members', isset($proposal) ? $proposal->members->pluck('user_id')->toArray() : [])) ? 'selected' : '' }}>
                                                                        {{ $member->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                @error('members')
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

                            <!--begin::Card-->
                            {{-- <div class="card pt-4 mb-6 mb-xl-9">
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
                            </div> --}}
                            <!--end::Card-->
                            <!--begin::Card-->
                            {{-- <div class="card pt-4 mb-6 mb-xl-9">
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
                            </div> --}}
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
<script>
    $(document).ready(function () {
        var maxSelections = 4; // Batas maksimal pilihan

        // Mengaktifkan atau menonaktifkan opsi berdasarkan jumlah pilihan
        function toggleOptions() {
            var selectedOptions = $('#membersSelect').val(); // Mengambil pilihan yang dipilih
            var options = $('#membersSelect option');

            if (selectedOptions.length >= maxSelections) {
                // Menonaktifkan opsi yang belum dipilih
                options.each(function () {
                    if ($(this).prop('selected') === false) {
                        $(this).prop('disabled', true); // Menonaktifkan opsi
                    }
                });
            } else {
                // Mengaktifkan kembali semua opsi jika pilihan kurang dari batas
                options.prop('disabled', false);
            }
        }

        // Panggil fungsi saat perubahan pilihan
        $('#membersSelect').on('change', function () {
            toggleOptions();
        });

        // Panggil fungsi untuk menonaktifkan opsi saat halaman dimuat jika sudah ada pilihan
        toggleOptions();
    });
</script>
@endsection
