@props(['size' => '1.5rem', 'role' => 'img', 'title' => '', 'titleId' => "miconQuickEditTitle-".uniqid()])

<i {{ $attributes->merge(['class' => ' ']) }}>
	<svg class="micon" xmlns="http://www.w3.org/2000/svg" role="{{ $role }}" width="{{ $size }}" height="{{ $size }}"
		viewBox="0 0 24 24" aria-labelledby="{{ $titleId }}">
		@if(!empty($title))
			<title id="{{ $titleId }}">{{ $title }}</title>
		@endif
		<g fill="none" fill-rule="evenodd">
		<polygon points="0 0 24 0 24 24 0 24"/>
		<path fill="currentColor" fill-rule="nonzero" d="M2,0 C0.89,0 0,0.89 0,2 L0,16 C0,17.1045695 0.8954305,18 2,18 L16,18 C17.1045695,18 18,17.1045695 18,16 L18,9 L16,9 L16,16 L2,16 L2,2 L9,2 L9,0 L2,0 M14.78,1 C14.61,1 14.43,1.07 14.3,1.2 L13.08,2.41 L15.58,4.91 L16.8,3.7 C17.06,3.44 17.06,3 16.8,2.75 L15.25,1.2 C15.12,1.07 14.95,1 14.78,1 M12.37,3.12 L5,10.5 L5,13 L7.5,13 L14.87,5.62 L12.37,3.12 Z" transform="translate(3.000000, 3.000000)"/>
	  </g>
	</svg>
</i>
