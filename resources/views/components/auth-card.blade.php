<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="flex flex-col w-full sm:max-w-md mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg">
		<div class="flex items-center justify-center w-full mb-6">
			{{ $logo }}
		</div>
		<div class="w-full">
        	{{ $slot }}
		</div>
    </div>
</div>
