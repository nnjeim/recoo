<?php

namespace App\Actions\User\Transformers;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

trait PaginateTransformer
{
	/**
	 * @param User $user
	 * @return Collection
	 */
	protected function transform(User $user): Collection
	{
		return collect($user)
			->except(['password', 'created_at', 'updated_at', 'deleted_at'])
			->merge([
				'email_verified' => $user->email_verified_at !== null,
				'profile_photo_url' => $user->profile_photo_url,
				'roles' => $user->roles()->pluck('name')->join(', '),
				'last_login_at' => $user->last_login_at ? adjustUserTimezone($user->last_login_at) : '-',
				'deleted' => $user->deleted_at !== null,
			]);
	}
}
