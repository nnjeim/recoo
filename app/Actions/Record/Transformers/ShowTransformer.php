<?php

namespace App\Actions\Record\Transformers;

use App\Models\Record;
use Illuminate\Support\Collection;

trait ShowTransformer
{
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

			return $return;
		};

		return collect($record)
			->except(['params', 'user_id', 'user', 'created_at', 'updated_at'])
			->merge([
					'params' => $formatParams($record->params),
					'created_at' => adjustUserTimezone($record->created_at),
					'updated_at' => adjustUserTimezone($record->updated_at),
				]);
	}
}
