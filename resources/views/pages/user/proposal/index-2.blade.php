@extends('layouts.app')
@section('title', 'Data Proposal | SIPKM UM')

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
                            <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search user" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <!--end::Export-->
                            <!--begin::Add user-->
                            <a href="{{route('proposal.edit')}}" class="btn btn-primary">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->Tambah
                            </a>
                            <!--end::Add user-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Group actions-->
                        <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                            <div class="fw-bolder me-5">
                            <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected</div>
                            <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Delete Selected</button>
                        </div>
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">Ketua Tim</th>
                                <th class="min-w-80px">Judul</th>
                                <th class="min-w-125px">Anggota Tim</th>
                                <th class="min-w-125px">Status</th>
                                <th class="text-end min-w-100px">Aksi</th>
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
                                                {{$row->leader->faculty->short_name}}
                                            </span>
                                        </div>
                                    </div>
                                    <!--begin::User details-->
                                </td>
                                <td>
                                    <div class="d-flex flex-column" style="line-height: 1.2;">
                                        <div class="d-flex flex-wrap gap-1 mt-1">
                                            <span class="badge badge-primary fw-bolder"
                                                  style="padding: 0.25rem 0.5rem;">
                                                PKM-{{$row->scheme}}
                                            </span>
                                            <span class="badge badge-danger fw-bolder"
                                                  style="padding: 0.25rem 0.5rem;">
                                                    {{$row->created_at->format('Y')}}
                                            </span>
                                        </div>
                                        <small class="text-dark" style="margin-bottom: 0.25rem !important;">{{$row->title}}</small>
                                    </div>
                                </td>
                                <td>
                                    <!--begin::Users-->
                                    <div class="symbol-group symbol-hover mb-3">
                                        <!--begin::User-->
                                        @if ($proposal_member->has($row->id) && $proposal_member[$row->id]->count() > 0)
                                            @foreach ($proposal_member[$row->id] as $member)
                                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{ $member->user->name }}">
                                                    <img alt="Pic" src="{{ $member->user->getPhoto() }}" style="object-fit: cover; object-position: top; display: block;" />
                                                </div>
                                            @endforeach
                                        @else
                                            <small class="text-danger">Belum ada anggota</small>
                                        @endif
                                        <!--end::User-->
                                    </div>
                                    <!--end::Users-->
                                </td>
                                <td>

                                </td>
                                <!--begin::Joined-->
                                <!--begin::Action=-->
                                <td class="text-end">
                                    <div class="btn-group">
                                        <!-- Button Edit dengan ikon pensil -->
                                        <a href="{{route('proposal.edit', $row->id)}}" class="btn btn-light btn-active-light-primary btn-sm">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>

                                        <!-- Button Dropdown untuk Actions -->
                                        <a href="#" class="btn btn-light btn-active-light-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        </a>

                                        <!-- Dropdown Menu -->
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><button class="dropdown-item btn-delete" data-id="{{$row->id}}"><i class="bi-trash dropdown-item-icon"></i> Hapus</button></li>
                                        </ul>
                                    </div>
                                </td>
                                <!--end::Action=-->
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
