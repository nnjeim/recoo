<?php

namespace App\Http\Livewire\Profile;

use App\Http\Livewire\Profile\Traits\Edit\ActionsTrait;
use App\Http\Livewire\Profile\Traits\Edit\ValidationTrait;
use App\Http\Livewire\Traits\WithToasts;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
	use ActionsTrait;
	use ValidationTrait;
	use WithToasts;
	use WithFileUploads;

	public array $user;

	public $photo;

	public function mount()
	{
		$this->showUser();
	}

	public function uploadProfilePhoto()
	{
		Auth::user()->updateProfilePhoto($this->photo);

		return redirect()->route('profile.index');
	}

	public function deleteProfilePhoto()
	{
		Auth::user()->deleteProfilePhoto();
	}

	/**
	 * @return Factory|View|Application
	 */
	public function render(): Factory|View|Application
	{
		return view('components.profile.edit');
	}
}
