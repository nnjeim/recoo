@props(['paginator', 'selectedRecords'])

<div {{ $attributes->merge(['class' => 'flex items-center justify-between flex-wrap mt-4']) }}>
	<div class="flex items-center basis-2/5 mb-4">
		@if($slot->isNotEmpty())
			<div class="mr-4">
				{{ $slot }}
			</div>
		@endif
		<div x-bind:class="{ 'hidden lg:block': !{{ count($selectedRecords) }} }">
			@if(!empty($selectedRecords))
				{{ trans_choice('general.table.selected_records', count($selectedRecords), ['count' => count($selectedRecords)]) }}
			@endif
		</div>
	</div>
	<div class="text-center basis-1/5 mb-4">
		@if($paginator->total() > 0)
			<p>
				{!! __('pagination.showing', ['firstItem' => $paginator->firstItem(), 'lastItem' => $paginator->lastItem(), 'total' => $paginator->total() ]) !!}
			</p>
		@else
			<p class="p-3 text-sm text-red-600">
				<span class="mr-1">
					<x-micon.warning size="1.2rem"/>
				</span>
				{{ __('general.table.no_records') }}
			</p>
		@endif
	</div>
	<div class="basis-2/5 mb-4">
		{{ $paginator->onEachSide(1)->links() }}
	</div>
</div>
