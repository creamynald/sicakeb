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
                    <li class="breadcrumb-item text-muted">Dashboards</li>
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
            <div class="row g-5 g-xl-10 mb-xl-10">
                <!--begin::Col-->
                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 4-->
                    <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Amount-->
                                    <span class="card-label fw-bold text-gray-900">Perjanjian Kinerja</span>
                                    <!--end::Amount-->
                                    <!--begin::Badge-->
                                    <span class="badge badge-light-success fs-base">
                                        <i class="ki-duotone fs-5 text-success ms-n1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>{{ date('Y') }}</span>
                                    <!--end::Badge-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Subtitle-->
                                <span class="text-gray-500 pt-1 fw-semibold fs-6">{{ auth()->user()->opd?->nama }}</span>
                                <!--end::Subtitle-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-2 pb-4 d-flex align-items-center">
                            <!--begin::Chart-->
                            <div class="d-flex flex-center me-5 pt-2">
                                <div id="kt_card_widget_4_chart" style="min-width: 70px; min-height: 70px"
                                    data-kt-size="70" data-kt-line="11"></div>
                            </div>
                            <!--end::Chart-->
                            <!--begin::Labels-->
                            <div class="d-flex flex-column content-justify-center w-100">
                                <!--begin::Label-->
                                <div class="d-flex fs-6 fw-semibold align-items-center">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-6px rounded-2 bg-danger me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <a href="{{ route('target.index') }}"
                                        class="text-gray-500 flex-grow-1 me-4">Target</a>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="fw-bolder text-gray-700 text-xxl-end">
                                        <!--begin::Actions-->
                                        <a href="{{ route('target.index') }}"
                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                            <i class="ki-duotone ki-arrow-right fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </a>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Label-->
                                <!--begin::Label-->
                                <div class="d-flex fs-6 fw-semibold align-items-center my-3">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <a href="{{ route('realisasi.index') }}"
                                        class="text-gray-500 flex-grow-1 me-4">Realisasi</a>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="fw-bolder text-gray-700 text-xxl-end">
                                        <!--begin::Actions-->
                                        <a href="{{ route('realisasi.index') }}"
                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                            <i class="ki-duotone ki-arrow-right fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </a>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Label-->
                                <!--begin::Label-->
                                <div class="d-flex fs-6 fw-semibold align-items-center">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-6px rounded-2 me-3" style="background-color: #E4E6EF">
                                    </div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <a href="{{ route('capaian') }}" class="text-gray-500 flex-grow-1 me-4">Capaian</a>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="fw-bolder text-gray-700 text-xxl-end">
                                        <!--begin::Actions-->
                                        <a href="{{ route('capaian') }}"
                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                            <i class="ki-duotone ki-arrow-right fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </a>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Labels-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 4-->
                    <!--begin::Card widget 5-->
                    <div class="card card-flush h-md-50 mb-xl-10">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Amount-->
                                    <span class="card-label fw-bold text-gray-900">Laporan Hasil Evaluasi</span>
                                    <!--end::Amount-->
                                    <!--begin::Badge-->
                                    <span class="badge badge-light-success fs-base">
                                        <i class="ki-duotone fs-5 text-success ms-n1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>{{ date('Y') }}</span>
                                    <!--end::Badge-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Subtitle-->
                                <span class="text-gray-500 pt-1 fw-semibold fs-6">{{ auth()->user()->opd?->nama }}</span>
                                <!--end::Subtitle-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex align-items-end pt-0">
                            <!--begin::Progress-->
                            <div class="d-flex align-items-center flex-column mt-3 w-100">
                                <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                    <a href="{{ route('lhe.index') }}" class="fw-bolder fs-6 text-gray-900">Tindak Lanjut
                                        LHE</a>
                                    <!--begin::Actions-->
                                    <a href="{{ route('lhe.index') }}"
                                        class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="ki-duotone ki-arrow-right fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                    <!--end::Actions-->
                                </div>
                                <div class="h-8px mx-3 w-100 bg-light-success rounded">
                                    <div class="bg-success rounded h-8px" role="progressbar" style="width: 100%;"
                                        aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!--end::Progress-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 5-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 6-->
                    <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Amount-->
                                    <span class="card-label fw-bold text-gray-900">Upload File</span>
                                    <!--end::Amount-->
                                    <!--begin::Badge-->
                                    <span class="badge badge-light-success fs-base">
                                        <i class="ki-duotone fs-5 text-success ms-n1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>2024</span>
                                    <!--end::Badge-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Subtitle-->
                                <span class="text-gray-500 pt-1 fw-semibold fs-6">{{ auth()->user()->opd?->nama }}</span>
                                <!--end::Subtitle-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-2 pb-4 d-flex align-items-center">
                            <!--begin::Labels-->
                            <div class="d-flex flex-column content-justify-center w-100">
                                <!--begin::Label-->
                                <div class="d-flex fs-6 fw-semibold align-items-center">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-6px rounded-2 bg-info me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <a href="{{ route('file.index', ['jenis_file' => 'RPJMD']) }}"
                                        class="text-gray-500 flex-grow-1 me-4">RPJMD</a>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="fw-bolder text-gray-700 text-xxl-end">
                                        <!--begin::Actions-->
                                        <a href="{{ route('file.index', ['jenis_file' => 'RPJMD']) }}"
                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                            <i class="ki-duotone ki-arrow-right fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </a>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Label-->
                                <!--begin::Label-->
                                <div class="d-flex fs-6 fw-semibold align-items-center my-3">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-6px rounded-2 bg-warning me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <a href="{{ route('file.index', ['jenis_file' => 'RENSTRA']) }}"
                                        class="text-gray-500 flex-grow-1 me-4">Renstra</a>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="fw-bolder text-gray-700 text-xxl-end">
                                        <!--begin::Actions-->
                                        <a href="{{ route('file.index', ['jenis_file' => 'RENSTRA']) }}"
                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                            <i class="ki-duotone ki-arrow-right fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </a>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Label-->
                                <!--begin::Label-->
                                <div class="d-flex fs-6 fw-semibold align-items-center">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-6px rounded-2 bg-dark me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <a href="{{ route('file.index', ['jenis_file' => 'LAKIP']) }}"
                                        class="text-gray-500 flex-grow-1 me-4">Lakip</a>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="fw-bolder text-gray-700 text-xxl-end">
                                        <!--begin::Actions-->
                                        <a href="{{ route('file.index', ['jenis_file' => 'LAKIP']) }}"
                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                            <i class="ki-duotone ki-arrow-right fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </a>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Labels-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 6-->

                    <!--begin::Card widget 7-->
                    <div class="card card-flush h-md-50 mb-xl-10">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Amount-->
                                <div class="d-flex align-items-center">
                                    <!--end::Amount-->
                                    <span class="card-label fw-bold text-gray-900">Pegawai </span>
                                    <!--end::Amount-->
                                    <!--begin::Badge-->
                                    <span class="badge badge-light-primary fs-base">
                                        <i class="ki-duotone fs-5 text-primary ms-n1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>{{ count($data_pegawai) }}</span>
                                    <!--end::Badge-->
                                </div>
                                <!--begin::Subtitle-->
                                <span class="text-gray-500 pt-1 fw-semibold fs-6">{{ auth()->user()->opd?->nama }}</span>
                                <!--end::Subtitle-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex flex-column justify-content-end pe-0">
                            <!--begin::Title-->
                            <span class="fs-6 fw-bolder text-gray-800 d-block mb-2">
                                {{-- @role('operator')
                                    {{ auth()->user()->opd?->nama }}
                                @endrole --}}
                            </span>
                            <!--end::Title-->
                            <!--begin::Users group-->
                            <div class="symbol-group symbol-hover flex-nowrap">
                                @foreach ($data_pegawai->take(6) as $item)
                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip"
                                        title="{{ $item->nama }}">
                                        <span
                                            class="symbol-label {{ 'bg-' . ['primary', 'success', 'danger', 'warning', 'info'][array_rand(['primary', 'success', 'danger', 'warning', 'info'])] }} text-inverse-warning fw-bold">{{ substr($item->nama, 0, 1) }}</span>
                                    </div>
                                @endforeach
                                <a href="{{ route('pegawai.index') }}" class="symbol symbol-35px symbol-circle"
                                    data-bs-toggle="tooltip" title="Semua Pegawai">
                                    <span class="symbol-label bg-light text-gray-400 fs-8 fw-bold">All</span>
                                </a>
                            </div>
                            <!--end::Users group-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 7-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
                    <!--begin::List widget 20-->
                    <div class="card h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-900">Data Master</span>
                                <span class="text-muted mt-1 fw-semibold fs-7">{{ auth()->user()->opd?->nama }}</span>
                            </h3>
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                {{-- <a href="#" class="btn btn-sm btn-light">All Courses</a> --}}
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-6">
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-40px me-4">
                                    <div class="symbol-label fs-2 fw-semibold bg-danger text-inverse-danger">O</div>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Section-->
                                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                    <!--begin:Author-->
                                    <div class="flex-grow-1 me-2">
                                        <a href="{{ route('opd.index') }}"
                                            class="text-gray-800 text-hover-primary fs-6 fw-bold">OPD</a>
                                        <span class="text-muted fw-semibold d-block fs-7">{{ $data_opd }} OPD
                                            Pemerintahan</span>
                                    </div>
                                    <!--end:Author-->
                                    <!--begin::Actions-->
                                    <a href="{{ route('opd.index') }}"
                                        class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="ki-duotone ki-arrow-right fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                    <!--begin::Actions-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-4"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-40px me-4">
                                    <div class="symbol-label fs-2 fw-semibold bg-success text-inverse-success">T</div>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Section-->
                                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                    <!--begin:Author-->
                                    <div class="flex-grow-1 me-2">
                                        <a href="{{ route('tujuan.index') }}"
                                            class="text-gray-800 text-hover-primary fs-6 fw-bold">Tujuan</a>
                                        <span class="text-muted fw-semibold d-block fs-7">{{ $data_tujuan }}
                                            Tujuan</span>
                                    </div>
                                    <!--end:Author-->
                                    <!--begin::Actions-->
                                    <a href="{{ route('tujuan.index') }}"
                                        class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="ki-duotone ki-arrow-right fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                    <!--begin::Actions-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-4"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-40px me-4">
                                    <div class="symbol-label fs-2 fw-semibold bg-info text-inverse-info">S</div>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Section-->
                                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                    <!--begin:Author-->
                                    <div class="flex-grow-1 me-2">
                                        <a href="{{ route('sasaran.index') }}"
                                            class="text-gray-800 text-hover-primary fs-6 fw-bold">Sasaran</a>
                                        <span class="text-muted fw-semibold d-block fs-7">{{ $data_sasaran }}</span>
                                    </div>
                                    <!--end:Author-->
                                    <!--begin::Actions-->
                                    <a href="{{ route('sasaran.index') }}"
                                        class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="ki-duotone ki-arrow-right fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                    <!--begin::Actions-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-4"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-40px me-4">
                                    <div class="symbol-label fs-2 fw-semibold bg-primary text-inverse-primary">P</div>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Section-->
                                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                    <!--begin:Author-->
                                    <div class="flex-grow-1 me-2">
                                        <a href="{{ route('program.index') }}"
                                            class="text-gray-800 text-hover-primary fs-6 fw-bold">Program</a>
                                        <span class="text-muted fw-semibold d-block fs-7">{{ $data_program }}
                                            Program.</span>
                                    </div>
                                    <!--end:Author-->
                                    <!--begin::Actions-->
                                    <a href="{{ route('program.index') }}"
                                        class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="ki-duotone ki-arrow-right fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                    <!--begin::Actions-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-4"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-40px me-4">
                                    <div class="symbol-label fs-2 fw-semibold bg-warning text-inverse-warning">K</div>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Section-->
                                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                    <!--begin:Author-->
                                    <div class="flex-grow-1 me-2">
                                        <a href="{{ route('kegiatan.index') }}"
                                            class="text-gray-800 text-hover-primary fs-6 fw-bold">Kegiatan</a>
                                        <span class="text-muted fw-semibold d-block fs-7">{{ $data_kegiatan }}
                                            Kegiatan</span>
                                    </div>
                                    <!--end:Author-->
                                    <!--begin::Actions-->
                                    <a href="{{ route('kegiatan.index') }}"
                                        class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="ki-duotone ki-arrow-right fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                    <!--begin::Actions-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-4"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-40px me-4">
                                    <div class="symbol-label fs-2 fw-semibold bg-dark text-inverse-dark">S</div>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Section-->
                                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                    <!--begin:Author-->
                                    <div class="flex-grow-1 me-2">
                                        <a href="{{ route('subkegiatan.index') }}"
                                            class="text-gray-800 text-hover-primary fs-6 fw-bold">Sub Kegiatan</a>
                                        <span class="text-muted fw-semibold d-block fs-7">{{ $data_subkegiatan }} Sub
                                            Kegiatan</span>
                                    </div>
                                    <!--end:Author-->
                                    <!--begin::Actions-->
                                    <a href="{{ route('subkegiatan.index') }}"
                                        class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="ki-duotone ki-arrow-right fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                    <!--begin::Actions-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::List widget 20-->
                </div>
                <!--end::Col-->
                <!--end::Row-->
                <!--begin::Row-->
                {{-- recent order and discounted sales section from demo1/dashboard --}}
                <!--end::Row-->
                <!--begin::Row-->
                @role('Super-Admin')
                    <div class="row gy-5 g-xl-10">
                        <!--begin::Col-->
                        <div class="col-xl-4 mb-xl-10">
                            <!--begin::List widget 5-->
                            <div class="card card-flush">
                                <!--begin::Header-->
                                <div class="card-header pt-7">
                                    <!--begin::Title-->
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-gray-900">Online User</span>
                                        <span class="text-gray-500 mt-1 fw-semibold fs-6">{{ $onlineUsers->count() }} sedang
                                            online</span>
                                    </h3>
                                    <!--end::Title-->
                                    <!--begin::Toolbar-->
                                    <div class="card-toolbar">
                                        <a href="#" class="btn btn-sm btn-light">Reload Data</a>
                                    </div>
                                    <!--end::Toolbar-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body">
                                    <!--begin::Scroll-->
                                    <div class="hover-scroll-overlay-y pe-6 me-n6" style="height: 415px">
                                        <!--begin::Item-->
                                        @foreach ($allUsersSorted as $item)
                                            <div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
                                                <!--begin::Info-->
                                                <div class="d-flex flex-stack mb-3">
                                                    <!--begin::Wrapper-->
                                                    <div class="me-3">
                                                        <!--begin::Icon-->
                                                        <img src="{{ $item->avatar ? url('/avatars/' . $item->avatar) : asset('assets/media/avatars/blank.png') }}"
                                                            class="w-50px ms-n1 me-1" alt="Logo" />
                                                        <!--end::Icon-->
                                                        <!--begin::Title-->
                                                        <a href="#"
                                                            class="text-gray-800 text-hover-primary fw-bold">{{ $item->name }}</a>
                                                        <!--end::Title-->
                                                    </div>
                                                    <!--end::Wrapper-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Customer-->
                                                <div class="d-flex flex-stack">
                                                    <!--begin::Name-->
                                                    <span class="text-gray-500 fw-bold">OPD:
                                                        <a href="#"
                                                            class="text-gray-800 text-hover-primary fw-bold">{{ $item->opd?->nama }}</a></span>
                                                    <!--end::Name-->
                                                    <!--begin::Label-->
                                                    @if ($item->is_online)
                                                        <span class="badge badge-light-success">Online</span>
                                                    @endif
                                                    <!--end::Label-->
                                                </div>
                                                <div class="d-flex flex-stack">
                                                    <!--begin::Label-->
                                                    @if (!$item->is_online)
                                                        <span class="text-gray-500 fw-bold">Last Login :
                                                            <a href="#"
                                                                class="text-gray-800 text-hover-primary fw-bold">{{ \Carbon\Carbon::parse($item->last_login_at)->format('d M Y, H:i') }}</a>
                                                        </span>
                                                    @endif
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Customer-->
                                            </div>
                                        @endforeach
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Scroll-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::List widget 5-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xl-8 mb-5 mb-xl-10">
                            <!--begin::Table Widget 4-->
                            <div class="card card-flush">
                                <!--begin::Card header-->
                                <div class="card-header pt-7">
                                    <!--begin::Title-->
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-gray-800">Log Activity</span>
                                        <span class="text-gray-500 mt-1 fw-semibold fs-6">Catatan aktifitas pengguna</span>
                                    </h3>
                                    <!--end::Title-->
                                    <!--begin::Actions-->
                                    <div class="card-toolbar">
                                        <!--begin::Filters-->
                                        <div class="d-flex flex-stack flex-wrap gap-4">
                                            <!--begin::Destination-->
                                            {{-- <div class="d-flex align-items-center fw-bold">
                                        <!--begin::Label-->
                                        <div class="text-gray-500 fs-7 me-2">Cateogry</div>
                                        <!--end::Label-->
                                        <!--begin::Select-->
                                        <select
                                            class="form-select form-select-transparent text-graY-800 fs-base lh-1 fw-bold py-0 ps-3 w-auto"
                                            data-control="select2" data-hide-search="true"
                                            data-dropdown-css-class="w-150px" data-placeholder="Select an option">
                                            <option></option>
                                            <option value="Show All" selected="selected">Show All</option>
                                            <option value="a">Category A</option>
                                            <option value="b">Category A</option>
                                        </select>
                                        <!--end::Select-->
                                    </div> --}}
                                            <!--end::Destination-->
                                            <!--begin::Status-->
                                            {{-- <div class="d-flex align-items-center fw-bold">
                                        <!--begin::Label-->
                                        <div class="text-gray-500 fs-7 me-2">Status</div>
                                        <!--end::Label-->
                                        <!--begin::Select-->
                                        <select
                                            class="form-select form-select-transparent text-gray-900 fs-7 lh-1 fw-bold py-0 ps-3 w-auto"
                                            data-control="select2" data-hide-search="true"
                                            data-dropdown-css-class="w-150px" data-placeholder="Select an option"
                                            data-kt-table-widget-4="filter_status">
                                            <option></option>
                                            <option value="Show All" selected="selected">Show All</option>
                                            <option value="Shipped">Shipped</option>
                                            <option value="Confirmed">Confirmed</option>
                                            <option value="Rejected">Rejected</option>
                                            <option value="Pending">Pending</option>
                                        </select>
                                        <!--end::Select-->
                                    </div> --}}
                                            <!--end::Status-->
                                            <!--begin::Search-->
                                            {{-- <div class="position-relative my-1">
                                        <i
                                            class="ki-duotone ki-magnifier fs-2 position-absolute top-50 translate-middle-y ms-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <input type="text" data-kt-table-widget-4="search"
                                            class="form-control w-150px fs-7 ps-12" placeholder="Search" />
                                    </div> --}}
                                            <!--end::Search-->
                                        </div>
                                        <!--begin::Filters-->
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-2">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-dashed fs-6 gy-3" id="activities-table">
                                        <!--begin::Table head-->
                                        <thead>
                                            <!--begin::Table row-->
                                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                                <th class="min-w-60px">No</th>
                                                <th class="text-start min-w-60px">Aksi</th>
                                                <th class="text-start min-w-125px">Model</th>
                                                <th class="text-start min-w-100px">User</th>
                                                <th class="text-start min-w-50px">Waktu</th>
                                                <th>Atribut</th>
                                                <th>Lawas</th>
                                            </tr>
                                            <!--end::Table row-->
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->
                                        <tbody class="fw-bold text-gray-600">
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Table Widget 4-->
                        </div>
                        <!--end::Col-->
                    </div>
                @endrole
                <!--end::Row-->
            </div>
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
