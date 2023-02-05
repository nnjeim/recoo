@props(['text' => __('general.entity.save')])

<button {{ $attributes->merge(['type' => 'submit', 'class' => 'form__btn_primary']) }}
		wire:loading.attr="disabled">
	<x-micon.spinner size="1rem" class="mr-2" wire:loading />
	<span>{{ $text }}</span>
</button>
