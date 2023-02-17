<?php

namespace App\Http\Livewire\Profile;

use App\Http\Livewire\Profile\Traits\Edit\ActionsTrait;
use App\Http\Livewire\Profile\Traits\Edit\StateTrait;
use App\Http\Livewire\Profile\Traits\Edit\ValidationTrait;
use App\Http\Livewire\Traits\WithToasts;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
	use ActionsTrait;
	use StateTrait;
	use ValidationTrait;
	use WithFileUploads;
	use WithToasts;

	public function mount()
	{
		$this->showUser();
	}

	/**
	 * @return Factory|View|Application
	 */
	public function render(): Factory|View|Application
	{
		return view('components.profile.edit');
	}
}
