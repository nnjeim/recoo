<?php

namespace App\Http\Livewire\Records;

use App\Http\Livewire\Traits\WithPersist;
use App\Http\Livewire\Traits\WithSorting;
use App\Http\Livewire\Records\Traits\Index\ActionsTrait;
use App\Http\Livewire\Records\Traits\Index\GettersTrait;
use App\Http\Livewire\Records\Traits\Index\SettersTrait;
use App\Http\Livewire\Records\Traits\Index\StateTrait;
use App\Http\Livewire\Traits\WithToasts;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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
		'toggleSelect',
		'confirmRecordDeletion',
		'restoreRecords',
	];

	/**
	 * @return Factory|View|Application
	 */
	public function render(): Factory|View|Application
	{
		// persist
		$this->getPersistedProps();
		// fetch records
		$paginator = $this->paginate();
		// show deleted
		$this->countTrashedRecords();
		// set bulk actions
		$this->setBulkActions();

		return view('components.records.index')->with(['paginator' => $paginator]);
	}
}
