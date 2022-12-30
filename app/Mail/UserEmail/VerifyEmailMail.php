<?php

namespace App\Mail\UserEmail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmailMail extends Mailable
{
	use Queueable, SerializesModels;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct(public User $user, public string $verificationUrl)
	{
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build(): self
	{
		return $this
			->from(config('mail.from.address'), config('mail.from.name'))
			->subject(config('app.name') . ' - Verify Email Address')
			->markdown('email.userEmail.verifyEmail');
	}
}
