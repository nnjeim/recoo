@props(['size' => '1.5rem'])

<i {{ $attributes->merge(['class' => ' ']) }}>
	<svg xmlns="http://www.w3.org/2000/svg" height="{{ $size }}" width="{{ $size }}" viewBox="0 0 24 24">
		<defs>
			<path id="a" d="M0 0 24 0 24 24 0 24z" />
		</defs>
		<g fill="none" fill-rule="evenodd">
			<use xlink:href="#a" />
			<use xlink:href="#a" />
			<path fill="currentColor" fill-rule="nonzero" d="M21,3 L3,3 C1.9,3 1,3.9 1,5 L1,17 C1,18.1 1.9,19 3,19 L8,19 L8,21 L16,21 L16,19 L21,19 C22.1,19 23,18.1 23,17 L23,5 C23,3.9 22.1,3 21,3 Z M21,17 L3,17 L3,5 L21,5 L21,17 Z M19,8 L8,8 L8,10 L19,10 L19,8 Z M19,12 L8,12 L8,14 L19,14 L19,12 Z M7,8 L5,8 L5,10 L7,10 L7,8 Z M7,12 L5,12 L5,14 L7,14 L7,12 Z" />
		</g>
	</svg>
</i>
