<?php

namespace App\Mail\UserEmail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

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
	 * Get the message envelope.
	 *
	 * @return Envelope
	 */
	public function envelope(): Envelope
	{
		return new Envelope(
			subject: 'Verify Email Address',
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
			markdown: 'email.userEmail.verifyEmail',
		);
	}
}
