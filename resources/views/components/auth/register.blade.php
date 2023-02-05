<x-auth-card>
	<x-slot name="logo">
		<a href="/" class="w-48 h-20">
			<x-layout.auth-logo class="fill-current text-gray-500" />
		</a>
	</x-slot>

	<form method="POST" wire:submit.prevent="registerUser">
		@csrf
		<!-- Name -->
		<div>
			<x-form.label for="name" :value="__('Name')" />
			<x-form.input
				id="name"
				class="block mt-1 w-full"
				type="text"
				wire:model.defer="user.name"
				required
				autofocus
			/>
			<x-form.input-error for="user.name" class="mt-2" />
		</div>

		<!-- Email Address -->
		<div class="mt-4">
			<x-form.label for="email" :value="__('Email')" />
			<x-form.input
				id="email"
				class="block mt-1 w-full"
				type="email"
				wire:model.defer="user.email"
				required />
			<x-form.input-error for="user.email" class="mt-2" />
		</div>

		<!-- Password -->
		<div class="mt-4">
			<x-form.label for="password" :value="__('Password')" />
			<div class="relative" x-data="{ showPassword: false }">
				<input
					id="password"
					class="form__input"
					:type="showPassword === false ? 'password' : 'text'"
					wire:model.defer="user.password"
					required
					autocomplete="new-password" />
				<span class="form__input_show-password">
					<template x-if="showPassword === false">
						<x-micon.visibility_on title="{{ __('show password') }}" class="pointer" size="1.125rem" @click="showPassword = true" />
					</template>
					<template x-if="showPassword === true">
						<x-micon.visibility_off title="{{ __('hide password') }}" class="pointer" size="1.125rem" @click="showPassword = false" />
					</template>
				</span>
			</div>
			<x-form.input-error for="user.password" class="mt-2" />
		</div>

		<!-- Confirm Password -->
		<div class="mt-4">
			<x-form.label for="password_confirmation" :value="__('Confirm Password')" />
			<div class="relative" x-data="{ showPassword: false }">
				<input
					id="password_confirmation"
					class="form__input"
					:type="showPassword === false ? 'password' : 'text'"
					wire:model.defer="user.password_confirmation"
					required />
				<span class="form__input_show-password">
					<template x-if="showPassword === false">
						<x-micon.visibility_on title="{{ __('show password') }}" class="pointer" size="1.125rem" @click="showPassword = true" />
					</template>
					<template x-if="showPassword === true">
						<x-micon.visibility_off title="{{ __('hide password') }}" class="pointer" size="1.125rem" @click="showPassword = false" />
					</template>
				</span>
			</div>
			<x-form.input-error for="user.password_confirmation" class="mt-2" />
		</div>

		<div class="flex items-center justify-end mt-4">
			<a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" href="{{ route('login') }}">
				{{ __('Already registered?') }}
			</a>
			<x-form.submit-button
				class="ml-4"
				:text="__('Register')" />
		</div>
	</form>
</x-auth-card>
