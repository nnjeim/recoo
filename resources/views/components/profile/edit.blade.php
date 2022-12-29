<section>
	<form id="send-verification" method="post" action="{{ route('verification.send') }}">
		@csrf
	</form>

	<x-form.form-section submit="updateUser">
		<x-slot name="title">
			{{ __('Profile Information') }}
		</x-slot>

		<x-slot name="description">
			{{ __('Update your account\'s profile information and email address.') }}
		</x-slot>

		<x-slot name="form">
			<div class="space-y-6 mt-6">
				<div>
					<x-form.label for="name" :value="__('Name')" />
					<x-form.input id="name" type="text" class="mt-1 block w-full" wire:model.defer="user.name" required autofocus autocomplete="name" />
					<x-form.input-error for="user.name" />
				</div>

				<div>
					<x-form.label for="email" :value="__('Email')" />
					<x-form.input id="email" type="email" class="mt-1 block w-full" wire:model.defer="user.email" required autocomplete="email" />
					<x-form.input-error for="user.email" />

					@if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
						<div>
							<p class="text-sm mt-2 text-gray-800">
								{{ __('Your email address is unverified.') }}

								<button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
									{{ __('Click here to re-send the verification email.') }}
								</button>
							</p>

							@if (session('status') === 'verification-link-sent')
								<p class="mt-2 font-medium text-sm text-green-600">
									{{ __('A new verification link has been sent to your email address.') }}
								</p>
							@endif
						</div>
					@endif
				</div>

				<div class="flex items-center gap-4">
					<x-form.primary-button>{{ __('Save') }}</x-form.primary-button>

					@if (session('status') === 'profile-updated')
						<p
							x-data="{ show: true }"
							x-show="show"
							x-transition
							x-init="setTimeout(() => show = false, 2000)"
							class="text-sm text-gray-600"
						>{{ __('Saved.') }}</p>
					@endif
				</div>
			</div>
		</x-slot>
	</x-form.form-section>
</section>
