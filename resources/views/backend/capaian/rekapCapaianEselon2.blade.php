@extends('backend.layouts.base')
@section('content')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Dashboard</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="index.html" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Rata-Rata Capaian</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Secondary button-->
                {{-- <a href="apps/ecommerce/sales/listing.html" class="btn btn-sm fw-bold btn-secondary">Manage Sales</a> --}}
                <!--end::Secondary button-->
                <!--begin::Primary button-->
                {{-- <a href="apps/ecommerce/catalog/add-product.html" class="btn btn-sm fw-bold btn-primary">Add Product</a> --}}
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
            <!--begin::Row-->
            <!--begin::Category-->
            <div class="card card-flush mb-5">
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->

                        <!--end::Search-->
                    </div>
                    <!--end::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">

                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_category_table">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                <th>No</th>
                                <th>Nama Perangkat Daerah</th>
                                <th>Rata-Rata Capaian</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @php
                                $sortedOpds = $opds->sortByDesc(function ($opd) use ($opdAverages) {
                                    return $opdAverages[$opd->nama] ?? 0;
                                });
                                $no = 1;
                            @endphp
                            @foreach ($sortedOpds as $item => $opd)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $opd->nama }}</td>
                                    <td>{{ $opdAverages[$opd->nama] ?? 0 }}%</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Category-->
            <!--end::Content container-->
        </div>
        <!--end::Content-->

        @push('css')
            <!--begin::Vendor Stylesheets(used for this page only)-->
            <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
                type="text/css" />
            <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
                type="text/css" />
            <!--end::Vendor Stylesheets-->
        @endpush
        @push('js')
            <!--begin::Vendors Javascript(used for this page only)-->
            <script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
            <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
            <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
            <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
            <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
            <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
            <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
            <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
            <script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
            <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
            <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
            <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
            <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
            <!--end::Vendors Javascript-->
            <!--begin::Custom Javascript(used for this page only)-->
            <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
            <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
            <script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
            <script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
            <script src="{{ asset('assets/js/custom/utilities/modals/create-app.js') }}"></script>
            <script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>
            <!--end::Custom Javascript-->
        @endpush

        @push('scripts')
            @if (session('error'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: '{{ session('error') }}', // Menampilkan pesan error dari session
                    });
                </script>
            @endif

            <script>
                $(document).ready(function() {
                    function fetchActivities(filters = {}) {
                        $('#activities-table').DataTable({
                            processing: true,
                            serverSide: true,
                            responsive: true,
                            ajax: {
                                url: '{{ route('activities') }}',
                                data: filters
                            },
                            columns: [{
                                    data: 'DT_RowIndex',
                                    name: 'DT_RowIndex',
                                    orderable: false,
                                    searchable: false
                                },
                                {
                                    data: 'description',
                                    name: 'description'
                                },
                                {
                                    data: 'log_name',
                                    name: 'log_name'
                                },
                                {
                                    data: 'user_name',
                                    name: 'user_name'
                                },
                                {
                                    data: 'time',
                                    name: 'time'
                                },
                                {
                                    data: 'properties',
                                    name: 'properties',
                                    orderable: false,
                                    searchable: false
                                },
                                {
                                    data: 'old_data',
                                    name: 'old_data',
                                    orderable: false,
                                    searchable: false
                                }
                            ]
                        });
                    }

                    // Initialize DataTable
                    fetchActivities();

                    // Filter form submission
                    $('#filters').on('submit', function(e) {
                        e.preventDefault();
                        var filters = {
                            day: $('#day').val(),
                            month: $('#month').val(),
                            year: $('#year').val()
                        };
                        $('#activities-table').DataTable().destroy();
                        fetchActivities(filters);
                    });
                });
            </script>
        @endpush
    @endsection
