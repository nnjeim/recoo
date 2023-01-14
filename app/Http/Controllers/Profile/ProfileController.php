<?php

namespace App\Http\Controllers\Profile;

use App\Actions\Profile\DestroyAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\DestroyRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\Factory as ViewFactory;

class ProfileController extends Controller
{
	private ViewFactory $viewFactory;

	public function __construct(ViewFactory $viewFactory)
	{
		$this->viewFactory = $viewFactory;
	}

	/**
	 * @return View
	 */
	public function index(): View
	{
		return $this->viewFactory->make('profile.index');
	}

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
