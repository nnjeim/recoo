<section>
	<x-form.form-section submit="deleteUser">
		<x-slot name="title">
			{{ __('Delete Account') }}
		</x-slot>

		<x-slot name="description">
			{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
		</x-slot>

		<x-slot name="form" submit="deleteUser">
			<x-danger-button
				class="my-4"
				type="button"
				x-data=""
				x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
				{{ __('Delete Account') }}
			</x-danger-button>

			<x-modal name="confirm-user-deletion" focusable>
				<div class="p-6">
					<h2 class="text-lg font-medium text-gray-900">
						{{ __('Are you sure your want to delete your account?') }}
					</h2>

					<p class="mt-1 text-sm text-gray-600">
						{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
					</p>

					<div class="mt-6">
						<x-form.label for="password" value="Password" class="sr-only" />
						<div class="relative" x-data="{ showPassword: false }">
							<input
								id="password"
								:type="showPassword === false ? 'password' : 'text'"
								class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm"
								placeholder="Password"
								autocomplete="current-password"
								wire:model.defer="password" />
							<span class="form__input_show-password">
								<template x-if="showPassword === false">
									<x-micon.visibility_on title="{{ __('show password') }}" class="pointer" size="1.125rem" @click="showPassword = true" />
								</template>
								<template x-if="showPassword === true">
									<x-micon.visibility_off title="{{ __('hide password') }}" class="pointer" size="1.125rem" @click="showPassword = false" />
								</template>
							</span>
						</div>
						<x-form.input-error for="password" class="mt-2" />
					</div>

					<div class="mt-6 flex justify-end">
						<x-secondary-button
							x-on:click="$dispatch('close')">
							{{ __('Cancel') }}
						</x-secondary-button>

						<x-danger-button
							class="ml-3"
							x-on:click="$wire.call('deleteUser')">
							{{ __('Delete Account') }}
						</x-danger-button>
					</div>
				</div>
			</x-modal>
		</x-slot>
	</x-form.form-section>
</section>
