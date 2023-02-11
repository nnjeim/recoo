<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Storage;

trait HasProfilePhoto
{
	/**
	 * Get the URL to the user's profile photo.
	 *
	 * @return string
	 */
	public function getProfilePhotoUrlAttribute(): string
	{
		return $this->profile_photo_path ? Storage::disk('public')->url($this->profile_photo_path) : $this->defaultProfilePhotoUrl();
	}

	/**
	 * Get the default profile photo URL if no profile photo has been uploaded.
	 *
	 * @return string
	 */
	protected function defaultProfilePhotoUrl(): string
	{
		$name = trim(collect(explode(' ', $this->name))
			->map(function ($segment) {
				return mb_substr($segment, 0, 1);
			})
			->join(' '));

		return 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&color=7F9CF5&background=EBF4FF';
	}
}
