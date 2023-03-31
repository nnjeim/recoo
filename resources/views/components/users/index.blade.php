<div class="w-full">
	<div class="flex items-center mb-4 w-full">
		<!-- dropdown -->
		<x-form.dropdown align="left">
			<x-slot name="trigger">
				<button
					class="flex items-center justify-center mx-2.5 cursor-pointer transition text-gray-300 hover:text-black focus:text-black">
					<x-micon.more_vert/>
				</button>
			</x-slot>

			<x-slot name="content">
				<x-form.dropdown-link wire:click="selectAllRecords">
					{{ __('users.table.action_bar.select_all_records') }}
				</x-form.dropdown-link>
				<x-form.dropdown-link wire:click="unselectAllRecords">
					{{ __('users.table.action_bar.unselect_all_records') }}
				</x-form.dropdown-link>
			</x-slot>
		</x-form.dropdown>
		<!-- search -->
		<div>
			<x-form.input
				wire:model.debounce.500ms="filters.search"
				type="search"
				placeholder="{{ __('users.table.action_bar.search_placeholder') }}"
				class="w-full mb-0"
			/>
		</div>
		<div class="h-8 w-[1px] bg-gray-300 mx-4"></div>
		<!-- init state -->
		<button class="text-orange-600 hover:text-orange-800 focus:text-black" wire:click="initState" title="refresh">
			<x-micon.settings_backup_restore/>
		</button>
		<div class="h-8 w-[1px] bg-gray-300 mx-4"></div>
		<!-- deleted records -->
		@if($showDeleted)
			<div>
				<x-form.secondary-button class="text" wire:click="$toggle('filters.deleted')"
										 wire:loading.class="loading">
					{{ trans('users.table.action_bar.' . (!empty($filters['deleted']) ? 'hide_deleted' : 'show_deleted')) }}
				</x-form.secondary-button>
			</div>
		@endif
		<!-- right side bar -->
		<div class="flex items-center ml-auto">
			<div class="flex items-center">
				<span class="mr-2 text-sm">{{ __('users.table.action_bar.show') }}</span>
				<x-form.select
					wire:model="perPage"
					:options="$perPageOptions"
					class="mb-0"
				/>
			</div>
			@can('store_user')
				<div class="h-8 w-[1px] bg-gray-300 mx-4"></div>
				<a href="{{ route('users.store') }}"
				   class="form__btn_transparent">
					<x-micon.add size="1.5rem"/>
					<span>{{ __('users.table.action_bar.user') }}</span>
				</a>
			@endcan
		</div>
	</div>
	<!-- table -->
	<x-table.table>
		<x-table.thead>
			<x-table.tr-thead>
				<x-table.th-toggle-all :checked="count($selectedRecords) > 0"/>
				<x-table.th-sortable
					title="{{ __('users.table.headers.name') }}"
					sortField="name"
					:sortBy="$sortBy"
					:sortDirection="$sortDirection"
				/>
				<x-table.th-sortable
					title="{{ __('users.table.headers.email_verified') }}"
					align="center"
					sortField="email_verified_at"
					:sortBy="$sortBy"
					:sortDirection="$sortDirection"
				/>
				<x-table.th title="{{ __('users.table.headers.login_status') }}"/>
				<x-table.th-sortable
					title="{{ __('users.table.headers.roles') }}"
					align="center"
					sortField="role"
					:sortBy="$sortBy"
					:sortDirection="$sortDirection"
				/>
				<x-table.th-sortable
					title="{{ __('users.table.headers.status') }}"
					align="center"
					sortField="status"
					:sortBy="$sortBy"
					:sortDirection="$sortDirection"
				/>
				<x-table.th
					class="w-24"
					title="{{ __('users.table.headers.actions') }}"
					align="center"/>
			</x-table.tr-thead>
		</x-table.thead>
		<x-table.tbody>
			@foreach($data as $user)
				<livewire:users.row :rowData="$user" :key="time().$user['id']"/>
			@endforeach
		</x-table.tbody>
	</x-table.table>
	<!-- table footer -->
	<x-table.footer :paginator="$paginator" :selectedRecords="$selectedRecords">
		<x-users.partials.index.bulkActions :bulk-actions="$bulkActions"/>
	</x-table.footer>
	<!-- user delete confirmation -->
	<x-form.confirmation-modal wire:model="confirmingRecordDeletion">
		<x-slot name="title">
			{{ trans_choice('users.modal.delete_record_title', count($selectedRecords), ['attribute' => trans_choice('users.attributes.user', count($selectedRecords))]) }}
		</x-slot>

		<x-slot name="content">
			{{ trans_choice('users.modal.delete_record_content', count($selectedRecords), ['attribute' => trans_choice('users.attributes.user', count($selectedRecords))]) }}
		</x-slot>

		<x-slot name="footer">
			<x-form.secondary-button wire:click="$set('confirmingRecordDeletion', false)" wire:loading.attr="disabled">
				{{ __('users.modal.delete_record_cancel') }}
			</x-form.secondary-button>

			<x-form.danger-button class="ml-2" wire:click="destroyRecords" wire:loading.attr="disabled">
				{{ __('users.modal.delete_record_confirm') }}
			</x-form.danger-button>
		</x-slot>
	</x-form.confirmation-modal>
</div>
