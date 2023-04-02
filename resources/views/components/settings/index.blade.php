<x-form.tabs.vertical :tabs="$tabs" :activeTab="$activeTab">
	<!-- info tab -->
	<x-form.tabs.vertical.content :visibility="$activeTab === 'info'">
		<x-settings.partials.info />
	</x-form.tabs.vertical.content>
</x-form.tabs.vertical>
