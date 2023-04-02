<x-app-layout>
	<x-slot name="title">
		{{ __('settings.roles.header.title') }}
	</x-slot>
	<x-slot name="header">
		<livewire:settings.header />
	</x-slot>
	<!-- settings -->
	<livewire:settings.roles :routeName="$routeName" />
</x-app-layout>
