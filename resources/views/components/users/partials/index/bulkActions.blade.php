@php

@endphp
<div class="flex items-center gap-4"
	 x-cloak
	 x-data="usersBulkActions()">
	<select class="form__select"
			x-model="action"
			x-on:change="onChange">
		<option value="">{{ __('users.table.action_bar.bulk_actions_title') }}</option>
		@foreach($bulkActions as $action)
			<option value="{{ $action }}">{{ __('users.table.action_bar.' . \Str::snake($action)) }}</option>
		@endforeach
	</select>
	<button class="form__btn_primary"
			x-on:click="callAction"
			x-show="showApplyButton">
		{{ __('users.table.action_bar.apply') }}
	</button>
</div>
