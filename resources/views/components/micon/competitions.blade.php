@props(['size' => '1.5rem'])

<i {{ $attributes->merge(['class' => ' ']) }}>
	<svg xmlns="http://www.w3.org/2000/svg" height="{{ $size }}" width="{{ $size }}" viewBox="0 0 24 24">
		<g fill="none" fill-rule="evenodd">
			<path d="M0 0 24 0 24 24 0 24z" />
			<path d="M0 0H24V24H0z" />
			<path fill="currentColor" fill-rule="nonzero" d="M16,11 L16,3 L8,3 L8,9 L2,9 L2,21 L22,21 L22,11 L16,11 Z M10,5 L14,5 L14,19 L10,19 L10,5 Z M4,11 L8,11 L8,19 L4,19 L4,11 Z M20,19 L16,19 L16,13 L20,13 L20,19 Z" />
		</g>
	</svg>
</i>
