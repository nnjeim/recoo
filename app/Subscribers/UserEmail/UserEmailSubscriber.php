<?php

namespace App\Subscribers\UserEmail;

use App\Events\UserEmail;
use App\Subscribers\BaseSubscriber;
use App\Notifications\UserEmail\VerifyEmailNotification;

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

	/**
	 * @param $events
	 * @return void
	 */
	public function subscribe($events): void
	{
		$events->listen(UserEmail\VerifyEmailEvent::class, self::class . '@verifyEmail');
	}
}
