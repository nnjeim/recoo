<?php

namespace App\Actions\Profile;

use App\Actions\User\Base\BaseUserAction;
use App\Http\Response\ResponseBuilder;
use Illuminate\Support\Facades\Auth;

class DestroyAction extends BaseUserAction
{
	protected string $action = 'destroy';

	/**
	 * @param array|null $args
	 * @return $this
	 */
	public function execute(?array $args = []): self
	{
		$user = Auth::user();

		Auth::guard()->logout();

		$user->delete();

		request()->session()->invalidate();
		request()->session()->regenerateToken();

		$this->success = true;

		return $this;
	}

	/**
	 * @return ResponseBuilder
	 */
	public function withResponse(): ResponseBuilder
	{
		return ResponseBuilder::make()
			->setSuccess($this->success)
			->setActionMessage($this->action, $this->attribute, $this->success)
			->setErrors()
			->setStatusAccepted();
	}
}
