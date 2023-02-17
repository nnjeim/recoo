<div
	x-data="{
		notifications: @entangle('notifications'),
		count: 0,
		countUnread() {
			const totalCount = this
				.notifications
				.reduce((count, notification) => count += !notification.read_at ? 1 : 0, 0);
			this.count = totalCount;
		},
		init() {
			this.countUnread();
			$watch('notifications', () => this.countUnread());
		}
	}"
	class="relative flex items-center"
>
	<x-form.dropdown align="right" width="w-64">
		<x-slot name="trigger">
			<div
				class="cursor-pointer text-gray-600"
				title="notifications">
				<x-micon.notifications title="{{ __('notifications.title') }}" />
				<span class="absolute right-0 top-0 -translate-y-1/2 translate-x-1/2 flex items-center justify-center text-xs h-4 w-4 bg-gold text-black rounded-full" x-text="count"></span>
			</div>
		</x-slot>
		<x-slot name="content">
			<div class="-mt-1 -mb-1 text-gray">
				<div class="max-h-72 overflow-hidden">
					<ul class="max-h-72 overflow-auto p-2">
						<template x-if="notifications.length > 0">
							<template x-for="notification in notifications">
								<li
									class="flex flex-col border-b border-gray-200 last:border-b-0 p-1 mb-1"
									x-on:click.once="$wire.call('markNotificationAsRead', notification.id)">
									<div class="flex items-center justify-between">
										<div
											class="text-xs text-gray-600"
											x-bind:class="{'font-bold': !notification.read_at}"
											x-text="notification.data.title"></div>
										<div class="action">
											<template x-if="notification.data.click_action">
												<a x-bind:href="notification.data.click_action">
													<x-micon.link size="0.875rem" />
												</a>
											</template>
											<span class="cursor-pointer">
											<x-micon.delete
												size="0.875rem"
												x-on:click.once="$wire.call('destroyNotification', notification.id)" />
										</span>
										</div>
									</div>
									<div class="text-xs text-wrap" x-text="notification.data.body"></div>
									<div class="text-xs text-gray-400" x-text="notification.created_at"></div>
								</li>
							</template>
						</template>
						<template x-if="notifications.length === 0">
							<li class="text-sm text-red-500 text-center">
								<span>{{ __('notifications.no_records') }}</span>
							</li>
						</template>
					</ul>
				</div>
				<div
					class="p-2 mt-2 text-sm text-center bg-gray-100 cursor-pointer hover:bg-gray-200"
					x-on:click.once="$wire.call('markNotificationAsRead', null, 'all')"
					x-show="count > 0">
					<span>{{ __('notifications.mark_all_as_read') }}</span>
					<x-micon.done_all size="1rem" class="ml-2 text-green-600" />
				</div>
			</div>
		</x-slot>
	</x-form.dropdown>
</div>
