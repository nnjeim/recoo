<?php

namespace App\Http\Livewire\Users;

use App\Http\Livewire\Traits\WithPersist;
use App\Http\Livewire\Traits\WithSorting;
use App\Http\Livewire\Traits\WithToasts;
use App\Http\Livewire\Users\Traits\Index\ActionsTrait;
use App\Http\Livewire\Users\Traits\Index\GettersTrait;
use App\Http\Livewire\Users\Traits\Index\SettersTrait;
use App\Http\Livewire\Users\Traits\Index\StateTrait;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
	use StateTrait;
	use GettersTrait;
	use SettersTrait;
	use ActionsTrait;
	use WithPagination;
	use WithSorting;
	use WithPersist;
	use WithToasts;

	const INIT_FILTERS = [
		'search' => null,
		'deleted' => false,
		'email_verified_at' => null,
	];

	public $filters = self::INIT_FILTERS;

	protected $queryString = [
		'filters' => [
			'except' => self::INIT_FILTERS,
		],
		'page' => ['except' => 1],
		'sortBy' => ['except' => 'id'],
		'sortDirection' => ['except' => 'desc'],
	];

	protected $listeners = [
		'toggleSelect-ev' => 'toggleSelect',
		'confirmRecordDeletion',
		'restoreRecord-ev' => 'restoreRecords',
	];

	public function render()
	{
		// persist
		$this->getPersistedProps();
		// fetch users
		$paginator = $this->paginate();
		// show deleted
		$this->countTrashedRecords();
		// set bulk actions
		$this->setBulkActions();

		return view('components.users.index')->with(['paginator' => $paginator]);
	}
}
