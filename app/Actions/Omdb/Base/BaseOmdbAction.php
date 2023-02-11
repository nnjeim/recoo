<?php

namespace App\Actions\Omdb\Base;

use App\Actions\BaseAction;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

abstract class BaseOmdbAction extends BaseAction
{
	protected string $apiBaseUrl;

	protected string $attribute = 'omdb';

	protected PendingRequest $httpClient;

	public function __construct()
	{
		$apiBaseUrl = rtrim(config('constants.omdb_api_url'), DIRECTORY_SEPARATOR);

		$this->httpClient =  Http::baseUrl($apiBaseUrl);
	}

	/**
	 * @param  array  $args
	 * @return string
	 */
	protected function formQuery(array $args = []): string
	{
		$queryArgs = [
			'apikey' => config('constants.omdb_api_key'),
		];

		if (! empty($args)) {
			foreach ($args as $key => $value) {
				$queryArgs[$key] = $value;
			}
		}

		return '?' . http_build_query($queryArgs);
	}
}
