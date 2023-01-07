<?php

namespace App\Http\Livewire\Users\Traits\Index;

trait SettersTrait
{
	/**
	 * Lifecycle method triggered when the filters property is updated.
	 * @return void
	 */
	public function updatedFilters(): void
	{
		$this->persist('filters', $this->filters);
		$this->resetPage();
		$this->exportUrlProperty();
	}

	/**
	 * Method to control the show delete records button visibility.
	 * @param  bool  $value
	 * @return void
	 */
	public function setShowDeleted(bool $value = true): void
	{
		$this->showDeleted = $value;

		$this->persist('showDeleted', $this->showDeleted);
	}

	/**
	 * Method to select the current page records.
	 * @return void
	 */
	public function selectPageRecords(): void
	{
		$this->selectedRecords = $this->pageRecords;
	}

	/**
	 * Method to unselect all records.
	 * @return void
	 */
	public function unselectAllRecords(): void
	{
		$this->forget(['selectedRecords']);

		$this->reset(['selectedRecords']);
	}

	/**
	 * Method to reset the filters array.
	 * @return void
	 */
	public function clearFilters(): void
	{
		$this->reset(['filters']);
		$this->forget(['filters']);
		$this->resetPage();

		$this->exportUrlProperty();
	}

	/**
	 * Method to reset the overall state properties.
	 * @return void
	 */
	public function initState(): void
	{
		$this->reset(['filters', 'selectedRecords', 'sortBy', 'sortDirection', 'showDeleted']);
		$this->forget(['filters', 'selectedRecords', 'sortBy', 'sortDirection', 'showDeleted']);
		$this->resetPage();
		$this->exportUrlProperty();
	}

	/**
	 * Method to toggle the selection status of a record.
	 * @param  int  $id
	 * @return void
	 */
	public function toggleSelect(int $id): void
	{
		$selectedRecords = $this->selectedRecords;

		$index = array_search($id, $selectedRecords);

		if ($index !== false) {
			unset($selectedRecords[$index]);
		} else {
			$selectedRecords[] = $id;
		}

		$this->selectedRecords = array_values($selectedRecords);

		$this->exportUrlProperty();
	}

	/**
	 * Method to set the confirmation deletion modal visibility.
	 * @param  int|null  $id
	 * @return void
	 */
	public function confirmRecordDeletion(?int $id = null): void
	{
		if ($id !== null) {
			$this->toggleSelect($id);
		}

		$this->confirmingRecordDeletion = true;
	}

	/**
	 * Method to set bulk actions.
	 * @return void
	 */
	public function setBulkActions(): void
	{
		$restoreActionExists = array_search('restoreRecords', $this->bulkActions);

		if ($this->filters['deleted'] && ! $restoreActionExists) {
			$this->bulkActions = [
				... $this->bulkActions,
				... ['restoreRecords'],
			];
			return;
		}

		$this->reset(['bulkActions']);
	}
}
