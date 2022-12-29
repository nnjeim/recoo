@props([
	'toggleOnLabel' => null,
	'toggleOffLabel' => null,
])

<div x-cloak x-data="{value: @entangle($attributes->wire('model'))}" x-on:click="value = +value === 1 ? 0 : 1">
	<template x-if="+value === 1">
		<div class="flex items-center">
			<x-micon.toggle_on />
			@if (! empty($toggleOnLabel))
			<span class="ml-2">{{ $toggleOnLabel }}</span>
			@endif
		</div>
	</template>
	<template x-if="+value !== 1">
		<div class="flex items-center">
			<x-micon.toggle_off />
			@if (! empty($toggleOffLabel))
			<span class="ml-2">{{ $toggleOffLabel }}</span>
			@endif
		</div>
	</template>
</div>
