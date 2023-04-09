<x-form.form-section class="max-w-2xl" submit="editTenantOptions">
	<x-slot name="form">
		<div class="space-y-6">
			<!-- Tenant address -->
			<div>
				<h3 class="font-bold">{{ __('settings.info.options.address_title') }}</h3>
			</div>
			<!-- Name -->
			<div>
				<x-form.label for="name" value="{{ __('settings.info.options.name') }}"/>
				<x-form.input
					type="text"
					id="name"
					class="form__input w-full"
					wire:model="tenantOptions.name"
				/>
				<x-form.input-error for="tenantOptions.name"/>
			</div>
			<!-- Address1 -->
			<div>
				<x-form.label for="address1" value="{{ __('settings.info.options.address1') }}"/>
				<x-form.input
					type="text"
					id="address1"
					class="form__input w-full"
					wire:model="tenantOptions.address1"
				/>
				<x-form.input-error for="tenantOptions.address1"/>
			</div>
			<!-- Address2 -->
			<div>
				<x-form.label for="address2" value="{{ __('settings.info.options.address2') }}"/>
				<x-form.input
					type="text"
					id="address2"
					class="form__input w-full"
					wire:model="tenantOptions.address2"
				/>
				<x-form.input-error for="tenantOptions.address2"/>
			</div>
			<!-- Phone -->
			<div>
				<x-form.label for="phone" value="{{ __('settings.info.options.phone') }}"/>
				<x-form.input
					type="text"
					id="phone"
					class="form__input w-full"
					wire:model="tenantOptions.phone"
				/>
				<x-form.input-error for="tenantOptions.phone"/>
			</div>

			<!-- Tenant timezone -->
			<div>
				<h3 class="font-bold">{{ __('settings.info.options.timezone_title') }}</h3>
			</div>
			<!-- Name -->

			<div>
		</div>
	</x-slot>
	<x-slot name="actions">
		<x-form.submit-button type="submit" wire:loading.attr="disabled" class="has-icon-right">
			<span>{{ __('settings.info.options.save') }}</span>
			<x-micon.arrow_forward/>
		</x-form.submit-button>
	</x-slot>
</x-form.form-section>
