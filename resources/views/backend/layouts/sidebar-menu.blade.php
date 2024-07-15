<div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu"
    data-kt-menu="true" data-kt-menu-expand="false">
    <!--begin:Menu item-->
    <div data-kt-menu-trigger="click" class="menu-item menu-accordion  @if (Request::segment(2) == 'dashboard' || Request::segment(2) == 'rekap-capaian-pemda' || Request::segment(2) == 'rekap-capaian-opd') show @endif">
        <!--begin:Menu link-->
        <span class="menu-link">
            <span class="menu-icon">
                <i class="ki-outline ki-element-11 fs-2"></i>
            </span>
            <span class="menu-title">Dashboards</span>
            <span class="menu-arrow"></span>
        </span>
        <!--end:Menu link-->
        <!--begin:Menu sub-->
        <div class="menu-sub menu-sub-accordion">
            <!--begin:Menu item-->
            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link @if (Request::segment(2) == 'dashboard') active @endif"
                    href="{{ url('/admin/dashboard') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Dashboard</span>
                </a>
                <!--end:Menu link-->
                <!--begin:Menu link-->
                @role('admin|Super-Admin')
                <a class="menu-link @if (Request::segment(2) == 'rekap-capaian-pemda') active @endif"
                    href="{{ route('capaianPemda') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Rekap Capaian</span>
                </a>
                @endrole

                @if (auth()->user()->opd_id != null)
                <a class="menu-link @if (Request::segment(2) == 'rekap-capaian-opd') active @endif"
                    href="{{ route('capaianOpd') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Rekap Capaian</span>
                </a>
                @endif
                <!--end:Menu link-->
            </div>
            <!--end:Menu item-->
        </div>
        <!--end:Menu sub-->
    </div>
    <!--end:Menu item-->
    <!--begin:Menu item-->
    <div class="menu-item pt-5">
        <!--begin:Menu content-->
        <div class="menu-content">
            <span class="menu-heading fw-bold text-uppercase fs-7">Management</span>
        </div>
        <!--end:Menu content-->
    </div>
    <!--end:Menu item-->

    <!--begin:Menu item-->
    <div data-kt-menu-trigger="click" class="menu-item menu-accordion @if (Request::segment(2) == 'pegawai' ||
            Request::segment(2) == 'opd' ||
            Request::segment(2) == 'sasaran' ||
            Request::segment(2) == 'program' ||
            Request::segment(2) == 'kegiatan' ||
            Request::segment(2) == 'subkegiatan' ||
            Request::segment(2) == 'tujuan') show @endif">
        <!--begin:Menu link-->
        <span class="menu-link">
            <span class="menu-icon">
                <i class="ki-outline ki-menu fs-2"></i>
            </span>
            <span class="menu-title">Data Master</span>
            <span class="menu-arrow"></span>
        </span>
        <!--end:Menu link-->
        <!--begin:Menu sub-->
        <div class="menu-sub menu-sub-accordion">
            <!--begin:Menu item-->
            <div class="menu-item">
                <!--begin:Menu link-->
                @role('admin|Super-Admin')
                    <a class="menu-link @if (Request::segment(2) == 'opd') active @endif" href="{{ route('opd.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">OPD</span>
                    </a>
                @endrole
                <a class="menu-link @if (Request::segment(2) == 'pegawai') active @endif"
                    href="{{ route('pegawai.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Pegawai</span>
                </a>
                <a class="menu-link @if (Request::segment(2) == 'tujuan') active @endif" href="{{ route('tujuan.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Tujuan</span>
                </a>
                <a class="menu-link @if (Request::segment(2) == 'sasaran') active @endif"
                    href="{{ route('sasaran.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Sasaran</span>
                </a>
                <a class="menu-link @if (Request::segment(2) == 'program') active @endif"
                    href="{{ route('program.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Program</span>
                </a>
                <a class="menu-link @if (Request::segment(2) == 'kegiatan') active @endif"
                    href="{{ route('kegiatan.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Kegiatan</span>
                </a>
                <a class="menu-link @if (Request::segment(2) == 'subkegiatan') active @endif"
                    href="{{ route('subkegiatan.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Sub Kegiatan</span>
                </a>
                <!--end:Menu link-->
            </div>
            <!--end:Menu item-->
        </div>
        <!--end:Menu sub-->
    </div>
    <!--end:Menu item-->

    <!--begin:Menu item-->
    <div data-kt-menu-trigger="click" class="menu-item menu-accordion @if (Request::segment(2) == 'target' || Request::segment(2) == 'realisasi' || Request::segment(2) == 'capaian') show @endif">
        <!--begin:Menu link-->
        <span class="menu-link">
            <span class="menu-icon">
                <i class="ki-duotone ki-graph-up fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                    <span class="path5"></span>
                    <span class="path6"></span>
                </i>
            </span>
            <span class="menu-title">Perjanjian Kinerja</span>
            <span class="menu-arrow"></span>
        </span>
        <!--end:Menu link-->
        <!--begin:Menu sub-->
        <div class="menu-sub menu-sub-accordion">
            <!--begin:Menu item-->
            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link @if (Request::segment(2) == 'target') active @endif"
                    href="{{ route('target.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Target</span>
                </a>
                <a class="menu-link @if (Request::segment(2) == 'realisasi') active @endif"
                    href="{{ route('realisasi.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Realisasi</span>
                </a>
                <a class="menu-link @if (Request::segment(2) == 'capaian') active @endif" href="{{ route('capaian') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Capaian</span>
                </a>
                <a class="menu-link @if (Request::segment(2) == 'dok-renaksi') active @endif"
                    href="{{ route('dok-renaksi.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Dok. Renaksi</span>
                </a>
                <!--end:Menu link-->
            </div>
            <!--end:Menu item-->
        </div>
        <!--end:Menu sub-->
    </div>
    <!--end:Menu item-->

    <!--begin:Menu item-->
    <div data-kt-menu-trigger="click"
        class="menu-item menu-accordion @if (Request::get('jenis_file') == 'RPJMD' ||
                Request::get('jenis_file') == 'RENSTRA' ||
                Request::get('jenis_file') == 'LAKIP') show @endif">
        <!--begin:Menu link-->
        <span class="menu-link">
            <span class="menu-icon">
                <i class="ki-duotone ki-document fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                    <span class="path5"></span>
                    <span class="path6"></span>
                </i>
            </span>
            <span class="menu-title">Upload File</span>
            <span class="menu-arrow"></span>
        </span>
        <!--end:Menu link-->
        <!--begin:Menu sub-->
        <div class="menu-sub menu-sub-accordion">
            <!--begin:Menu item-->
            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link @if (Request::get('jenis_file') == 'RPJMD') active @endif"
                    href="{{ route('file.index', ['jenis_file' => 'RPJMD']) }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">RPJMD</span>
                </a>
                <a class="menu-link @if (Request::get('jenis_file') == 'RENSTRA') active @endif"
                    href="{{ route('file.index', ['jenis_file' => 'RENSTRA']) }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Renstra</span>
                </a>
                <a class="menu-link @if (Request::get('jenis_file') == 'LAKIP') active @endif"
                    href="{{ route('file.index', ['jenis_file' => 'LAKIP']) }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Lakip</span>
                </a>
                <!--end:Menu link-->
            </div>
            <!--end:Menu item-->
        </div>
        <!--end:Menu sub-->
    </div>
    <!--end:Menu item-->

    @role('admin|Super-Admin')
        <!--begin:Menu item-->
        <div class="menu-item pt-5">
            <!--begin:Menu content-->
            <div class="menu-content">
                <span class="menu-heading fw-bold text-uppercase fs-7">Administrator</span>
            </div>
            <!--end:Menu content-->
        </div>
        <!--end:Menu item-->
    @endrole

    <!--begin:Menu item-->
    @role('Super-Admin')
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
            <!--begin:Menu link-->
            <span class="menu-link">
                <span class="menu-icon">
                    <i class="ki-outline ki-key-square fs-2"></i>
                </span>
                <span class="menu-title">Roles & Permission</span>
                <span class="menu-arrow"></span>
            </span>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div
                class="menu-sub menu-sub-accordion
            @if (Request::segment(2) == 'roles' ||
                    Request::segment(2) == 'permissions' ||
                    Request::segment(2) == 'assignable' ||
                    Request::segment(2) == 'assign-to-user') show @endif
            ">
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link @if (Request::segment(2) == 'roles') active @endif"
                        href="{{ route('roles.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Roles</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link @if (Request::segment(2) == 'permissions') active @endif"
                        href="{{ route('permissions.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Permissions</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link @if (Request::segment(2) == 'assignable') active @endif"
                        href="{{ route('assignable.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Assign Permission</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
            </div>
            <!--end:Menu sub-->
        </div>
    @endrole
    <!--end:Menu item-->

    <!--begin:Menu item-->
    @role('admin|Super-Admin')
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
            <!--begin:Menu link-->
            <span class="menu-link">
                <span class="menu-icon">
                    <i class="ki-outline ki-user-square fs-2"></i>
                </span>
                <span class="menu-title">Users</span>
                <span class="menu-arrow"></span>
            </span>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div class="menu-sub menu-sub-accordion">
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="{{ route('users.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">user</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
            </div>
            <!--end:Menu sub-->
        </div>
    @endrole

    <!--begin:Menu item-->
    <div class="menu-item pt-5">
        <!--begin:Menu content-->
        <div class="menu-content">
            <span class="menu-heading fw-bold text-uppercase fs-7">LHE</span>
        </div>
        <!--end:Menu content-->
    </div>
    <!--end:Menu item-->
    <!--begin:Menu item-->
    <div class="menu-item">
        <!--begin:Menu link-->
        <a class="menu-link" href="{{ route('lhe.index') }}">
            <span class="menu-icon">
                <i class="ki-duotone ki-rocket fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </span>
            <span class="menu-title">Tindak Lanjut LHE</span>
        </a>
        <!--end:Menu link-->
    </div>
    <!--end:Menu item-->
</div>
