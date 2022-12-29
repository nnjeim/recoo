@props([
	'visibility' => true,
])

<div {{ $attributes->merge(['class' => $visibility ? '' : ' hidden']) }}>
	{{ $slot }}
</div>
