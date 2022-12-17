<?php

namespace App\Actions\User;

use App\Actions\User\Base\BaseUserAction;
use App\Http\Response\ResponseBuilder;
use Illuminate\Support\Facades\DB;

class RestoreAction extends BaseUserAction
{
	protected string $action = 'restore';

	/**
	 * @param  array  $args
	 * @return $this
	 */
	public function execute(array $args = [])
	{
		$user = null;

		// exist
		$userBuilder = $this->validateModel($args + ['showDeleted' => true]);

		// transaction
		DB::beginTransaction();
		try {
			$user = $userBuilder->first();

			if (! $user->trashed()) {
				$this->unprocessableAction($this->action, $this->attribute);
			}

			$user->restore();

			DB::commit();
			$this->success = true;
		} catch (Exception $e) {
			DB::rollback();
			throw $e;
		}

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
