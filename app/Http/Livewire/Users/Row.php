<?php

namespace App\Http\Livewire\Users;

use App\Http\Livewire\Traits\WithToasts;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

class Row extends Component
{
	use WithToasts;

	public Collection $rowData;

	public function showRecord()
	{
		$this->redirectRoute('users.edit', ['id' => $this->rowData['id']]);
	}

	public function toggleSelect()
	{
		$this->emitUp('toggleSelect', $this->rowData['id']);
	}

	public function destroyRecord()
	{
		$this->emitUp('confirmRecordDeletion', $this->rowData['id']);
	}

	public function restoreRecord()
	{
		$this->emitUp('restoreRecords', $this->rowData['id']);
	}

	/**
	 * @return Application|Factory|View
	 */
	public function render(): Application|Factory|View
	{
		return view('components.users.row');
	}
}
