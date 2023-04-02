<?php

namespace App\Http\Livewire\Settings;

use App\Http\Livewire\Settings\Traits\Index\ActionsTrait;
use App\Http\Livewire\Settings\Traits\Index\StateTrait;
use App\Http\Livewire\Settings\Traits\Index\ValidationTrait;
use App\Http\Livewire\Traits\WithToasts;
use App\Http\Livewire\Traits\WithVerticalTabs;
use Livewire\Component;

class Index extends Component
{
	use ActionsTrait;
	use StateTrait;
	use ValidationTrait;
	use WithToasts;
	use WithVerticalTabs;

	protected $listeners = [
		//
	];

	public function mount()
	{
		/*-- init tabs--*/
		$this->initTabs();
		/*-- timezones --*/
		$this->fetchTimezones();
	}

	public function render()
	{
		return view('components.settings.index');
	}
}
