<?php

namespace App\Http\Livewire\Records\Traits\Store;

trait StateTrait
{
	public array $record = [
		'title' => '',
		'imdb_id' => '',
		'param' => [],
	];

	public array $imdb_search_type_options = [
		[
			'name' => 'Title',
			'value' => 's'
		],
		[
			'name' => 'IMDb ID',
			'value' => 'i'
		],
	];

	public string $imdb_search = '';

	public string $imdb_search_type = 's';

	public array $imdb_records = [];

	public string $activeTab = 'search';

	public array $tabs = [
		[
			'title' => 'records.entity.store_imdb_search_title',
			'slug' => 'search',
			'description' => 'records.entity.store_imdb_search_description',
			'icon' => 'search',
			'active' => true,
			'error' => false,
			'fields' => [
				//
			],
		],
		[
			'title' => 'records.entity.store_information_title',
			'slug' => 'info',
			'description' => 'records.entity.store_information_description',
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
	];
}
