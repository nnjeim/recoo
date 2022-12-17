@props([
	'submit',
])

<div {{ $attributes->merge(['class' => 'max-w-2xl']) }}>
	@if (isset($title) || isset($description))
		<x-form.section-title>
			@if (isset($title))
				<x-slot name="title">{{ $title }}</x-slot>
			@endif

			@if (isset($description))
				<x-slot name="description">{{ $description }}</x-slot>
			@endif
		</x-form.section-title>
	@endif

	<form class="relative" wire:submit.prevent="{{ $submit }}">
		<fieldset wire:loading.attr="disabled">
			{{ $form }}
		</fieldset>

		@if (isset($actions))
			<div class="sticky bottom-0 bg-white py-5 -mx-px flex items-center justify-start mt-8">
				{{ $actions }}
			</div>
		@endif
	</form>
</div>
