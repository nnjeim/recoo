<?php

namespace App\Channels\User\Email;

use App\Actions\Channel;
use App\Mail\User\UserUpdatedMail;
use App\Notifications\User\UserUpdatedNotification;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class UserUpdatedEmailChannel
{
	/**
	 * Send the given notification.
	 *
	 * @param $notifiable
	 * @param UserUpdatedNotification $notification
	 * @return void
	 */
	public function send($notifiable, UserUpdatedNotification $notification): void
	{
		$channel = invoke(Channel\StoreAction::class, $notifiable, $notifiable->id, 'update', 'email');

		if (! $channel->flag) {
			try {
				// email
				$mail = Mail::to($notifiable->email);

				$mail->send(new UserUpdatedMail($notifiable));
			} catch (TransportExceptionInterface $e) {
				throw new TransportException($e->getMessage());
			}
			// channel
			invoke(Channel\FlagAction::class, $channel);
		}
	}
}
