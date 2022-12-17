@props([
    'route' => 'dashboard',
    'name' => '',
])

<div {{ $attributes->merge(['class' => '-mx-4 -mt-11.5 pl-6 pr-4 py-4']) }}>
	<a href="{{ route($route) }}" class="flex items-center text-orange-600 hover:text-orange-800 font-semibold">
		<x-micon.chevron_left />
		<span>{{ __('general.navbar.back_to') }} {{ $name }}</span>
	</a>
</div>
