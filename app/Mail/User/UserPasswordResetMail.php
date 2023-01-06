<?php

namespace App\Mail\User;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

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
	 * Get the message envelope.
	 *
	 * @return Envelope
	 */
	public function envelope(): Envelope
	{
		return new Envelope(
			subject: 'User Updated',
		);
	}

	/**
	 * Get the message content definition.
	 *
	 * @return Content
	 */
	public function content(): Content
	{
		return new Content(
			markdown: 'email.user.userUpdated',
		);
	}
}
