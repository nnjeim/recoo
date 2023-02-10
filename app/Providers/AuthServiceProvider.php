<?php

namespace App\Providers;

use App\Actions\Permission\CanAction;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;

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

		Blade::if('can', function (string $name) {
			if (! Auth::check()) {
				return false;
			}

			return trigger(CanAction::class, $name);
		});
	}
}
