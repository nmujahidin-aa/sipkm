@extends('layouts.app')
@section('title', 'Data Proposal | SIPKM UM')
@section('style')
<link href="{{URL::to('/')}}/assets/css/custom.css" rel="stylesheet" type="text/css" />
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
            <!--begin::Navbar-->
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center mb-3">
                    <div class="ms-3">
                        <h3 class="card-header-title mb-1">
                            Riwayat Pengajuan Proposal
                        </h3>
                        <p class="mb-0">Berikut merupakan daftar pengajuan proposal yang pernah anda ikuti</p>
                    </div>
                </div>
                <div>
                    <a href="{{ route('proposal.edit') }}"
                        class="btn btn-primary @if(isset($setting) && $setting->is_proposal_submission_open == 0) disabled @endif">
                        Ajukan
                    </a>
                </div>
            </div>
            <div class="separator my-2"></div>
            @if ($proposal->isEmpty())
                <div class="alert alert-warning fade show mb-5 d-flex align-items-center" role="alert">
                    <i class="bi bi-info-circle fs-1 me-3 alert-heading"></i>
                    <div>
                        <h4 class="alert-heading mb-1">Tidak ada data</h4>
                        <p class="mb-0">Belum ada data proposal yang diajukan per 2025.</p>
                    </div>
                </div>
            @else
            @foreach ($proposal as $index => $row)
            <div class="card mb-6 mb-xl-9">
                <div class="card-body pt-9 pb-0">
                    <!--begin::Details-->
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                        <div class="flex-grow-1">
                            <!--begin::Head-->
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <!--begin::Details-->
                                <div class="d-flex flex-column">
                                    <!--begin::Status-->
                                    <div class="d-flex align-items-center mb-1">
                                        <a href="#" class="text-gray-800 text-hover-primary fs-3 fw-bolder me-3">{{$row->team_name}}</a>
                                        <span class="badge badge-primary me-2">PKM-{{$row->scheme}}</span>
                                        <span class="badge badge-danger">{{$row->created_at->format('Y')}}</span>
                                    </div>
                                    <!--end::Status-->
                                    <!--begin::Description-->
                                    <div class="d-flex flex-wrap fw-bold mb-4 fs-5 text-gray-400">{{$row->title}}</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Details-->

                                <!--end::Actions-->
                            </div>
                            <!--end::Head-->
                            <!--begin::Info-->
                            <div class="d-flex flex-wrap justify-content-start">
                                <!--begin::Stats-->
                                <div class="d-flex flex-wrap">
                                    <!--begin::Stat-->
                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <!--begin::Label-->
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="#">
                                                    <div class="symbol-label">
                                                        <img src="{{$row->leader->getPhoto()}}" alt="{{$row->leader->name}}" style="object-fit: cover; object-position: top; width: 100%; height: 100%; display: block;"/>
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::User details-->
                                            <div class="d-flex flex-column" style="line-height: 1.2;">
                                                <a href="#" class="text-gray-800 text-hover-primary fw-bold mb-1" style="margin-bottom: 0.25rem !important;">
                                                    {{$row->leader->name}}
                                                </a>
                                                <small class="text-muted" style="font-size: 12px; margin-bottom: 0.25rem !important;">NIM. {{$row->leader->nim ?: '-'}}</small>
                                                <div class="d-flex flex-wrap gap-1 mt-1">
                                                    <span class="badge fw-bolder text-{{$row->leader->faculty->theme()}}"
                                                          style="background-color: {{$row->leader->faculty->color}}; font-size: 10px; padding: 0.25rem 0.5rem;">
                                                        {{$row->leader->faculty->name}}
                                                    </span>
                                                </div>
                                            </div>
                                            <!--begin::User details-->
                                        </div>
                                        <!--end::Label-->
                                    </div>
                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        @if (isset($advisor[$row->id]) && $advisor[$row->id]->isNotEmpty())
                                            @php $advisorData = $advisor[$row->id]->first(); @endphp
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                    <a href="#">
                                                        <div class="symbol-label">
                                                            <img src="{{ $advisorData->user->getPhoto() }}"
                                                                 alt="{{ $advisorData->user->name ?? 'Tidak ada advisor' }}"
                                                                 style="object-fit: cover; object-position: top; width: 100%; height: 100%; display: block;" />
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="d-flex flex-column" style="line-height: 1.2;">
                                                    <a href="#" class="text-gray-800 text-hover-primary fw-bold mb-1"
                                                       style="margin-bottom: 0.25rem !important;">
                                                        {{ $advisorData->user->name ?? 'Tidak ada advisor' }}
                                                    </a>
                                                    <small class="text-muted" style="font-size: 12px; margin-bottom: 0.25rem !important;">
                                                        NIP. {{ $advisorData->user->nip ?? '-' }}
                                                    </small>
                                                    <div class="d-flex flex-wrap gap-1 mt-1">
                                                        <span class="badge fw-bolder text-{{ $advisorData->user->faculty->theme() }}"
                                                              style="background-color: {{ $advisorData->user->faculty->color }};
                                                                     font-size: 10px; padding: 0.25rem 0.5rem;">
                                                            {{ $advisorData->user->faculty->name }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <small class="text-danger">Dosen Pembimbing belum diatur</small>
                                        @endif
                                    </div>
                                    <div class="min-w-125px py-3 px-4 me-6 mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder">Anggota :</div>
                                        </div>
                                        <div class="symbol-group symbol-hover mb-3">
                                            @if ($proposal_member->has($row->id) && $proposal_member[$row->id]->count() > 0)
                                                @foreach ($proposal_member[$row->id] as $member)
                                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{ $member->user->name }}">
                                                        <img alt="Pic" src="{{ $member->user->getPhoto() }}" style="object-fit: cover; object-position: top; display: block;" />
                                                    </div>
                                                @endforeach
                                            @else
                                                <small class="text-danger">Belum ada anggota</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!--end::Users-->
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Details-->
                    <div class="mb-3">
                        @if ($row->status == 'reviewed')
                            <span class="badge badge-primary">Status: Tahap Seleksi</span>
                        @elseif ($row->status == 'accepted')
                            <span class="badge badge-success">Status: Lolos Tahap Selanjutnya</span>
                        @elseif ($row->status == 'rejected')
                            <span class="badge badge-danger">Status: Tidak Lolos</span>
                        @endif
                    </div>
                    <div class="separator"></div>
                    <!--end::Nav wrapper-->
                </div>
                <div class="card-footer border-0">
                    <!--begin::Actions-->
                    <div class="d-flex mb-4 justify-content-end">
                        <a href="{{ route('proposal.edit', $row->id) }}" class="btn btn-sm btn-warning me-3 text-dark position-relative">
                            <i class="bi bi-pencil text-dark"></i> Log Catatan
                            <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill @if (isset($proposalReview[$row->id]) && $proposalReview[$row->id]->count() > 0) bg-danger @else bg-success @endif">
                                {{isset($proposalReview[$row->id]) ? $proposalReview[$row->id]->count() : 0}}
                            </span>
                        </a>
                        <a href="{{route('proposal.edit', $row->id)}}" class="btn btn-sm btn-primary me-3"><i class="bi bi-pencil"></i> Ubah</a>
                        <!--begin::Menu-->
                        <div class="me-0">
                            <button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary btn-delete" data-id="{{$row->id}}">
                                <i class="bi bi-trash fs-3"></i>
                            </button>
                        </div>
                        <!--end::Menu-->
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            {{$proposal->links()}}
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<form id="frmDelete" method="POST">
    @csrf
    @method('DELETE')
    <input type="hidden" name="id"/>
</form>
@endsection


@section('script')
<script src="{{URL::to('/')}}/assets/plugins/custom/datatables/datatables.bundle.js"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{URL::to('/')}}/assets/js/custom/apps/user-management/users/list/table.js"></script>
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
                    $("#frmDelete").attr("action", "{{ route('proposal.single_destroy', '_id_') }}".replace("_id_", id));
                    $("#frmDelete").find('input[name="id"]').val(id);
                    $("#frmDelete").submit();
                }
            })
        });
    });
</script>
@endsection
