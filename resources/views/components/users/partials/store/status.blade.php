<x-form.form-section submit="storeUser">
	<x-slot name="form">
		<div>
			<table class="table w-full">
				<tbody>
				<tr>
					<td class="pr-6 py-4">
						<x-form.label value="{{ __('users.entity.status_title') }}"/>
					</td>
					<td class="px-6 py-4">
						<x-form.switch wire:model="user.status"
									   toggle-on-label="{{ __('users.entity.active') }}"
									   toggle-off-label="{{ __('users.entity.inactive') }}"/>
					</td>
				</tr>
				</tbody>
			</table>
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
