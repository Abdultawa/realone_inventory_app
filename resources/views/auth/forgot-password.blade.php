<x-guest-layout>

    <div class="text-start w-100 mb-5">
        <h3 class="my-4 text-start">Password Reset</h3>
        <a href="{{route('login')}}" class="btn btn-sm btn-success">Return to Login  <i class="fas fa-user-lock ms-2"></i></a>
    </div>


    <div class="mb-4 text-sm text-gray-500">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="w-100 d-block">
        @csrf

        <!-- Email Address -->
        <div class="form-floating mb-3 w-full">
            <x-text-input id="email" class="block form-control rounded-0" type="email" name="email" value="{{old('email'?? '')}}" required  autofocus placeholder="Email"/>
            <x-input-label for="email" :value="__('Email')" />
            <x-input-error :messages="$errors->get('email')" class="text-danger" />
        </div>
        {{-- <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div> --}}

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="btn btn-sm btn-dark">{{ __('Email Password Reset Link') }}</x-primary-button>
        </div>
    </form>
</x-guest-layout>
