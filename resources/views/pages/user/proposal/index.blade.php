@extends('layouts.app')
@section('title', 'Data Proposal | SIPKM UM')
@section('style')
<link href="{{URL::to('/')}}/assets/css/custom.css" rel="stylesheet" type="text/css" />
<style>
    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7); }
        70% { box-shadow: 0 0 0 10px rgba(220, 53, 69, 0); }
        100% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0); }
    }
    
    @keyframes pulseShadow {
        0% { box-shadow: 0 0 5px rgba(220, 53, 69, 0.3); }
        50% { box-shadow: 0 0 15px rgba(220, 53, 69, 0.5); }
        100% { box-shadow: 0 0 5px rgba(220, 53, 69, 0.3); }
    }
    
    .clickable-card:hover {
        transform: translateY(-2px);
        transition: transform 0.2s ease;
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
                            <div class="">
                                <!--begin::Stats-->
                                <div class="">
                                <div class="row g-3">  <!-- g-3 untuk memberikan gap antara kolom -->
                                <!-- Kolom 1 - Ketua -->
                                    <div class="col-xl-3 col-lg-6 col-md-6 col-12 mb-3">
                                        <div class="border border-gray-300 border-dashed rounded h-100 p-3">  <!-- h-100 dan p-3 untuk padding internal -->
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                    <a href="#">
                                                        <div class="symbol-label">
                                                            <img src="{{$row->leader->getPhoto()}}" alt="{{$row->leader->name}}" style="object-fit: cover; object-position: top; width: 100%; height: 100%; display: block;"/>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <a href="#" class="text-gray-800 text-hover-primary fw-bold mb-1">{{$row->leader->name}}</a>
                                                    <small class="text-muted">NIM. {{$row->leader->nim ?: '-'}}</small>
                                                    <div class="d-flex flex-wrap gap-1 mt-1">
                                                        <span class="badge fw-bolder text-{{$row->leader->faculty->theme()}}"
                                                            style="background-color: {{$row->leader->faculty->color}}; font-size: 10px; padding: 0.25rem 0.5rem;">
                                                            {{$row->leader->faculty->short_name}}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Kolom 2 - Dosen Pembimbing -->
                                    <div class="col-xl-3 col-lg-6 col-md-6 col-12 mb-3">
                                        <div class="border border-gray-300 border-dashed rounded h-100 p-3">
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
                                                    <div class="d-flex flex-column">
                                                        <div class="text-gray-800 fw-bold mb-1">{{ $advisorData->user->name ?? 'Tidak ada advisor' }}</div>
                                                        <small class="text-muted">NIP. {{ $advisorData->user->nip ?? '-' }}</small>
                                                        <div class="d-flex flex-wrap gap-1 mt-1">
                                                            <span class="badge fw-bolder text-{{ $advisorData->user->faculty->theme() }}"
                                                                style="background-color: {{ $advisorData->user->faculty->color }};
                                                                        font-size: 10px; padding: 0.25rem 0.5rem;">
                                                                {{ $advisorData->user->faculty->short_name }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="text-danger">Dosen Pembimbing belum diatur</div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Kolom 3 - Anggota -->
                                    <div class="col-xl-3 col-lg-6 col-md-6 col-12 mb-3">
                                        <div class="border border-gray-300 border-dashed rounded h-100 p-3">
                                            <div class="fw-bolder mb-2">Anggota :</div>
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

                                    @if (in_array($row->status, ['reserve', 'upload', 'funded', 'pimnas']))
                                        @php
                                            $totalFields = $row->members->count() + 1;
                                            $completed = 0;
                                            if($row->commitment) {
                                                $completed += $row->commitment->leader ? 1 : 0;
                                                for($i = 1; $i <= $row->members->count(); $i++) {
                                                    $field = "member_$i";
                                                    $completed += $row->commitment->$field ? 1 : 0;
                                                }
                                            }
                                            $progress = ($completed / $totalFields) * 100;
                                            $isComplete = $completed === $totalFields;
                                        @endphp

                                        <div class="col-xl-3 col-lg-6 col-md-6 col-12 mb-3">
                                            <div class="border border-gray-300 border-dashed rounded h-100 p-3 position-relative clickable-card"
                                                style="cursor: pointer; @if(!$isComplete) animation: pulseShadow 2s infinite; @endif"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#commitmentModal-{{ $row->id }}">
                                                
                                                <!-- Konten utama -->
                                                <div class="text-center py-2">
                                                    <i class="bi bi-file-earmark-check fs-1 @if($isComplete) text-success @else text-danger @endif"></i>
                                                    <div class="mt-2 @if($isComplete) text-success @else text-danger @endif fw-bold">
                                                        @if($isComplete) Dokumen Lengkap @else Unggah Komitmen @endif
                                                    </div>
                                                    
                                                    <!-- Indikator progres -->
                                                    <div class="progress mt-3" style="height: 10px;">
                                                        <div class="progress-bar @if($isComplete) bg-success @else bg-danger @endif" 
                                                            role="progressbar" 
                                                            style="width: {{ $progress }}%;" 
                                                            aria-valuenow="{{ $progress }}" 
                                                            aria-valuemin="0" 
                                                            aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <small class="text-muted">{{ $completed }}/{{ $totalFields }} dokumen lengkap</small>
                                                </div>
                                                
                                                <!-- Overlay untuk highlight -->
                                                @if(!$isComplete)
                                                    <div class="position-absolute top-0 start-0 w-100 h-100" 
                                                        style="pointer-events: none; border-radius: inherit; box-shadow: 0 0 0 rgba(220, 53, 69, 0.7); animation: pulse 2s infinite;">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
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
                        @elseif ($row->status == 'reserve')
                            <span class="badge badge-warning text-dark">Status: Cadangan</span>
                        @elseif ($row->status == 'upload')
                            <span class="badge badge-success">Status: Upload Simbelmawa</span>
                        @elseif ($row->status == 'funded')
                            <span class="badge badge-success">Status: Didanai</span>
                        @elseif ($row->status == 'pimnas')
                            <span class="badge badge-success">Status: PIMNAS</span>
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
                        <a href="{{ route('proposal.edit', $row->id) }}" class="btn btn-sm btn-warning me-5 text-dark position-relative">
                            <i class="bi bi-pencil text-dark"></i> Log Catatan
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill @if (isset($proposalReview[$row->id]) && $proposalReview[$row->id]->count() > 0) bg-danger @else bg-success @endif">
                                {{isset($proposalReview[$row->id]) ? $proposalReview[$row->id]->count() : 0}}
                            </span>
                        </a>
                        <a href="{{route('proposal.edit', $row->id)}}" class="btn btn-sm btn-primary me-3"><i class="bi bi-pencil"></i> Ubah</a>
                        <!--begin::Menu-->
                        @if($row->status == 'reviewed')
                        <div class="me-0">
                            <button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary btn-delete" data-id="{{$row->id}}">
                                <i class="bi bi-trash fs-3"></i>
                            </button>
                        </div>
                        @endif
                        <!--end::Menu-->
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="commitmentModal-{{ $row->id }}" tabindex="-1" aria-labelledby="commitmentModalLabel-{{ $row->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title text-light" id="commitmentModalLabel">Unggah Dokumen Komitmen</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="commitmentForm-{{ $row->id }}" action="{{ route('proposal.commitment', $row->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <!-- Ketua -->
                                <div class="mb-4 p-3 border rounded">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="mb-0 fw-bold">1. Form Komitmen Ketua</h6>
                                        <span id="leaderStatus" class="badge {{ $row->commitment && $row->commitment->leader ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $row->commitment && $row->commitment->leader ? '✓ Terunggah' : 'Belum diunggah' }}
                                        </span>
                                    </div>
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="leader" id="leaderFile" accept=".pdf">
                                        @if($row->commitment && $row->commitment->leader)
                                            <a href="{{ Storage::url($row->commitment->leader) }}" target="_blank" class="btn btn-outline-success">
                                                <i class="bi bi-download"></i> Download
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                <!-- Anggota 1-4 -->
                                @for($i = 1; $i <= $row->members->count(); $i++)
                                    @php 
                                        $memberField = "member_$i";
                                        $memberFile = $row->commitment ? $row->commitment->$memberField : null;
                                    @endphp
                                    <div class="mb-4 p-3 border rounded">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h6 class="mb-0 fw-bold">{{ $i+1 }}. Form Komitmen Anggota {{ $i }}</h6>
                                            <span id="{{ $memberField }}Status" class="badge {{ $memberFile ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $memberFile ? '✓ Terunggah' : 'Belum diunggah' }}
                                            </span>
                                        </div>
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="{{ $memberField }}" id="{{ $memberField }}File" accept=".pdf">
                                            @if($memberFile)
                                                <a href="{{ Storage::url($memberFile) }}" target="_blank" class="btn btn-outline-success">
                                                    <i class="bi bi-download"></i> Download
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endfor
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-danger">Simpan Perubahan</button>
                            </div>
                        </form>
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
<!-- Modal -->

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
