<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class Register extends Component
{
	/**
	 * Handle an incoming registration request.
	 *
	 * @param  Request  $request
	 * @return RedirectResponse
	 *
	 * @throws ValidationException
	 */
	public function store(Request $request): RedirectResponse
	{
		$request->validate([
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
			'password' => ['required', 'confirmed', Rules\Password::defaults()],
		]);

		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
		]);

		event(new Registered($user));

		Auth::login($user);

		return redirect(RouteServiceProvider::HOME);
	}

	public function render()
	{
		return view('components.register.index');
	}
}
