<?php

namespace App\Actions\Record\Queries;

use App\Models\Record;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

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

		$query = Record::query()->with('user');
		// deleted
		$query->when(isTrue($deleted), fn ($q) => $q->onlyTrashed());
		// search
		$query->when($search !== null, fn ($q) => collect(explode(' ', $search))
			->filter()
			->each(fn ($term) => $q
				// search by the records table fields
				->where(fn ($q) => $q
					->where('records.title', 'like', '%' . $term . '%')
					->orWhere('records.imdb_id', 'like', '%' . $term . '%')
				)
				// search by using a params key
				->orWhere(fn ($q) => $q
					->where('records.params->year', 'like', '%' . $term . '%')
				)
				// search by username or email
				->orWhereHas(
					'user',
					fn ($q) => $q
						->where('users.name', 'LIKE', '%' . strtolower($term) . '%')
						->orWhere('users.email', 'LIKE', '%' . strtolower($term) . '%')
				)
			)
		);
		// sorting
		$query->when(! empty($sortBy), function ($q) use ($sortBy, $sortOrder) {
			return match ($sortBy) {
				'year' => $q->orderBy('records.params->year', $sortOrder),
				'user_name' => $q->orderBy(
					User::select('users.name')
						->whereColumn('users.id', '=', 'records.user_id')
						->take(1),
					$sortOrder
				),
				default => $q->orderBy($sortBy, $sortOrder),
			};
		});

		return $query;
	}
}
