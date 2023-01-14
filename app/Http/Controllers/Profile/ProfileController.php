<?php

namespace App\Http\Controllers\Profile;

use App\Actions\Profile\DestroyAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Profile\DestroyRequest;

class ProfileController extends Controller
{
	/**
	 * @param DestroyRequest $request
	 * @return RedirectResponse|null
	 */
	public function destroy(DestroyRequest $request): RedirectResponse|null
    {
       $action = trigger(DestroyAction::class);

	   if ($action->success) {
		   return Redirect::to('/');
	   }

	   return null;
    }
}
