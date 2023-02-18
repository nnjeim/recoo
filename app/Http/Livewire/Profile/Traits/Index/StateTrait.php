<?php

namespace App\Http\Livewire\Profile\Traits\Index;

trait StateTrait
{
	public string $activeTab = 'info';

	public array $tabs = [
		[
			'slug' => 'info',
			'title' => 'profile.information.title',
			'description' => 'profile.information.description',
			'icon' => 'person',
			'active' => true,
			'error' => false,
			'fields' => [
				'user.name',
				'user.email',
			],
		],
		[
			'slug' => 'password',
			'title' => 'profile.password.title',
			'description' => 'profile.password.description',
			'icon' => 'key',
			'active' => true,
			'error' => false,
			'fields' => [
				//
			],
		],
		[
			'slug' => 'options',
			'title' => 'profile.options.title',
			'description' => 'profile.options.description',
			'icon' => 'settings_account',
			'active' => true,
			'error' => false,
			'fields' => [
				//
			],
		],
		[
			'slug' => 'delete',
			'title' => 'profile.delete.title',
			'description' => 'profile.delete.description',
			'icon' => 'delete',
			'active' => true,
			'error' => false,
			'fields' => [
				//
			],
		],
	];
}
