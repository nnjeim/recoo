<?php

namespace App\Channels\UserEmail\Email;

use App\Actions\Channel;
use App\Mail\UserEmail\VerifyEmailMail;
use App\Notifications\UserEmail\VerifyEmailNotification;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class VerifyEmailChannel
{
	/**
	 * @param  $notifiable
	 * @param  VerifyEmailNotification  $notification
	 */
	public function send($notifiable, VerifyEmailNotification $notification): void
	{
		['verificationUrl' => $verificationUrl] = $notification->toEmailNotification($notifiable);

		$channel = invoke(Channel\StoreAction::class, $notifiable, $notifiable->id, 'verification_email', 'email');

		if (! $channel->flag) {
			try {
				/*-- email --*/
				$mail = Mail::to($notifiable->email);

				$mail->send(new VerifyEmailMail($notifiable, $verificationUrl));
			} catch (TransportExceptionInterface $e) {
				throw new TransportException($e->getMessage());
			}
			/*-- channel --*/
			invoke(Channel\FlagAction::class, $channel);
		}
	}
}
