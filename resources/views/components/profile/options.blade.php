<section>
	<x-form.form-section submit="updateOptions">
		<x-slot name="form">
			<div class="space-y-6 mb-6">
				<!-- timezones -->
				<div>
					<x-form.label for="name" :value="__('profile.options.timezone')" />
					<x-form.selectors.single-fetch
						id="timezones"
						method="fetchTimezones"
						options="timezones"
						option-value="name"
						option-name="name"
						:placeholder="__('profile.options.timezone_placeholder')"
						:searchPlaceholder="__('profile.options.search')"
						wire:model="options.datetime.timezone" />
				</div>
			</div>

			<div class="flex items-center gap-4">
				<x-form.action-message class="mr-3" on="saved">
					{{ __('users.entity.save_message') }}
				</x-form.action-message>
				<x-form.submit-button />
			</div>
		</x-slot>
	</x-form.form-section>
</section>
