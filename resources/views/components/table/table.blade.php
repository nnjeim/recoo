<div class="overflow-x-auto lg:overflow-visible min-w-full divide-y divide-gray-200">
	<table {{ $attributes->merge(['class' => 'w-full']) }}>
		{{ $slot }}
	</table>
</div>
