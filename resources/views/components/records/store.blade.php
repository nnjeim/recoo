<x-form.tabs.vertical :tabs="$tabs" :activeTab="$activeTab">
	<!-- search tab -->
	<x-form.tabs.vertical.content :visibility="$activeTab === 'search'">
		<x-records.partials.store.search
			:imdb_search_type_options="$imdb_search_type_options"
		 	:imdb_records="$imdb_records" />
	</x-form.tabs.vertical.content>
	<!-- info tab -->
	<x-form.tabs.vertical.content :visibility="$activeTab === 'info'">
		<x-records.partials.store.info />
	</x-form.tabs.vertical.content>
</x-form.tabs.vertical>
