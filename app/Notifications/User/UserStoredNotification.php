<?php

namespace App\Notifications\User;

use App\Channels\User\Email\UserStoredEmailChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class UserStoredNotification extends Notification
{
	public string $action = 'store';

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
		return [UserStoredEmailChannel::class, 'database'];
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
			'body' => 'The user account ' . $notifiable->name . ' was stored',
			'click_action' => '/users/' . $notifiable->id,
		];
	}
}
