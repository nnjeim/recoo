<div class="flex items-center gap-4"
	 x-cloak
	 x-data="usersBulkActions()">
	<select class="border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm mt-1 block w-full m-0"
			x-model="action"
			x-on:change="onChange">
		<option value="">{{ __('users.table.action_bar.bulk_actions_title') }}</option>
		@foreach($bulkActions as $action)
			<option value="{{ $action }}">{{ __('users.table.action_bar.' . \Str::snake($action)) }}</option>
		@endforeach
	</select>
	<button class="button inverse"
			x-on:click="callAction"
			x-show="showApplyButton">
		{{ __('users.table.action_bar.apply') }}
	</button>
</div>
