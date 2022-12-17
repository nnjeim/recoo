<x-error-layout>
	<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-cf-gray">
		<div class="flex flex-col overflow-hidden bg-cf-gray w-full h-full">
			<div class="flex flex-col justify-center space-y-1 flex-1 items-center">
				<h1 class="text-cf-base text-center">401</h1>
				<p class="text-beige-darker font-bold">Access denied!</p>
				<a class="text-white hover:text-beige-darker" href="{{ route('login') }}">
					<x-micon.login class="mr-1" size="1.125rem"/>
					<span>Login</span>
				</a>
			</div>
		</div>
	</div>
</x-error-layout>
