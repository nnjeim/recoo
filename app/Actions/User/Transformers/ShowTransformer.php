<?php

namespace App\Actions\User\Transformers;

use App\Models\User;
use Illuminate\Support\Collection;

trait ShowTransformer
{
	/**
	 * @param  User  $user
	 * @return Collection
	 */
	protected function transform(User $user): Collection
	{
		return collect($user)
			->merge([
				'email_verified' => $user->email_verified_at !== null,
				'created_at' => adjustUserTimezone($user->created_at),
				'updated_at' => adjustUserTimezone($user->updated_at),
			]);
	}
}
