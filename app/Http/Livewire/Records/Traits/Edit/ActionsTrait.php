<?php

namespace App\Http\Livewire\Records\Traits\Edit;

use App\Actions\Record;

trait ActionsTrait
{
	/**
	 * @return void
	 */
	public function showRecord(): void
	{
		$action = trigger(Record\ShowAction::class, ['id' => $this->recordId]);

		if ($action->success) {
			$this->record = $action->data->toArray();
		}
	}

	/**
	 * @return void
	 */
	public function updateRecord(): void
	{
		$message = '';

		$validator = $this->validateRecord();

		$this->setTabsErrors($validator);

		$this->displayErrors($validator);

		if ($validator->fails()) {
			return;
		}

		$action = trigger(Record\UpdateAction::class, $this->record)->withResponse();

		if ($action->success) {
			$message = $action->message;

			$this->emit('saved');
		}

		if ($action->errors) {
			foreach ($action->errors as $key => $error) {
				$message = $error[0];
			}
		}

		// notification
		$this->notifyAction($action->success, $message);
	}
}
