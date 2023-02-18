<?php

namespace App\Http\Livewire\Profile\Traits\Options;

use App\Actions\UserOption;
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

	/**
	 * Method to update the user options.
	 *
	 * @return void
	 */
	public function updateOptions(): void
	{
		$message = '';

		$action = trigger(UserOption\UpdateAction::class, $this->options)->withResponse();

		if ($action->success) {
			$message = $action->message;
			$this->options = $action->data;
		}

		if ($action->errors) {
			foreach ($action->errors as $key => $error) {
				$message = $error[0];
			}
		}

		$this->notifyAction($action->success, $message);
	}

	/**
	 * Method to show the options.
	 *
	 * @return void
	 */
	public function showOptions(): void
	{
		$message = '';

		$action = trigger(UserOption\ShowAction::class, $this->options)->withResponse();

		if ($action->success) {
			$this->options = $action->data;
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
