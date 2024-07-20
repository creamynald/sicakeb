@extends('frontend.layouts.appdetail')
@section('content')
<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4">Pengukuran Kinerja</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
            <li class="breadcrumb-item active text-white">{{$pegawai->opd?->nama}}</li>
        </ol>    
    </div>
</div>
<!-- Header End -->

<div class="container-fluid guide py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Data Pengukuran Kinerja</h5>
            <h3 class="mb-0">Nama : {{$pegawai->nama}}</h3>
            <h4 class="mb-0">Eselon : {{$pegawai->eselon}}</h4>
        </div>

<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!--begin::Card-->
        <div class="card table-responsive">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <!--begin::Card title-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                        <!--begin::Add customer-->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" onclick="history.go(-1);">Kembali</button>
                        <!--end::Add customer-->
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
                            <th class="text-center middle-align" rowspan="2">No</th>
                            <th class="text-center middle-align" rowspan="2">Sasaran</th>
                            <th class="text-center middle-align" rowspan="2">Indikator Kinerja</th>
                            <th class="text-center middle-align" rowspan="2">Target Kinerja Tahunan</th>
                            <th class="text-center" colspan="2">TW I</th>
                            <th class="text-center" colspan="2">TW II</th>
                            <th class="text-center" colspan="2">TW III</th>
                            <th class="text-center" colspan="2">TW IV</th>
                            <th class="text-center middle-align" rowspan="2">Realisasi Kinerja</th>
                            <th class="text-center middle-align" rowspan="2">Capaian Kinerja</th>
                            <th class="text-center middle-align" rowspan="2">Penghambat</th>
                            <th class="text-center middle-align" rowspan="2">Pendukung</th>
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
                        @if ($item->has_child == null)
                            <tr>
                                <td class="text-center fw-bold">{{ $data + 1 }}</td>
                                <td>{{ $item->sasaran }}</td>
                                <td>{{ $item->indikator }}</td>
                                <td class="text-center">{{ $item->target_kinerja_tahunan }}</td>
                                <td class="text-center">{{ $item->tw1 }}</td>
                                <td class="text-center">{{ $realisasi->getRealisasi($item->id)->tw1??'' }}</td>
                                <td class="text-center">{{ $item->tw2 }}</td>
                                <td class="text-center">{{ $realisasi->getRealisasi($item->id)->tw2??'' }}</td>
                                <td class="text-center">{{ $item->tw3 }}</td>
                                <td class="text-center">{{ $realisasi->getRealisasi($item->id)->tw3??'' }}</td>
                                <td class="text-center">{{ $item->tw4 }}</td>
                                <td class="text-center">{{ $realisasi->getRealisasi($item->id)->tw4??'' }}</td>
                                <td class="text-center">
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
                                <td class="text-center">{{ $realisasi->getRealisasi($item->id)->penghambat??'' }}</td>
                                <td class="text-center">{{ $realisasi->getRealisasi($item->id)->pendukung??'' }}</td>
                            </tr>
                        @endif
                            @foreach ($target as $subItem)
                            @if ($subItem->parent_id == $item->id)
                            <tr>
                                <td colspan="@if ($subItem->jenis_child == 'indikator') 2 @else 6 @endif"></td>
                                @if ($subItem->jenis_child == 'indikator')
                                <td>{{ $item->indikator }}</td>
                                <td class="text-center">{{ $item->target_kinerja_tahunan }}</td>
                                <td class="text-center">{{ $subItem->tw1 }}</td>
                                <td class="text-center">{{ $realisasi->getRealisasi($subItem->id)->tw1??'' }}</td>
                                <td class="text-center">{{ $subItem->tw2 }}</td>
                                <td class="text-center">{{ $realisasi->getRealisasi($subItem->id)->tw2??'' }}</td>
                                <td class="text-center">{{ $subItem->tw3 }}</td>
                                <td class="text-center">{{ $realisasi->getRealisasi($subItem->id)->tw3??'' }}</td>
                                <td class="text-center">{{ $subItem->tw4 }}</td>
                                <td class="text-center">{{ $realisasi->getRealisasi($subItem->id)->tw4??'' }}</td>
                                <td class="text-center">
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
                                <td class="text-center">{{ $realisasi->getRealisasi($subItem->id)->penghambat??'' }}</td>
                                <td class="text-center">{{ $realisasi->getRealisasi($subItem->id)->pendukung??'' }}</td>
                                @endif
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
</div>

</div>
</div>

<!-- Travel Guide Start -->
<div class="container-fluid guide py-5">
  <div class="container py-5">
      <div class="mx-auto text-center mb-5" style="max-width: 900px;">
          <h5 class="section-title px-3">Kontak Alamat</h5>
      </div>
      <div class="row g-2 align-items-center">
          <div class="col-lg-4">
            <div class="row g-2">
                <div class="address">
                  <i class="icofont-google-map"></i>
                  <h4>Alamat :</h4>
                  <p>Jl. Ahmad Yani<br/>Kabupaten Bengkalis Kode Pos : 28712</p>
                </div>
      
                <div class="email">
                  <i class="icofont-envelope"></i>
                  <h4>Email :</h4>
                  <p>bengkalis@bengkaliskab.go.id</p>
                </div>
      
                <div class="phone">
                  <i class="icofont-phone"></i>
                  <h4>No Telpon :</h4>
                  <p>(+62766) 21258</p>
                </div>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="row g-2">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.4998055696374!2d102.11054317472527!3d1.4730433611679958!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d15fcbe48d0a8f%3A0xc996b17198015a2b!2sKantor%20Bupati%20Bengkalis!5e0!3m2!1sid!2sid!4v1716974329858!5m2!1sid!2sid" width="100%" height="450" style="border-radius:5px;width:100%;height:250px;margin:0px;padding:0px;border:1px solid #0880e8;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
      </div>
  </div>
</div>
<!-- Travel Guide End -->

<!-- Subscribe Start -->
<div class="container-fluid subscribe py-5">
  <div class="container text-center py-5">
      <div class="mx-auto text-center" style="max-width: 900px;">
          <h5 class="subscribe-title px-3">Link Terkait</h5>
        <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
            <a href="https://menpan.go.id" target="_blank"><img src="{{asset('gambar/link/pan rb.png')}}" width="250px" height="120px" alt=""></a>&emsp;
            <a href="https://riau.go.id" target="_blank"><img src="{{asset('gambar/link/Riau.png')}}" width="100px" height="120px" alt=""></a>&emsp;
            <a href="https://bengkaliskab.go.id" target="_blank"><img src="{{asset('gambar/link/bengkalis.png')}}" width="100px" height="120px" alt=""></a>&emsp;
            <a href="https://diskominfotik.bengkaliskab.go.id" target="_blank"><img src="{{asset('gambar/link/diskominfotik.png')}}" width="100px" height="120px" alt=""></a>&emsp;
            <a href="https://siapadia.riau.go.id" target="_blank"><img src="{{asset('gambar/link/siapadia.png')}}" width="250px" height="120px" alt=""></a>
            </div>
        </div>
      </div>
  </div>
</div>
<!-- Subscribe End -->

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
@endpush
{{-- begin::custom js --}}
@push('scripts')
    @include('frontend.capaian.script')
@endpush
{{-- end::custom js --}}
{{-- end::aditional js --}}
@endsection