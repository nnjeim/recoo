<?php

namespace App\Http\Livewire\Profile;

use App\Http\Livewire\Profile\Traits\Options\ActionsTrait;
use App\Http\Livewire\Profile\Traits\Options\StateTrait;
use App\Http\Livewire\Traits\WithToasts;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Options extends Component
{
	use ActionsTrait;
	use StateTrait;
	use WithToasts;

	public function mount()
	{
		$this->fetchTimezones();

		$this->showOptions();
	}

	/**
	 * @return Factory|View|Application
	 */
	public function render(): Factory|View|Application
	{
		return view('components.profile.options');
	}
}
