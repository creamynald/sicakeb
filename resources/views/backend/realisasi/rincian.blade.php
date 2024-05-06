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
                                    <th class="text-center" colspan="2">TW I</th>
                                    <th class="text-center" colspan="2">TW II</th>
                                    <th class="text-center" colspan="2">TW III</th>
                                    <th class="text-center" colspan="2">TW IV</th>
                                    <th class="text-center middle-align" rowspan="2">Realisasi Anggaran</th>
                                    <th class="text-center middle-align" rowspan="2">Penghambat</th>
                                    <th class="text-center middle-align" rowspan="2">Pendukung</th>
                                    <th class="text-center middle-align" rowspan="2">Solusi</th>
                                    <th class="text-center min-w-70px middle-align" rowspan="2">Aksi</th>
                                </tr>
                                <tr>
                                    <th class="text-center">T</th>
                                    <th class="text-center">R</th>

                                    <th class="text-center">T</th>
                                    <th class="text-center">R</th>

                                    <th class="text-center">T</th>
                                    <th class="text-center">R</th>

                                    <th class="text-center">T</th>
                                    <th class="text-center">R</th>
                                </tr>
                            </thead>
                            <tbody class="fs-6 text-gray-600">
                                @foreach ($target as $data => $item)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $data + 1 }}</td>
                                        <td>{{ $item->sasaran }}</td>
                                        <td>{{ $item->indikator }}</td>
                                        <td class="text-center">{{ $item->tahun }}</td>
                                        <td class="text-center">{{ $item->tw1 }}</td>
                                        <td class="text-center">{{ $realisasi->getRealisasi($item->id)->tw1??'' }}</td>
                                        <td class="text-center">{{ $item->tw2 }}</td>
                                        <td class="text-center">{{ $realisasi->getRealisasi($item->id)->tw2??'' }}</td>
                                        <td class="text-center">{{ $item->tw3 }}</td>
                                        <td class="text-center">{{ $realisasi->getRealisasi($item->id)->tw3??'' }}</td>
                                        <td class="text-center">{{ $item->tw4 }}</td>
                                        <td class="text-center">{{ $realisasi->getRealisasi($item->id)->tw4??'' }}</td>
                                        <td class="text-center">
                                            @if ($realisasi->getRealisasi($item->id) != null)
                                                @if ($realisasi->getRealisasi($item->id)->realisasi_anggaran == ''
                                                || $realisasi->getRealisasi($item->id)->realisasi_anggaran == 0
                                                || $realisasi->getRealisasi($item->id)->realisasi_anggaran == '-'
                                                || $realisasi->getRealisasi($item->id)->realisasi_anggaran == null)
                                                    -
                                                @else
                                                    @if (is_numeric($realisasi->getRealisasi($item->id)->realisasi_anggaran))
                                                        @rp($realisasi->getRealisasi($item->id)->realisasi_anggaran)
                                                    @else
                                                        {{$realisasi->getRealisasi($item->id)->realisasi_anggaran}}
                                                    @endif
                                                @endif
                                            @else
                                                 <span style="color: red;">Realisasi belum diisi</span>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $realisasi->getRealisasi($item->id)->pendukung??'' }}</td>
                                        <td class="text-center">{{ $realisasi->getRealisasi($item->id)->penghambat??'' }}</td>
                                        <td class="text-center">{{ $realisasi->getRealisasi($item->id)->solusi??'' }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center flex-shrink-0">
                                                <button data-id="{{$realisasi->getRealisasi($item->id)->id??''}}" data-target-pk="{{$item->id}}"
                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btn-edit">
                                                    <i class="ki-duotone ki-pencil fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
                <!--begin::Modals-->
                <!-- Modal Tambah/Edit -->
                @include('backend.'.Request::segment(2).'.form')
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
    @push('scripts')
        @include('backend.' . Request::segment(2) . '.script')
    @endpush
    {{-- end::custom js --}}
    {{-- end::aditional js --}}
@endsection
