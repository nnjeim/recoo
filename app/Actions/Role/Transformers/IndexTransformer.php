<?php

namespace App\Actions\Role\Transformers;

use Illuminate\Database\Eloquent\Collection;

trait IndexTransformer
{
	/**
	 * @param  Collection  $roles
	 * @return \Illuminate\Support\Collection
	 */
	protected function transform(Collection $roles): \Illuminate\Support\Collection
	{
		return $roles
			->map(fn ($role) => $role->only('id', 'name'))
			->values();
	}
}
