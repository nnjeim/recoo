@props([
	'align' => '',
	'sortBy',
	'sortDirection',
	'sortField',
	'title',
])

<x-table.th {{ $attributes->merge(['class' => 'cursor-pointer']) }} wire:click="sortBy('{{ $sortField }}')">
	<div class="flex justify-between">
		<div @class(['mx-auto' => $align === 'center'])>
			@if (!empty($title))
				{{ $title }}
			@endif

			{{ $slot }}
		</div>

		@if ($sortBy === $sortField)
			@if ($sortDirection === 'desc')
				<x-micon.expand_more />
			@else
				<x-micon.expand_less />
			@endif
		@else
			<x-micon.unfold_more />
		@endif
	</div>
</x-table.th>
