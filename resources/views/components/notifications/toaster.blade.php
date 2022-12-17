<div
	x-data="{
		messages: [],
		options: {
			duration: 3000,
		},
		toast(message) {
			if (!this.messages.includes(message)) {
				this.messages.push(message);
				if (this.options.duration) {
					setTimeout(() => {
						this.remove(message)
					}, this.options.duration);
				}
			}
		},
		remove(message) {
			this.messages.splice(this.messages.indexOf(message), 1)
		},
	}"
	x-init="() => {
		window.addEventListener('toast-ev', event => toast(event.detail));
	}"
	class="fixed inset-0 z-50 flex flex-col items-end justify-center px-4 pt-48 pb-6 space-y-4 sm:justify-start pointer-events-none"
	:class="{ 'hidden': !messages.length }"
>
	<template x-for="(message, messageIndex) in messages" :key="messageIndex" hidden>
		<div
			x-transition:enter="transform ease-out duration-300 transition"
			x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
			x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
			x-transition:leave="transition ease-in duration-100"
			x-transition:leave-start="opacity-100"
			x-transition:leave-end="opacity-0"
			class="w-full max-w-sm"
		>
			<div class="bg-white rounded-3 pointer-events-auto">
				<div
					class="p-2 border rounded-3"
					:class="{
						'bg-gray-200 border-black/15': !message.type || message.type === 'info',
						'bg-green-600/5 border-status-success': message.type === 'success',
						'bg-red-600/5 border-status-error': message.type === 'error',
						'text-orange-600/15 border-gold': message.type === 'warning',
					}"
				>
					<div class="flex items-center">
						<div class="flex-shrink-0">
							<svg x-show="message.type === 'success'" class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>

							<svg x-show="message.type === 'error'" class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>

							<svg x-show="message.type === 'info'" class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>

							<svg x-show="message.type === 'warning'" class="w-6 h-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
							</svg>
						</div>

						<div class="ml-2.5 flex-1">
							<template x-if="message.title">
								<p x-text="message.title" class="font-medium text-black text-md"></p>
							</template>
							<p x-text="message.message" class="text-gray"></p>
						</div>
						<div class="flex flex-shrink-0 ml-4">
							<button @click="remove(message)" class="inline-flex text-gray transition duration-150 ease-in-out focus:outline-none focus:text-black cursor-pointer">
								<svg class="w-4.5 h-4.5" viewBox="0 0 20 20" fill="currentColor">
									<path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
								</svg>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</template>
</div>
