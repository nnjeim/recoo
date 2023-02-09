<?php

namespace App\Http\Livewire\Users\Traits\Index;

use App\Actions\User;

trait ActionsTrait
{
	public function paginate()
	{
		$action = trigger(User\PaginateAction::class, [
			'page' => $this->page,
			'sortBy' => $this->sortBy,
			'sortOrder' => $this->sortDirection,
			'perPage' => $this->perPage,
			'filters' => $this->filters,
		]);

		$paginator = $action->data;

		$isSelected = fn (int $id): bool => in_array($id, $this->selectedRecords);

		/*-- selected users --*/
		$this->pageRecords = [];

		$this->data = $paginator->getCollection()
			->each(fn ($user) => $this->pageRecords[] = $user['id'])
			->map(function ($user) use ($isSelected) {
				$user['selected'] = $isSelected($user['id']);

				return $user;
			});

		return $paginator;
	}

	/**
	 * @return void
	 */
	public function countTrashedRecords(): void
	{
		$action = trigger(User\CountTrashedAction::class);

		$this->setShowDeleted($action->data > 0);
	}

	/**
	 * Method to select all filtered records.
	 * @return void
	 */
	public function selectAllRecords(): void
	{
		$action = trigger(
			User\SelectAllAction::class,
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
		if (! can('destroy_user')) {
			$this->notifyAction(
				false,
				trans('partials/actions.destroy_failure', ['attribute' => trans_choice('partials/attributes.user', 1)])
			);
			$this->confirmingRecordDeletion = false;
			return;
		}

		$message = '';

		$mode = empty($this->filters['deleted']) ? 'soft' : 'force';

		$action = $id === null
			? trigger(User\DestroyBulkAction::class, [
					'ids' => $this->selectedRecords,
					'mode' => $mode,
				])
				->withResponse()
			: trigger(User\DestroyAction::class, compact('id', 'mode'))
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
		if (! can('restore_user')) {
			$this->notifyAction(
				false,
				trans('partials/actions.restore_failure', ['attribute' => trans_choice('partials/attributes.user', 1)])
			);
			$this->confirmingRecordDeletion = false;
			return;
		}

		$message = '';

		$action = $id === null
			? trigger(User\RestoreBulkAction::class, [
					'ids' => $this->selectedRecords,
				])
				->withResponse()
			: trigger(User\RestoreAction::class, compact('id'))
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
