<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework my-4">
        @csrf


        <h3 class="fw-bolder text-primary mb-3">Login</h3>

        <!-- Email Address -->
        <div class="fv-row mb-8">
            <x-text-input id="email" class="block form-control rounded-0 py-3" type="email" name="email" :value="old('email')" required   placeholder="Email"/>
            <x-input-label for="email" :value="__('Email')" />
            <x-input-error :messages="$errors->get('email')" class="text-danger" />
        </div>


        <!-- Password -->
        <div class="fv-row mb-8">
            <x-text-input id="password" class="block form-control rounded-0" type="password" name="password" required   placeholder="Password"/>
            <x-input-label for="password" :value="__('Password')" />
            <x-input-error :messages="$errors->get('email')" class="text-danger" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4 d-flex  align-items-center mx-3">
            <div class="text-success">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>
            @if (Route::has('password.request'))
                <div class="text-end  ms-auto">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center  mt-4">
            <x-primary-button class="py-4 btn btn-primary rounded-0 w-100">{{ __('Log in') }}</x-primary-button>
        </div>
    </form>


</x-guest-layout>
