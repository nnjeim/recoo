<?php

namespace App\Actions\Notification\Transformers;

use Illuminate\Database\Eloquent\Collection;

trait IndexTransformer
{
	/**
	 * @param Collection $notifications
	 * @return \Illuminate\Support\Collection
	 */
	protected function transform(Collection $notifications): \Illuminate\Support\Collection
	{
		return $notifications
			->map(fn ($notification) => [
				'id' => $notification->id,
				'data' => [
					'title' => $notification->data['title'],
					'body' => $notification->data['body'],
					'click_action' => $notification->data['click_action'] ?? null,
				],
				'read_at' => $notification->read_at,
				'created_at' => adjustUserTimezone($notification->created_at),
			]);
	}
}
