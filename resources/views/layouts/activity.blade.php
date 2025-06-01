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
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		{{-- <link href="{{ asset('modules/metronic_v8.2.7/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" /> --}}
		{{-- <link href="{{ asset('modules/metronic_v8.2.7/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" /> --}}
		{{-- <link href="{{ asset('modules/metronic_v8.2.7/css/style.bundle.css')}}" rel="stylesheet" type="text/css" /> --}}
		<link href="{{ asset('modules/override.css')}}" rel="stylesheet" type="text/css" />
        @stack('template_linked_css')
		<script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
        if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
        </script>

	</head>
	<body id="kt_body" data-bs-spy="scroll" data-bs-target="#kt_landing_menu" class="bg-body position-relative app-blank">
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>

        <div class="page-loader flex-column bg-dark bg-opacity-75">
            <span class="spinner-border text-danger" role="status"></span>
            <span class="text-gray-800 fs-6 fw-bolder mt-5">Loading...</span>
        </div>

		<div class="d-flex flex-column flex-root vh-100_" id="kt_app_root">

		<div class="mt-20  position-relative h-100">
				<div class="container">
					@yield('content')
				</div>
			</div>


		</div>
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<i class="ki-outline ki-arrow-up"></i>
		</div>

    <script>
        var hostUrl = "modules/metronic_v8.2.7/";
    </script>
    {{--
    <script src="{{ asset('modules/metronic_v8.2.7/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('modules/metronic_v8.2.7/js/scripts.bundle.js') }}"></script>
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
    --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    @stack('jsscript')
    @stack('footer_scripts')

	</body>


</html>
