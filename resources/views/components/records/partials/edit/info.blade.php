<x-form.form-section submit="updateRecord">
	<x-slot name="form">
		<div class="space-y-6">
			<!-- title -->
			<div>
				<x-form.label for="record_title">{{ __('records.entity.record_title') }}</x-form.label>
				<x-form.input id="record_title"
							  type="text"
							  class="mt-1 block w-full"
							  wire:model.defer="record.title" />
				<x-form.input-error for="record.title" class="mt-1" />
			</div>
			<!-- release year -->
			<div>
				<x-form.label for="record_release_year">{{ __('records.entity.record_release_year') }}</x-form.label>
				<x-form.input id="record_release_year"
							  type="number"
							  class="mt-1 block w-full"
							  wire:model.defer="record.params.year" />
				<x-form.input-error for="record.params.year" class="mt-1" />
			</div>
			<!-- IMDb id -->
			<div>
				<x-form.label for="record_imdb_id">{{ __('records.entity.record_imdb_id') }}</x-form.label>
				<x-form.input id="record_imdb_id"
							  type="text"
							  class="mt-1 block w-full"
							  wire:model.defer="record.imdb_id" />
				<x-form.input-error for="record.imdb_id" class="mt-1" />
			</div>
			<!-- genre -->
			<div>
				<x-form.label for="record_genre">{{ __('records.entity.record_genre') }}</x-form.label>
				<x-form.input id="record_genre"
							  type="text"
							  class="mt-1 block w-full"
							  wire:model.defer="record.params.genre" />
				<x-form.input-error for="record.params.genre" class="mt-1" />
			</div>
			<!-- poster -->
			<div>
				<x-form.label for="record_poster">{{ __('records.entity.record_poster') }}</x-form.label>
				<x-form.input id="record_poster"
							  type="text"
							  class="mt-1 block w-full"
							  wire:model.defer="record.params.poster" />
				<x-form.input-error for="record.params.poster" class="mt-1" />
			</div>
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
