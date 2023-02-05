<x-form.form-section submit="updateUser">
	<x-slot name="form">
		<div class="space-y-6">
			<!-- name -->
			<div>
				<x-form.label for="user_name">{{ __('users.entity.name') }}</x-form.label>
				<x-form.input id="user_name"
							  type="text"
							  class="mt-1 block w-full"
							  wire:model.defer="user.name" />
				<x-form.input-error for="user.name" class="mt-1" />
			</div>
			<!-- email -->
			<div>
				<x-form.label for="user_email">{{ __('users.entity.email') }}</x-form.label>
				<x-form.input id="user_email"
							  type="text"
							  class="mt-1 block w-full"
							  wire:model.defer="user.email" />
				<x-form.input-error for="user.email" class="mt-1" />
			</div>
			<!-- roles -->
			<div>
				<x-form.label for="user_roles">{{ __('users.entity.roles') }}</x-form.label>
				<x-form.selectors.multiple
					wire:model="user.roles"
					autocomplete="off"
					options="roles"
					placeholder="{{ __('users.entity.roles_placeholder') }}" />
				<x-form.input-error for="user.roles" class="mt-1" />
			</div>
		</div>
	</x-slot>
	<!-- actions -->
	<x-slot name="actions">
		<x-form.action-message class="mr-3" on="saved">
			{{ __('users.entity.save_message') }}
		</x-form.action-message>
		<x-form.submit-button />
	</x-slot>
</x-form.form-section>
