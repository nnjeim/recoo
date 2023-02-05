<?php

namespace App\Http\Livewire\Users\Traits\Edit;

trait StateTrait
{
	public int $userId;

	public array $user = [];

	public array $roles = [];

	public string $activeTab = 'info';

	public array $tabs = [
		[
			'title' => 'users.entity.edit_information_title',
			'slug' => 'info',
			'description' => 'users.entity.edit_information_description',
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
