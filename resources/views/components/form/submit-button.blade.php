@props(['text' => __('general.entity.save')])

<button {{ $attributes->merge(['type' => 'submit', 'class' => 'button button-primary']) }}
		wire:loading.attr="disabled">
	<span>{{ $text }}</span>
	<x-micon.spinner size="1rem" class="ml-2" wire:loading />
</button>
