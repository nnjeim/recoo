<?php

namespace App\Http\Livewire\Auth\Traits\Register;

trait StateTrait
{
	public array $user = [
		'name' => '',
		'email' => '',
		'password' => '',
		'password_confirmation' => '',
	];
}
