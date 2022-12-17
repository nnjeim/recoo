@props(['size' => '1.5rem'])

<i {{ $attributes->merge(['class' => ' ']) }}>
	<svg xmlns="http://www.w3.org/2000/svg" height="{{ $size }}" width="{{ $size }}" viewBox="0 0 24 24">
		<g fill="none" fill-rule="evenodd">
			<path d="M0 0 24 0 24 24 0 24z" />
			<path d="M0 0H24V24H0z" />
			<g fill="currentColor" fill-rule="nonzero">
				<path d="M18,0 L2,0 C0.9,0 0,0.9 0,2 L0,16 C0,17.1 0.9,18 2,18 L18,18 C19.1,18 20,17.1 20,16 L20,2 C20,0.9 19.1,0 18,0 Z M18,16 L2,16 L2,2 L18,2 L18,16 Z" transform="translate(2 3)" />
				<path d="M17.41 7.42 15.99 6 12.82 9.17 11.41 7.75 10 9.16 12.82 12z" transform="translate(2 3)" />
				<path d="M3 4H8V6H3z" transform="translate(2 3)" />
				<path d="M3 8H8V10H3z" transform="translate(2 3)" />
				<path d="M3 12H8V14H3z" transform="translate(2 3)" />
			</g>
		</g>
	</svg>
</i>
