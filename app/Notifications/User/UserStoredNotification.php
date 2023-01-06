<?php

namespace App\Notifications\User;

use App\Channels\User\Email\UserStoredEmailChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Models\User;

class UserStoredNotification extends Notification
{
	/**
	 * Create a new notification instance
	 */
	public function __construct(private readonly User $user)
	{
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function via(mixed $notifiable): array
	{
		$via = [];
		// notify the new user
		if ($notifiable->id === $this->user->id) {
			$via[] = UserStoredEmailChannel::class;
		}
		// send a database notification to the superuser
		if ($notifiable->id === 1) {
			$via[] = 'database';
		}

		return $via;
	}

	/**
	 * @param mixed $notifiable
	 * @return array
	 */
	public function toEmailNotification(mixed $notifiable): array
	{
		return [
			//
		];
	}

	/**
	 * @param mixed $notifiable
	 * @return array
	 */
	public function toDatabase(mixed $notifiable): array
	{
		return [
			'title' => trans('notifications.user_stored.title'),
			'body' => trans('notifications.user_stored.body', ['name' => $this->user->name]),
			'click_action' => '/users/' . $this->user->id,
		];
	}
}
