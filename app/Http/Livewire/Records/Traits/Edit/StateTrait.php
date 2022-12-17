<?php

namespace App\Http\Livewire\Records\Traits\Edit;

trait StateTrait
{
	public int $recordId;

	public array $record = [];

	public string $activeTab = 'info';

	public array $tabs = [
		[
			'title' => 'records.entity.edit_information_title',
			'slug' => 'info',
			'description' => 'records.entity.edit_information_description',
			'icon' => 'description',
			'active' => true,
			'error' => false,
			'fields' => [
				'record.title',
				'record.params.year',
				'record.imdb_id',
				'record.params.genre',
				'record.params.poster',
			],
		],
		[
			'title' => 'records.entity.status_title',
			'slug' => 'status',
			'description' => 'records.entity.status_description',
			'icon' => 'disabled_visible',
			'active' => false,
			'error' => false,
			'fields' => [
				//
			],
		],
	];
}
