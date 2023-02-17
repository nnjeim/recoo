<section>
	<x-form.form-section submit="updatePassword">
		<x-slot name="form">
			<div class="space-y-6 mt-6">
				<div>
					<x-form.label for="current_password" :value="__('Current Password')" />
					<div class="relative" x-data="{ showPassword: false }">
						<input
							id="current_password"
							class="form__input"
							:type="showPassword === false ? 'password' : 'text'"
							autocomplete="current-password"
							wire:model.defer="current_password" />
						<span class="form__input_show-password">
							<template x-if="showPassword === false">
								<x-micon.visibility_on title="{{ __('show password') }}" class="pointer" size="1.125rem" @click="showPassword = true" />
							</template>
							<template x-if="showPassword === true">
								<x-micon.visibility_off title="{{ __('hide password') }}" class="pointer" size="1.125rem" @click="showPassword = false" />
							</template>
						</span>
					</div>
					<x-form.input-error for="current_password" />
				</div>

				<div>
					<x-form.label for="password" :value="__('New Password')" />
					<div class="relative" x-data="{ showPassword: false }">
						<input
							id="password"
							class="form__input"
							:type="showPassword === false ? 'password' : 'text'"
							autocomplete="new-password"
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
					<x-form.input-error for="password" />
				</div>

				<div>
					<x-form.label for="password_confirmation" :value="__('Confirm Password')" />
					<div class="relative" x-data="{ showPassword: false }">
						<input
							id="password_confirmation"
							class="form__input"
							:type="showPassword === false ? 'password' : 'text'"
							autocomplete="new-password"
							wire:model.defer="password_confirmation" />
						<span class="form__input_show-password">
							<template x-if="showPassword === false">
								<x-micon.visibility_on title="{{ __('show password') }}" class="pointer" size="1.125rem" @click="showPassword = true" />
							</template>
							<template x-if="showPassword === true">
								<x-micon.visibility_off title="{{ __('hide password') }}" class="pointer" size="1.125rem" @click="showPassword = false" />
							</template>
						</span>
					</div>
					<x-form.input-error for="password_confirmation" />
				</div>

				<div class="flex items-center gap-4">
					<x-form.action-message class="mr-3" on="saved">
						{{ __('Save') }}
					</x-form.action-message>
					<x-form.submit-button />
				</div>
			</div>
		</x-slot>
	</form>
	</x-form.form-section>
</section>
