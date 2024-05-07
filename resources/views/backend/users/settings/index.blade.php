@extends('backend.layouts.base')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Pengaturan Akun</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{url('admin/dashboard')}}" class="text-muted text-hover-primary">Dashboard</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Akun</li>
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
                <!--begin::Navbar-->
                <div class="card mb-5 mb-xl-10">
                    <div class="card-body pt-9 pb-0">
                        <!--begin::Details-->
                        <div class="d-flex flex-wrap flex-sm-nowrap">
                            <!--begin: Pic-->
                            <div class="me-7 mb-4">
                                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                    <img src="{{ auth()->user()->avatar ? url('/avatars/' . auth()->user()->avatar) : asset('assets/media/avatars/blank.png') }}"
                                        alt="image" />
                                    <div
                                        class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px">
                                    </div>
                                </div>
                            </div>
                            <!--end::Pic-->
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                                <!--begin::Title-->
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <!--begin::User-->
                                    <div class="d-flex flex-column">
                                        <!--begin::Name-->
                                        <div class="d-flex align-items-center mb-2">
                                            <a href="#"
                                                class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ Auth::user()->name }}</a>
                                            <a href="#">
                                                <i class="ki-duotone ki-verify fs-1 text-primary">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </a>
                                        </div>
                                        <!--end::Name-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                            <span>Anda login sebagai&nbsp;</span>
                                            <a href="#"
                                                class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                                <i class="ki-duotone ki-profile-circle fs-4 me-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>{{ ucfirst(Auth::user()->getRoleNames()->first()) }}
                                            </a>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Title-->
                                <!--begin::Stats-->
                                <div class="d-flex flex-wrap flex-stack">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column flex-grow-1 pe-8">
                                        <!--begin::Stats-->
                                        <div class="d-flex flex-wrap">
                                            <!--begin::Stat-->
                                            <div
                                                class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                <!--begin::Number-->
                                                <div class="d-flex align-items-center">
                                                    {{-- logo --}}
                                                    <div class="symbol symbol-50px symbol-light-primary me-6">
                                                        <span class="symbol-label">
                                                            <img src="{{ asset('assets/favicon/logo-bengkalis.png') }}"
                                                                class="h-50 align-self-center" alt="" />
                                                        </span>
                                                    </div>
                                                    {{-- text organization --}}
                                                    <div class="d-flex flex-column flex-grow-1">
                                                        <a href="#"
                                                            class="text-gray-800 text-hover-primary fw-bolder fs-6">
                                                            @if (auth()->user() && auth()->user()->opd)
                                                                {{ auth()->user()->opd->nama }}
                                                            @else
                                                                <span class="badge badge-light-danger fw-bold">Akun ini tidak tertaut dengan OPD manapun</span>
                                                            @endif

                                                        </a>
                                                        {{-- email --}}
                                                        <span>
                                                            <class="text-gray-400 fw-bold fs-7">
                                                            {{-- icon email --}}
                                                            <i class="fas fa-envelope me-1"></i>
                                                            {{ $user->email }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <!--end::Number-->
                                            </div>
                                            <!--end::Stat-->
                                        </div>
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Progress-->
                                    <!--begin::Progress-->
                                    <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                                        @php
                                            // Initialize the base profile completion percentage
                                            $completionPercentage = 100; // Assume starting at 50%

                                            // Conditions to modify the completion percentage
                                            if (empty($user->avatar)) {
                                                $completionPercentage -= 10; // Reduce by 10% if no avatar or avatar is empty
                                            }

                                            // Additional conditions could be added here in the future
                                            // Example: if (empty($user->bio)) { $completionPercentage -= 5; }

                                        @endphp
                                        <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                            <span class="fw-semibold fs-6 text-gray-500">Kelengkapan Profil</span>
                                            <span class="fw-bold fs-6">{{ $completionPercentage }}%</span>
                                        </div>
                                        <div class="h-5px mx-3 w-100 bg-light mb-3">
                                            <div class="bg-success rounded h-5px" role="progressbar"
                                                style="width: {{ $completionPercentage }}%;"
                                                aria-valuenow="{{ $completionPercentage }}" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <!--end::Progress-->


                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Details-->
                        <!--begin::Navs-->
                        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 active" href="#">Pengaturan</a>
                            </li>
                            <!--end::Nav item-->
                        </ul>
                        <!--begin::Navs-->
                    </div>
                </div>
                <!--end::Navbar-->
                <!--begin::Basic info-->
                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                        data-bs-target="#kt_account_profile_details" aria-expanded="true"
                        aria-controls="kt_account_profile_details">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Profile Details</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_profile_details" class="collapse show">
                        <!--begin::Form-->
                        <form id="kt_account_profile_details_form" class="form"
                            action="{{ route('profile.update', $user) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <!--begin::Input group for Avatar-->
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Avatar</label>
                                    <div class="col-lg-8">
                                        <div class="image-input image-input-outline" data-kt-image-input="true"
                                            style="background-image: url({{ auth()->user()->avatar ? url('/avatars/' . auth()->user()->avatar) : asset('assets/media/avatars/blank.png') }})">
                                            <div class="image-input-wrapper w-125px h-125px"
                                                style="background-image: url({{ auth()->user()->avatar ? url('/avatars/' . auth()->user()->avatar) : asset('assets/media/avatars/blank.png') }})">
                                            </div>
                                            <!--begin::Label-->
                                            <label
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                title="Change avatar">
                                                <i class="ki-duotone ki-pencil fs-7">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                <!--begin::Inputs-->
                                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="avatar_remove" />
                                                <!--end::Inputs-->
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Remove-->
                                            <span
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                title="Remove avatar">
                                                <i class="ki-duotone ki-cross fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <!--end::Remove-->
                                        </div>
                                        <div class="form-text">Allowed file types: png, jpg, jpeg.</div>

                                    </div>
                                </div>
                                <!--end::Input group-->

                                <!-- Full Name Input -->
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nama Lengkap</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="name"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="Full name" value="{{ old('name', $user->name) }}" />
                                    </div>
                                </div>

                                <!-- Email Input -->
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Email</label>
                                    <div class="col-lg-8">
                                        <input type="email" name="email"
                                            class="form-control form-control-lg form-control-solid" placeholder="Email"
                                            value="{{ old('email', $user->email) }}" />
                                    </div>
                                </div>

                                <!-- Current Password Input -->
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Sandi Saat Ini</label>
                                    <div class="col-lg-8">
                                        <input type="password" name="current_password"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="Current password" autocomplete="false" required/>
                                            <small style="color: green">Masukkan Sandi Untuk Menyimpan Perubahan</small>
                                    </div>
                                </div>

                                <!-- New Password Input -->
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Sandi Baru</label>
                                    <div class="col-lg-8">
                                        <input type="password" name="new_password"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="New password" />
                                    </div>
                                </div>

                                <!-- Verify Password Input -->
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Masukkan Ulang Sandi</label>
                                    <div class="col-lg-8">
                                        <input type="password" name="new_password_confirmation"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="Verify password" />
                                    </div>
                                </div>

                            </div>
                            <!--end::Card body-->

                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="reset"
                                    class="btn btn-light btn-active-light-primary me-2">Discard</button>
                                <button type="submit" class="btn btn-primary"
                                    id="kt_account_profile_details_submit">Save Changes</button>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>

                <!--end::Basic info-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
@endsection

@push('scripts')
    <script>
        @if (session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif
        @if (session('error'))
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
    <script>
        $(document).ready(function(){
            $('input[name="current_password"]').val('');
        });
    </script>
@endpush
