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
                        @urlSegment(2)</h1>
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
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <div class="dataTables_filter ">
                                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                                        @urlSegment(2) Tahun @php echo isset ($_GET['periode']) ? $_GET['periode'] : date('Y') @endphp </h1>
                                </div>
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table id="" class="table align-middle table-bordered fs-6 gy-5">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold align-middle fs-7 text-uppercase gs-0">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Program/Kegiatan/Subkegiatan</th>
                                    <th class="text-center">Indikator</th>
                                    <th class="text-center">Anggaran</th>
                                    <th class="text-center">Target Kinerja Tahunan</th>
                                    <th class="text-center">Realisasi</th>
                                    <th class="text-center">Capaian</th>
                                    <th class="text-center">Tingkat Efisiensi</th>
                                    <th class="text-center">Faktor</th>
                                </tr>
                            </thead>
                            <tbody class="fs-6 text-gray-600">
                                @foreach ($target as $data => $item)
                                    <tr>
                                        <td class="text-center align-middle">{{ $data + 1 }}</td>
                                        <td>
                                            @if ($item->jenis_master == 'program')
                                                {{$item->program->nama}}
                                            @elseif ($item->jenis_master == 'kegiatan')
                                                {{$item->kegiatan->nama}}
                                            @elseif ($item->jenis_master == 'subkegiatan')
                                                {{$item->subkegiatan->nama}}
                                            @endif
                                        </td>
                                        <td>{{ $item->indikator }}</td>
                                        <td class="text-center">@rp($item->anggaran)</td>
                                        <td class="text-center">{{ $item->target_kinerja_tahunan }}</td>
                                        <td>{{ $item->tw1 }}</td>
                                        <td>{{ $item->tw2 }}</td>
                                        <td>{{ $item->tw3 }}</td>
                                        <td>Opsional</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
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
        <script src="{{ asset('assets/js/custom/apps/customers/list/export.js') }}"></script>
        <script src="{{ asset('assets/js/custom/apps/customers/list/list.js') }}"></script>
        <script src="{{ asset('assets/js/custom/apps/customers/add.js') }}"></script>
        <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
        <script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
        <script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
        <script src="{{ asset('assets/js/custom/utilities/modals/create-app.js') }}"></script>
        <script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>
        <!--end::Custom Javascript-->
    @endpush
    {{-- begin::custom js --}}
    {{-- @push('scripts')
        @include('backend.' . Request::segment(2) . '.script')
    @endpush --}}
    {{-- end::custom js --}}
    {{-- end::aditional js --}}
@endsection
