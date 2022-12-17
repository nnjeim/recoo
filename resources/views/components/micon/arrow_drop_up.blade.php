@props(['size' => '1.5rem'])

<i {{ $attributes->merge(['class' => ' ']) }}>
	<svg class="micon" xmlns="http://www.w3.org/2000/svg" height="{{ $size }}" viewBox="0 0 24 24" width="{{ $size }}" fill="currentColor">
		<path d="M0 0h24v24H0V0z" fill="none"/>
		<path d="M7 14l5-5 5 5H7z"/>
    </svg>
</i>
