@props(['size' => '1.5rem'])

<i {{ $attributes->merge(['class' => ' ']) }}>
	<svg xmlns="http://www.w3.org/2000/svg" height="{{ $size }}" width="{{ $size }}" viewBox="0 0 24 24">
		<g fill="none" fill-rule="evenodd">
			<path d="M0 0 24 0 24 24 0 24z" />
			<path d="M0 0H24V24H0z" />
			<g fill="currentColor" fill-rule="nonzero">
				<path d="M18,0 L2,0 C1,0 0,0.9 0,2 L0,5.01 C0,5.73 0.43,6.35 1,6.7 L1,18 C1,19.1 2.1,20 3,20 L17,20 C17.9,20 19,19.1 19,18 L19,6.7 C19.57,6.35 20,5.73 20,5.01 L20,2 C20,0.9 19,0 18,0 Z M17,18 L3,18 L3,7 L17,7 L17,18 Z M18,5 L2,5 L2,2 L18,2 L18,5 Z" transform="translate(2 2)" />
				<path d="M7 10H13V12H7z" transform="translate(2 2)" />
			</g>
		</g>
	</svg>
</i>
