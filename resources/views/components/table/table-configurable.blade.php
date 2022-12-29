<x-table.table
	{{ $attributes->merge(['class' => 'w-full']) }}
	x-data="{
		isVisible(column) {
			return this.visibleColumns.find(visibleColumn => visibleColumn.id === column) !== undefined;
		},
		visibleColumns: $wire.entangle('visibleColumns').defer,
	}"
>
	{{ $slot }}
</x-table.table>
