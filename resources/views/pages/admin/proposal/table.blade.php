<table class="table align-top table-striped table-row-dashed fs-6 gy-5" id="table">
    <!--begin::Table head-->
    <thead>
        <!--begin::Table row-->
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th class="w-250px">Ketua Tim</th>
            <th class="min-w-500px">Judul</th>
            <th class="w-150px">Skema</th>
            <th class="w-150px">Komitmen</th>
            <th class="w-150px">Status</th>
            <th class="w-100px">Aksi</th>
            <th></th>
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
                <!--begin::User details-->
                <div class="d-flex flex-column" style="line-height: 1.2;">
                    <a href="#" class="text-gray-800 text-hover-primary fw-bold mb-1" style="margin-bottom: 0.25rem !important;">
                        {{$row->leader->name ?: '-'}}
                    </a>
                    <small class="text-muted" style="font-size: 12px; margin-bottom: 0.25rem !important;">NIM. {{$row->leader->nim ?: '-'}}</small>
                    <div class="d-flex flex-wrap gap-1 mt-1">
                        <span class="badge fw-bolder text-{{ $row->leader->faculty ? $row->leader->faculty->theme() : 'dark' }}"
                            style="background-color: {{ $row->leader->faculty ? $row->leader->faculty->color : '#fff' }}; font-size: 10px; padding: 0.25rem 0.5rem;">
                          {{$row->leader->studyProgram->name ?? '-'}}
                      </span>
                    </div>
                </div>
                <!--begin::User details-->
            </td>
            <td>
                <div class="d-flex flex-column" style="line-height: 1.2;">
                    <span class="text-dark" style="margin-bottom: 0.25rem !important;">{{$row->title}}</span>
                    <small>Pendamping:
                        @if (isset($advisor[$row->id]) && $advisor[$row->id]->isNotEmpty())
                            @php $advisorData = $advisor[$row->id]->first(); @endphp
                            {{ $advisorData->user->name ?? 'Tidak ada advisor' }} - {{ $advisorData->user->nidn ?? ' NIDN belum diatur ' }}
                        @else
                            <small class="text-danger">Belum diatur</small>
                        @endif
                    </small>
                </div>
            </td>

            <td>
                PKM-{{$row->scheme}}
            </td>

            <td>
                <div class="mb-3">
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
                    @if($isComplete)
                        <span class="badge badge-success">{{$completed}}/{{$row->members->count()+1}}</span>
                    @else
                        <span class="badge badge-danger"> {{$completed}}/{{$row->members->count()+1}}</span>
                    @endif
                </div>
            </td>
            
            <td>
                <div class="mb-3">
                    @if ($row->status == 'reviewed')
                        <span class="badge badge-primary">Ditinjau</span>
                    @elseif ($row->status == 'rejected')
                        <span class="badge badge-danger">Tidak Lolos</span>     
                    @elseif ($row->status == 'reserve')
                        <span class="badge badge-warning text-dark">Cadangan</span>
                    @elseif ($row->status == 'upload')
                        <span class="badge badge-success">Upload</span>
                    @elseif ($row->status == 'funded')
                        <span class="badge badge-success">Didanai</span>
                    @elseif ($row->status == 'pimnas')
                        <span class="badge badge-success">Pimnas</span>
                    @endif
                </div>
            </td>

            <td>
                <a href="{{ route('admin.proposal.edit', $row->id) }}" class="btn btn-sm btn-light btn-active-light-primary"><i class="bi bi-pencil"></i></a>
            </td>
            <td></td>
        </tr>
        <!--end::Table row-->
        @endforeach
    </tbody>
    <!--end::Table body-->
</table>
<!--end::Table-->
<div id="paginationLinks">
    {{ $proposal->appends(request()->query())->links() }}
</div>
