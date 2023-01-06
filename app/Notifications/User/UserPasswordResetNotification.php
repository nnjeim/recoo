<?php

namespace App\Notifications\User;

use App\Channels\User\Email\UserPasswordResetEmailChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class UserPasswordResetNotification extends Notification
{
	public string $action = 'update';

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
		return [UserPasswordResetEmailChannel::class, 'database'];
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
			'title' => $this->action,
			'body' => 'Your password was changed',
			'click_action' => '/profile',
		];
	}
}
