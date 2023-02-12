<?php

namespace App\Actions\Traits;

use Illuminate\Support\Facades\Auth;

trait ActionHelpersTrait
{
	/**
	 * @param array $args
	 * @return string
	 */
	protected function getDeleteMode(array $args): string
	{
		['mode' => $mode] = $args + ['mode' => 'soft'];

		if (Auth::id() === 1) {
			return $mode;
		}

		return 'soft';
	}

	/**
	 * @param string $message
	 * @return array
	 */
	protected function setErrors(string $message): array
	{
		return [
			'message' => [$message],
		];
	}

	/**
	 * @return bool
	 */
	protected function isCacheEnabled(): bool
	{
		return config('cache.enabled', false);
	}

	/**
	 * @return void
	 */
	protected function flushModuleCache(): void
	{
		if (! config('cache.enabled', false)) {
			return;
		}

		$this
			->setCacheTag($this->cacheTag)
			->flushCacheTag();
	}
}
