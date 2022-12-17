@props(['title', 'align' => ''])

<td
	{{
		$attributes
			->class([
				'text-center' => $align === 'center',
				'text-right' => $align === 'right',
			])
			->merge([
				'class' => 'align-middle border border-gray-200 extra-tight px-2 py-2 text-base text-gray'
			])
	}}
>
	@if (!empty($title))
		{{ $title }}
	@endif

	{{ $slot }}
</td>
