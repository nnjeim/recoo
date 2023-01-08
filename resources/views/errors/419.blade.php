<x-error-layout>
	<div class="flex flex-col overflow-hidden bg-cf-gray w-full h-full">
		<div class="flex flex-col justify-center space-y-2 flex-1 items-center">
			<h1 class="text-red-600 text-center font-bold text-5xl mb-2">419</h1>
			<p class="text-black mb-4">The page expired!</p>
			<a class="text-white hover:text-beige-darker" href="{{ url()->previous() }}">
				<x-micon.arrow_back class="mr-1" size="1.125rem"/>
				<span>Back</span>
			</a>
		</div>
	</div>
</x-error-layout>
