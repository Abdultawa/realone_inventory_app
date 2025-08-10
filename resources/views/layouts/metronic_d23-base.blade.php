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
        {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
		<!--end::Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="{{ asset('modules/metronic_v8.2.7/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('modules/metronic_v8.2.7/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('modules/override.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Fonts-->
		<!--begin::Vendor Stylesheets(used for this page only)-->
		<link href="{{asset('modules/metronic_v8.2.7/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('modules/metronic_v8.2.7/plugins/custom/vis-timeline/vis-timeline.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="{{asset('modules/metronic_v8.2.7/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('modules/metronic_v8.2.7/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />

        <!-- Select2 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

		<!--end::Global Stylesheets Bundle-->
		<script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
        if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
        </script>

        <style>
                    .card-custom {
                        border: none;
                        border-radius: 10px;
                        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                    }
                    .icon-bg {
                        background-color: #e8f5e9;
                        border-radius: 50%;
                        padding: 10px;
                        display: inline-block;
                    }
                    .overview-value {
                        font-size: 1.5rem;
                        font-weight: bold;
                    }
                    .overview-label {
                        color: #888;
                        font-size: 11px;
                    }
                    .review-btn {
                        color: #FF8800;
                        cursor: pointer;
                        font-weight: bold;
                    }
                    .small-text {
                        font-size: 0.9rem;
                        color: #6c757d;
                    }
                    .table-custom th, .table-custom td {
                        vertical-align: middle;
                    }
                    .btn-outline-custom {
                        color: #28a745;
                        border-color: #28a745;
                    }
                    .btn-outline-custom:hover {
                        background-color: #28a745;
                        color: #fff;
                    }
                      /* Additional Styling */
                    .user-info {
                        font-size: 14px;
                    }
                    .user-info label {
                        font-weight: bold;
                    }
                    .user-info .text-muted {
                        font-weight: 500;
                    }
                    .user-info .text-unavailable {
                        color: green;
                        font-weight: 500;
                    }
                    /* Remove padding and margin for the Next of Kin section */
                    .no-padding-margin {
                        left: 0;
                    }
        </style>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_app_body" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" class="app-default">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->

        <!--begin::loader-->
        <div class="page-loader flex-column bg-dark bg-opacity-75">
            <span class="spinner-border text-danger" role="status"></span>
            <span class="text-gray-800 fs-6 fw-bolder mt-5">Loading...</span>
        </div>
        <!--end::loader-->

		<!--begin::App-->
		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
			<!--begin::Page-->
			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
				<!--begin::Header-->
				<div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate-="true" data-kt-sticky-name="app-header-sticky" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
					<!--begin::Header container-->
                        @include('layouts.metronic_d23-base-navbar')
					<!--end::Header container-->
				</div>
				<!--end::Header-->
				<!--begin::Wrapper-->
				<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
					<!--begin::Sidebar-->
                        @include('layouts.metronic_d23-base-sidebar')
					<!--end::Sidebar-->
					<!--begin::Main-->
					<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
						<!--begin::Content wrapper-->
						<div class="d-flex flex-column flex-column-fluid">
							<!--begin::Content-->
							<div id="kt_app_content" class="app-content flex-column-fluid">
								<!--begin::Content container-->
								<div id="kt_app_content_container" class="app-container container-xxl_ container-fluid">
                                    {{ $slot }}
                                </div>

								<!--end::Content container-->
							</div>
							<!--end::Content-->
						</div>
						<!--end::Content wrapper-->
						<!--begin::Footer-->
						<div id="kt_app_footer" class="app-footer">
							<!--begin::Footer container-->
							<div class="app-container container-xxl d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
								<!--begin::Copyright-->
								<div class="text-gray-900 order-2 order-md-1">
									<span class="text-muted fw-semibold me-1">2024&copy;</span>
									<a href="#!" target="_blank" class="text-gray-800 text-hover-primary">{{ env('APP_NAME','') }}</a>
								</div>
								<!--end::Copyright-->
								<!--begin::Menu-->
								<ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1 d-none">
									<li class="menu-item">
										<a href="#!" target="_blank" class="menu-link px-2">About</a>
									</li>
									<li class="menu-item">
										<a href="#1" target="_blank" class="menu-link px-2">Support</a>
									</li>
								</ul>
                                <div class="d-flex fw-semibold text-primary fs-base gap-5">
                                    <a href="#!" id="terms" data-bs-toggle="modal" data-bs-target="#termsModal">Terms</a>
                                    <a href="#!" id="contact" data-bs-toggle="modal" data-bs-target="#contactModal">Contact Us</a>
                                    <a href="#!" id="faqs" data-bs-toggle="modal" data-bs-target="#faqsModal">FAQs</a>
                                </div>
								<!--end::Menu-->
							</div>
							<!--end::Footer container-->
						</div>
						<!--end::Footer-->
					</div>
					<!--end:::Main-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::App-->
		<!--begin::Drawers-->
		<!--begin::Activities drawer-->

		<!--end::Activities drawer-->
		<!--begin::Chat drawer-->

		<!--end::Chat drawer-->
		<!--begin::Chat drawer-->

		<!--end::Chat drawer-->
		<!--end::Drawers-->
		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<i class="ki-outline ki-arrow-up"></i>
		</div>
		<!--end::Scrolltop-->
		<!--begin::Modals-->

		<!--end::Modals-->

		<!--begin::Javascript-->
		<script>var hostUrl = "{{ asset('modules/metronic_v8.2.7/')}}";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="{{ asset('modules/metronic_v8.2.7/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{ asset('modules/metronic_v8.2.7/js/scripts.bundle.js')}}"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Vendors Javascript(used for this page only)-->
		<script src="{{ asset('modules/metronic_v8.2.7/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
{{--
        <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
		<script src="{{ asset('modules/metronic_v8.2.7/plugins/custom/datatables/datatables.bundle.js')}}"></script>
--}}
		<!--end::Vendors Javascript-->
		<!--begin::Custom Javascript(used for this page only)-->
		<script src="{{ asset('modules/metronic_v8.2.7/js/widgets.bundle.js')}}"></script>
		<script src="{{ asset('modules/metronic_v8.2.7/js/custom/widgets.js')}}"></script>
		<script src="{{ asset('modules/metronic_v8.2.7/js/custom/apps/chat/chat.js')}}"></script>
		<script src="{{ asset('modules/metronic_v8.2.7/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
		<script src="{{ asset('modules/metronic_v8.2.7/js/custom/utilities/modals/users-search.js')}}"></script>
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
