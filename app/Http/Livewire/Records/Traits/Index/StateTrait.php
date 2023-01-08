<?php

namespace App\Http\Livewire\Records\Traits\Index;

use Illuminate\Support\Collection;

trait StateTrait
{
	public int $perPage = 10;

	public array $perPageOptions = ['10', '20', '50'];

	public array $selectedRecords = [];

	public array $pageRecords = [];

	public mixed $confirmingRecordDeletion = false;

	public bool $showDeleted = false;

	public Collection $data;

	public array $bulkActions = [
		'confirmRecordDeletion',
	];
}
