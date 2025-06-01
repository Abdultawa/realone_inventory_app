<x-app-layout>
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Card-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h1>Create New User</h1>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body">
                        <!--begin::Form-->
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf
                            <!--begin::Name-->
                            <div class="mb-10">
                                <label for="name" class="form-label required">Full Name</label>
                                <input type="text" id="name" name="name" class="form-control form-control-solid"
                                    placeholder="Enter full name" required />
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Name-->

                            <!--begin::Email-->
                            <div class="mb-10">
                                <label for="email" class="form-label required">Email</label>
                                <input type="email" id="email" name="email" class="form-control form-control-solid"
                                    placeholder="Enter email" required />
                                @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Email-->

                            <!--begin::Password-->
                            <div class="mb-10">
                                <label for="password" class="form-label required">Password</label>
                                <input type="password" id="password" name="password" class="form-control form-control-solid"
                                    placeholder="Enter password" required />
                                @error('password')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Password-->

                            <!--begin::Password Confirmation-->
                            <div class="mb-10">
                                <label for="password_confirmation" class="form-label required">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="form-control form-control-solid" placeholder="Confirm password" required />
                                @error('password_confirmation')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Password Confirmation-->

                            <!--begin::Role-->
                            <div class="mb-10">
                                <label for="role" class="form-label required">Role</label>
                                <select name="role" id="role" class="form-select form-select-solid" required>
                                    <option value="" disabled selected>Select role</option>
                                    <option value="admin">Admin</option>
                                    <option value="staff">Staff</option>
                                </select>
                                @error('role')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-10">
                                <label for="store_id" class="form-label required">Store</label>
                                <select name="store_id" id="store_id" class="form-select form-select-solid" required>
                                    <option value="" disabled selected>Select Store</option>
                                    @foreach ($stores as $store)
                                            <option value="{{$store->id}}" selected>{{$store->name}}</option>
                                    @endforeach
                                </select>
                                @error('store_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Role-->

                            <!--begin::Submit-->
                            <div class="d-flex justify-content-end">
                                <a href="{{route('users.index')}}" class="btn btn-secondary me-3">Cancel</a>
                                <button type="submit" class="btn btn-primary">Create User</button>
                            </div>
                            <!--end::Submit-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
</x-app-layout>
