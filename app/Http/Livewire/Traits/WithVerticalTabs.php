<?php

namespace App\Http\Livewire\Traits;

use Illuminate\Validation\Validator;

trait WithVerticalTabs
{

	/**
	 * @param  Validator  $validator
	 * @return $this
	 */
	public function setTabsErrors(Validator $validator): self
	{
		$errors = $validator->errors()->toArray();
		$errorKeys = array_keys($errors);

		// Iterate through tabs to set correct error tabs.
		foreach ($this->tabs as &$tab) {
			// Reset tab errors.
			$tab['error'] = false;

			// Skip to next records, if there are no errors.
			if (! $errors) {
				continue;
			}

			foreach ($tab['fields'] as $field) {
				// Prepare the field name for a regex pattern.
				// I.e. record.definitions.*.short_name => record\.definitions\.[^.]*\.short_name
				$pattern = str_replace('\*', '[^.]*', preg_quote($field));

				if (preg_grep("/^$pattern\$/i", $errorKeys)) {
					$tab['error'] = true;
					break;
				}
			}
		}

		return $this;
	}

	/**
	 * @return $this
	 */
	public function initTabs(): self
	{
		if (count($this->tabs)) {
			foreach ($this->tabs as &$tab) {
				$tab['title'] = __($tab['title']);
				$tab['description'] = __($tab['description']);
			}
		}

		return $this;
	}
}
