<?php

namespace App\Http\Livewire\Profile\Traits\Options;

trait StateTrait
{
	public array $options = [
		'datetime' => [
			'timezone' => '',
		],
		'notifications' => [
			//
		],
	];

	public array $timezones = [];
}
