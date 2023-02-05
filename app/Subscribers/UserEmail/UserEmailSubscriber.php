<?php

namespace App\Subscribers\UserEmail;

use App\Actions\Geoip\LookupAction;
use App\Events\UserEmail;
use App\Subscribers\BaseSubscriber;
use App\Notifications\UserEmail\VerifyEmailNotification;
use Illuminate\Auth\Events\Verified;

class UserEmailSubscriber extends BaseSubscriber
{
	/**
	 * Create the event listener.
	 *
	 * @return void
	 */
	public function __construct()
	{
	}

	/**
	 * @param  UserEmail\VerifyEmailEvent  $event
	 * @return void
	 */
	public function verifyEmail(UserEmail\VerifyEmailEvent $event): void
	{
		$user = $event->user;
		// Log
		$this
			->setModel($user)
			->setLabel(__FUNCTION__)
			->setBody([
				'subject' => $user->name,
			])
			->log();

		// verification email notification
		$user->notify(new VerifyEmailNotification($user));
	}

	public function verifiedEmail(Verified $event): void
	{
		$user = $event->user;
		// Log
		$this
			->setModel($user)
			->setLabel(__FUNCTION__)
			->setBody([
				'subject' => $user->name,
			])
			->log();

		// update user logins
		$user
			->logins()
			->create([
				'params' => invoke(LookupAction::class),
			]);
	}

	/**
	 * @param $events
	 * @return void
	 */
	public function subscribe($events): void
	{
		$events->listen(UserEmail\VerifyEmailEvent::class, self::class . '@verifyEmail');

		$events->listen(Verified::class, self::class . '@verifiedEmail');
	}
}
