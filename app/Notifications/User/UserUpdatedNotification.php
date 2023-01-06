<?php

namespace App\Notifications\User;

use App\Channels\User\Email\UserUpdatedEmailChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class UserUpdatedNotification extends Notification
{
	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct()
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
		return [UserUpdatedEmailChannel::class, 'database'];
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
			'title' => trans('notifications.profile_updated.title'),
			'body' => trans('notifications.profile_updated.body'),
			'click_action' => '/profile',
		];
	}
}
