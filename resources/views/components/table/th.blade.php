@props(['title', 'align' => ''])

<th scope="col"
	{{
		$attributes
			->class([
				'text-center' => $align === 'center',
				'text-left' => $align !== 'center',
			])
			->merge([
				'class' => 'align-middle border border-b-3 border-b-gray-600 border-gray-200 extra-tight font-semibold px-2 py-2 text-base text-black'
			])
	}}
>
	@if (!empty($title))
		{{ $title }}
	@endif
	{{ $slot }}
</th>
