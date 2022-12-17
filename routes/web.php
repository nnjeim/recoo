<?php

use App\Http\Controllers\Module\ModuleController;
use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
// redirect
Route::redirect('/', '/dashboard', 301)->name('home');
// auth routes
require __DIR__ . '/partials/auth.php';
// authenticated routes
Route::middleware('auth')
	->group(function () {
		// verified routes
		Route::middleware('verified')
			->group(function () {
				// dashboard
				Route::get('/dashboard', [ModuleController::class, 'builder'])->name('dashboard');
			});
		// profile
		Route::group([
			'prefix' => 'profile',
			'as' => 'profile.',
		],function () {
			Route::get('/', [ModuleController::class, 'builder'])->name('edit');
			Route::patch('/', [ProfileController::class, 'update'])->name('update');
			Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
		});
		// users
		Route::group([
			'prefix' => 'users',
			'as' => 'users.',
		],function () {
			Route::get('/', [ModuleController::class, 'builder'])->name('index');
			Route::get('/{id}', [ModuleController::class, 'builder'])->where('id', '[0-9]+')->name('edit');
			Route::get('/create', [ModuleController::class, 'builder'])->name('store');
			Route::get('/options', [ModuleController::class, 'builder'])->name('options');
		});
		// records
		Route::group([
			'prefix' => 'records',
			'as' => 'records.',
		],function () {
			Route::get('/', [ModuleController::class, 'builder'])->name('index');
			Route::get('/{id}', [ModuleController::class, 'builder'])->where('id', '[0-9]+')->name('edit');
			Route::get('/create', [ModuleController::class, 'builder'])->name('store');
		});
	});
