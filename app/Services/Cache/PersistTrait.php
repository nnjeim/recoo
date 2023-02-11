<?php

namespace App\Services\Cache;

use Illuminate\Support\Facades\Cache;

trait PersistTrait
{
	public string $cacheTag = 'default';

	public string $cacheKey;

	public string $separator = '_';

	/**
	 * @param  string  $separator
	 * @return $this
	 */
	public function setSeparator(string $separator = '_'): static
	{
		$this->separator = $separator;

		return $this;
	}

	/**
	 * @param  string  $cacheTag
	 * @param  int|string|null  $suffix
	 * @return $this
	 */
	public function setCacheTag(string $cacheTag): static
	{
		$this->cacheTag = $cacheTag;

		return $this;
	}

	/**
	 * @param string $cacheKey
	 * @return $this
	 */
	public function setCacheKey(string $cacheKey): static
	{
		$this->cacheKey = $cacheKey;

		return $this;
	}

	/**
	 * @param $args
	 * @return $this
	 */
	public function formCacheKey($args): static
	{
		$args = is_array($args) ? $args : func_get_args();

		$this->cacheKey = implode($this->separator, $args);

		return $this;
	}

	/**
	 * @return bool
	 */
	public function hasCacheKey(): bool
	{
		return Cache::tags($this->cacheTag)->has($this->cacheKey);
	}

	/**
	 * @return mixed
	 */
	public function getCacheKey(): mixed
	{
		return Cache::tags($this->cacheTag)->get($this->cacheKey);
	}

	/**
	 * @param $value
	 * @param $ttl
	 * @return mixed
	 */
	public function rememberCache($value, $ttl): mixed
	{
		Cache::tags($this->cacheTag)->put($this->cacheKey, $value, $ttl);

		return $this->getCacheKey();
	}

	/**
	 * @param $value
	 * @return mixed
	 */
	public function rememberCacheForever($value): mixed
	{
		Cache::tags($this->cacheTag)->forever($this->cacheKey, $value);

		return $this->getCacheKey();
	}

	/**
	 * @return mixed
	 */
	public function forgetCacheKey(): mixed
	{
		return Cache::tags($this->cacheTag)->forget($this->cacheKey);
	}

	/**
	 * @return mixed
	 */
	public function flushCacheTag(): mixed
	{
		return Cache::tags($this->cacheTag)->flush();
	}
}
