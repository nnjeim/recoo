<?php

namespace App\Http\Livewire\Users;

use App\Http\Livewire\Traits\WithToasts;
use Livewire\Component;

class Row extends Component
{
	use WithToasts;

	public $rowData;

	public function showRecord()
	{
		$this->redirectRoute('users.edit', ['id' => $this->rowData['id']]);
	}

	public function destroyRecord()
	{
		$this->emitUp('confirmRecordDeletion', $this->rowData['id']);
	}

	public function restoreRecord()
	{
		$this->emitUp('restoreRecord-ev', $this->rowData['id']);
	}

	public function render()
	{
		return view('components.users.row');
	}
}
