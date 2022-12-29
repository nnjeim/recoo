<?php

namespace App\Notifications\User;

use App\Channels\User\Email\UserUpdatedEmailChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class UserUpdatedNotification extends Notification
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
	public function via($notifiable): array
	{
		return [UserUpdatedEmailChannel::class, 'database'];
	}

	/**
	 * @param $notifiable
	 * @return array
	 */
	public function toEmailNotification($notifiable): array
	{
		return [
			//
		];
	}

	/**
	 * @param $notifiable
	 * @return array
	 */
	public function toDatabase($notifiable): array
	{
		return [
			'title' => $this->action,
			'body' => 'Your profile was updated',
			'click_action' => '/account',
		];
	}
}
