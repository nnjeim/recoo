<?php

namespace App\Actions\Record\Transformers;

use App\Models\Record;
use Illuminate\Support\Collection;

trait PaginateTransformer
{
	private array $requiredFields = [
		'title',
		'year',
		'poster',
	];
	/**
	 * @param  Record  $record
	 * @return Collection
	 */
	protected function transform(Record $record): Collection
	{
		/**
		 * @param  array  $params
		 * @return array
		 */
		$formatParams = function(array $params): array {
			$return = [];

			array_walk($params, function($value, $key) use (&$return) {
				$return[strtolower($key)] = $value;
			});

			return array_only($return, $this->requiredFields);
		};

		return collect($record)
			->except(['params', 'user_id', 'user', 'created_at', 'updated_at', 'deleted_at'])
			->merge(array_merge(
				$formatParams($record->params),
				[
					'user_name' => $record->user?->name ?? '',
					'deleted' => $record->deleted_at !== null,
				],
			));
	}
}
