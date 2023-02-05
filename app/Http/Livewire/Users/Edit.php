<?php

namespace App\Http\Livewire\Users;

use App\Http\Livewire\Users\Traits\Edit\ActionsTrait;
use App\Http\Livewire\Users\Traits\Edit\StateTrait;
use App\Http\Livewire\Users\Traits\Edit\ValidationTrait;
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
		$this->fetchRoles();

		$this->showUser();

		// tabs
		$this->initTabs();
	}

	/**
	 * @return Application|Factory|View
	 */
	public function render(): Application|Factory|View
	{
		return view('components.users.edit');
	}
}
