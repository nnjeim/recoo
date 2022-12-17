<x-error-layout>
	<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-cf-gray">
		<div class="flex flex-col overflow-hidden bg-cf-gray w-full h-full">
			<div class="flex flex-col justify-center space-y-1 flex-1 items-center">
				<h1 class="text-cf-base text-center">419</h1>
				<p class="text-beige-darker font-bold">The page expired!</p>
				<a class="text-white hover:text-beige-darker" href="{{ url()->previous() }}">
					<x-micon.arrow_back class="mr-1" size="1.125rem"/>
					<span>Back</span>
				</a>
			</div>
		</div>
	</div>
</x-error-layout>
