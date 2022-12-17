@props(['size' => '1.5rem', 'role' => 'img', 'title' => '', 'titleId' => "miconAddTitle-".uniqid()])

<i {{ $attributes->merge(['class' => ' ']) }}>
    <svg class="micon" xmlns="http://www.w3.org/2000/svg" role="{{ $role }}" height="{{ $size }}"
		viewBox="0 0 24 24" width="{{ $size }}" fill="currentColor" aria-labelledby="{{ $titleId }}">
        @if(!empty($title))
			<title id="{{ $titleId }}">{{ $title }}</title>
		@endif
		<path d="M0 0h24v24H0V0z" fill="none"/>
        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
    </svg>
</i>
