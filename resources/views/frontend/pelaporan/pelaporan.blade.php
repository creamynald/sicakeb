@extends('frontend.layouts.appdetail')
@section('content')
<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4">
            @if (isset($_GET['jenis_file']))
                    @if ($_GET['jenis_file'] == 'LAKIP')                        
                    Pelaporan Kinerja
                    @else
                    Dokumen Lain
                    @endif
                @endif
            </h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
            <li class="breadcrumb-item active text-white">
                @if (isset($_GET['jenis_file']))
                    @if ($_GET['jenis_file'] == 'LAKIP')                        
                        Dokumen Lakip Pemerintah Kabupaten Bengkalis
                    @else
                    Dokumen {{$_GET['jenis_file']}} Pemerintah Kabupaten Bengkalis
                    @endif
                @endif
            </li>
        </ol>    
    </div>
</div>
<!-- Header End -->

<div class="container-fluid guide py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Data @if (isset($_GET['jenis_file']))
                @if ($_GET['jenis_file'] == 'LAKIP')                        
                    Dokumen Lakip
                @else
                Dokumen {{$_GET['jenis_file']}}
                @endif
            @endif
            </h5>
            <h3 class="mb-0">Perangkat Daerah Kabupaten Bengkalis Tahun Anggaran {{ date('Y') }}</h3>
        </div>

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
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <div class="dataTables_filter ">
                            {{-- begin::pencarian manual untuk data opd --}}
                            <input type="text" id="search" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Pencarian..."/>
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
                <table id="myTable" class="table align-middle">
                    <thead>
                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-30px">No</th>
                            <th class="min-w-125px">Perangkat Daerah</th>
                            <th class="text-end min-w-70px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="fw-bold fs-6 text-gray-600">
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
    <style>
        #customSearch {
            width: 200px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
        }
    </style>
@endpush
{{-- end::aditional css --}}
{{-- begin::additional js --}}
@push('js')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Custom Javascript-->
@endpush
@push('scripts')
    @include('frontend.pelaporan.script')
@endpush
{{-- end::aditional js --}}
@endsection