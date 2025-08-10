<div class="flex-column-fluid px-4 px-lg-8 py-4" id="kt_app_sidebar_nav">
    <!--begin::Nav wrapper-->
    <div id="kt_app_sidebar_nav_wrapper" class="d-flex flex-column hover-scroll-y pe-4 me-n4" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar, #kt_app_sidebar_nav" data-kt-scroll-offset="5px">


        <!--begin::Links-->
        <div class="mb-6">
            <!--begin::Title-->
            <span class="badge badge-light-primary">{{Auth::user()->role?? ':role:'}}</span>
            {{-- <img src="{{asset('/modules/imgs/flags/'.Str::lower($user->country->alpha2).'.png')}}" alt="Flag" width="30"> --}}


            <h3 class="text-gray-800 fw-bold mb-8 ps-1 pt-2">Dashboard</h3>
            <!--end::Title-->
            <!--begin::Row-->
            <div class="row row-cols-3" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">

                    {{-- <div class="col-12"><h6>Admin Menu</h6></div> --}}
                    @if(auth()->user()->isStaff())
                    <x-button-link route="{{route('staff.dashboard')}}" icon="ki-outline ki-home fs-1" label="Dashboard" bgColor="btn-light-primary"/>
                    @endif
                    @if(auth()->user()->isAdmin())
                    <x-button-link route="{{route('dashboard')}}" icon="fas fa-home" label="Dashboard" bgColor="btn-light-primary"/>
                    @endif
                    <x-button-link route="{{route('products.index')}}" icon="ki-outline ki-faceid fs-1" label="Products" bgColor="btn-light-primary"/>
                    @if(auth()->user()->isAdmin())
                    <x-button-link route="{{route('stores.index')}}" icon="fas fa-users-cog fs-1" label="Stores" bgColor="btn-light-primary"/>
                    <x-button-link route="{{route('categories.index')}}" icon="fas fa-users-cog fs-1" label="Categorys" bgColor="btn-light-primary"/>
                    <x-button-link route="{{route('users.index')}}" icon="ki-outline ki-wifi-square fs-1" label="Users" bgColor="btn-light-primary"/>
                    <x-button-link route="{{route('transfers.index')}}" icon="fas fa-laptop-house fs-1" label="Transfers" bgColor="btn-light-primary"/>
                    @endif
                    <x-button-link route="{{route('invoices.index')}}" icon="fas fa-laptop-house fs-1" label="Sales" bgColor="btn-light-primary"/>

            </div>
            <!--end::Row-->
        </div>
        <!--end::Links-->
    </div>
    <!--end::Nav wrapper-->
</div>
<!--begin::Footer-->
<div class="flex-column-auto d-flex flex-center px-4 px-lg-8 py-3 py-lg-8" id="kt_app_sidebar_footer">
</div>
<!--end::Footer-->
