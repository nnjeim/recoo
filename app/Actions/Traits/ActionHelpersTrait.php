<?php

namespace App\Actions\Traits;

use App\Actions\ModuleOption;
use App\Actions\ModuleSetting;
use Illuminate\Support\Facades\Auth;

trait ActionHelpersTrait
{
	/**
	 * @param  string|null  $optionable_type
	 * @return mixed
	 */
	protected function getModuleOptions(?string $optionable_type = null): mixed
	{
		return trigger(
			ModuleOption\ShowAction::class,
			[
				'optionable_type' => $optionable_type ?? $this->class,
			]
		)->data;
	}

	/**
	 * @param  string|null  $settable_type
	 * @return mixed
	 */
	protected function getModuleSettings(?string $settable_type = null): mixed
	{
		return trigger(
			ModuleSetting\ShowAction::class,
			[
				'settable_type' => $settable_type ?? $this->class,
			]
		)->data;
	}

	/**
	 * @param  array  $args
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
	 * @param  string  $message
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
		if (!config('cache.enabled', false)) {
			return;
		}

		$this->setCacheTag($this->cacheTag)->flushCacheTag();
	}
}
