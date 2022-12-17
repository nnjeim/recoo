<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
			<a href="/" class="w-48 h-20">
				<x-layout.auth-logo class="fill-current text-gray-500" />
			</a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div>
                <x-form.label for="password" :value="__('Password')" />

                <x-form.input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex justify-end mt-4">
                <x-form.primary-button>
                    {{ __('Confirm') }}
                </x-form.primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
