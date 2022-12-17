<x-form.tabs.vertical :tabs="$tabs" :activeTab="$activeTab">
	<!-- info tab -->
	<x-form.tabs.vertical.content :visibility="$activeTab === 'info'">
		<x-users.partials.edit.info />
	</x-form.tabs.vertical.content>
	<!-- status tab -->
	<x-form.tabs.vertical.content :visibility="$activeTab === 'status'">
		<x-users.partials.edit.status :user="$user" />
	</x-form.tabs.vertical.content>
</x-form.tabs.vertical>
