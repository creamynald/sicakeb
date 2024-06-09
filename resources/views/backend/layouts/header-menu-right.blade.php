<!--begin::Navbar-->
<div class="app-navbar flex-shrink-0">
    <!--begin::Search-->
    <div class="app-navbar-item ms-1 ms-md-4">
        <i class="ki-duotone ki-calendar">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>&nbsp;
        <span id="date" class="text-primary"></span>
        &nbsp;<i class="ki-duotone ki-time">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>&nbsp;
        <span id="clock" class="text-primary"></span>
    </div>

    <!--end::Search-->
    <!--begin::Activities-->

    <!--end::Activities-->
    <!--begin::Notifications-->

    <!--end::Notifications-->
    <!--begin::Chat-->

    <!--end::Chat-->
    <!--begin::My apps links-->

    <!--end::My apps links-->
    <!--begin::Theme mode-->
    <div class="app-navbar-item ms-1 ms-md-4">
        <!--begin::Menu toggle-->
        <a href="#"
            class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px"
            data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end">
            <i class="ki-outline ki-night-day theme-light-show fs-1"></i>
            <i class="ki-outline ki-moon theme-dark-show fs-1"></i>
        </a>
        <!--begin::Menu toggle-->
        <!--begin::Menu-->
        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
            data-kt-menu="true" data-kt-element="theme-mode-menu">
            <!--begin::Menu item-->
            <div class="menu-item px-3 my-0">
                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
                    <span class="menu-icon" data-kt-element="icon">
                        <i class="ki-outline ki-night-day fs-2"></i>
                    </span>
                    <span class="menu-title">Light</span>
                </a>
            </div>
            <!--end::Menu item-->
            <!--begin::Menu item-->
            <div class="menu-item px-3 my-0">
                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                    <span class="menu-icon" data-kt-element="icon">
                        <i class="ki-outline ki-moon fs-2"></i>
                    </span>
                    <span class="menu-title">Dark</span>
                </a>
            </div>
            <!--end::Menu item-->
            <!--begin::Menu item-->
            <div class="menu-item px-3 my-0">
                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
                    <span class="menu-icon" data-kt-element="icon">
                        <i class="ki-outline ki-screen fs-2"></i>
                    </span>
                    <span class="menu-title">System</span>
                </a>
            </div>
            <!--end::Menu item-->
        </div>
        <!--end::Menu-->
    </div>
    <!--end::Theme mode-->
    <!--begin::User menu-->
    <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
        <!--begin::Menu wrapper-->
        <div class="cursor-pointer symbol symbol-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
     data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
    <img src="{{ auth()->user()->avatar ? url('/avatars/' . auth()->user()->avatar) : asset('assets/media/avatars/blank.png') }}"
         class="rounded-3" alt="user" />
</div>



        <!--begin::User account menu-->
        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
            data-kt-menu="true">
            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <div class="menu-content d-flex align-items-center px-3">
                    <!--begin::Avatar-->
                    <div class="symbol symbol-50px me-5">
                        <img alt="Logo"
                            src="{{ auth()->user()->avatar ? url('/avatars/' . auth()->user()->avatar) : asset('assets/media/avatars/blank.png') }}" />
                    </div>
                    <!--end::Avatar-->
                    <!--begin::Username-->
                    <div class="d-flex flex-column">
                        <div class="fw-bold d-flex align-items-center fs-5">{{ Auth::user()->name }}
                            <span
                                class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">{{ ucfirst(Auth::user()->getRoleNames()->first()) }}</span>
                        </div>
                        <a href="#"
                            class="fw-semibold text-muted text-hover-primary fs-7">{{ Auth::user()->email }}</a>
                    </div>
                    <!--end::Username-->
                </div>
                @role('operator')
                    @if (!empty(optional(Auth::user()->opd)->nama))
                        <div class="px-3">
                            <a href="#" class="fw-bold text-primary fs-7">{{ Auth::user()->opd?->nama }}</a>
                        </div>
                    @endif
                @endrole

            </div>
            <!--end::Menu item-->

            <!--begin::Menu separator-->
            <div class="separator my-2"></div>
            <!--end::Menu separator-->


            <!--begin::Menu item-->
            <div class="menu-item px-5 d-flex justify-content-between">
                <div>
                    <a href="{{ route('profile.edit', ['user' => auth()->user()->id]) }}"
                        class="menu-link px-5 btn btn-outline-warning">Edit Profile</a>
                </div>
                <div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="menu-link px-5 bg-danger text-white"
                            onclick="event.preventDefault();
                        this.closest('form').submit();">Sign
                            Out</a>
                    </form>
                </div>
            </div>

            <!--end::Menu item-->
        </div>
        <!--end::User account menu-->
        <!--end::Menu wrapper-->
    </div>
</div>
<!--end::Navbar-->
@push('js')
    <script>
        // Function to update clock every second
        function updateClock() {
            var now = new Date();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();

            // Add leading zero if hours, minutes or seconds are less than 10
            hours = (hours < 10) ? "0" + hours : hours;
            minutes = (minutes < 10) ? "0" + minutes : minutes;
            seconds = (seconds < 10) ? "0" + seconds : seconds;

            // Mengambil nama hari dalam bahasa Indonesia
            var hari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"][now.getDay()];
            // Mengambil nama bulan dalam bahasa Indonesia
            var bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
                "November", "Desember"
            ][now.getMonth()];
            // Mendapatkan tahun dan tanggal
            var tahun = now.getFullYear();
            var tanggal = now.getDate();

            // Display the time in the 'clock' element
            document.getElementById('clock').textContent = hours + ":" + minutes + ":" + seconds;
            document.getElementById('date').textContent = hari + ", " + tanggal + " " + bulan + " " + tahun;
        }

        // Call the updateClock function every second
        setInterval(updateClock, 1000);

        // Initial call to display clock immediately
        updateClock();
    </script>
@endpush
