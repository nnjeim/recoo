<?php

namespace App\Actions\User\Transformers;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

trait PaginateTransformer
{
	/**
	 * @param  User  $user
	 */
	protected function transform(User $user): Collection
	{
		return collect($user)
			->except(['password', 'created_at', 'updated_at', 'deleted_at'])
			->merge([
				'email_verified' => $user->email_verified_at !== null,
				'profile_photo_url' => $this->defaultProfilePhotoUrl($user),
				'deleted' => $user->deleted_at !== null,
			]);
	}

	/**
	 * @param  User  $user
	 * @return string
	 */
	protected function getProfilePhotoUrl(User $user): string
	{
		$avatarStorageOptions = Arr::get($this->getModuleOptions(), 'profile.avatar.storage');

		['disk' => $disk, 'folder' => $folder] = $avatarStorageOptions;

		$avatarFolder = trim($folder, DIRECTORY_SEPARATOR);

		return $user->profile_photo_path
			? Storage::disk($disk)->url($avatarFolder . DIRECTORY_SEPARATOR . $user->profile_photo_path)
			: $this->defaultProfilePhotoUrl($user);
	}

	/**
	 * @param $user
	 * @return string
	 */
	protected function defaultProfilePhotoUrl($user): string
	{
		return 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&color=444444&background=EFECE9';
	}
}
