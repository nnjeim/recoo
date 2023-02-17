<?php

namespace App\Http\Livewire\Profile;

use App\Http\Livewire\Profile\Traits\Index\StateTrait;
use App\Http\Livewire\Traits\WithVerticalTabs;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Index extends Component
{
	use StateTrait;
	use WithVerticalTabs;

	public function mount()
	{
		$this->initTabs();
	}

	/**
	 * @return Factory|View|Application
	 */
	public function render(): Factory|View|Application
	{
		return view('components.profile.index');
	}
}
