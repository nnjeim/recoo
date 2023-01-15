<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\View\ViewController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Middleware\EnsureEmailIsVerified;
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
	Route::controller(Auth\AuthController::class)
		->group(function () {
			Route::get('login', 'showLoginForm')->name('login');
			Route::post('login', 'LoginUsingCredentials');
			Route::match(['get', 'post'], '/logout', 'logout')->name('logout');
		});
	// registration routes
	Route::controller(Auth\RegisterController::class)
		->group(function () {
			Route::get('register', 'showRegisterForm')->name('register');
		});
	require __DIR__ . '/partials/auth.php';

	/*
	|--------------------------------------------------------------------------
	| Authenticated routes
	|--------------------------------------------------------------------------
	*/
	Route::middleware('auth')
		->group(function () {
			/*
			|--------------------------------------------------------------------------
			| Password routes
			|--------------------------------------------------------------------------
			*/
			Route::controller(Auth\PasswordController::class)
				->group(function () {
					Route::get('confirm-password', 'show')->name('password.confirm');
					Route::post('confirm-password', 'store');
				});
			/*
			|--------------------------------------------------------------------------
			| Email verification routes
			|--------------------------------------------------------------------------
			*/
			Route::controller(Auth\EmailVerificationController::class)
				->group(function () {
					// verify email view
					Route::get('verify-email', 'showVerificationEmailForm')->name('verification.notice');
					// resend verification email action
					Route::post('email/verification-notification', 'resendVerificationEmail')
						->middleware('throttle:6,1')
						->name('verification.send');
					// verify email action
					Route::get('verify-email/{id}/{hash}', 'verifyEmail')
						->middleware(['signed', 'throttle:6,1'])
						->name('verification.verify');
				});
			/*
			|--------------------------------------------------------------------------
			| Verified routes
			|--------------------------------------------------------------------------
			*/
			Route::middleware(EnsureEmailIsVerified::class)
				->group(function () {
					// dashboard
					Route::get('/dashboard', ViewController::class)->name('dashboard');
					// profile
					Route::group([
						'prefix' => 'profile',
						'as' => 'profile.',
					], function () {
						Route::get('/', [ProfileController::class, 'index'])->name('index');
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
});
