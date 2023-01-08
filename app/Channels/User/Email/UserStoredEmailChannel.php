<?php

namespace App\Channels\User\Email;

use App\Actions\Channel;
use App\Mail\User\UserStoredMail;
use App\Notifications\User\UserStoredNotification;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class UserStoredEmailChannel
{
	/**
	 * Send the given notification.
	 *
	 * @param $notifiable
	 * @param UserStoredNotification $notification
	 * @return void
	 */
	public function send($notifiable, UserStoredNotification $notification): void
	{
		$channel = invoke(Channel\StoreAction::class, $notifiable, $notifiable->id, 'store', 'email');

		if (! $channel->flag) {
			try {
				// email
				$mail = Mail::to($notifiable->email);

				$mail->send(new UserStoredMail($notifiable));
			} catch (TransportExceptionInterface $e) {
				throw new TransportException($e->getMessage());
			}
			// channel
			invoke(Channel\FlagAction::class, $channel);
		}
	}
}
