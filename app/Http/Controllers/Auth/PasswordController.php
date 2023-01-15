<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\Factory as ViewFactory;

class PasswordController extends Controller
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
	 * Show the confirm password view.
	 *
	 * @return Application|Factory|View
	 */
	public function show(): Application|Factory|View
	{
		return $this
			->viewFactory
			->make('auth.confirm-password');
	}

	/**
	 * Confirm the user's password.
	 *
	 * @param Request $request
	 * @return RedirectResponse
	 */
	public function store(Request $request): RedirectResponse
	{
		if (! Auth::guard('web')->validate([
			'email' => $request->user()->email,
			'password' => $request->password,
		])) {
			throw ValidationException::withMessages([
				'password' => __('auth.password'),
			]);
		}

		$request->session()->put('auth.password_confirmed_at', time());

		return redirect()->intended(RouteServiceProvider::HOME);
	}
}
