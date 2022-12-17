<?php

namespace App\Actions\Traits;

use App\Actions\ModuleOption;
use App\Actions\ModuleSetting;
use Illuminate\Support\Facades\Auth;

trait ActionHelpersTrait
{
	/**
	 * @param array $args
	 * @return string
	 */
	protected function getDeleteMode(array $args): string
	{
		['mode' => $mode] = $args + ['mode' => 'soft'];

		if (Auth::id() === 1) {
			return $mode;
		}

		return 'soft';
	}

	protected function setErrors(string $message)
	{
		return [
			'message' => [$message],
		];
	}
}
