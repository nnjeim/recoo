<?php

namespace App\Http\Livewire\Users\Traits\Store;

trait StateTrait
{
	public array $user = [
		'name' => '',
		'email' => '',
		'status' => '1',
		'roles' => [
			[
				'id' => 3,
				'name' => 'editor',
			]
		]
	];

	public string $activeTab = 'info';

	public array $tabs = [
		[
			'title' => 'users.entity.store_information_title',
			'slug' => 'info',
			'description' => 'users.entity.store_information_description',
			'icon' => 'description',
			'active' => true,
			'error' => false,
			'fields' => [
				'user.name',
				'user.email',
			],
		],
		[
			'title' => 'users.entity.status_title',
			'slug' => 'status',
			'description' => 'users.entity.status_description',
			'icon' => 'disabled_visible',
			'active' => false,
			'error' => false,
			'fields' => [
				'user.status',
			],
		],
	];
}
