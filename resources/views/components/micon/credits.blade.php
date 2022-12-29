@props(['size' => '1.5rem'])

<i {{ $attributes->merge(['class' => ' ']) }}>
	<svg xmlns="http://www.w3.org/2000/svg" height="{{ $size }}" width="{{ $size }}" viewBox="0 0 24 24">
		<defs>
			<path id="a" d="M0 0 24 0 24 24 0 24z" />
		</defs>
		<g fill="none" fill-rule="evenodd">
			<use xlink:href="#a" />
			<use xlink:href="#a" />
			<path fill="currentColor" fill-rule="nonzero" d="M21,5 L23,5 L23,19 L21,19 L21,5 Z M17,5 L19,5 L19,19 L17,19 L17,5 Z M14,5 L2,5 C1.45,5 1,5.45 1,6 L1,18 C1,18.55 1.45,19 2,19 L14,19 C14.55,19 15,18.55 15,18 L15,6 C15,5.45 14.55,5 14,5 Z M13,17 L3,17 L3,7 L13,7 L13,17 Z" />
			<circle cx="8" cy="9.94" r="1.95" fill="currentColor" fill-rule="nonzero" />
			<path fill="currentColor" fill-rule="nonzero" d="M11.89,15.35 C11.89,14.05 9.3,13.4 8,13.4 C6.7,13.4 4.11,14.05 4.11,15.35 L4.11,16 L11.89,16 L11.89,15.35 Z" />
		</g>
	</svg>
</i>
