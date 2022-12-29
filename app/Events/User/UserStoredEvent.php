<?php

namespace App\Events\User;

use App\Models\User;
use Illuminate\Queue\SerializesModels;

class UserStoredEvent
{
	use SerializesModels;

	public function __construct(public User $user)
	{
	}
}
