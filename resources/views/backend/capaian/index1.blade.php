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
                        Rekap Capaian OPD</h1>
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
                        <li class="breadcrumb-item text-muted">Rekap capaian OPD</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Filter menu-->
                    <div class="m-0">
                    </div>
                    <!--end::Filter menu-->
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
                                        Rekap Capaian OPD Tahun @php echo isset ($_GET['periode']) ? $_GET['periode'] : date('Y') @endphp </h1>
                                </div>
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0 table-responsive">
                        <!--begin::Table-->
                        <table id="" class="table align-middle table-bordered fs-6 gy-5 table-striped w-auto">
                            <thead class="sticky-top">
                                <tr class="text-start text-gray-500 fw-bold align-middle fs-7 text-uppercase gs-0">
                                    <th class="text-center" rowspan="2">No</th>
                                    <th rowspan="2">Sasaran</th>
                                    {{-- <th class="text-center">Program/Kegiatan/Subkegiatan</th> --}}
                                    <th class="text-center" rowspan="2">Indikator</th>
                                    <th class="text-center" rowspan="2">Anggaran</th>
                                    <th class="text-center" rowspan="2">Target Kinerja Tahunan</th>
                                    <th class="text-center" colspan="2">TW I</th>
                                    <th class="text-center" colspan="2">TW II</th>
                                    <th class="text-center" colspan="2">TW III</th>
                                    <th class="text-center" colspan="2">TW IV</th>
                                    <th class="text-center" rowspan="2">Realisasi</th>
                                    <th class="text-center" rowspan="2">Capaian</th>
                                </tr>
                                <tr>
                                    <th class="text-center">T</th>
                                    <th class="text-center" style="background-color: rgba(155, 155, 155, 0.162);">R</th>
                                    <th class="text-center">T</th>
                                    <th class="text-center" style="background-color: rgba(155, 155, 155, 0.162);">R</th>
                                    <th class="text-center">T</th>
                                    <th class="text-center" style="background-color: rgba(155, 155, 155, 0.162);">R</th>
                                    <th class="text-center">T</th>
                                    <th class="text-center" style="background-color: rgba(155, 155, 155, 0.162);">R</th>
                                </tr>
                            </thead>
                            <tbody class="fs-6 text-gray-600">
                                @php
                                    $totalCapaian = 0;
                                    $jumlahItem = 0;
                                @endphp
                                @foreach ($target as $data => $item)
                                @php
                                    $realisasiItem = $realisasi->getRealisasi($item->id);
                                    $capaianValid = false;
                                @endphp
                                    <tr>
                                        <td class="text-center align-middle">{{ $data + 1 }}</td>
                                        <td>{{$item->sasaran}}</td>
                                        {{-- <td>
                                            @if ($item->jenis_master == 'program')
                                                {{ $item->program?->nama }}
                                            @elseif ($item->jenis_master == 'kegiatan')
                                                {{ $item->kegiatan?->nama }}
                                            @elseif ($item->jenis_master == 'subkegiatan')
                                                {{ $item->subkegiatan?->nama }}
                                            @endif
                                        </td> --}}
                                        <td>{{ $item->indikator }}</td>
                                        <td class="text-center">
                                            @if ($item->anggaran == '' || $item->anggaran == null)
                                                -
                                            @elseif(is_numeric($item->anggaran))
                                                @rp($item->anggaran)
                                            @else
                                                {{$item->anggaran}}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{ $item->target_kinerja_tahunan }}@if (is_numeric($item->target_kinerja_tahunan))
                                                {{ $item->satuan }}
                                            @endif
                                        </td>
                                        {{-- Target dan realisasi per TW --}}
                                        <td class="text-center">{{$item->tw1}}</td>
                                        <td class="text-center" style="background-color: rgba(155, 155, 155, 0.162);">{{$realisasi->getRealisasi($item->id)->tw1 ?? ''}}</td>
                                        <td class="text-center">{{$item->tw2}}</td>
                                        <td class="text-center" style="background-color: rgba(155, 155, 155, 0.162);">{{$realisasi->getRealisasi($item->id)->tw2 ?? ''}}</td>
                                        <td class="text-center">{{$item->tw3}}</td>
                                        <td class="text-center" style="background-color: rgba(155, 155, 155, 0.162);">{{$realisasi->getRealisasi($item->id)->tw3 ?? ''}}</td>
                                        <td class="text-center">{{$item->tw4}}</td>
                                        <td class="text-center" style="background-color: rgba(155, 155, 155, 0.162);">{{$realisasi->getRealisasi($item->id)->tw4 ?? ''}}</td>
                                        {{-- Target dan realisasi per TW --}}
                                        {{-- Realisasi --}}
                                        <td class="text-center">
                                            @if ($realisasi->getRealisasi($item->id) == null)
                                                <span style="color: red;">Realisasi Belum Diisi</span>
                                            @else
                                                @if ($realisasi->getRealisasi($item->id)?->realisasi_manual != null && $realisasi->getRealisasi($item->id)->realisasi_manual != '-' && $realisasi->getRealisasi($item->id)->realisasi_manual != 0)
                                                    {{ $realisasi->getRealisasi($item->id)?->realisasi_manual ?? '-'}}
                                                @else
                                                    @if (is_numeric($item->target_kinerja_tahunan))
                                                        @php
                                                            $tw1 = $realisasi->getRealisasi($item->id)->tw1 ?? '';
                                                            $tw2 = $realisasi->getRealisasi($item->id)->tw2 ?? '';
                                                            $tw3 = $realisasi->getRealisasi($item->id)->tw3 ?? '';
                                                            $tw4 = $realisasi->getRealisasi($item->id)->tw4 ?? '';

                                                            $tw1 = ($tw1 === null || $tw1 === '-' || $tw1 === '') ? 0 : $tw1;
                                                            $tw2 = ($tw2 === null || $tw2 === '-' || $tw2 === '') ? 0 : $tw2;
                                                            $tw3 = ($tw3 === null || $tw3 === '-' || $tw3 === '') ? 0 : $tw3;
                                                            $tw4 = ($tw4 === null || $tw4 === '-' || $tw4 === '') ? 0 : $tw4;

                                                            $non_numeric_tw = [];

                                                            if (!is_numeric($tw1)) {
                                                                $non_numeric_tw[] = 'TW1';
                                                            }
                                                            if (!is_numeric($tw2)) {
                                                                $non_numeric_tw[] = 'TW2';
                                                            }
                                                            if (!is_numeric($tw3)) {
                                                                $non_numeric_tw[] = 'TW3';
                                                            }
                                                            if (!is_numeric($tw4)) {
                                                                $non_numeric_tw[] = 'TW4';
                                                            }
                                                        @endphp
                                                        {{-- jika ada salah satu tw yang non numeric --}}
                                                        @if (!empty($non_numeric_tw))
                                                            @php
                                                                $tw_message = implode(', ', $non_numeric_tw);
                                                            @endphp
                                                            {{-- cetak mana saja yang non numeric --}}
                                                            <div class="alert alert-warning">
                                                                TW berikut tidak bersifat numerik: {{ $tw_message }}. Mohon periksa.
                                                            </div>
                                                        @else
                                                        {{-- jika semua numeric lalu lakukan perhitungan --}}
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
                                                        @endif
                                                    @else
                                                        {{ $realisasi->getRealisasi($item->id)->tw4 ?? 'Menunggu TW IV' }}
                                                    @endif
                                                @endif
                                            @endif
                                        </td>
                                        {{-- End::Realisasi --}}
                                        {{-- Capaian --}}
                                        <td class="text-center">
                                            {{-- Cek realisasi sudah di isi? --}}
                                            @if ($realisasi->getRealisasi($item->id) == null)
                                                <span style="color: red;">Realisasi Belum Diisi</span>
                                            @else
                                                {{-- Jika sudah diisi cek apakah persen manual diisi --}}
                                                @if ($realisasi->getRealisasi($item->id)?->capaian != null && $realisasi->getRealisasi($item->id)->capaian != '-' && $realisasi->getRealisasi($item->id)->capaian != 0)
                                                    {{-- tampilkan persen manual --}}
                                                    {{ $realisasi->getRealisasi($item->id)?->capaian .'%' ?? '-'}}
                                                @else
                                                    {{-- jika persen manual tidak di isi maka lakukan perhitungan --}}
                                                    {{-- cek apakah target kinerja tahunan berbentuk numerik --}}
                                                    @if (is_numeric($item->target_kinerja_tahunan))
                                                        {{-- cek setiap tw apakah ada yang non numeric --}}
                                                        @php
                                                            $tw1 = $realisasi->getRealisasi($item->id)->tw1 ?? '';
                                                            $tw2 = $realisasi->getRealisasi($item->id)->tw2 ?? '';
                                                            $tw3 = $realisasi->getRealisasi($item->id)->tw3 ?? '';
                                                            $tw4 = $realisasi->getRealisasi($item->id)->tw4 ?? '';

                                                            $tw1 = ($tw1 === null || $tw1 === '-' || $tw1 === '') ? 0 : $tw1;
                                                            $tw2 = ($tw2 === null || $tw2 === '-' || $tw2 === '') ? 0 : $tw2;
                                                            $tw3 = ($tw3 === null || $tw3 === '-' || $tw3 === '') ? 0 : $tw3;
                                                            $tw4 = ($tw4 === null || $tw4 === '-' || $tw4 === '') ? 0 : $tw4;

                                                            $non_numeric_tw = [];

                                                            if (!is_numeric($tw1)) {
                                                                $non_numeric_tw[] = 'TW1';
                                                            }
                                                            if (!is_numeric($tw2)) {
                                                                $non_numeric_tw[] = 'TW2';
                                                            }
                                                            if (!is_numeric($tw3)) {
                                                                $non_numeric_tw[] = 'TW3';
                                                            }
                                                            if (!is_numeric($tw4)) {
                                                                $non_numeric_tw[] = 'TW4';
                                                            }
                                                        @endphp
                                                        {{-- jika ada salah satu tw yang non numeric --}}
                                                        @if (!empty($non_numeric_tw))
                                                            @php
                                                                $tw_message = implode(', ', $non_numeric_tw);
                                                            @endphp
                                                            {{-- cetak mana saja yang non numeric --}}
                                                            <div class="alert alert-warning">
                                                                TW berikut tidak bersifat numerik: {{ $tw_message }}. Mohon periksa.
                                                            </div>
                                                        @else
                                                        {{-- jika semua numeric lalu lakukan perhitungan --}}
                                                            @php
                                                            $capaian = round(( $realisasi->converTw($tw1) +
                                                                $realisasi->converTw($tw2) +
                                                                $realisasi->converTw($tw3) +
                                                                $realisasi->converTw($tw4)) /
                                                                $item->target_kinerja_tahunan * 100, 2);

                                                                $totalCapaian += $capaian;
                                                                $jumlahItem++;
                                                                $capaianValid = true;
                                                            @endphp
                                                            {{ $capaian . '%' }}
                                                        @endif
                                                    @else
                                                    {{-- Jika Kinerja tahunan non numeric lalu cetak menunggu tw 4 --}}
                                                        Menunggu TW IV
                                                    @endif
                                                @endif
                                            @endif
                                        </td>
                                        {{-- End::Capaian --}}
                                    </tr>
                                    @if (!$capaianValid)
                                        @php
                                            // Pastikan item ini tidak dihitung dalam total capaian atau jumlah item
                                            $totalCapaian += $realisasiItem->capaian ?? 0;
                                            $jumlahItem++;
                                        @endphp
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <!--end::Table-->
                        @php
                            $rataRataCapaian = $jumlahItem > 0 ? round($totalCapaian / $jumlahItem, 2) : 0;
                        @endphp

                        {{-- <div class="alert alert-info">
                            total Capaian : {{$totalCapaian}},
                            jumlah Item : {{$jumlahItem}},
                            Rata-rata Capaian: {{ $rataRataCapaian . '%' }}
                        </div> --}}
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
    {{-- end::aditional js --}}
@endsection
