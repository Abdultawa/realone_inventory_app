<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
<head>
    <base href="{{ env('APP_URL', '') }}" />
    <title>{{ env('APP_NAME', '') }}</title>
    <meta charset="utf-8" />
    <meta name="description" content="{{ env('APP_DECS', '') }}" />
    <meta name="keywords" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="{{ env('APP_NAME', '') }}" />
    <link rel="canonical" href="{{ env('APP_URL', '') }}" />
    <link rel="shortcut icon" href="{{ asset('modules/metronic_v8.2.7/media/logos/favicon.ico')}}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('modules/metronic_v8.2.7/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('modules/metronic_v8.2.7/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('modules/override.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>

</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center">
    <!--begin::Theme mode setup on page load-->
    <script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
    <!--end::Theme mode setup on page load-->

    <!--begin::loader-->
        <div class="page-loader flex-column bg-dark bg-opacity-75">
            <span class="spinner-border text-danger" role="status"></span>
            <span class="text-gray-800 fs-6 fw-bolder mt-5">Loading...</span>
        </div>
        <!--end::loader-->

    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Page bg image-->
        <style>body { background-image: url("{{ asset('modules/metronic_v8.2.7/media/auth/bg10.jpeg')}}"); } [data-bs-theme="dark"] body { background-image: url("{{ asset('modules/metronic_v8.2.7/assets/media/auth/bg10-dark.jpeg')}}"); }</style>
        <!--end::Page bg image-->
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid container">
            <!--begin::Aside-->
            <div class="d-md-flex flex-lg-row-fluid d-none">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                    <!--begin::Image-->
                    <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="{{ asset('modules/metronic_v8.2.7/media/auth/agency.png')}}" alt="" />
                    <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="{{ asset('modules/metronic_v8.2.7/media/auth/agency-dark.png')}}" alt="" />
                    <!--end::Image-->
                    <!--begin::Title-->
                    <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">Real One Communication</h1>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <div class="text-gray-600 fs-base text-center fw-semibold">
                        <p class="text-dark w-sm-80 m-auto"></p>
                    </div>
                    <!--end::Text-->
                </div>
                <!--end::Content-->
            </div>
            <!--begin::Aside-->
            <!--begin::Body-->
            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-sm-12 p-7">
                <!--begin::Wrapper-->
                <div class="bg-body d-flex flex-column flex-center rounded-1 w-md-600px w-100 p-md-10 p-6 shadow">
                    <!--begin::Content-->
                    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px w-100">

                        <!--begin::Logo image-->
                            <div class="logo-wrap py-4 mb-7 mb-sm-0">
                                <a href="{{ route('dashboard') }}">
                                    <img alt="Logo" src="{{ asset('modules/metronic_v8.2.7/media/logos/realone.png')}}" class="h-50px h-lg-60px theme-light-show" />
                                    <img alt="Logo" src="{{ asset('modules/metronic_v8.2.7/media/logos/realone.png')}}" class="h-50px h-lg-60px theme-dark-show" />
                                </a>
                            </div>
                        <!--end::Logo image-->

                        <!--begin::Wrapper-->
                        <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">

                            {{ $slot }}

                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Footer-->
                        <div class="d-flex flex-stack">
                            <!--begin::Links-->
                            <div class="d-flex fw-semibold text-primary fs-base gap-5">
                                    <a href="#!" id="terms" data-bs-toggle="modal" data-bs-target="#termsModal">Terms</a>
                                    <a href="#!" id="contact" data-bs-toggle="modal" data-bs-target="#contactModal">Contact Us</a>
                                    <a href="#!" id="faqs" data-bs-toggle="modal" data-bs-target="#faqsModal">FAQs</a>
                                </div>
                            <!--end::Links-->
                        </div>
                        <!--end::Footer-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->

    <!--begin::Javascript-->
    <script>var hostUrl = "{{ asset('modules/metronic_v8.2.7/')}}";</script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('modules/metronic_v8.2.7/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{ asset('modules/metronic_v8.2.7/js/scripts.bundle.js')}}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('modules/metronic_v8.2.7/js/custom/authentication/sign-in/general.js')}}"></script>
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
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "50000",
            "extendedTimeOut": "3000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        @if(Session::has('success')) toastr.success("{!! Session::get('success') !!}"); @endif
        @if(Session::has('info')) toastr.info("{!! Session::get('info') !!}"); @endif
        @if(Session::has('warning')) toastr.warning("{!! Session::get('warning') !!}"); @endif
        @if(Session::has('error')) toastr.error("{!! Session::get('error') !!}"); @endif
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
