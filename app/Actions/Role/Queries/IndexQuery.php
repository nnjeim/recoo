<?php

namespace App\Actions\Role\Queries;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class IndexQuery
{
	/**
	 * @return Collection
	 */
	public function __invoke(): Collection
	{
		$query = Role::query()
			->where([
				['id', '>', 1],
				['locked', '=', 1],
			])
			->select('roles.id', 'roles.name');

		return $query->get();
	}
}
