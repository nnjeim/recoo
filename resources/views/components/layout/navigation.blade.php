<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
	<!-- Primary Navigation Menu -->
	<div class="w-full lg:max-w-[90%] xl:max-w-[80%] mx-auto px-4 sm:px-6 lg:px-8">
		<div class="flex justify-between h-16">
			<div class="flex">
				<!-- Logo -->
				<div class="shrink-0 flex items-center">
					<a href="{{ route('dashboard') }}" class="h-auto w-24">
						<x-layout.application-logo class="block fill-current text-gray-800"/>
					</a>
				</div>

				<!-- Navigation Links -->
				<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
					<x-navbar.link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
						{{ __('general.navbar.dashboard') }}
					</x-navbar.link>
				</div>
				<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
					<x-navbar.link :href="route('users.index')" :active="request()->routeIs('users.index')">
						{{ __('general.navbar.users') }}
					</x-navbar.link>
				</div>
				<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
					<x-navbar.link :href="route('records.index')" :active="request()->routeIs('records.index')">
						{{ __('general.navbar.records') }}
					</x-navbar.link>
				</div>
			</div>
			<!-- right menu -->
			<div class="hidden sm:flex sm:items-center sm:ml-6">
				<!-- notifications -->
				<livewire:notifications />
				<!-- Separator -->
				<div class="w-[1px] h-8 mx-4 bg-gray-100"></div>
				<!-- dropdown -->
				<x-form.dropdown align="right" width="48">
					<x-slot name="trigger">
						<button
							class="inline-flex items-center pr-3 py-2 border border-transparent leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
							<img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
								 alt="{{ Auth::user()->name }}"/>
							<div class="ml-2">{{ Auth::user()->name }}</div>

							<div class="ml-1">
								<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
									 viewBox="0 0 20 20">
									<path fill-rule="evenodd"
										  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
										  clip-rule="evenodd"/>
								</svg>
							</div>
						</button>
					</x-slot>

					<x-slot name="content">
						<x-form.dropdown-link :href="route('profile.index')">
							{{ __('general.navbar.profile') }}
						</x-form.dropdown-link>

						@can('view_settings')
							<x-form.dropdown-link :href="route('settings.index')">
								{{ __('general.navbar.settings') }}
							</x-form.dropdown-link>
						@endcan

						<!-- Authentication -->
						<form method="POST" action="{{ route('logout') }}">
							@csrf

							<x-form.dropdown-link :href="route('logout')"
												  onclick="event.preventDefault();
                                                this.closest('form').submit();">
								{{ __('general.navbar.logout') }}
							</x-form.dropdown-link>
						</form>
					</x-slot>
				</x-form.dropdown>
			</div>

			<div class="-mr-2 flex items-center sm:hidden">
				<!-- notifications -->
				<livewire:notifications />
				<!-- Hamburger -->
				<button @click="open = ! open"
						class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
					<svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
						<path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
							  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							  d="M4 6h16M4 12h16M4 18h16"/>
						<path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
							  stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
					</svg>
				</button>
			</div>
		</div>
	</div>

	<!-- Responsive Navigation Menu -->
	<div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
		<div class="pt-2 pb-3 space-y-1">
			<x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
				{{ __('general.navbar.dashboard') }}
			</x-responsive-nav-link>
		</div>

		<!-- Responsive Settings Options -->
		<div class="pt-4 pb-1 border-t border-gray-200">
			<div class="px-4">
				<div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
				<div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
			</div>

			<div class="mt-3 space-y-1">
				<x-responsive-nav-link :href="route('profile.index')">
					{{ __('general.navbar.profile') }}
				</x-responsive-nav-link>

				<!-- Authentication -->
				<form method="POST" action="{{ route('logout') }}">
					@csrf

					<x-responsive-nav-link :href="route('logout')"
										   onclick="event.preventDefault();
                                        this.closest('form').submit();">
						{{ __('general.navbar.logout') }}
					</x-responsive-nav-link>
				</form>
			</div>
		</div>
	</div>
</nav>
