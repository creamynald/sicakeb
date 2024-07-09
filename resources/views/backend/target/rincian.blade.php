@extends('backend.layouts.base')
{{-- This page using "demo1/apps/customers/list.html" to get the data table --}}
@section('content')
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        @urlSegment(2) List</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ url('/admin/dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">@urlSegment(2)</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Filter menu-->
                    <div class="m-0">
                        <!--begin::Menu toggle-->
                        {{-- <a href="#" class="btn btn-sm btn-flex btn-secondary fw-bold" data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-filter fs-6 text-muted me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>Filter</a> --}}
                        <!--end::Menu toggle-->
                        <!--begin::Menu 1-->
                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                            id="kt_menu_654c7021994de">
                            <!--begin::Header-->
                            <div class="px-7 py-5">
                                <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Menu separator-->
                            <div class="separator border-gray-200"></div>
                            <!--end::Menu separator-->
                            <!--begin::Form-->
                            <div class="px-7 py-5">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-semibold">Status:</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div>
                                        <select class="form-select form-select-solid" multiple="multiple"
                                            data-kt-select2="true" data-close-on-select="false"
                                            data-placeholder="Select option" data-dropdown-parent="#kt_menu_654c7021994de"
                                            data-allow-clear="true">
                                            <option></option>
                                            <option value="1">Approved</option>
                                            <option value="2">Pending</option>
                                            <option value="2">In Process</option>
                                            <option value="2">Rejected</option>
                                        </select>
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-semibold">Member Type:</label>
                                    <!--end::Label-->
                                    <!--begin::Options-->
                                    <div class="d-flex">
                                        <!--begin::Options-->
                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                            <span class="form-check-label">Author</span>
                                        </label>
                                        <!--end::Options-->
                                        <!--begin::Options-->
                                        <label class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="2"
                                                checked="checked" />
                                            <span class="form-check-label">Customer</span>
                                        </label>
                                        <!--end::Options-->
                                    </div>
                                    <!--end::Options-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-semibold">Notifications:</label>
                                    <!--end::Label-->
                                    <!--begin::Switch-->
                                    <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="" name="notifications"
                                            checked="checked" />
                                        <label class="form-check-label">Enabled</label>
                                    </div>
                                    <!--end::Switch-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="d-flex justify-content-end">
                                    <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2"
                                        data-kt-menu-dismiss="true">Reset</button>
                                    <button type="submit" class="btn btn-sm btn-primary"
                                        data-kt-menu-dismiss="true">Apply</button>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Form-->
                        </div>
                        <!--end::Menu 1-->
                    </div>
                    <!--end::Filter menu-->
                    <!--begin::Secondary button-->
                    <!--end::Secondary button-->
                    <!--begin::Primary button-->
                    {{-- <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_create_app">Create</a> --}}
                    <!--end::Primary button-->
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Card-->
                <div class="card table-responsive">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <div class="dataTables_filter ">
                                    {{-- begin::pencarian manual untuk data opd --}}
                                    <input type="text" id="search" data-kt-docs-table-filter="search"
                                        class="form-control form-control-solid w-250px ps-15" placeholder="Search.." />
                                    {{-- end::pencarian manual untuk data opd --}}
                                </div>
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                                <!--begin::Add customer-->
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    id="btnTambah">Tambah Data</button>
                                <!--end::Add customer-->
                            </div>
                            <!--end::Toolbar-->
                            <!--begin::Group actions-->
                            <div class="d-flex justify-content-end align-items-center d-none"
                                data-kt-customer-table-toolbar="selected">
                                <div class="fw-bold me-5">
                                    <span class="me-2" data-kt-customer-table-select="selected_count"></span>Selected
                                </div>
                                <button type="button" class="btn btn-danger"
                                    data-kt-customer-table-select="delete_selected">Delete Selected</button>
                            </div>
                            <!--end::Group actions-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table id="" class="table align-middle table-bordered fs-6 gy-5">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="text-center middle-align" rowspan="2">No</th>
                                    <th class="text-center middle-align" rowspan="2">Sasaran</th>
                                    <th class="text-center middle-align" rowspan="2">Indikator</th>
                                    <th class="text-center middle-align" rowspan="2">Tahun</th>
                                    <th class="text-center middle-align" rowspan="2">Target Kinerja Tahunan</th>
                                    <th class="text-center middle-align" rowspan="2">Satuan</th>
                                    <th class="text-center" colspan="4">Target</th>
                                    <th class="text-center middle-align" rowspan="2">Program/Kegiatan/Sub Kegiatan</th>
                                    <th class="text-center middle-align" rowspan="2">Anggaran</th>
                                    <th class="text-center min-w-70px middle-align" rowspan="2">Aksi</th>
                                </tr>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="text-center">TW I</th>
                                    <th class="text-center">TW II</th>
                                    <th class="text-center">TW III</th>
                                    <th class="text-center">TW IV</th>
                                </tr>
                            </thead>
                            <tbody class="fs-6 text-gray-600">
                                @foreach ($target as $data => $item)
                                @if ($item->has_child == null)
                                    <tr>
                                        <td>{{ $data + 1 }}</td>
                                        <td>{{ $item->sasaran }}</td>
                                        <td>{{ $item->indikator }}</td>
                                        <td class="text-center">{{ $item->tahun }}</td>

                                        <td class="text-center">{{ $item->target_kinerja_tahunan }}</td>
                                        <td class="text-center">
                                            @if ($item->satuan == '' || $item->satuan == null || $item->satuan == '-')
                                                {{ '' }}
                                            @else
                                                {{ $item->satuan }}
                                            @endif
                                        </td>
                                        <td>{{ $item->tw1 }}</td>
                                        <td>{{ $item->tw2 }}</td>
                                        <td>{{ $item->tw3 }}</td>
                                        <td>{{ $item->tw4 }}</td>
                                        <td>
                                            @if ($item->jenis_master == 'program')
                                                {{$item->program->nama}}
                                            @elseif ($item->jenis_master == 'kegiatan')
                                                {{$item->kegiatan->nama}}
                                            @elseif ($item->jenis_master == 'subkegiatan')
                                                {{$item->subkegiatan->nama}}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->anggaran == '' || $item->anggaran == null || $item->anggaran == 0 || $item->anggaran == '-')
                                                -
                                            @else
                                                @if (is_numeric($item->anggaran))
                                                    @rp($item->anggaran)
                                                @else
                                                    {{ $item->anggaran }}
                                                @endif
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center flex-shrink-1">
                                                <button data-id="{{ $item->id }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btn-edit">
                                                    <i class="ki-duotone ki-pencil fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </button>
                                                <button onclick="deleteItem({{ $item->id }})" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1">
                                                    <i class="ki-duotone ki-trash fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                        <span class="path5"></span>
                                                    </i>
                                                </button>
                                                @if ($item->has_child != 1)
                                                <button data-id="{{ $item->id }}" class="btn btn-icon btn-bg-light btn-active-color-success btn-sm btn-tambah">
                                                    <i class="ki-duotone ki-plus-square fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                    @foreach ($target as $subItem)
                                        @if ($subItem->parent_id == $item->id)
                                        <tr>
                                            <td colspan="4"></td>

                                            <td class="text-center">{{ $subItem->target_kinerja_tahunan }}</td>
                                            <td class="text-center">{{ $subItem->satuan }}</td>
                                            <td class="text-center">{{ $subItem->tw1 }}</td>
                                            <td class="text-center">{{ $subItem->tw2 }}</td>
                                            <td class="text-center">{{ $subItem->tw3 }}</td>
                                            <td class="text-center">{{ $subItem->tw4 }}</td>

                                            <td>
                                                @if ($subItem->jenis_master == 'program')
                                                    {{$subItem->program->nama}}
                                                @elseif ($subItem->jenis_master == 'kegiatan')
                                                    {{$subItem->kegiatan->nama}}
                                                @elseif ($subItem->jenis_master == 'subkegiatan')
                                                    {{$subItem->subkegiatan->nama}}
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($subItem->anggaran == '' || $subItem->anggaran == null || $subItem->anggaran == 0 || $subItem->anggaran == '-')
                                                    -
                                                @else
                                                    @if (is_numeric($subItem->anggaran))
                                                        @rp($subItem->anggaran)
                                                    @else
                                                        {{ $subItem->anggaran }}
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center flex-shrink-1">
                                                    <button data-id="{{ $subItem->id }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btn-edit">
                                                        <i class="ki-duotone ki-pencil fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </button>
                                                    <button onclick="deleteItem({{ $subItem->id }})" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1">
                                                        <i class="ki-duotone ki-trash fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                            <span class="path4"></span>
                                                            <span class="path5"></span>
                                                        </i>
                                                    </button>
                                                </div>

                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
                <!--begin::Modals-->
                @include('backend.' . Request::segment(2) . '.form')
                <!--end::Modals-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->

    {{-- begin::additional css --}}
    @push('css')
        <!--begin::Vendor Stylesheets(used for this page only)-->
        <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
            type="text/css" />
        <!--end::Vendor Stylesheets-->
        <style>
            .middle-align {
                vertical-align: middle;
            }
        </style>
    @endpush
    {{-- end::aditional css --}}
    {{-- begin::additional js --}}
    @push('js')
        <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <!--begin::Custom Javascript(used for this page only)-->
        <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
        <script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
        <script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
        <script src="{{ asset('assets/js/custom/utilities/modals/create-app.js') }}"></script>
        <script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>
        <!--end::Custom Javascript-->
    @endpush
    {{-- begin::custom js --}}
    @push('scripts')
        {{-- Script untuk mengambil data berdasarkan pilihan jenis_master --}}
        <script>
            document.getElementById('jenis_master').addEventListener('change', function() {
                updateMasterDropdown();
            });

            function updateMasterDropdown(master_id = null) {
                var jenisMaster = document.getElementById('jenis_master').value;
                var masterLabel = document.getElementById('master_label');
                var masterDropdown = document.getElementById('master_id');
                masterDropdown.innerHTML = '<option value="">Loading...</option>';

                switch (jenisMaster) {
                    case 'program':
                        masterLabel.textContent = 'Pilih Program';
                        break;
                    case 'kegiatan':
                        masterLabel.textContent = 'Pilih Kegiatan';
                        break;
                    case 'subkegiatan':
                        masterLabel.textContent = 'Pilih Subkegiatan';
                        break;
                    default:
                        masterLabel.textContent = '';
                        break;
                }

                fetch('{{ route('get-data') }}?jenis_master=' + jenisMaster)
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(data) {
                        masterDropdown.innerHTML = '<option value="">Pilih ' + jenisMaster.charAt(0).toUpperCase() +
                            jenisMaster.slice(1) + '</option>';
                        data.forEach(function(item) {
                            masterDropdown.innerHTML += '<option value="' + item.id + '">' + item.nama +
                                '</option>';
                        });
                        // Set nilai awal dropdown master_id berdasarkan data yang diedit
                        masterDropdown.value = master_id;
                    });
            }
        </script>
        {{-- End --}}
        @include('backend.' . Request::segment(2) . '.script')
    @endpush
    {{-- end::custom js --}}
    {{-- end::aditional js --}}
@endsection
