<?php

namespace App\Notifications\UserEmail;

use App\Channels\UserEmail\Email\VerifyEmailChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class VerifyEmailNotification extends Notification
{
	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct(private readonly string $verificationUrl)
	{
	}

	/**
	 * @param $notifiable
	 * @return string[]
	 */
	public function via($notifiable): array
	{
		return [VerifyEmailChannel::class];
	}

	/**
	 * @param $notifiable
	 * @return array
	 */
	public function toEmailNotification($notifiable): array
	{
		return  [
			'verificationUrl' => $this->verificationUrl,
		];
	}
}
