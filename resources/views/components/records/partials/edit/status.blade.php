<x-form.form-section submit="updateRecord">
	<x-slot name="form">
		<div>
			<table class="table w-full">
				<tbody>
				<tr>
					<td class="pr-6 py-4 border-b border-gray-300">
						<x-form.label value="{{ __('records.entity.created_at') }}"/>
					</td>
					<td class="px-6 py-4 border-b border-gray-300">{{ $record['created_at'] }}</td>
				</tr>
				<tr>
					<td class="pr-6 py-4">
						<x-form.label value="{{ __('records.entity.updated_at') }}"/>
					</td>
					<td class="px-6 py-4">{{ $record['updated_at'] }}</td>
				</tr>
				</tbody>
			</table>
		</div>
	</x-slot>
	<!-- actions -->
	<x-slot name="actions">
		<x-form.action-message class="mr-3" on="saved">
			{{ __('records.entity.save_message') }}
		</x-form.action-message>
		<x-form.submit-button />
	</x-slot>
</x-form.form-section>
