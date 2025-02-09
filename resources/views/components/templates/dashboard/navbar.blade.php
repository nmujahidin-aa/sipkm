<div class="toolbar">
    <!--begin::Toolbar-->
    <div class="container-fluid py-6 py-lg-0 d-flex flex-column flex-lg-row align-items-lg-stretch justify-content-between">
        <!--begin::Page title-->
        @yield('breadcumb')
        <!--end::Page title-->
        <!--begin::Action group-->
        <div class="d-flex align-items-center overflow-auto pt-3 pt-lg-0">
            <!--begin::Action wrapper-->
            <div class="d-flex align-items-center">
                <!--begin::Label-->
                <span class="fs-7 fw-bolder text-gray-700 pe-4 text-nowrap d-none d-xxl-block">Role</span>
                <!--end::Label-->
                <!--begin::Select-->
                @if(auth()->user()->roles->count() > 1)
                    <select class="form-select form-select-xl form-select-solid w-100px w-200px"
                            data-control="select2"
                            data-placeholder="{{ ucfirst(auth()->user()->currentRole()->name) }}"
                            data-hide-search="true"
                            onchange="window.location.href=this.value">
                        <!-- Option aktif dari current_role_id -->
                        <option value="" disabled selected>
                            {{ ucfirst(auth()->user()->currentRole()->name) }}
                        </option>
                        <!-- Daftar role lainnya -->
                        @foreach(auth()->user()->roles->where('id', '!=', auth()->user()->current_role_id) as $role)
                            <option value="{{ route('switch-role', $role->id) }}">
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                @endif
                <!--end::Select-->
            </div>
            <!--end::Action wrapper-->
        </div>
        <!--end::Action group-->
    </div>
    <!--end::Toolbar-->
</div>
