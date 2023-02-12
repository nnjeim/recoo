<tr x-cloak
	x-data='recordsRowData(<?php echo json_encode($rowData, JSON_HEX_APOS); ?>)'
	class="table__tr"
	x-bind:class="{
		'bg-red-600/5': row.deleted,
		'even:bg-gray-50': !row.deleted,
	}">
	<x-table.td>
		<div
			class="w-5 h-5 mx-auto flex items-center justify-center rounded-full cursor-pointer text-gray hover:bg-gray-200"
			x-on:click="$wire.call('toggleSelect'); row.selected = !row.selected;"
		>
			<template x-if="!row.selected">
				<x-micon.check_box_blank fill="currentColor" />
			</template>
			<template x-if="row.selected">
				<x-micon.check_box fill="currentColor" />
			</template>
		</div>
	</x-table.td>
	<x-table.td>
		<div class="flex items-center w-full">
			<div class="flex-shrink-0">
				<img class="h-10 w-10 object-cover" x-bind:src="row.poster" x-bind:alt="row.title" />
			</div>
			<div class="ml-4 whitespace-nowrap max-w-[100px] xl:max-w-[200px] overflow-hidden text-ellipsis">
				<a href="{{ rtrim(config('constants.imdb_hyperlink')) . DIRECTORY_SEPARATOR . $rowData['imdb_id'] }}"
				   target="_blank"
				   class="underline decoration-2 decoration-blue-200 hover:text-blue-700"
				   x-text="row.title">
				</a>
			</div>
		</div>
	</x-table.td>
	<x-table.td align="center">
		<div x-text="row.year"></div>
	</x-table.td>
	<x-table.td>
		<div x-text="row.imdb_id"></div>
	</x-table.td>
	<x-table.td>
		<div class="whitespace-nowrap max-w-[150px] xl:max-w-[250px] xl:max-w-[400px] 2xl:max-w-[500px] overflow-hidden text-ellipsis">
			<a x-bind:href="row.poster" target="_blank">
				<span class="underline decoration-2 decoration-blue-200 hover:text-blue-700" x-text="row.poster"></span>
			</a>
		</div>
	</x-table.td>
	<x-table.td>
		<div class="whitespace-nowrap" x-text="row.user_name"></div>
	</x-table.td>
	<x-table.td align="center" class="w-24">
		<template x-if="!row.deleted">
			<div class="flex items-center justify-center w-full gap-1">
				@can('destroy_record')
				<a class="flex items-center justify-center h-8 w-8 rounded-full bg-transparent hover:bg-gray-100"
				   x-on:click="$wire.call('destroyRecord')">
					<x-micon.delete class="cursor-pointer micon-hover text-red-600 hover:text-red-800"
									title="{{__('records.table.body.actions.delete')}}" />
				</a>
				@endcan
				@can('show_record')
				<a class="flex items-center justify-center h-8 w-8 rounded-full bg-transparent hover:bg-gray-100"
				   x-on:click="$wire.call('showRecord')">
					<x-micon.edit class="cursor-pointer micon-hover text-gray-600 hover:text-black"
						title="{{__('records.table.body.actions.edit')}}" />
				</a>
				@endcan
			</div>
		</template>
		<template x-if="row.deleted">
			<div class="flex items-center justify-center w-full gap-2">
				@can('destroy_record')
				<a class="flex items-center justify-center h-8 w-8 rounded-full bg-transparent hover:bg-gray-100"
				   x-on:click="$wire.call('destroyRecord')">
					<x-micon.delete class="cursor-pointer micon-hover text-red-600 hover:text-red-800"
						title="{{__('records.table.body.actions.delete_forever')}}" />
				</a>
				@endcan
				@can('restore_record')
				<a class="flex items-center justify-center h-8 w-8 rounded-full bg-transparent hover:bg-gray-100"
				   x-on:click="$wire.call('restoreRecord')">
					<x-micon.restore_from_trash class="cursor-pointer micon-hover"
						title="{{__('records.table.body.actions.restore')}}" />
				</a>
				@endcan
			</div>
		</template>
	</x-table.td>
</tr>
