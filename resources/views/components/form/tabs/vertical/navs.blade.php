@if(count($tabs))
	<ul class="flex flex-nowrap xl:block gap-4 xl:sticky xl:top-8">
		@foreach($tabs as $tab)
			@php
				$buttonClass = $tab['slug'] === $activeTab ?
					($tab['error'] ? 'text-red-600 before:bg-red-600' : 'text-black before:bg-orange-600') :
					($tab['error'] ? 'text-red-600' : 'text-gray');
				$iconClass = $tab['slug'] === $activeTab ?
					($tab['error'] ? 'text-red-600' : 'text-orange-600') :
					($tab['error'] ? 'text-red-600' : 'text-black/15');
				$icon = 'micon.' . $tab['icon'] ?: 'dashboard';

				$mobileButtonClass = $tab['slug'] === $activeTab ? 'border-orange-600': '';
			@endphp
			<li
				@class([
					'group mb-1.25 last:mb-0 grow',
					'hidden' => isset($tab['visible']) && ! $tab['visible'],
				])
			>
				<div class="relative">
					<button
						class="hidden xl:flex gap-x-2.5 justify-center items-center text-left px-4 py-4 hover:text-black hover:before:bg-gray-300 before:absolute before:h-full before:-left-px before:rounded-r-1 before:w-1 {{ $buttonClass }}"
						wire:click="$set('activeTab', '{{ $tab['slug'] }}')"
					>
						<div>
							<x-dynamic-component :component="$icon" class="{{$iconClass}} group-hover:text-gray-400" size="24" />
						</div>
						<div class="flex flex-col">
							<span class="font-semibold">{{ $tab['title'] }}</span>
							<span>{{ $tab['description'] }}</span>
						</div>
					</button>
					<button
						class="xl:hidden w-full text-black text-left font-semibold border-t-3 border-black/15 py-2 {{ $mobileButtonClass }}"
						wire:click="$set('activeTab', '{{ $tab['slug'] }}')"
					>
						{{ $tab['title'] }}
					</button>
				</div>
			</li>
		@endforeach
	</ul>
@endif
