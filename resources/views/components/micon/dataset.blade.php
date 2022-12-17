@props(['size' => '1.5rem'])

<i {{ $attributes->merge(['class' => ' ']) }}>
	<svg class="micon" xmlns="http://www.w3.org/2000/svg" height="{{ $size }}" viewBox="0 0 24 24" width="{{ $size }}" fill="currentColor">
		<path d="M7 13h4v4H7zm6 0h4v4h-4z"/>
		<path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14z"/>
		<path d="M7 7h4v4H7zm6 0h4v4h-4z"/>
    </svg>
</i>
