<?php

namespace App\Http\Controllers\View;

use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\View\View;
use Illuminate\View\Factory as ViewFactory;

class ViewController
{
	private ViewFactory $viewFactory;

	private string $routeName;

	public function __construct(ViewFactory $viewFactory)
	{
		$this->viewFactory = $viewFactory;

		$this->routeName = Route::currentRouteName();
	}

	/**
	 * @return View
	 */
	public function builder(): View
	{
		$dottedPath = $this->routeName . (! str_contains($this->routeName, '.') ? '.index' : '');

		return $this
			->viewFactory
			->make(
				$dottedPath,
				array_merge(Route::current()->parameters(), ['routeName' => $this->routeName])
			);
	}
}
