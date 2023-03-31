<?php

namespace App\Providers;

use App\Actions\Permission\CanAction;
use App\Actions\Permission\FetchUserPermissions;
use Illuminate\Auth\SessionGuard;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * The policy mappings for the application.
	 *
	 * @var array<class-string, class-string>
	 */
	protected $policies = [
		// 'App\Models\Model' => 'App\Policies\ModelPolicy',
	];

	/**
	 * Register any authentication / authorization services.
	 *
	 * @return void
	 */
	public function boot(): void
	{
		$this->registerPolicies();
		// add the user permission to Auth.
		SessionGuard::macro('permissions', function () {
			return trigger(FetchUserPermissions::class)->data;
		});

		// blade can helper.
		Blade::if('can', function (string $name) {
			if (! Auth::check()) {
				return false;
			}

			if (Auth::user()->isSuper()) {
				return true;
			}

			$permissions = Auth::permissions()->toArray();

			if (! in_array($name, array_keys($permissions))) {
				return false;
			}

			return $permissions[$name];
		});
	}
}
