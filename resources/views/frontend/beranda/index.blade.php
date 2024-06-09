@extends('frontend.layouts.app')
@section('content')
<!-- Carousel Start -->
<div class="carousel-header">
  <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
      <ol class="carousel-indicators">
          <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
          <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
          <li data-bs-target="#carouselId" data-bs-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
          <div class="carousel-item active">
              <img src="{{asset('gambar/Background.jpg')}}" class="img-fluid" alt="Image">
              {{-- <div class="carousel-caption">
                  <div class="p-3" style="max-width: 900px;">
                      <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Explore The World</h4>
                      <h1 class="display-2 text-capitalize text-white mb-4">Let's The World Together!</h1>
                      <p class="mb-5 fs-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                      </p>
                      <div class="d-flex align-items-center justify-content-center">
                          <a class="btn-hover-bg btn btn-primary rounded-pill text-white py-3 px-5" href="#">Discover Now</a>
                      </div>
                  </div>
              </div> --}}
          </div>
          <div class="carousel-item">
              <img src="{{asset('gambar/Visi dan Misi.jpg')}}" class="img-fluid" alt="Image">
              {{-- <div class="carousel-caption">
                  <div class="p-3" style="max-width: 900px;">
                      <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Explore The World</h4>
                      <h1 class="display-2 text-capitalize text-white mb-4">Find Your Perfect Tour At Travel</h1>
                      <p class="mb-5 fs-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                      </p>
                      <div class="d-flex align-items-center justify-content-center">
                          <a class="btn-hover-bg btn btn-primary rounded-pill text-white py-3 px-5" href="#">Discover Now</a>
                      </div>
                  </div>
              </div> --}}
          </div>
          <div class="carousel-item">
              <img src="{{asset('gambar/kantorbupatibengkalis.jpg')}}" class="img-fluid" alt="Image">
              {{-- <div class="carousel-caption">
                  <div class="p-3" style="max-width: 900px;">
                      <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Explore The World</h4>
                      <h1 class="display-2 text-capitalize text-white mb-4">You Like To Go?</h1>
                      <p class="mb-5 fs-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                      </p>
                      <div class="d-flex align-items-center justify-content-center">
                          <a class="btn-hover-bg btn btn-primary rounded-pill text-white py-3 px-5" href="#">Discover Now</a>
                      </div>
                  </div>
              </div> --}}
          </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
          <span class="carousel-control-prev-icon btn bg-primary" aria-hidden="false"></span>
          <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
          <span class="carousel-control-next-icon btn bg-primary" aria-hidden="false"></span>
          <span class="visually-hidden">Next</span>
      </button>
  </div>
</div>
<!-- Carousel End -->
{{-- </div>
<div class="container-fluid search-bar position-relative" style="top: -50%; transform: translateY(-50%);">
<div class="container">
  <div class="position-relative rounded-pill w-100 mx-auto p-5" style="background: rgba(19, 53, 123, 0.8);">
      <input class="form-control border-0 rounded-pill w-100 py-3 ps-4 pe-5" type="text" placeholder="Eg: Thailand">
      <button type="button" class="btn btn-primary rounded-pill py-2 px-4 position-absolute me-2" style="top: 50%; right: 46px; transform: translateY(-50%);">Search</button>
  </div>
</div>
</div> --}}
<!-- Navbar & Hero End -->
      
<!-- About Start -->
<div class="container-fluid about py-5">
  <div class="container py-5">
      <div class="row g-5 align-items-center">
          <div class="col-lg-5">
              <div class="h-100" style="border: 50px solid; border-color: transparent #13357B transparent #13357B;">
                  <img src="{{asset('gambar/logo/Tentang.png')}}" class="img-fluid w-100 h-100" alt="">
              </div>
          </div>
          <div class="col-lg-7" style="background: linear-gradient(rgba(255, 255, 255, .8), rgba(255, 255, 255, .8)), url(img/about-img-1.png);">
              <h5 class="section-about-title pe-3">KATA SAMBUTAN</h5>
              <h1 class="mb-4">Selamat Datang di <span class="text-primary">SICAKEB</span></h1>
              <p class="mb-4">"Sistem Akuntabilitas Kinerja Instansi Pemerintah (SAKIP) adalah rangkaian sistematik dari beberapa aktifitas alat dan prosedur yang dirancang untuk tujuan penetapan dan pengukuran, pengumpulan data, pengklasifikasian, pengikhtisaran dan pelaporan kinerja pada Instansi Pemerintah dalam rangka pertanggungjawaban dan peningkatan kinerja Instansi Pemerintah."</p>
              <p class="mb-4">"Bagi Perangkat Daerah yang akan memulai menggunakan SiCAKEB silahkan untuk masuk melalui halaman login sistem. Masyarakat yang ingin melihat/mengunduh LAKIP Perangkat Daerah Kabupaten Bengkalis silahkan masuk ke halaman download atau pilih salah satu sub menu dari menu download diatas ini."</p>
              <a class="btn btn-primary rounded-pill py-3 px-5 mt-2" href="">Selanjutnya</a>
          </div>
      </div>
  </div>
