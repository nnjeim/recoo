@props(['size' => '1.5rem', 'role' => 'img', 'title' => '', 'titleId' => "miconDoneTitle-".uniqid()])

<i {{ $attributes->merge(['class' => ' ']) }}>
    <svg class="micon" xmlns="http://www.w3.org/2000/svg" role="{{ $role }}" height="{{ $size }}"
		viewBox="0 0 24 24" width="{{ $size }}" fill="currentColor" aria-labelledby="{{ $titleId }}">
		@if(!empty($title))
			<title id="{{ $titleId }}">{{ $title }}</title>
		@endif
		<path d="M0 0h24v24H0V0z" fill="none"/>
        <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/>
    </svg>
</i>
