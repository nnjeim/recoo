<x-form.tabs.vertical :tabs="$tabs" :activeTab="$activeTab">
	<!-- info tab -->
	<x-form.tabs.vertical.content :visibility="$activeTab === 'info'">
		<x-records.partials.edit.info />
	</x-form.tabs.vertical.content>
	<!-- status tab -->
	<x-form.tabs.vertical.content :visibility="$activeTab === 'status'">
		<x-records.partials.edit.status :record="$record" />
	</x-form.tabs.vertical.content>
</x-form.tabs.vertical>
