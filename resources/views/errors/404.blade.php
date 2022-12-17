<x-error-layout>
	<div class="flex flex-col overflow-hidden bg-cf-gray w-full h-full">
		<div class="flex flex-col justify-center space-y-2 flex-1 items-center">
			<h1 class="text-red-600 text-center font-bold text-5xl mb-2">404</h1>
			<p class="text-black mb-4">{{ $message ?? '' }}</p>
			<a class="text-black hover:text-beige-darker" href="{{ route('dashboard') }}">
				<x-micon.arrow_back class="mr-1" size="1.125rem" />
				<span>Dashboard</span>
			</a>
		</div>
	</div>
</x-error-layout>
