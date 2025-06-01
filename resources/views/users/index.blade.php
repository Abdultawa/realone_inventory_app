<x-app-layout>
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Users-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <input type="text" data-kt-ecommerce-product-filter="search"
                                    class="form-control form-control-solid w-250px ps-12"
                                    placeholder="Search User" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <!--begin::Add user-->
                            <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>
                            <!--end::Add user-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_users_table">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                data-kt-check-target="#kt_ecommerce_users_table .form-check-input"
                                                value="1" />
                                        </div>
                                    </th>
                                    <th class="min-w-200px">Name</th>
                                    <th class="text-end min-w-100px">Email</th>
                                    <th class="text-end min-w-100px">Role</th>
                                    <th class="text-end min-w-70px">Status</th>
                                    <th class="text-end min-w-70px">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @forelse ($users as $user)
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="1" />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="ms-5">
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                        data-kt-ecommerce-product-filter="user_name">{{ $user->name }}</a>
                                                    <!--end::Title-->
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end pe-0">
                                            <span class="fw-bold">{{ $user->email }}</span>
                                        </td>
                                        <td class="text-end pe-0">
                                            <span class="fw-bold">{{ $user->role }}</span>
                                        </td>
                                        <td class="text-end pe-0">
                                            <span
                                                class="badge {{ $user->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                                {{ ucfirst($user->status) }}
                                            </span>
                                        </td>

                                        <td class="text-end">
                                            <a href="#"
                                                class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                {{-- <div class="menu-item px-3">
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                        class="menu-link px-3">Edit</a>
                                                </div> --}}
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                @if ($user->status === 'active')
                                                    <div class="menu-item px-3">
                                                        <form action="{{ route('users.deactivate', $user->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PATCH')
                                                            <a href="#" class="menu-link px-3"
                                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                                                Deactivate</a>
                                                        </form>
                                                    </div>
                                                @else
                                                    <div class="menu-item px-3">
                                                        <form action="{{ route('users.activate', $user->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PATCH')
                                                            <a href="#" class="menu-link px-3"
                                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                                                Activate</a>
                                                        </form>
                                                    </div>
                                                @endif
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <form action="{{ route('users.destroy', $user->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="#" class="menu-link px-3"
                                                            onclick="event.preventDefault();
                                                                   this.closest('form').submit();">Delete</a>
                                                    </form>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu-->
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <span class="text-muted">No users found.</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Users-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
</x-app-layout>
