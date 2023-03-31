<?php

namespace App\Http\Livewire\Settings\Traits\Index;

use Nnjeim\World\World;

trait ActionsTrait
{
	/**
	 * Method to fetch the world timezones.
	 *
	 * @param  string|null  $search
	 * @return void
	 */
	public function fetchTimezones(?string $search = null): void
	{
		$message = '';

		$action = World::timezones([
			'fields' => 'id,name',
			'search' => $search,
			'limit' => 10,
		]);

		if ($action->success) {
			$this->timezones = $action->data->toArray();
			return;
		}

		if ($action->errors) {
			foreach ($action->errors as $key => $error) {
				$message = $error[0];
			}
		}

		$this->notifyAction($action->success, $message);
	}
}
