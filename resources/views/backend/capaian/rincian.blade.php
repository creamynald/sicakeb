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
                        @urlSegment(2) Detail</h1>
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

                            </div>
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->

                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table id="" class="table table-responsive align-middle table-bordered fs-6 gy-5">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="text-center middle-align">No</th>
                                    <th class="text-center middle-align">Sasaran</th>
                                    <th class="text-center middle-align">Indikator Kinerja</th>
                                    <th class="text-center middle-align">Target Kinerja Tahunan</th>
                                    <th class="text-center middle-align">Realisasi Kinerja</th>
                                    <th class="text-center middle-align">Capaian Kinerja</th>
                                    <th class="text-center middle-align">
                                        @if ($pegawai->eselon == 'II')
                                            Program
                                        @elseif ($pegawai->eselon == 'III')
                                            Kegiatan
                                        @elseif ($pegawai->eselon == 'IV')
                                            Sub Kegiatan
                                        @endif
                                    </th>
                                    <th class="text-center middle-align">Anggaran</th>
                                    <th class="text-center middle-align">Tingkat Efisiensi</th>
                                    <th class="text-center middle-align">Faktor Pendukung</th>
                                    <th class="text-center middle-align">Faktor Penghambat</th>
                                </tr>
                            </thead>
                            <tbody class="fs-6 text-gray-600">
                                @foreach ($target as $data => $item)
                                @if ($item->has_child == null)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $data + 1 }}</td>
                                        <td>{{ $item->sasaran }}</td>
                                        <td>{{ $item->indikator }}</td>
                                        <td class="text-center">{{ $item->target_kinerja_tahunan }}</td>
                                        <td class="text-center">
                                            @if ($realisasi->getRealisasi($item->id)?->realisasi_manual != null && $realisasi->getRealisasi($item->id)->realisasi_manual != '-' && $realisasi->getRealisasi($item->id)->realisasi_manual != 0)
                                                {{ $realisasi->getRealisasi($item->id)?->realisasi_manual ?? '-'}}
                                            @else
                                                @if (is_numeric($item->target_kinerja_tahunan))
                                                    @php
                                                        echo $realisasi->converTw(
                                                            $realisasi->getRealisasi($item->id)->tw1 ?? '',
                                                            ) +
                                                            $realisasi->converTw(
                                                                $realisasi->getRealisasi($item->id)->tw2 ?? '',
                                                            ) +
                                                            $realisasi->converTw(
                                                                $realisasi->getRealisasi($item->id)->tw3 ?? '',
                                                            ) +
                                                            $realisasi->converTw(
                                                                $realisasi->getRealisasi($item->id)->tw4 ?? '',
                                                            );
                                                    @endphp
                                                @else
                                                    {{ $realisasi->getRealisasi($item->id)->tw4 ?? 'Menunggu TW IV' }}
                                                @endif
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($realisasi->getRealisasi($item->id)?->capaian != null && $realisasi->getRealisasi($item->id)->capaian != '-' && $realisasi->getRealisasi($item->id)->capaian != 0)
                                                {{ $realisasi->getRealisasi($item->id)?->capaian .'%' ?? '-'}}
                                            @else
                                                @if (is_numeric($item->target_kinerja_tahunan))
                                                    {{ round(
                                                        (($realisasi->converTw($realisasi->getRealisasi($item->id)->tw1 ?? '') +
                                                            $realisasi->converTw($realisasi->getRealisasi($item->id)->tw2 ?? '') +
                                                            $realisasi->converTw($realisasi->getRealisasi($item->id)->tw3 ?? '') +
                                                            $realisasi->converTw($realisasi->getRealisasi($item->id)->tw4 ?? '')) /
                                                            $item->target_kinerja_tahunan) *
                                                            100,
                                                        2,
                                                    ) . '%' }}
                                                @else
                                                    {{ $realisasi->getRealisasi($item->id)->tw4 ?? 'Menunggu TW IV' }}
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->jenis_master == 'program')
                                                {{ $item->program->nama }}
                                            @elseif ($item->jenis_master == 'kegiatan')
                                                {{ $item->kegiatan->nama }}
                                            @elseif ($item->jenis_master == 'subkegiatan')
                                                {{ $item->subkegiatan->nama }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($item->anggaran == '' || $item->anggaran == null || $item->anggaran == 0 || $item->anggaran == '-')
                                            -
                                            @else
                                                @if (is_numeric($item->anggaran))
                                                    @rp($item->anggaran)
                                                @else
                                                    {{$item->anggaran}}
                                                @endif
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($item->anggaran == '' || $item->anggaran == null || $item->anggaran == 0 || $item->anggaran == '-')
                                                -
                                            @else
                                                @if ($realisasi->getRealisasi($item->id) == null)
                                                    <span style="color: red;">Realisasi Belum Diisi</span>
                                                @else
                                                    @if ($realisasi->getRealisasi($item->id)->realisasi_anggaran == null || $realisasi->getRealisasi($item->id)->realisasi_anggaran == '' || $realisasi->getRealisasi($item->id)->realisasi_anggaran == '-')
                                                        -
                                                    @else
                                                        @if ($item->anggaran > $realisasi->getRealisasi($item->id)->realisasi_anggaran)
                                                            Efisien
                                                        @elseif ($item->anggaran < $realisasi->getRealisasi($item->id)->realisasi_anggaran)
                                                            Tidak Efisien
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{ $realisasi->getRealisasi($item->id)->pendukung ?? '-' }}</td>
                                        <td>{{ $realisasi->getRealisasi($item->id)->penghambat ?? '-' }}</td>
                                    </tr>
                                @endif
                                    @foreach ($target as $subItem)
                                    @if ($subItem->parent_id == $item->id)
                                    <tr>
                                        <td colspan="@if ($subItem->jenis_child == 'indikator') 2 @else 6 @endif"></td>
                                        @if ($subItem->jenis_child == 'indikator')
                                        <td>{{ $subItem->indikator }}</td>
                                        <td class="text-center">{{ $subItem->target_kinerja_tahunan }}</td>
                                        <td class="text-center">
                                            @if ($realisasi->getRealisasi($subItem->id)?->realisasi_manual != null && $realisasi->getRealisasi($subItem->id)->realisasi_manual != '-' && $realisasi->getRealisasi($subItem->id)->realisasi_manual != 0)
                                                {{ $realisasi->getRealisasi($subItem->id)?->realisasi_manual ?? '-'}}
                                            @else
                                                @if (is_numeric($subItem->target_kinerja_tahunan))
                                                    @php
                                                        echo $realisasi->converTw(
                                                            $realisasi->getRealisasi($subItem->id)->tw1 ?? '',
                                                            ) +
                                                            $realisasi->converTw(
                                                                $realisasi->getRealisasi($subItem->id)->tw2 ?? '',
                                                            ) +
                                                            $realisasi->converTw(
                                                                $realisasi->getRealisasi($subItem->id)->tw3 ?? '',
                                                            ) +
                                                            $realisasi->converTw(
                                                                $realisasi->getRealisasi($subItem->id)->tw4 ?? '',
                                                            );
                                                    @endphp
                                                @else
                                                    {{ $realisasi->getRealisasi($subItem->id)->tw4 ?? 'Menunggu TW IV' }}
                                                @endif
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($realisasi->getRealisasi($subItem->id)?->capaian != null && $realisasi->getRealisasi($subItem->id)->capaian != '-' && $realisasi->getRealisasi($subItem->id)->capaian != 0)
                                                {{ $realisasi->getRealisasi($subItem->id)?->capaian .'%' ?? '-'}}
                                            @else
                                                @if (is_numeric($subItem->target_kinerja_tahunan))
                                                    {{ round(
                                                        (($realisasi->converTw($realisasi->getRealisasi($subItem->id)->tw1 ?? '') +
                                                            $realisasi->converTw($realisasi->getRealisasi($subItem->id)->tw2 ?? '') +
                                                            $realisasi->converTw($realisasi->getRealisasi($subItem->id)->tw3 ?? '') +
                                                            $realisasi->converTw($realisasi->getRealisasi($subItem->id)->tw4 ?? '')) /
                                                            $subItem->target_kinerja_tahunan) *
                                                            100,
                                                        2,
                                                    ) . '%' }}
                                                @else
                                                    {{ $realisasi->getRealisasi($subItem->id)->tw4 ?? 'Menunggu TW IV' }}
                                                @endif
                                            @endif
                                        </td>
                                        @endif
                                        <td>
                                            @if ($subItem->jenis_master == 'program')
                                                {{ $subItem->program->nama }}
                                            @elseif ($subItem->jenis_master == 'kegiatan')
                                                {{ $subItem->kegiatan->nama }}
                                            @elseif ($subItem->jenis_master == 'subkegiatan')
                                                {{ $subItem->subkegiatan->nama }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($subItem->anggaran == '' || $subItem->anggaran == null || $subItem->anggaran == 0 || $subItem->anggaran == '-')
                                            -
                                            @else
                                                @if (is_numeric($subItem->anggaran))
                                                    @rp($subItem->anggaran)
                                                @else
                                                    {{$subItem->anggaran}}
                                                @endif
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($subItem->anggaran == '' || $subItem->anggaran == null || $subItem->anggaran == 0 || $subItem->anggaran == '-')
                                                -
                                            @else
                                                @if ($realisasi->getRealisasi($subItem->id) == null)
                                                    <span style="color: red;">Realisasi Belum Diisi</span>
                                                @else
                                                    @if ($realisasi->getRealisasi($subItem->id)->realisasi_anggaran == null || $realisasi->getRealisasi($subItem->id)->realisasi_anggaran == '' || $realisasi->getRealisasi($subItem->id)->realisasi_anggaran == '-')
                                                        -
                                                    @else
                                                        @if ($subItem->anggaran > $realisasi->getRealisasi($subItem->id)->realisasi_anggaran)
                                                            Efisien
                                                        @elseif ($subItem->anggaran < $realisasi->getRealisasi($subItem->id)->realisasi_anggaran)
                                                            Tidak Efisien
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{ $realisasi->getRealisasi($subItem->id)->pendukung ?? '-' }}</td>
                                        <td>{{ $realisasi->getRealisasi($subItem->id)->penghambat ?? '-' }}</td>
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
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->

    {{-- begin::additional css --}}
    @push('css')
        <!--begin::Vendor Stylesheets(used for this page only)-->
        <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
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
        @include('backend.' . Request::segment(2) . '.script')
    @endpush
    {{-- end::custom js --}}
    {{-- end::aditional js --}}
@endsection
