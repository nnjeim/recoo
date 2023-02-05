@props([
	'keyName' => 'name',
	'keyValue' => 'value',
	'options' => [],
	'placeholder' => null,
	'placeholderValue' => null,
	'isInvalid' => false,
	'isSuccess' => false,
])

<select {{ $attributes->merge(['class' => 'form__select']) }}>
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
