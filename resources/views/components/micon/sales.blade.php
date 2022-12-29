@props(['size' => '1.5rem'])

<i {{ $attributes->merge(['class' => ' ']) }}>
	<svg xmlns="http://www.w3.org/2000/svg" height="{{ $size }}" width="{{ $size }}" viewBox="0 0 24 24">
		<g fill="none" fill-rule="evenodd">
			<path d="M0 0H24V24H0z" />
			<path fill="currentColor" fill-rule="nonzero" d="M19,3 C20.1,3 21,3.9 21,5 L21,5 L21,19 C21,20.1 20.1,21 19,21 L19,21 L5,21 C3.9,21 3,20.1 3,19 L3,19 L3,5 C3,3.9 3.9,3 5,3 L5,3 Z M19,5 L5,5 L5,19 L19,19 L19,5 Z M9,12 L9,17 L7,17 L7,12 L9,12 Z M17,7 L17,17 L15,17 L15,7 L17,7 Z M13,14 L13,17 L11,17 L11,14 L13,14 Z M13,10 L13,12 L11,12 L11,10 L13,10 Z" />
		</g>
	</svg>
</i>
