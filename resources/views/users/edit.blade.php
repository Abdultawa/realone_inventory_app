<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold fs-3 text-gray-800">Edit User</h2>
    </x-slot>

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card card-flush">
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <div class="card-title">
                            <h3 class="mb-0">Edit User Details</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @method('PUT')
                            @csrf

                            <!-- Name -->
                            <div class="mb-10">
                                <label for="name" class="form-label required">Full Name</label>
                                <input type="text" id="name" name="name" class="form-control form-control-solid"
                                       value="{{ old('name', $user->name) }}" required />
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-10">
                                <label for="email" class="form-label required">Email</label>
                                <input type="email" id="email" name="email" class="form-control form-control-solid"
                                       value="{{ old('email', $user->email) }}" required />
                                @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-10">
                                <label for="password" class="form-label">New Password (optional)</label>
                                <input type="password" id="password" name="password" class="form-control form-control-solid"
                                       placeholder="Leave blank to keep current password" />
                                @error('password')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password Confirmation -->
                            <div class="mb-10">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                       class="form-control form-control-solid" placeholder="Confirm new password" />
                                @error('password_confirmation')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Role -->
                            <div class="mb-10">
                                <label for="role" class="form-label required">Role</label>
                                <select name="role" id="role" class="form-select form-select-solid" required>
                                    <option disabled>Select Role</option>
                                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="staff" {{ old('role', $user->role) === 'staff' ? 'selected' : '' }}>Staff</option>
                                </select>
                                @error('role')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Store -->
                            <div class="mb-10">
                                <label for="store_id" class="form-label">Store</label>
                                <select name="store_id" id="store_id" class="form-select form-select-solid">
                                    {{-- <option disabled>Select Store</option> --}}
                                    <option value="">No Store</option>
                                    @foreach ($stores as $store)
                                        <option value="{{ $store->id }}" {{ old('store_id', $user->store_id) == $store->id ? 'selected' : '' }}>
                                            {{ $store->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('store_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit -->
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('users.index') }}" class="btn btn-secondary me-3">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
