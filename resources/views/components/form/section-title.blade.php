<div class="flex justify-between">
	<div>
		@if (isset($title))
			<h2 class="text-lg font-medium text-gray-900">
				{{ $title }}
			</h2>
		@endif

		@if (isset($description))
			<p class="mt-1 text-sm text-gray-600">
				{{ $description }}
			</p>
		@endif
	</div>

	@if (isset($aside))
		<div class="px-4">
			{{ $aside }}
		</div>
	@endif
</div>
