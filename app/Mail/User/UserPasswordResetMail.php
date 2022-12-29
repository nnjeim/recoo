<?php

namespace App\Mail\User;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserPasswordResetMail extends Mailable
{
	use Queueable, SerializesModels;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct(public User $user)
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
			->markdown('email.user.userUpdated');
	}
}
