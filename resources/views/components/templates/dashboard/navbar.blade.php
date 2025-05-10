<div class="toolbar">
    <!--begin::Toolbar-->
    <div class="container-fluid py-6 py-lg-0 d-flex flex-column flex-md-row align-items-md-stretch justify-content-md-between">
        <!--begin::Page title-->
        <div class="d-flex justify-content-center justify-content-md-start w-100 mb-3 mb-md-0">
            @yield('breadcumb')
        </div>
        <!--end::Page title-->
        <!--begin::Action group-->
        <div class="d-flex justify-content-center justify-content-md-end w-100">
            <!--begin::Action wrapper-->
            <div class="d-flex align-items-center w-100 w-md-auto flex-column flex-sm-row justify-content-center justify-content-md-end">
                <!--begin::Label-->
                @if(auth()->user()->roles->count() > 1)
                <span class="fs-7 fw-bolder text-gray-700 pe-4 text-nowrap d-none d-xxl-block">Role</span>
                <!--begin::Select-->
                    <select class="form-select form-select-xl form-select-solid w-100 w-md-auto"
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