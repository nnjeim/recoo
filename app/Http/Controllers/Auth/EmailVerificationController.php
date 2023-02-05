<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
	/**
	 * Display the email verification prompt.
	 *
	 * @param  Request  $request
	 * @return Application|RedirectResponse|View|Factory
	 */
	public function showVerificationEmailForm(Request $request): Application|RedirectResponse|View|Factory
	{
		return $request->user()->hasVerifiedEmail() ? redirect()->intended(RouteServiceProvider::HOME) : view('auth.verify-email');
	}

	/**
	 * Mark the authenticated user's email address as verified.
	 *
	 * @param  Request  $request
	 * @return RedirectResponse
	 */
	public function resendVerificationEmail(Request $request): RedirectResponse
	{
		if ($request->user()->hasVerifiedEmail()) {
			return redirect()->intended(RouteServiceProvider::HOME);
		}

		$request->user()->sendEmailVerificationNotification();

		return back()->with('status', 'verification-link-sent');
	}

	/**
	 * Mark the authenticated user's email address as verified.
	 *
	 * @param  EmailVerificationRequest  $request
	 * @return RedirectResponse
	 */
	public function verifyEmail(EmailVerificationRequest $request): RedirectResponse
	{
		if ($request->user()->hasVerifiedEmail()) {
			return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
		}

		if ($request->user()->markEmailAsVerified()) {
			event(new Verified($request->user()));
		}

		return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
	}
}
