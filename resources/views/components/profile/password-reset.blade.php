<section>
	<header>
		<h2 class="text-lg font-medium text-gray-900">
			{{ __('Update Password') }}
		</h2>

		<p class="mt-1 text-sm text-gray-600">
			{{ __('Ensure your account is using a long, random password to stay secure.') }}
		</p>
	</header>

	<form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
		@csrf
		@method('put')

		<div>
			<x-form.label for="current_password" :value="__('Current Password')" />
			<div class="relative" x-data="{ showPassword: false }">
				<input
					id="current_password"
					name="current_password"
					class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm"
					:type="showPassword === false ? 'password' : 'text'"
					autocomplete="current-password" />
				<span class="show-password">
					<template x-if="showPassword === false">
						<x-micon.visibility_on title="{{ __('show password') }}" class="pointer" size="1.125rem" @click="showPassword = true" />
					</template>
					<template x-if="showPassword === true">
						<x-micon.visibility_off title="{{ __('hide password') }}" class="pointer" size="1.125rem" @click="showPassword = false" />
					</template>
				</span>
			</div>
			<x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
		</div>

		<div>
			<x-form.label for="password" :value="__('New Password')" />
			<div class="relative" x-data="{ showPassword: false }">
				<input
					id="password"
					name="password"
					class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm"
					:type="showPassword === false ? 'password' : 'text'"
					autocomplete="new-password" />
				<span class="show-password">
					<template x-if="showPassword === false">
						<x-micon.visibility_on title="{{ __('show password') }}" class="pointer" size="1.125rem" @click="showPassword = true" />
					</template>
					<template x-if="showPassword === true">
						<x-micon.visibility_off title="{{ __('hide password') }}" class="pointer" size="1.125rem" @click="showPassword = false" />
					</template>
				</span>
			</div>
			<x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
		</div>

		<div>
			<x-form.label for="password_confirmation" :value="__('Confirm Password')" />
			<div class="relative" x-data="{ showPassword: false }">
				<input
					id="password_confirmation"
					name="password_confirmation"
					class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm"
					:type="showPassword === false ? 'password' : 'text'"
					autocomplete="new-password" />
				<span class="show-password">
					<template x-if="showPassword === false">
						<x-micon.visibility_on title="{{ __('show password') }}" class="pointer" size="1.125rem" @click="showPassword = true" />
					</template>
					<template x-if="showPassword === true">
						<x-micon.visibility_off title="{{ __('hide password') }}" class="pointer" size="1.125rem" @click="showPassword = false" />
					</template>
				</span>
			</div>
			<x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
		</div>

		<div class="flex items-center gap-4">
			<x-form.primary-button>{{ __('Save') }}</x-form.primary-button>

			@if (session('status') === 'password-updated')
				<p
					x-data="{ show: true }"
					x-show="show"
					x-transition
					x-init="setTimeout(() => show = false, 2000)"
					class="text-sm text-gray-600"
				>{{ __('Saved.') }}</p>
			@endif
		</div>
	</form>
</section>
