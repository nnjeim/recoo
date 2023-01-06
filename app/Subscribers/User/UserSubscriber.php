<?php

namespace App\Subscribers\User;

use App\Events\User;
use App\Notifications\UserEmail\VerifyEmailNotification;
use App\Subscribers\BaseSubscriber;
use App\Notifications\User\UserStoredNotification;
use App\Notifications\User\UserUpdatedNotification;
use Illuminate\Auth\Events\Verified;

class UserSubscriber extends BaseSubscriber
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
	 * @param User\UserStoredEvent $event
	 */
	public function userStored(User\UserStoredEvent $event): void
	{
		$user = $event->user;
		$superUser = $this->getSuperUser();
		// Log
		$this
			->setModel($user)
			->setLabel(__FUNCTION__)
			->setBody([
				'subject' => $user->name,
			])
			->setClickAction([
				'model' => $user->id,
			])
			->log();
		// User Notification
		$user->notify(new UserStoredNotification($user));
		// Superuser Notification
		$superUser->notify(new UserStoredNotification($user));
	}

	/**
	 * @param  User\UserRegisteredEvent  $event
	 * @return void
	 */
	public function userRegistered(User\UserRegisteredEvent $event): void
	{
		$user = $event->user;
		$superUser = $this->getSuperUser();
		// Log
		$this
			->setModel($user)
			->setLabel(__FUNCTION__)
			->setBody([
				'subject' => $user->name,
			])
			->log();
		// User Notification
		$user->notify(new UserStoredNotification($user));
		// Superuser Notification
		$superUser->notify(new UserStoredNotification($user));
		// email verification notification
		$user->notify(new VerifyEmailNotification($user));
	}

	/**
	 * @param User\UserUpdatedEvent $event
	 */
	public function userUpdated(User\UserUpdatedEvent $event): void
	{
		$user = $event->user;
		// Log
		$this
			->setModel($user)
			->setLabel(__FUNCTION__)
			->setBody([
				'subject' => $user->name,
			])
			->setClickAction([
				'model' => $user->id,
			])
			->log();
		// Notification
		$user->notify(new UserUpdatedNotification());
	}

	/**
	 * @param User\UserDestroyedEvent $event
	 */
	public function userDestroyed(User\UserDestroyedEvent $event): void
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
	}

	/**
	 * @param User\UserRestoredEvent $event
	 */
	public function userRestored(User\UserRestoredEvent $event): void
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
	}

	/**
	 * @param User\UserPasswordResetEvent $event
	 */
	public function userPasswordReset(User\UserPasswordResetEvent $event): void
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
		// Notification
		$user->notify(new UserUpdatedNotification());
	}

	/**
	 * @param  Verified  $event
	 */
	public function userVerified(Verified $event): void
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
	}

	/**
	 * @param $events
	 * @return void
	 */
	public function subscribe($events): void
	{
		$events->listen(User\UserStoredEvent::class, self::class . '@userStored');

		$events->listen(User\UserRegisteredEvent::class, self::class . '@userRegistered');

		$events->listen(User\UserUpdatedEvent::class, self::class . '@userUpdated');

		$events->listen(User\UserDestroyedEvent::class, self::class . '@userDestroyed');

		$events->listen(User\UserRestoredEvent::class, self::class . '@userRestored');

		$events->listen(User\UserPasswordResetEvent::class, self::class . '@userPasswordReset');

		$events->listen(Verified::class, self::class . '@userVerified');
	}
}
