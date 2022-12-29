<?php

namespace App\Events\User;

use App\Models\User;
use Illuminate\Queue\SerializesModels;

class UserDestroyedEvent
{
	use SerializesModels;

	public function __construct(public User $user)
	{
	}
}
