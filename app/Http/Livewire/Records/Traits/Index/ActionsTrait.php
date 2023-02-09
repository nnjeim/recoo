<?php

namespace App\Http\Livewire\Records\Traits\Index;

use App\Actions\Record;

trait ActionsTrait
{
	public function paginate()
	{
		$action = trigger(Record\PaginateAction::class, [
			'page' => $this->page,
			'sortBy' => $this->sortBy,
			'sortOrder' => $this->sortDirection,
			'perPage' => $this->perPage,
			'filters' => $this->filters,
		]);

		$paginator = $action->data;

		$isSelected = fn (int $id): bool => in_array($id, $this->selectedRecords);

		/*-- selected records --*/
		$this->pageRecords = [];

		$this->data = $paginator->getCollection()
			->each(fn ($record) => $this->pageRecords[] = $record['id'])
			->map(function ($record) use ($isSelected) {
				$record['selected'] = $isSelected($record['id']);

				return $record;
			});

		return $paginator;
	}

	/**
	 * @return void
	 */
	public function countTrashedRecords(): void
	{
		$action = trigger(Record\CountTrashedAction::class);

		$this->setShowDeleted($action->data > 0);
	}

	/**
	 * Method to select all filtered records.
	 * @return void
	 */
	public function selectAllRecords(): void
	{
		$action = trigger(
			Record\SelectAllAction::class,
			[
				'filters' => $this->filters,
			]
		);

		if ($action->success) {
			$this->selectedRecords = $action->data;
			// persist selected records.
			$this->persist('selectedRecords', $this->selectedRecords);
		}
	}

	/**
	 * Method to destroy records.
	 * @param  int|null  $id
	 * @return void
	 */
	public function destroyRecords(?int $id = null): void
	{
		// permission
		if (! can('destroy_record')) {
			$this->notifyAction(
				false,
				trans('partials/actions.destroy_failure', ['attribute' => trans_choice('partials/attributes.record', 1)])
			);
			return;
		}

		$message = '';

		$mode = empty($this->filters['deleted']) ? 'soft' : 'force';

		$action = $id === null
			? trigger(Record\DestroyBulkAction::class, [
					'ids' => $this->selectedRecords,
					'mode' => $mode,
				])
				->withResponse()
			: trigger(Record\DestroyAction::class, compact('id', 'mode'))
				->withResponse();

		if ($action->success) {
			$message = $action->message;

			$this->confirmingRecordDeletion = false;

			$this->resetPage();

			$this->unselectAllRecords();

			$this->emit('refreshLogs-ev');
		}

		if ($action->errors) {
			foreach ($action->errors as $key => $error) {
				$message = $error[0];
			}
		}
		/*-- notification --*/
		$this->notifyAction($action->success, $message);
	}

	/**
	 * Method to restore records.
	 * @param int|null $id
	 * @return void
	 */
	public function restoreRecords(?int $id = null): void
	{
		// permission
		if (! can('restore_record')) {
			$this->notifyAction(
				false,
				trans('partials/actions.restore_failure', ['attribute' => trans_choice('partials/attributes.record', 1)])
			);
			return;
		}

		$message = '';

		$action = $id === null
			? trigger(Record\RestoreBulkAction::class, [
					'ids' => $this->selectedRecords,
				])
				->withResponse()
			: trigger(Record\RestoreAction::class, compact('id'))
				->withResponse();

		if ($action->success) {
			$message = $action->message;

			$this->resetPage();

			$this->unselectAllRecords();

			$this->emit('refreshLogs-ev');
		}

		if ($action->errors) {
			foreach ($action->errors as $key => $error) {
				$message = $error[0];
			}
		}
		/*-- notification --*/
		$this->notifyAction($action->success, $message);
	}

	public function exportUrlProperty(): void
	{
		$this->dispatchBrowserEvent('setExportUrlProperty-ev', ['url' => $this->getExportUrlProperty()]);
	}
}
