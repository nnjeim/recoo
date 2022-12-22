<?php

namespace App\Events\User;

use App\Models\User;
use Illuminate\Queue\SerializesModels;

class UserDestroyedEvent
{
	use SerializesModels;

	public User $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}
}
