<?php

namespace App\Events\User;

use App\Models\User;
use Illuminate\Queue\SerializesModels;

class UserPasswordResetEvent
{
	use SerializesModels;

	public User $user;

	public string $password;

	public function __construct(User $user, string $password)
	{
		$this->user = $user;
		$this->password = $password;
	}
}
