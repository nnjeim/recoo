<?php

namespace App\Providers;

use App\Subscribers\UserEmail\UserEmailSubscriber;
use App\Subscribers\Record\RecordSubscriber;
use App\Subscribers\User\UserSubscriber;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
	/**
	 * The event listener mappings for the application.
	 *
	 * @var array<class-string, array<int, class-string>>
	 */
	protected $listen = [
		Registered::class => [
			SendEmailVerificationNotification::class,
		],
	];

	/**
	 * The subscriber classes to register.
	 *
	 * @var array
	 */
	protected $subscribe = [
		UserSubscriber::class,
		RecordSubscriber::class,
		UserEmailSubscriber::class,
	];

	/**
	 * Register any events for your application.
	 *
	 * @return void
	 */
	public function boot(): void
	{
		//
	}
}
