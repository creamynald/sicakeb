        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
          <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
              <span class="sr-only">Loading...</span>
          </div>
      </div>
      <!-- Spinner End -->

      <!-- Topbar Start -->
      <div class="container-fluid bg-primary px-5 d-none d-lg-block">
          <div class="row gx-0">
              <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
                  <div class="d-inline-flex align-items-center" style="height: 45px;">
                      <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-whatsapp fw-normal"></i></a>
                      <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-facebook-f fw-normal"></i></a>
                      <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-instagram fw-normal"></i></a>
                      <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-youtube fw-normal"></i></a>
                      <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle" href=""><i class="fab fa-google fw-normal"></i></a>
                  </div>
              </div>
              <div class="col-lg-4 text-center text-lg-end">
                  <div class="d-inline-flex align-items-center" style="height: 45px;">
                      <a href="https://drive.google.com/file/d/1O6kne2cyvP-dxBR0QZzrX2-qaGVZ7XHv/view?usp=sharing" target="blank_" class="btn btn-primary rounded-pill py-2 px-4 ms-lg-4"><i class="fa fa-book"></i> Manual Book</a>
                {{-- <div class="dropdown">
                          <a href="#" class="dropdown-toggle text-light" data-bs-toggle="dropdown"><small><i class="fa fa-home me-2"></i> My Dashboard</small></a>
                          <div class="dropdown-menu rounded">
                              <a href="#" class="dropdown-item"><i class="fas fa-user-alt me-2"></i> My Profile</a>
                              <a href="#" class="dropdown-item"><i class="fas fa-comment-alt me-2"></i> Inbox</a>
                              <a href="#" class="dropdown-item"><i class="fas fa-bell me-2"></i> Notifications</a>
                              <a href="#" class="dropdown-item"><i class="fas fa-cog me-2"></i> Account Settings</a>
                              <a href="#" class="dropdown-item"><i class="fas fa-power-off me-2"></i> Log Out</a>
                          </div>
                      </div> --}}
                  </div>
              </div>
          </div>
      </div>
      <!-- Topbar End -->

      <!-- Navbar & Hero Start -->
      <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="" class="navbar-brand p-0">
                {{-- <h1 class="m-0"><i class="fa fa-map-marker-alt me-3"></i>SICAKEB</h1> --}}
                <img src="{{asset('assets/favicon/Logo_SiCakeb.png')}}" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="#" class="nav-item nav-link active">Beranda</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Dokumen Sakip</a>
                        <div class="dropdown-menu m-0">
                            <a href="#" class="dropdown-item">Perencanaan Kinerja</a>
                            <a href="#" class="dropdown-item">Pengukuran Kinerja</a>
                            <a href="#" class="dropdown-item">Pelaporan Kinerja</a>
                            <a href="#" class="dropdown-item">Evaluasi Kinerja</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Dokumen Lain</a>
                        <div class="dropdown-menu m-0">
                            <a href="#" class="dropdown-item">RPJMD</a>
                            <a href="#" class="dropdown-item">Renstra</a>
                            <a href="#" class="dropdown-item">Lakip</a>
                        </div>
                    </div>
                </div>
                <a href="/login" class="btn btn-primary rounded-pill py-2 px-4 ms-lg-4"><i class="fa fa-sign"></i> Masuk</a>
            </div>
        </nav>