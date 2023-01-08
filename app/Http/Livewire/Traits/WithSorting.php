<?php

namespace App\Http\Livewire\Traits;

trait WithSorting
{
	public string $sortBy = 'id';

	public string $sortDirection = 'desc';

	public function sortBy($field): void
	{
		$this->sortDirection = $this->sortBy === $field
			? $this->reverseSort()
			: 'asc';

		$this->sortBy = $field;

		// Call afterUpdatedSorting "event" callback, if it's set in the class.
		if (method_exists($this, 'afterUpdatedSorting')) {
			$this->afterUpdatedSorting();
		}
	}

	public function reverseSort(): string
	{
		return $this->sortDirection === 'asc'
			? 'desc'
			: 'asc';
	}
}
