<?php

namespace App\Http\Livewire\Profile\Traits\PasswordUpdate;

trait StateTrait
{
	public string $current_password = '';

	public string $password = '';

	public string $password_confirmation = '';

	public array $user;
}
