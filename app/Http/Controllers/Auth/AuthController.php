<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUsingCredentialsRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Factory as ViewFactory;

class AuthController extends Controller
{
	private ViewFactory $viewFactory;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(ViewFactory $viewFactory)
	{
		$this->middleware('guest')->except('logout');

		$this->viewFactory = $viewFactory;
	}

	/**
	 * Display the login view.
	 *
	 * @return View
	 */
	public function showLoginForm(): View
	{
		if (!session()->has('url.intended')) {
			$url = str_contains(url()->previous(), config('app.url')) ? url()->previous() : RouteServiceProvider::HOME;

			session(['url.intended' => $url]);
		}

		return $this->viewFactory->make('auth.login');
	}

	/**
	 * Handle an incoming authentication request.
	 *
	 * @param  LoginUsingCredentialsRequest  $request
	 * @return RedirectResponse
	 */
	public function LoginUsingCredentials(LoginUsingCredentialsRequest $request): RedirectResponse
	{
		$request->authenticate();

		$request->session()->regenerate();

		return redirect()->intended(RouteServiceProvider::HOME);
	}

	/**
	 * Destroy an authenticated session.
	 *
	 * @param  Request  $request
	 * @return RedirectResponse
	 */
	public function logout(Request $request): RedirectResponse
	{
		Auth::guard('web')->logout();

		$request->session()->invalidate();

		$request->session()->regenerateToken();

		return redirect('/');
	}
}
