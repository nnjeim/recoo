@props(['size' => '1.5rem'])

<i {{ $attributes->merge(['class' => ' ']) }}>
	<svg xmlns="http://www.w3.org/2000/svg" height="{{ $size }}" width="{{ $size }}" viewBox="0 0 24 24">
		<g fill="none" fill-rule="evenodd">
			<path d="M0 0H24V24H0z" />
			<path fill="currentColor" fill-rule="nonzero" d="M3,3 L3,11 L11,11 L11,3 L3,3 Z M9,9 L5,9 L5,5 L9,5 L9,9 Z M3,13 L3,21 L11,21 L11,13 L3,13 Z M9,19 L5,19 L5,15 L9,15 L9,19 Z M13,3 L13,11 L21,11 L21,3 L13,3 Z M19,9 L15,9 L15,5 L19,5 L19,9 Z M13,13 L13,21 L21,21 L21,13 L13,13 Z M19,19 L15,19 L15,15 L19,15 L19,19 Z" />
		</g>
	</svg>
</i>
