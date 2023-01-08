<?php

namespace App\Http\Livewire\Users\Traits\Index;

trait GettersTrait
{
	protected function getQueryArgs(): array
	{
		$isNotNull = fn ($value) => ! is_null($value);

		// Add filters and sorting.
		$queryArgs = [
			'filters' => $this->filters,
			'sortBy' => $this->sortBy,
			'sortOrder' => $this->sortDirection,
			'selectedRecords' => $this->selectedRecords,
		];

		// Remove empty values.
		$queryArgs['filters'] = array_filter($queryArgs['filters'], $isNotNull);

		return array_filter($queryArgs, $isNotNull);
	}

	public function getExportUrlProperty(): string
	{
		$queryArgs = $this->getQueryArgs();

		// Build export URL with filters and sorting.
		$exportUrl = rtrim(config('constants.API_URL'), DIRECTORY_SEPARATOR) . '/users/export';

		if ($queryArgs) {
			$exportUrl .= '?' . http_build_query($queryArgs);
		}

		return $exportUrl;
	}

	/**
	 * @return void
	 */
	public function getPersistedProps(): void
	{
		// persist
		if ($this->getPersisted('perPage')) {
			$this->perPage = $this->getPersisted('perPage');
		}

		if ($this->getPersisted('selectedRecords')) {
			$this->selectedRecords = $this->getPersisted('selectedRecords');
		}

		if ($this->getPersisted('showDeleted')) {
			$this->showDeleted = $this->getPersisted('showDeleted');
		}

		$this
			->syncKey('filters')
			->syncKey('sortBy')
			->syncKey('sortDirection');

		// filters init
		$this->filters += self::INIT_FILTERS;
	}
}
