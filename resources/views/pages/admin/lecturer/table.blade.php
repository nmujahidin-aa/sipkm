
<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
    <!--begin::Table head-->
    <thead>
        <!--begin::Table row-->
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th class="min-w-125px">Dosen</th>
            <th class="min-w-125px">Role</th>
            <th class="text-end min-w-100px">Aksi</th>
        </tr>
        <!--end::Table row-->
    </thead>
    <!--end::Table head-->
    <!--begin::Table body-->
    <tbody class="text-gray-600 fw-bold">
        @foreach ($lecturers as $index => $row)
        <!--begin::Table row-->
        <tr>
            <!--begin::Checkbox-->
            <!--end::Checkbox-->
            <!--begin::User=-->
            <td class="d-flex align-items-center">
                <!--begin:: Avatar -->
                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                    <a href="#">
                        <div class="symbol-label">
                            <img src="{{$row->getPhoto()}}" alt="{{$row->name}}" style="object-fit: cover; object-position: top; width: 100%; height: 100%; display: block;"/>
                        </div>
                    </a>
                </div>
                <!--end::Avatar-->
                <!--begin::User details-->
                <div class="d-flex flex-column" style="line-height: 1.2;">
                    <a href="#" class="text-gray-800 text-hover-primary fw-bold mb-1" style="margin-bottom: 0.25rem !important;">
                        {{$row->name}}
                    </a>
                    <small class="text-muted" style="font-size: 12px; margin-bottom: 0.25rem !important;">
                        @if($row->nidn)
                            NIDN. {{$row->nidn}}
                        @elseif($row->nip)
                            NIP. {{$row->nip}}
                        @elseif ($row->nuptk)
                            NUPTK. {{$row->nuptk}}
                        @else
                            <span class="text-danger">NIDN/NIP/NUPTK belum diatur</span>
                        @endif
                    </small>
                    <div class="d-flex flex-wrap gap-1 mt-1">
                        @if($row->faculty && $row->studyProgram)
                            <span class="badge fw-bolder text-{{$row->faculty->theme()}}"
                                style="background-color: {{$row->faculty->color}}; font-size: 10px; padding: 0.25rem 0.5rem;">
                                {{$row->faculty->short_name}}
                            </span> |
                            <span class="badge fw-bolder text-{{$row->faculty->theme()}}"
                                style="background-color: {{$row->faculty->color}}; font-size: 10px; padding: 0.25rem 0.5rem;">
                                {{$row->studyProgram->name}}
                            </span>
                        @else
                            <span class="badge fw-bolder text-danger" 
                                style="background-color: white; font-size: 10px; padding: 0.25rem 0.5rem;">
                                -
                            </span>
                        @endif
                    </div>
                </div>
                <!--begin::User details-->
            </td>
            <td>
                @foreach($row->getRoleNames() as $role)
                @php
                    $roleColors = [
                        'ADMINISTRATOR' => 'danger',
                        'PKM_CENTER' => 'primary',
                        'MAHASISWA' => 'success',
                        'DOSEN' => 'warning',
                        'PENALARAN' => 'dark',
                    ];
                    $color = $roleColors[$role] ?? 'gray'; // Default warna jika role tidak terdaftar
                @endphp
                <span class="badge badge-{{$color}} fw-bolder me-1">{{ $role }}</span>
                @endforeach
            </td>
            <!--begin::Joined-->
            <!--begin::Action=-->
            <td class="text-end">
                <div class="btn-group">
                    <!-- Button Edit dengan ikon pensil -->
                    <a href="{{route('admin.lecturer.edit', $row->id)}}" class="btn btn-light btn-active-light-primary btn-sm">
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

<div id="paginationLinks">
    {{ $lecturers->appends(request()->query())->links() }}
</div>

