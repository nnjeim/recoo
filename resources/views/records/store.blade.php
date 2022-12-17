<x-app-layout>
	<x-slot name="header">
		<div class="flex items-center justify-between w-full">
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				{{ __('records.header.store_title') }}
			</h2>
			<x-form.back route="records.index" name="{{ __('records.header.title') }}" />
		</div>
	</x-slot>

	<div class="py-12">
		<div class="w-full lg:max-w-[90%] xl:max-w-[80%] mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 text-gray-900">
					<livewire:records.store />
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
