<?php

namespace App\Notifications\UserEmail;

use App\Channels\UserEmail\Email\VerifyEmailChannel;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Notification;

class VerifyEmailNotification extends Notification
{
	public string $verificationUrl;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct(private readonly User $user)
	{
		$this->verificationUrl = $this->formVerificationUrl();
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

	/**
	 * @return string
	 */
	private function formVerificationUrl(): string
	{
		return URL::temporarySignedRoute(
			'verification.verify',
			Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
			[
				'id' => $this->user->getKey(),
				'hash' => sha1($this->user->getEmailForVerification()),
			]
		);
	}
}
