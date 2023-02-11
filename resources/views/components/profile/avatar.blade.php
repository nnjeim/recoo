<!-- Profile Photo -->
<div
	x-cloak
	x-data="{
		photoName: null,
		photoPreview: null,
		uploaded: false,
		uploading: false,
		user: @entangle('user'),
		init() {
			window.addEventListener('avatar-ev', () => {
				photoPreview = null;
				uploaded = false;
			});
		}
	}"
	x-on:livewire-upload-start="uploaded = false; uploading = true"
	x-on:livewire-upload-finish="uploaded = true; uploading = false"
	class="col-span-6 sm:col-span-4"
>
	<!-- Profile Photo File Input -->
	<input
		type="file" class="hidden"
		wire:model="photo"
		x-ref="photo"
		autocomplete="off"
		x-on:change="
			photoName = $refs.photo.files[0].name;
			const reader = new FileReader();
			reader.onload = (e) => photoPreview = e.target.result;
			reader.readAsDataURL($refs.photo.files[0]);"
	/>
	<x-form.label for="photo" value="{{ __('profile.avatar.title') }}"/>
	<!-- Current Profile Photo -->
	<div class="my-2" x-show="! photoPreview">
		<template x-if="! user.profile_photo_url">
			<img
				x-bind:src="user.profile_photo_url"
				x-bind:alt="user.first_name+ ' profile image'"
				class="h-20 w-20 object-cover">
		</template>
		<template x-if="user.profile_photo_url">
			<img
				x-bind:src="user.profile_photo_url"
				x-bind:alt="user.first_name + ' profile image'"
				class="rounded-full h-20 w-20 object-cover">
		</template>
	</div>

	<!-- New Profile Photo Preview -->
	<div class="mt-2" x-show="photoPreview">
		<span
			class="block rounded-full w-20 h-20"
			x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
		</span>
	</div>

	<div>
		<!-- Select avatar button -->
		<x-form.secondary-button
			class="mt-2 mr-2 btn_sm"
			type="button"
			x-on:click.prevent="$refs.photo.click();"
		>
			<span x-show="uploading">
				<x-micon.spinner class="mr-3 h-3 w-3 text-white"/>
			</span>
			{{ __('profile.avatar.select_avatar') }}
		</x-form.secondary-button>
		<!-- Upload avatar button -->
		<x-form.secondary-button
			class="mr-2 btn_sm"
			type="button"
			x-on:click.prevent="$wire.uploadProfilePhoto()"
			x-show="uploaded"
		>
			{{ __('profile.avatar.upload_avatar') }}
		</x-form.secondary-button>
		<!-- Remove button -->
		<template x-if="user.profile_photo_path && !uploaded">
			<x-form.secondary-button
				type="button"
				class="mt-2 btn_sm"
				x-on:click="$wire.deleteProfilePhoto()"
			>
				{{ __('profile.avatar.remove_avatar') }}
			</x-form.secondary-button>
		</template>
	</div>
	<x-form.input-error for="photo" class="mt-2"/>
</div>
