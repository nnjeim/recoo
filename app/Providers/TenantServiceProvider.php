<?php

namespace App\Providers;

use App\Exceptions\AuthenticationException;
use App\Models\Tenant;
use App\Services\Cache\PersistTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

class TenantServiceProvider extends ServiceProvider
{
	use PersistTrait;

	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->app->singleton('ioc-tenant', function () {
			return filter_input(INPUT_COOKIE, '__token', FILTER_DEFAULT)
				? $this->getTenantByToken(filter_input(INPUT_COOKIE, '__token', FILTER_DEFAULT))
				: $this->getLatestTenantId();
		});
	}

	/**
	 * @param  string  $token
	 * @return mixed
	 * @throws AuthenticationException
	 */
	private function getTenantByToken(string $token): mixed
	{
		if (! $this->isCacheEnabled()) {
			$tenantBuilder = $this->getTenantBuilder($token);

			return $tenantBuilder->value('id');
		}

		// cache
		$this->setCacheTag('tenants');
		$this->formCacheKey('tenant', 'id', $token);

		if ($this->hasCacheKey()) {
			return $this->getCacheKey();
		}

		$tenantBuilder = $this->getTenantBuilder($token);

		return $this->rememberCacheForever($tenantBuilder->value('id'));
	}

	/**
	 * @param  string  $token
	 * @return Builder
	 * @throws AuthenticationException
	 */
	private function getTenantBuilder(string $token): Builder
	{
		$tenantBuilder = Tenant::whereToken($token);

		if (! $tenantBuilder->exists()) {
			throw new AuthenticationException();
		}

		return $tenantBuilder;
	}

	/**
	 * @return int
	 */
	private function getLatestTenantId(): int
	{
		if (! $this->isCacheEnabled()) {
			return Tenant::query()->latest()->value('id');
		}

		// cache
		$this->setCacheTag('tenants');
		$this->formCacheKey('tenant', 'latest');

		return $this->hasCacheKey()
			? $this->getCacheKey()
			: $this->rememberCacheForever(Tenant::query()->latest()->value('id'));
	}

	/**
	 * @return bool
	 */
	private function isCacheEnabled(): bool
	{
		return config('cache.enabled', false);
	}
}
