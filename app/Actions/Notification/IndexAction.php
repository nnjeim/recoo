<?php

namespace App\Actions\Notification;

use App\Actions\Notification\Base\BaseNotificationAction;
use App\Actions\Notification\Transformers\IndexTransformer;
use App\Http\Response\ResponseBuilder;
use Illuminate\Support\Facades\Auth;

class IndexAction extends BaseNotificationAction
{
	use IndexTransformer;

	/**
	 * @param array $args
	 * @return $this
	 */
	public function execute(array $args = []): self
	{
		$user = Auth::user();

		$this->success = true;
		$this->data = $this->transform($user->notifications);

		return $this;
	}

	/**
	 * @return ResponseBuilder
	 */
	public function withResponse(): ResponseBuilder
	{
		return ResponseBuilder::make()
			->setSuccess($this->success)
			->setAttributeMessage($this->attribute, true)
			->setData($this->data);
	}
}
