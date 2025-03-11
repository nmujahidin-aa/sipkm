@extends('layouts.app')
@section('title', 'Data Proposal | SIPKM UM')
@section('style')
<style>
</style>
@endsection
@section('breadcumb')
<div class="page-title d-flex flex-column me-5">
    <!--begin::Title-->
    <h1 class="d-flex flex-column text-dark fw-bolder fs-3 mb-0">Data Belmawa</h1>
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
        <li class="breadcrumb-item text-dark">Data Belmawa</li>
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
                <x-organisms.card-header add="true" addHref="{{route('admin.belmawa.edit')}}" />

                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-top table-striped table-row-dashed fs-6 gy-5" id="kt_table_users">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-300px">Nama</th>
                                <th class="w-200px">Username</th>
                                <th class="w-200px">Password</th>
                                <th class="w-150px text-end">Aksi</th>
                                <th></th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="text-gray-600 fw-bold">
                            @foreach ($belmawa as $index => $row)
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::User=-->
                                <td class="d-flex align-items-center">
                                    <!--begin::User details-->
                                    <div class="d-flex flex-column" style="line-height: 1.2;">
                                        <a href="#" class="text-gray-800 text-hover-primary fw-bold mb-1" style="margin-bottom: 0.25rem !important;">
                                            {{$row->user->name}}
                                        </a>
                                        <small class="text-muted" style="font-size: 12px; margin-bottom: 0.25rem !important;">NIM. {{$row->user->nim ?: '-'}}</small>
                                        <div class="d-flex flex-wrap gap-1 mt-1">
                                            <span class="badge fw-bolder text-{{$row->user->faculty->theme()}}"
                                                style="background-color: {{$row->user->faculty->color}}; font-size: 10px; padding: 0.25rem 0.5rem;">
                                              {{$row->user->studyProgram->name}}
                                          </span>
                                        </div>
                                    </div>
                                    <!--begin::User details-->
                                </td>

                                <td>
                                    {{$row->username}}
                                </td>

                                <td>
                                    {{$row->password}}
                                </td>

                                <td class="text-end">
                                    <div class="btn-group">
                                        <!-- Button Edit dengan ikon pensil -->
                                        <a href="{{route('admin.belmawa.edit', $row->id)}}" class="btn btn-light btn-active-light-primary btn-sm">
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
                    $("#frmDelete").attr("action", "{{ route('admin.belmawa.single_destroy', '_id_') }}".replace("_id_", id));
                    $("#frmDelete").find('input[name="id"]').val(id);
                    $("#frmDelete").submit();
                }
            })
        });
    });
</script>
@endsection
