<?php

namespace App\Http\Livewire\Records;

use App\Http\Livewire\Records\Traits\Edit\ActionsTrait;
use App\Http\Livewire\Records\Traits\Edit\StateTrait;
use App\Http\Livewire\Records\Traits\Edit\ValidationTrait;
use App\Http\Livewire\Traits\WithToasts;
use App\Http\Livewire\Traits\WithVerticalTabs;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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

	/**
	 * @return Factory|View|Application
	 */
	public function render(): Factory|View|Application
	{
		return view('components.records.edit');
	}
}
