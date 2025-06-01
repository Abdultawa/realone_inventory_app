<!DOCTYPE html>
<html lang="en">
	<head>
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
		<!--begin::Vendor Stylesheets(used for this page only)-->
		<link href="{{ asset('modules/metronic_v8.2.7/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('modules/metronic_v8.2.7/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="{{ asset('modules/metronic_v8.2.7/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('modules/metronic_v8.2.7/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('modules/override.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		<script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
        if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
        </script>

	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" data-bs-spy="scroll" data-bs-target="#kt_landing_menu" class="bg-body position-relative app-blank">
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
		<div class="d-flex flex-column flex-root vh-100" id="kt_app_root">

		<div class="mt-20  position-relative h-100">
				<!--begin::Container-->
				<div class="container">

					{{$slot}}

				</div>
				<!--end::Container-->
			</div>

			<!--begin::Footer Section-->
			<div class="mb-0">
				<!--begin::Wrapper-->
				<div class="landing-dark-bg pt-20">

					<!--begin::Separator-->
					<div class="landing-dark-separator"></div>
					<!--end::Separator-->
					<!--begin::Container-->
					<div class="container">
						<!--begin::Wrapper-->
						<div class="d-flex flex-column flex-md-row flex-stack py-7 py-lg-10">
							<!--begin::Copyright-->
							<div class="d-flex align-items-center order-2 order-md-1">
								<!--begin::Logo-->
								<a href="landing.html">
									<img alt="Logo" src="{{ asset('modules/metronic_v8.2.7/media/logos/custom-1-white.png')}}" class="h-15px h-md-20px" />
								</a>
								<!--end::Logo image-->
								<!--begin::Logo image-->
								<span class="mx-5 fs-6 fw-semibold text-gray-600 pt-1" href="#">&copy; 2024 Dannon Group.</span>
								<!--end::Logo image-->
							</div>
							<!--end::Copyright-->
							<!--begin::Menu-->
							<ul class="menu menu-gray-600 menu-hover-primary fw-semibold fs-6 fs-md-5 order-1 mb-5 mb-md-0 d-none">
								<li class="menu-item">
									<a href="#" target="_blank" class="menu-link px-2">About</a>
								</li>
								<li class="menu-item mx-5">
									<a href="#" target="_blank" class="menu-link px-2">Support</a>
								</li>
								<li class="menu-item">
									<a href="" target="_blank" class="menu-link px-2">Purchase</a>
								</li>
							</ul>

                            <div class="d-flex fw-semibold text-primary fs-base gap-5">
                                    <a href="#!" id="terms" data-bs-toggle="modal" data-bs-target="#termsModal">Terms</a>
                                    <a href="#!" id="contact" data-bs-toggle="modal" data-bs-target="#contactModal">Contact Us</a>
                                    <a href="#!" id="faqs" data-bs-toggle="modal" data-bs-target="#faqsModal">FAQs</a>
                                </div>
                                @include('modals.terms')
                                @include('modals.contact')
                                @include('modals.faqs')
							<!--end::Menu-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Container-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Footer Section-->
		</div>
		<!--end::Root-->
		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<i class="ki-outline ki-arrow-up"></i>
		</div>
		<!--end::Scrolltop-->

		<!--begin::Javascript-->
    <script>
        var hostUrl = "modules/metronic_v8.2.7/";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('modules/metronic_v8.2.7/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('modules/metronic_v8.2.7/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Custom Javascript(used for this page only)-->
    // <script src="{{ asset('modules/js/create-account.js') }}"></script>
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

	</body>
	<!--end::Body-->


</html>
