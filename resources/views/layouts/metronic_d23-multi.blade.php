<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="{{ env('APP_URL', '') }}" />
    <title>{{ env('APP_NAME', '') }}</title>
    <meta charset="utf-8" />
    <meta name="description" content="{{ env('APP_DECS', '') }}" />
    <meta name="keywords" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="{{ env('APP_NAME', '') }}" />
    <link rel="canonical" href="{{ env('APP_URL', '') }}" />
    <link rel="shortcut icon" href="{{ asset('modules/metronic_v8.2.7/media/logos/favicon.ico') }}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('modules/metronic_v8.2.7/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('modules/metronic_v8.2.7/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('modules/override.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->

    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
    </script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="app-blank">
    <!--begin::Theme mode setup on page load-->

        <!--begin::loader-->
        <div class="page-loader flex-column bg-dark bg-opacity-75">
            <span class="spinner-border text-danger" role="status"></span>
            <span class="text-gray-800 fs-6 fw-bolder mt-5">Loading...</span>
        </div>
        <!--end::loader-->

    <!--end::Theme mode setup on page load-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Authentication - Multi-steps-->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid stepper stepper-pills stepper-column stepper-multistep"
            id="kt_create_account_stepper">
            <!--begin::Aside-->
            <div class="d-flex flex-column flex-lg-row-auto w-lg-350px w-xl-500px">
                <div class="d-flex flex-column position-lg-fixed top-0 bottom-0 w-lg-350px w-xl-500px scroll-y bgi-size-cover bgi-position-center bg-hover-opacity-100 bg-success- gradient-bg-ecc-green">
                    {{-- style="background-image: url('{{asset('modules/metronic_v8.2.7/media/misc/auth-bg.png') }}');"> --}}
                    <div class="ecc-glass d-">
                        <!--begin::Header-->
                        <div class="d-flex flex-center py-10 py-lg-20 mt-lg-20 ">
                            <!--begin::Logo-->
                            <a href="{{env('APP_URL','')}}">
                                <img alt="Logo" src="{{ asset('modules/metronic_v8.2.7/media/logos/custom-1.png') }}" class="h-70px" />
                            </a>
                            <!--end::Logo-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="d-flex flex-row-fluid justify-content-center p-10 ">
                            <!--begin::Nav-->
                            <div class="stepper-nav">
                                <!--begin::Step 1-->
                                <div class="stepper-item current" data-kt-stepper-element="nav">
                                    <!--begin::Wrapper-->
                                    <div class="stepper-wrapper">
                                        <!--begin::Icon-->
                                        <div class="stepper-icon rounded-3">
                                            <i class="ki-outline ki-check fs-2 stepper-check"></i>
                                            <span class="stepper-number">1</span>
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Label-->
                                        <div class="stepper-label">
                                            <h3 class="stepper-title fs-2">Personal Infomation</h3>
                                        </div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Line-->
                                    <div class="stepper-line h-40px"></div>
                                    <!--end::Line-->
                                </div>
                                <!--end::Step 1-->
                                <!--begin::Step 2-->
                                <div class="stepper-item" data-kt-stepper-element="nav">
                                    <!--begin::Wrapper-->
                                    <div class="stepper-wrapper">
                                        <!--begin::Icon-->
                                        <div class="stepper-icon rounded-3">
                                            <i class="ki-outline ki-check fs-2 stepper-check"></i>
                                            <span class="stepper-number">2</span>
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Label-->
                                        <div class="stepper-label">
                                            <h3 class="stepper-title fs-2">Contact Information</h3>
                                        </div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Line-->
                                    <div class="stepper-line h-40px"></div>
                                    <!--end::Line-->
                                </div>
                                <!--end::Step 2-->
                                <!--begin::Step 3-->
                                <div class="stepper-item" data-kt-stepper-element="nav">
                                    <!--begin::Wrapper-->
                                    <div class="stepper-wrapper">
                                        <!--begin::Icon-->
                                        <div class="stepper-icon">
                                            <i class="ki-outline ki-check fs-2 stepper-check"></i>
                                            <span class="stepper-number">3</span>
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Label-->
                                        <div class="stepper-label">
                                            <h3 class="stepper-title fs-2">Next of Kin</h3>
                                        </div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Step 3-->
                            </div>
                            <!--end::Nav-->
                        </div>
                        <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="d-flex flex-center flex-wrap px-5 py-10">
                        <!--begin::Links-->
                        <div class="d-flex fw-semibold text-primary fs-base gap-5">
                            <a href="#!" id="terms" data-bs-toggle="modal" data-bs-target="#termsModal">Terms</a>
                            <a href="#!" id="contact" data-bs-toggle="modal" data-bs-target="#contactModal">Contact Us</a>
                            <a href="#!" id="faqs" data-bs-toggle="modal" data-bs-target="#faqsModal">FAQs</a>
                        </div>
                        @include('modals.terms')
                        @include('modals.contact')
                        @include('modals.faqs')
                        <!--end::Links-->
                    </div>
                    <!--end::Footer-->
                </div>

                </div>
            </div>
            <!--begin::Aside-->
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid py-10">
                <!--begin::Content-->
                <div class="d-flex flex-center flex-column flex-column-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-650px w-xl-700px p-10 p-lg-15 mx-auto">
                        {{ $slot }}
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Multi-steps-->
    </div>
    <!--end::Root-->

    <!--begin::Javascript-->
    <script>
        var hostUrl = "modules/metronic_v8.2.7/";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('modules/metronic_v8.2.7/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('modules/metronic_v8.2.7/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('modules/js/create-account.js') }}"></script>
    <!--end::Custom Javascript-->
    <script id="toastrJS">
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toastr-top-center",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "50000",
            "extendedTimeOut": "3000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        @if (Session::has('success'))
            toastr.success("{!! Session::get('success') !!}");
        @endif
        @if (Session::has('info'))
            toastr.info("{!! Session::get('info') !!}");
        @endif
        @if (Session::has('warning'))
            toastr.warning("{!! Session::get('warning') !!}");
        @endif
        @if (Session::has('error'))
            toastr.error("{!! Session::get('error') !!}");
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{!! $error !!}");
            @endforeach
        @endif
    </script>

    @stack('jsscript')

    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
