<?php

namespace App\Actions\User\Queries;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class PaginateQuery
{
	private array $args;

	public function __construct(array $args)
	{
		$this->args = $args;
	}

	public function __invoke(): Builder
	{
		[
			'filters' => $filters,
			'sortBy' => $sortBy,
			'sortOrder' => $sortOrder,
		] = $this->args + [
			'sortBy' => null,
			'sortOrder' => 'ASC',
			'filters' => [],
		];

		[
			'deleted' => $deleted,
			'status' => $status,
			'search' => $search,
		] = $filters + [
			'deleted' => false,
			'status' => null,
			'search' => '',
		];

		$query = User::query();
		// deleted
		$query->when(isTrue($deleted), fn ($q) => $q->onlyTrashed());
		// status
		$query->when(
			$status !== null,
			fn ($q) => $q->where(fn ($q) => $q->where('users.status', '=', $status))
		);
		// search
		$query->when($search !== null, fn ($q) => collect(explode(' ', $search))
			->filter()
			->each(fn ($term) => $q
				->where(fn ($q) => $q
					->where('users.name', 'like', '%' . $term . '%')
					->orWhere('users.email', 'like', '%' . $term . '%')
				)
			)
		);
		// sorting
		$query->when(! empty($sortBy), function ($q) use ($sortBy, $sortOrder) {
			if (in_array($sortBy, [
				'id',
				'name',
				'status',
				'email_verified_at'
			])) {
				return $q->orderBy($sortBy, $sortOrder);
			}

			return $q;
		});

		return $query;
	}
}
