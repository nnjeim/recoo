<section>
	<x-form.form-section submit="updateUser">
		<x-slot name="form">
			<!-- profile avatar -->
			<x-profile.avatar />
			<x-form.input-error for="upload" class="mt-2"/>

			<div class="space-y-6 mt-6">
				<div>
					<x-form.label for="name" :value="__('profile.information.name')" />
					<x-form.input
						id="name"
						type="text"
						class="mt-1 block w-full"
						wire:model.defer="user.name"
						required
						autofocus
						autocomplete="name" />
					<x-form.input-error for="user.name" />
				</div>

				<div>
					<x-form.label for="email" :value="__('profile.information.email')" />
					<x-form.input
						id="email"
						type="email"
						class="mt-1 block w-full"
						wire:model.defer="user.email"
						required
						autocomplete="email" />
					<x-form.input-error for="user.email" />

						@if(isset($user) && $user['email_verified_at'] === null)
						<div>
							<p class="text-sm mt-2 text-gray-800">
								{{ __('profile.information.email_not_verified_message') }}

								<button type="button"
										class="underline text-sm text-red-600 hover:text-red-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
										wire:click.prevent="sendEmailVerification">
									{{ __('profile.information.resend_email_verification_message') }}
								</button>
							</p>

							@if (session('status') === 'verification-link-sent')
								<p class="mt-2 font-medium text-sm text-green-600">
									{{ __('profile.information.resent_email_verfication_status') }}
								</p>
							@endif
						</div>
						@endif
				</div>

				<div class="flex items-center gap-4">
					<x-form.action-message class="mr-3" on="saved">
						{{ __('users.entity.save_message') }}
					</x-form.action-message>
					<x-form.submit-button />
				</div>
			</div>
		</x-slot>
	</x-form.form-section>
</section>
