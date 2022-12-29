@props(['size' => '1.5rem'])

<i {{ $attributes->merge(['class' => ' ']) }}>
	<svg xmlns="http://www.w3.org/2000/svg" height="{{ $size }}" width="{{ $size }}" viewBox="0 0 24 24">
		<defs>
			<path id="a" d="M0 0 24 0 24 24 0 24z" />
		</defs>
		<g fill="none" fill-rule="evenodd">
			<use xlink:href="#a" />
			<use xlink:href="#a" />
			<path fill="currentColor" fill-rule="nonzero" d="M12,7 L12,3 L2,3 L2,21 L22,21 L22,7 L12,7 Z M6,19 L4,19 L4,17 L6,17 L6,19 Z M6,15 L4,15 L4,13 L6,13 L6,15 Z M6,11 L4,11 L4,9 L6,9 L6,11 Z M6,7 L4,7 L4,5 L6,5 L6,7 Z M10,19 L8,19 L8,17 L10,17 L10,19 Z M10,15 L8,15 L8,13 L10,13 L10,15 Z M10,11 L8,11 L8,9 L10,9 L10,11 Z M10,7 L8,7 L8,5 L10,5 L10,7 Z M20,19 L12,19 L12,17 L14,17 L14,15 L12,15 L12,13 L14,13 L14,11 L12,11 L12,9 L20,9 L20,19 Z M18,11 L16,11 L16,13 L18,13 L18,11 Z M18,15 L16,15 L16,17 L18,17 L18,15 Z" />
		</g>
	</svg>
</i>
