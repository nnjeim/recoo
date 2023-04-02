<?php

namespace App\Http\Livewire\Settings\Traits\Index;

trait StateTrait
{
	public $activeTab = 'info';

	public array $tabs = [
		[
			'slug' => 'info',
			'title' => 'settings.tabs.info.title',
			'description' => 'settings.tabs.info.description',
			'icon' => 'info',
			'error' => false,
			'fields' => [
				//
			],
		],
		[
			'slug' => 'roles',
			'title' => 'settings.tabs.roles.title',
			'description' => 'settings.tabs.roles.description',
			'icon' => 'info',
			'error' => false,
			'fields' => [
				//
			],
		],
	];
}
