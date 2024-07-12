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
                        Rincian @urlSegment(2)</h1>
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
                            <p>Nama: {{$pegawai->nama}}</p>
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
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($target as $data => $item)
                                @if ($item->has_child == null)
                                    <tr>
                                        <td>{{ $no++ }}</td>
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
                                                <button data-id="{{ $item->id }}" data-parent-id="{{$item->parent_id}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btn-edit">
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
                                                @if ($item->has_child != 1 || $item->jenis_child == 'indikator')
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
                                            <td colspan="@if ($subItem->jenis_child == 'indikator') 2 @else 10 @endif"></td>
                                            @if ($subItem->jenis_child == 'indikator')
                                            <td class="text-center">{{ $subItem->indikator }}</td>
                                            <td class="text-center">{{ $subItem->tahun }}</td>
                                            <td class="text-center">{{ $subItem->target_kinerja_tahunan }}</td>
                                            <td class="text-center">{{ $subItem->satuan }}</td>
                                            <td class="text-center">{{ $subItem->tw1 }}</td>
                                            <td class="text-center">{{ $subItem->tw2 }}</td>
                                            <td class="text-center">{{ $subItem->tw3 }}</td>
                                            <td class="text-center">{{ $subItem->tw4 }}</td>
                                            @endif

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
                                                    <button data-id="{{ $subItem->id }}" data-parent-id="{{$subItem->parent_id}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btn-edit">
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
                                                    @if ($subItem->jenis_child == 'indikator')
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
