<?php

namespace App\Events\UserEmail;

use App\Models\User;
use Illuminate\Queue\SerializesModels;

class VerifyEmailEvent
{
	use SerializesModels;

	public function __construct(public User $user) {
	}
}
