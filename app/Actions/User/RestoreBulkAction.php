<?php

namespace App\Actions\User;

use App\Actions\User\Base\BaseUserAction;
use App\Http\Response\ResponseBuilder;
use App\Actions\User\RestoreAction;

class RestoreBulkAction extends BaseUserAction
{
	protected string $action = 'restore';

	/**
	 * @param  array  $args
	 * @return $this
	 */
	public function execute(array $args = [])
	{
		['ids' => $ids] = $args;

		$data = [];
		foreach ($ids as $id) {
			$action = trigger(RestoreAction::class, ['id' => $id]);
			$data[] = [
				'id' => $id,
				'success' => $action->success,
			];
			if ($action->success) {
				$this->restoredCount++;
			}
		}

		$this->success = $this->restoredCount > 0;
		$this->data = $data;

		return $this;
	}

	/**
	 * @return ResponseBuilder
	 */
	public function withResponse(): ResponseBuilder
	{
		return ResponseBuilder::make()
			->setSuccess($this->success)
			->setActionMessage(
				$this->action,
				$this->attribute,
				$this->success,
				$this->restoredCount > 1,
				[
					'restoredCount' => $this->restoredCount,
					'totalCount' => count($this->data),
				]
			)
			->setErrors()
			->setStatusAccepted();
	}
}
