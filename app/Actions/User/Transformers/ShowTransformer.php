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
				'created_at' => adjustTenantTimezone($user->created_at),
				'updated_at' => adjustTenantTimezone($user->updated_at),
			]);
	}
}
