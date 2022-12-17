<?php

use App\Http\Controllers\Webhook\WebhookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
Route::post('/ci', [WebhookController::class, 'webhook'])->name('webhook');
