<?php

namespace App\Http\Livewire\Profile;

use App\Http\Livewire\Profile\Traits\ActionsTrait;
use App\Http\Livewire\Profile\Traits\ValidationTrait;
use App\Http\Livewire\Traits\WithToasts;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Edit extends Component
{
	use ActionsTrait;
	use ValidationTrait;
	use WithToasts;

	public $user;

	public function mount()
	{
		$this->user = Auth::user()->toArray();
	}

	public function render()
	{
		return view('components.profile.edit');
	}
}
