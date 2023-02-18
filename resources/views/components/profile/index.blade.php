<x-form.tabs.vertical :tabs="$tabs" :activeTab="$activeTab">
	<!-- profile edit tab -->
	<x-form.tabs.vertical.content :visibility="$activeTab === 'info'">
		<livewire:profile.edit />
	</x-form.tabs.vertical.content>
	<!-- password tab -->
	<x-form.tabs.vertical.content :visibility="$activeTab === 'password'">
		<livewire:profile.password-update />
	</x-form.tabs.vertical.content>
	<!-- options -->
	<x-form.tabs.vertical.content :visibility="$activeTab === 'options'">
		<livewire:profile.options />
	</x-form.tabs.vertical.content>
	<!-- delete user -->
	<x-form.tabs.vertical.content :visibility="$activeTab === 'delete'">
		<livewire:profile.delete-user />
	</x-form.tabs.vertical.content>
</x-form.tabs.vertical>
