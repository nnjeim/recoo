<?php

namespace App\Http\Livewire\Records;

use App\Http\Livewire\Records\Traits\Edit\ActionsTrait;
use App\Http\Livewire\Records\Traits\Edit\StateTrait;
use App\Http\Livewire\Records\Traits\Edit\ValidationTrait;
use App\Http\Livewire\Traits\WithToasts;
use App\Http\Livewire\Traits\WithVerticalTabs;
use Livewire\Component;

class Edit extends Component
{
	use StateTrait;
	use ActionsTrait;
	use WithToasts;
	use WithVerticalTabs;
	use ValidationTrait;

	public function mount()
	{
		$this->showRecord();

		// tabs
		$this->initTabs();
	}

	public function render()
	{
		return view('components.records.edit');
	}
}
