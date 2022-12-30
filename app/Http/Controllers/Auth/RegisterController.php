<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Contracts\View\View;
use Illuminate\View\Factory as ViewFactory;

class RegisterController
{
	private ViewFactory $viewFactory;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(ViewFactory $viewFactory)
	{
		$this->viewFactory = $viewFactory;
	}

    /**
     * Display the registration view.
     *
	 * @return View
     */
    public function showRegisterForm(): View
    {
		return $this
			->viewFactory
			->make('auth.register');
    }
}
