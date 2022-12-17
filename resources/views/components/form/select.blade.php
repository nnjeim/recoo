@props([
	'keyName' => 'name',
	'keyValue' => 'value',
	'options' => [],
	'placeholder' => null,
	'placeholderValue' => null,
	'isInvalid' => false,
	'isSuccess' => false,
])

@php
	$class = 'border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm mt-1 block w-full';
	if ($isInvalid) {
		$class .= ' bg-red-600/5 text-red-600 ring-red-600 placeholder:text-red-600/50';
	} elseif ($isSuccess) {
		$class .= ' bg-green-600/5 text-green-600 ring-green-600 placeholder:text-green-600/50';
	}
@endphp

<select {{ $attributes->merge(['class' => $class]) }}>
	@if (!is_null($placeholder))
		<option value="{{ $placeholderValue }}">{{ $placeholder }}</option>
	@endif

	@if (!empty($options) && is_array($options))
		@foreach ($options as $option)
			<option value="{{ $option[$keyValue] ?? $option }}">{{ $option[$keyName] ?? $option }}</option>
		@endforeach
	@endif
	{{ $slot }}
</select>
