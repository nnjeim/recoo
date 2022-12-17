<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
			<a href="/" class="w-48 h-20">
				<x-layout.auth-logo class="fill-current text-gray-500" />
			</a>
        </x-slot>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
				<x-form.label for="email" :value="__('Email')" />
                <x-form.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
				<x-form.label for="password" :value="__('Password')" />
                <x-form.input id="password" class="block mt-1 w-full" type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
				<x-form.label for="password_confirmation" :value="__('Confirm Password')" />

                <x-form.input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-form.primary-button>
                    {{ __('Reset Password') }}
                </x-form.primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
