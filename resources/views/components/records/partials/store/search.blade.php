@props([
	'imdb_search_type_options' => [],
	'imdb_records' => [],
])
<div class="max-w-2xl">
	<div class="bg-orange-50 p-4 mb-6">
		<h2 class="mb-2 text-orange-600">
			<span>{{ __('records.entity.search_imdb') }}</span>
		</h2>
		<div class="flex items-center gap-4 border-b-2 border-orange-600 pb-4">
			<!-- search -->
			<x-form.input
				wire:model.defer="imdb_search"
				type="search"
				placeholder="{{ __('records.entity.search_imdb_placeholder') }}"
				class="w-48 mb-0"
			/>
			<!-- search by id or title -->
			<x-form.select
				wire:model="imdb_search_type"
				class="w-48 mt-0 mb-0"
				:options="$imdb_search_type_options">
			</x-form.select>
			<!-- apply search -->
			<div class="bg-orange-400 hover:bg-orange-600 h-10 w-10 flex items-center justify-center rounded-full cursor-pointer ml-auto"
				 wire:click="searchImdb">
				<x-micon.search class="text-white" size="1.2rem" />
			</div>
		</div>
	</div>
	@if (! empty($imdb_records))
		<div class="bg-gray-50">
			<table class="w-full bg-white">
				<x-table.thead>
					<x-table.tr-thead>
						<x-table.th>{{ __('records.entity.title') }}</x-table.th>
						<x-table.th>{{ __('records.entity.imdb_id') }}</x-table.th>
						<x-table.th>{{ __('records.entity.action') }}</x-table.th>
					</x-table.tr-thead>
				</x-table.thead>
				<x-table.tbody>
					@foreach($imdb_records as $index => $record)
						<x-table.tr class="bg-white even:bg-gray-50" :key="$index . time()">
							<x-table.td>{{ $record['title'] }}</x-table.td>
							<x-table.td>{{ $record['imdb_id'] }}</x-table.td>
							<x-table.td align="center">
								<button
									type="button"
									class="button button-transparent"
									wire:click.prevent="applyImdbRecord('{{ $record['imdb_id'] }}')">
									{{ __('records.entity.apply') }}
								</button>
							</x-table.td>
						</x-table.tr>
					@endforeach
				</x-table.tbody>
			</table>
		</div>
	@endif
</div>
