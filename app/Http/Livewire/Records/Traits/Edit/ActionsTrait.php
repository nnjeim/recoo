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
		// permission
		if (! can('show_record')) {
			$this->notifyAction(
				false,
				trans('partials/actions.show_failure', ['attribute' => trans_choice('partials/attributes.record', 1)])
			);
			return;
		}

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
		// permission
		if (! can('update_record')) {
			$this->notifyAction(
				false,
				trans('partials/actions.update_failure', ['attribute' => trans_choice('partials/attributes.record', 1)])
			);
			return;
		}

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