</div>
<!-- About End -->

<!-- Testimonial Start -->
<div class="container-fluid testimonial py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">PEJABAT PIMPINAN DAERAH</h5>
            <h1 class="mb-0">"Terwujudnya Kabupaten Bengkalis Yang Bermarwah, Maju dan Sejahtera"</h1>
        </div>
        <div class="testimonial-carousel owl-carousel">
            <div class="testimonial-item text-center rounded pb-4">
                <div class="testimonial-comment bg-light rounded p-4">
                    <p class="text-center mb-5">Saya Yakin Dengan Adanya Sistem Informasi Capaian Kinerja Elektronik Kabupaten Bengkalis (SICAKEB) Semoga Penilaian dan Predikat Kabupaten Bengkalis Terus Menjadi Yang Terbaik Untuk Terwujudnya Bengkalis BERMASA.
                    </p>
                </div>
                <div class="testimonial-img p-1">
                    <img src="{{asset('gambar/pejabat/bupati.jpg')}}" class="img-fluid rounded-circle" alt="Image">
                </div>
                <div style="margin-top: -35px;">
                    <h5 class="mb-0">Kasmarni, S.Sos, MMP</h5>
                    <p class="mb-0">Bupati Bengkalis</p>
                    <br><div class="d-inline-flex align-items-center" style="height: 20px;">
                        <a class="btn btn-sm btn-outline-dark btn-sm-square rounded-circle me-2" href=""><i class="fab fa-whatsapp fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-dark btn-sm-square rounded-circle me-2" href=""><i class="fab fa-facebook-f fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-dark btn-sm-square rounded-circle me-2" href=""><i class="fab fa-instagram fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-dark btn-sm-square rounded-circle me-2" href=""><i class="fab fa-youtube fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-dark btn-sm-square rounded-circle" href=""><i class="fab fa-google fw-normal"></i></a>
                    </div>
                </div>
            </div>
            <div class="testimonial-item text-center rounded pb-4">
                <div class="testimonial-comment bg-light rounded p-4">
                    <p class="text-center mb-5">Mudah-mudahan Sistem Informasi Capaian Kinerja Elektronik Kabupaten Bengkalis (SICAKEB) Terus Memberikan Yang Terbaik Dalam Penilaian Capaian Kinerja dalam mendukung terwujudnya Kabupaten Bengkalis Yang BERMASA.
                    </p>
                </div>
                <div class="testimonial-img p-1">
                    <img src="{{asset('gambar/pejabat/wabup.jpg')}}" class="img-fluid rounded-circle" alt="Image">
                </div>
                <div style="margin-top: -35px;">
                    <h5 class="mb-0">Dr. H. Bagus Santoso, MP</h5>
                    <p class="mb-0">Wakil Bupati Bengkalis</p>
                    <br><div class="d-inline-flex align-items-center" style="height: 20px;">
                        <a class="btn btn-sm btn-outline-dark btn-sm-square rounded-circle me-2" href=""><i class="fab fa-whatsapp fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-dark btn-sm-square rounded-circle me-2" href=""><i class="fab fa-facebook-f fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-dark btn-sm-square rounded-circle me-2" href=""><i class="fab fa-instagram fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-dark btn-sm-square rounded-circle me-2" href=""><i class="fab fa-youtube fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-dark btn-sm-square rounded-circle" href=""><i class="fab fa-google fw-normal"></i></a>
                    </div>
                </div>
            </div>
            <div class="testimonial-item text-center rounded pb-4">
                <div class="testimonial-comment bg-light rounded p-4">
                    <p class="text-center mb-5">Semoga Dengan Aplikasi Sistem Informasi Capaian Kinerja Elektronik Kabupaten Bengkalis (SICAKEB) Bisa Selalu Memberikan Hasil Penilaian Capaian Kinerja Yang Terbaik Untuk Mewujudkan Kabupaten Bengkalis Yang BERMASA.
                    </p>
                </div>
                <div class="testimonial-img p-1">
                    <img src="{{asset('gambar/pejabat/sekda.png')}}" class="img-fluid rounded-circle" alt="Image">
                </div>
                <div style="margin-top: -35px;">
                    <h5 class="mb-0">dr. Ersan Saputra, TH</h5>
                    <p class="mb-0">Sekretaris Daerah</p>
                    <br><div class="d-inline-flex align-items-center" style="height: 20px;">
                        <a class="btn btn-sm btn-outline-dark btn-sm-square rounded-circle me-2" href=""><i class="fab fa-whatsapp fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-dark btn-sm-square rounded-circle me-2" href=""><i class="fab fa-facebook-f fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-dark btn-sm-square rounded-circle me-2" href=""><i class="fab fa-instagram fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-dark btn-sm-square rounded-circle me-2" href=""><i class="fab fa-youtube fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-dark btn-sm-square rounded-circle" href=""><i class="fab fa-google fw-normal"></i></a>
                    </div>
                </div>
            </div>
            <div class="testimonial-item text-center rounded pb-4">
                <div class="testimonial-comment bg-light rounded p-4">
                    <p class="text-center mb-5">Sistem Informasi Capaian Kinerja Elektronik Kabupaten Bengkalis (SICAKEB) Akan Terus Berupaya Untuk Memberikan Penilaian Capaian Kinerja Dalam Mendukung Terwujudnya Visi Kabupaten Bengkalis Yang BERMASA.
                    </p>
                </div>
                <div class="testimonial-img p-1">
                    <img src="{{asset('gambar/pejabat/kadis.jpg')}}" class="img-fluid rounded-circle" alt="Image">
                </div>
                <div style="margin-top: -35px;">
                    <h5 class="mb-0">Dr. H. Suwarto, S.Pd, M.Pd</h5>
                    <p class="mb-0">Kepala Dinas Komunikasi Informatika dan Statistik</p>
                    <br><div class="d-inline-flex align-items-center" style="height: 20px;">
                        <a class="btn btn-sm btn-outline-dark btn-sm-square rounded-circle me-2" href=""><i class="fab fa-whatsapp fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-dark btn-sm-square rounded-circle me-2" href=""><i class="fab fa-facebook-f fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-dark btn-sm-square rounded-circle me-2" href=""><i class="fab fa-instagram fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-dark btn-sm-square rounded-circle me-2" href=""><i class="fab fa-youtube fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-dark btn-sm-square rounded-circle" href=""><i class="fab fa-google fw-normal"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <!-- Testimonial End -->

  <!-- Tour Booking Start -->
<div class="container-fluid booking py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h5 class="section-booking-title pe-3">Capaian Kinerja Tahun 2023</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <h1 class="text-white mb-4">Nilai</h1>
                        <h2 class="text-white mb-4">67.60</h2>
                    </div>
                    <div class="col-md-6">
                        <h1 class="text-white mb-4">Predikat</h1>
                        <h2 class="text-white mb-4">B</h2>
                    </div>
                </div>
                <a href="#" class="btn btn-light text-primary rounded-pill py-3 px-5 mt-2">Lihat</a>
            </div>
            <div class="col-lg-6">
                <h1 class="text-white mb-3">DATA PENILAIAN SAKIP</h1>
                <p class="text-white mb-4">NILAI SAKIP PEMERINTAH <span class="text-warning">KABUPATEN BENGKALIS</span></p>
                <form>
                    <div class="row g-3">
                        <div style="width: 50%; margin: auto;">
                            <canvas id="myPieChart"></canvas>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary text-white w-100 py-3" type="submit">Chart Pertahun</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
  <!-- Tour Booking End -->

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
            <a href="https://menpan.go.id" target="_blank"><img src="{{asset('gambar/link/pan rb.png')}}" width="250px" height="120px" alt="">&emsp;
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
@endsection