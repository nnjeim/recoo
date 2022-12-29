<?php

namespace App\Http\Livewire\Records\Traits\Store;

use App\Actions\Omdb\FetchAction;
use App\Actions\Record;

trait ActionsTrait
{
	/**
	 * Method to search a record by imdb id or other search criteria.
	 * @return void
	 */
	public function searchImdb()
	{
		if (empty($this->imdb_search)) {
			return;
		}

		$action = trigger(FetchAction::class, [$this->imdb_search_type => $this->imdb_search])->withResponse();

		if ($action->success) {
			$this->imdb_records = [];

			if ($this->imdb_search_type === 'i') {
				$this->imdb_records[] = $this->formatRecord($action->data);
			}

			if ($this->imdb_search_type === 's') {
				foreach ($action->data['Search'] as $data) {
					$this->imdb_records[] = $this->formatRecord($data);
				}
			}

			return;
		}
		// error handling
		$message = '';

		$this->reset(['imdb_records']);

		foreach ($action->errors as $key => $error) {
			$message = $error[0];
		}

		// notification
		$this->notifyAction(false, $message);
	}

	/**
	 * Method to fetch an imdb record by id.
	 * @param  string  $imdb_id
	 * @return void
	 */
	public function applyImdbRecord(string $imdb_id)
	{
		$message = 'The record was successfully applied';

		$action = trigger(FetchAction::class, ['i' => $imdb_id]);

		if ($action->success) {
			$this->record = $this->formatRecord($action->data);

			$this->activeTab = 'info';
		}

		if ($action->errors) {
			foreach ($action->errors as $key => $error) {
				$message = $error[0];
			}
		}

		// notification
		$this->notifyAction($action->success, $message);
	}

	/**
	 * Method to store a record.
	 * @return void
	 */
	public function storeRecord()
	{
		$message = '';

		$validator = $this->validateRecord();

		$this->setTabsErrors($validator);

		$this->displayErrors($validator);

		if ($validator->fails()) {
			return;
		}

		$action = trigger(Record\StoreAction::class, $this->record)->withResponse();

		if ($action->success) {
			$message = $action->message;
			// notification
			$this->notifyAction($action->success, $message);

			return redirect()->route('records.edit', ['id' => $action->data['id']]);
		}

		if ($action->errors) {
			foreach ($action->errors as $key => $error) {
				$message = $error[0];
			}
		}

		// notification
		$this->notifyAction($action->success, $message);
	}

	/**
	 * @param  array  $params
	 * @return array
	 */
	private function formatRecord(array $params): array
	{
		$formattedParams = [];

		array_walk($params, function($value, $key) use (&$formattedParams) {
			$formattedParams[strtolower($key)] = $value;
		});

		return [
			'title' => $formattedParams['title'],
			'imdb_id' => $formattedParams['imdbid'],
			'params' => $formattedParams,
		];
	}
}
