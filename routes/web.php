<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\View\ViewController;
use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::middleware([
	'web',
])->group(function () {
	// redirect
	Route::redirect('/', '/dashboard', 301)->name('home');
	// auth routes
	Route::controller(AuthController::class)
		->group(function () {
			Route::get('login', 'showLoginForm')->name('login');
			Route::post('login', 'LoginUsingCredentials');
			Route::match(['get', 'post'], '/logout', 'logout')->name('logout');
		});
	require __DIR__ . '/partials/auth.php';
// authenticated routes ------------------------------------------------------------------------------------------*/
	Route::middleware('auth')
		->group(function () {
			// verified routes
			Route::middleware('verified')
				->group(function () {
					// dashboard
					Route::get('/dashboard', ViewController::class)->name('dashboard');
				});
			// profile
			Route::group([
				'prefix' => 'profile',
				'as' => 'profile.',
			], function () {
				Route::get('/', ViewController::class)->name('edit');
				Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
			});
			// users
			Route::group([
				'prefix' => 'users',
				'as' => 'users.',
			], function () {
				Route::get('/', ViewController::class)->name('index');
				Route::get('/{id}', ViewController::class)->where('id', '[0-9]+')->name('edit');
				Route::get('/create', ViewController::class)->name('store');
				Route::get('/options', ViewController::class)->name('options');
			});
			// records
			Route::group([
				'prefix' => 'records',
				'as' => 'records.',
			], function () {
				Route::get('/', ViewController::class)->name('index');
				Route::get('/{id}', ViewController::class)->where('id', '[0-9]+')->name('edit');
				Route::get('/create', ViewController::class)->name('store');
			});
		});
});
