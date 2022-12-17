<?php

namespace App\Actions\Omdb\Base;

use App\Actions\BaseAction;
use Illuminate\Support\Facades\Http;

abstract class BaseOmdbAction extends BaseAction
{
	protected string $cacheTag = 'omdb';

	protected string $attribute = 'omdb';

	protected string $apiBaseUrl;

	protected $httpClient;

	public function __construct()
	{
		$apiBaseUrl = rtrim(config('constants.OMDB_API_URL'), DIRECTORY_SEPARATOR);

		$this->httpClient =  Http::baseUrl($apiBaseUrl);
	}

	/**
	 * @param  array  $args
	 * @return string
	 */
	protected function formQuery(array $args = []): string
	{
		$queryArgs = [
			'apikey' => config('constants.OMDB_API_KEY'),
		];

		if (! empty($args)) {
			foreach ($args as $key => $value) {
				$queryArgs[$key] = $value;
			}
		}

		return '?' . http_build_query($queryArgs);
	}
}
