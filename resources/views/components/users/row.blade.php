<tr x-cloak
	x-data='usersRowData(<?php echo json_encode($rowData, JSON_HEX_APOS); ?>)'
	class="table__tr"
	x-bind:class="{
		'bg-red-600/5': row.deleted,
		'even:bg-gray-50': !row.deleted,
	}"
>
	<x-table.td>
		<div
			class="w-5 h-5 mx-auto flex items-center justify-center rounded-full cursor-pointer text-gray hover:bg-gray-200"
			x-on:click="$wire.call('toggleSelect'); row.selected = !row.selected;"
		>
			<template x-if="!row.selected">
				<x-micon.check_box_blank fill="currentColor"/>
			</template>
			<template x-if="row.selected">
				<x-micon.check_box fill="currentColor"/>
			</template>
		</div>
	</x-table.td>
	<x-table.td>
		<div class="flex items-center w-full">
			<div class="flex-shrink-0">
				<img
					class="h-10 w-10 rounded-full object-cover"
					x-bind:src="row.profile_photo_url"
					x-bind:alt="row.name"/>
			</div>
			<div class="ml-4">
				<div x-text="row.name"></div>
				<div class="text-sm" x-bind:title="row.email" x-text="row.email"></div>
			</div>
		</div>
	</x-table.td>
	<x-table.td align="center">
		<template x-if="row.email_verified">
			<div>
				<x-micon.check_circle class="inline-block align-bottom text-status-success mr-1.5"/>
				<span x-text="'{{ __('users.table.body.email_verified') }}'"></span>
			</div>
		</template>
		<template x-if="!row.email_verified">
			<div>
				<x-micon.error_outline class="inline-block align-bottom text-red-600 mr-1.5"/>
				<span x-text="'{{ __('users.table.body.email_not_verified') }}'"></span>
			</div>
		</template>
	</x-table.td>
	<x-table.td>
		<div class="flex flex-wrap gap-1 mb-1.5">
			<div x-text="'{{ __('users.table.body.last_login_at') }}'"></div>
			<div x-text="row.last_login_at"></div>
		</div>
	</x-table.td>
	<x-table.td align="center">
		<span x-text="row.roles"></span>
	</x-table.td>
	<x-table.td align="center">
		<div class="w-full flex justify-center items-center">
			<template x-if="+row.status === 1">
				<span x-text="'{{ __('users.table.body.active')  }}'"></span>
			</template>
			<template x-if="+row.status !== 1">
				<span x-text="'{{ __('users.table.body.inactive')  }}'"></span>
			</template>
		</div>
	</x-table.td>
	<x-table.td align="center" class="w-24">
		<template x-if="!row.deleted">
			<div class="flex items-center justify-center w-full gap-1">
				@can('destroy_user')
					<a class="flex items-center justify-center h-8 w-8 rounded-full bg-transparent hover:bg-gray-100"
					   x-on:click="$wire.call('destroyRecord')">
						<x-micon.delete
							class="cursor-pointer micon-hover text-red-600 hover:text-red-800"
							title="{{__('users.table.body.actions.delete')}}"/>
					</a>
				@endcan
				@can('show_user')
					<a class="flex items-center justify-center h-8 w-8 rounded-full bg-transparent hover:bg-gray-100"
					   x-on:click="$wire.call('showRecord')">
						<x-micon.edit
							class="cursor-pointer micon-hover text-gray-600 hover:text-black"
							title="{{__('users.table.body.actions.edit')}}"/>
					</a>
				@endcan
			</div>
		</template>
		<template x-if="row.deleted">
			<div class="flex items-center justify-center w-full gap-1">
				@can('destroy_user')
					<a class="flex items-center justify-center h-8 w-8 rounded-full bg-transparent hover:bg-gray-100"
					   x-on:click="$wire.call('destroyRecord')">
						<x-micon.delete
							class="cursor-pointer micon-hover text-red-600 hover:text-red-800"
							title="{{__('users.table.body.actions.delete_forever')}}"/>
					</a>
				@endcan
				@can('restore_user')
					<a class="flex items-center justify-center h-8 w-8 rounded-full bg-transparent hover:bg-gray-100"
					   x-on:click="$wire.call('restoreRecord')">
						<x-micon.restore_from_trash
							class="cursor-pointer micon-hover"
							title="{{__('users.table.body.actions.restore')}}"/>
					</a>
				@endcan
			</div>
		</template>
	</x-table.td>
</tr>
