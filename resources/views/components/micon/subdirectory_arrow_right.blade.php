@props(['size' => '24'])

<i {{ $attributes->merge(['class' => '']) }}>
	<svg xmlns="http://www.w3.org/2000/svg" class="micon" width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24">
	  <g fill="none" fill-rule="evenodd" transform="translate(-392.000000, -383.000000) translate(280.000000, 111.000000) translate(0.000000, 117.000000) translate(0.000000, 142.000000) translate(112.000000, 13.000000)">
		<polygon points="18 18 0 18 0 0 18 0" opacity="0.87"/>
		<polygon fill="currentColor" fill-rule="nonzero" points="14.25 11.25 9.75 15.75 8.685 14.685 11.3775 12 3 12 3 3 4.5 3 4.5 10.5 11.3775 10.5 8.685 7.815 9.75 6.75"/>
	  </g>
	</svg>
</i>
