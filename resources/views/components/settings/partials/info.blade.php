<x-form.form-section class="max-w-2xl" submit="editTenantOptions">
	<x-slot name="form">
		<!-- Name -->
		<div class="mb-5">
			<x-form.label for="name" value="{{ __('settings.general.options.info.name') }}" />
			<x-form.input
				type="text"
				id="name"
				class="form__input w-full"
				wire:model="tenantOptions.name"
			/>
			<x-form.input-error for="tenantOptions.name" />
		</div>
		<!-- Address1 -->
		<div class="mb-5">
			<x-form.label for="address1" value="{{ __('settings.general.options.info.address1') }}" />
			<x-form.input
				type="text"
				id="address1"
				class="form__input w-full"
				wire:model="tenantOptions.address1"
			/>
			<x-form.input-error for="tenantOptions.address1" />
		</div>
		<!-- Address2 -->
		<div class="mb-5">
			<x-form.label for="address2" value="{{ __('settings.general.options.info.address2') }}" />
			<x-form.input
				type="text"
				id="address2"
				class="form__input w-full"
				wire:model="tenantOptions.address2"
			/>
			<x-form.input-error for="tenantOptions.address2" />
		</div>
		<!-- Phone -->
		<div class="mb-5">
			<x-form.label for="phone" value="{{ __('settings.general.options.info.phone') }}" />
			<x-form.input
				type="text"
				id="phone"
				class="form__input w-full"
				wire:model="tenantOptions.phone"
			/>
			<x-form.input-error for="tenantOptions.phone" />
		</div>
	</x-slot>
	<x-slot name="actions">
		<x-form.button type="submit" wire:loading.attr="disabled" class="has-icon-right">
			<span>{{ __('settings.general.options.save') }}</span>
			<x-micon.arrow_forward />
		</x-form.button>
	</x-slot>
</x-form.form-section>
