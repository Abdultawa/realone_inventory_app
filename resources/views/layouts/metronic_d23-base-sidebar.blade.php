<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="275px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_toggle">
    <!--begin::Logo-->
    <div class="d-flex flex-stack px-4 px-lg-6 py-3 py-lg-8" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="#">
            <img alt="Logo" src="{{ asset('modules/metronic_v8.2.7/media/logos/realone.png')}}" class="h-50px h-lg-60px theme-light-show" />
            <img alt="Logo" src="{{ asset('modules/metronic_v8.2.7/media/logos/realone.png')}}" class="h-50px h-lg-60px theme-dark-show" />
        </a>
        <!--end::Logo image-->
        <!--begin::User menu-->
        <div class="ms-3">
            <!--begin::Menu wrapper-->
            <div class="cursor-pointer position-relative symbol symbol-circle symbol-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                <img src="{{ asset( 'blank.png') }}" alt="user" />
                <div class="position-absolute rounded-circle bg-success start-100 top-100 h-8px w-8px ms-n3 mt-n3"></div>
            </div>
            <!--begin::User account menu-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <div class="menu-content d-flex align-items-center px-3">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-50px me-5">
                            <img alt="Logo" src="{{ asset( 'blank.png') }}" />
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Username-->
                        <div class="d-flex flex-column">
                            <div class="fw-bold d-flex_ align-items-center fs-5">
                                <span class="badge badge-light-primary fw-bold fs-8 px-2 py-1 ms-0 d-block_">{{Auth::user()->role ?? ':role:'}}</span>
                                <h5 class="mb-0 ">{{Auth::user()->name ?? 'n/a'}}</h5>
                            </div>
                            <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{Auth::user()->email ?? 'n/a'}}</a>
                        </div>
                        <!--end::Username
                        If the country_id is null the code error for the user
                        -->
                    </div>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu separator-->
                <div class="separator my-2"></div>
                <!--end::Menu separator-->
                <!--begin::Menu item-->
                <div class="menu-item px-5">
                    <a href="#" class="menu-link px-5 review-btn review-profile" data-id="">My Profile</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-5">
                    <a href="#" class="menu-link px-5">Reset Password</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu separator-->
                <div class="separator my-2"></div>
                <!--end::Menu separator-->
                <!--begin::Menu item-->
                <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                    <a href="#" class="menu-link px-5">
                        <span class="menu-title position-relative">Mode
                        <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                            <i class="ki-outline ki-night-day theme-light-show fs-2"></i>
                            <i class="ki-outline ki-moon theme-dark-show fs-2"></i>
                        </span></span>
                    </a>
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
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
                <!--end::Menu item-->

                <!--begin::Menu item-->
                {{-- <div class="menu-item px-5 my-1">
                    <a href="#!" class="menu-link px-5">Account Settings</a>
                </div> --}}
                <!--end::Menu item-->
                <!--begin::Menu item-->
                {{-- @impersonating($guard = null)
                <div class="menu-item px-5 my-1">
                    <a href="#" class="menu-link px-5"><i class="fas fa-power-off text-danger"></i> Switch Revert </a>
                </div>
                @endImpersonating --}}

                <div class="menu-item px-5">
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{route('logout')}}" class="menu-link px-5" onclick="event.preventDefault(); this.closest('form').submit();">Sign Out</a>
                    </form>
                </div>
                <!--end::Menu item-->
            </div>
            <!--end::User account menu-->
            <!--end::Menu wrapper-->
        </div>
        <!--end::User menu-->
    </div>
    <!--end::Logo-->
    <!--begin::Sidebar nav-->
        @include('layouts.metronic_d23-base-sidebar-nav')
    <!--end::Sidebar nav-->
</div>
