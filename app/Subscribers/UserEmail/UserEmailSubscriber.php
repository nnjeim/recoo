<?php

namespace App\Listeners\UserEmail;

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
		$verificationUrl = $event->verificationUrl;
		// Log
		$this
			->setModel($user)
			->setLabel(__FUNCTION__)
			->setBody([
				'subject' => $user->name,
			])
			->log();

		// verification email notification
		$user->notify(new VerifyEmailNotification($verificationUrl));
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
