<?php

namespace App\Actions\User;

use App\Actions\User\DestroyAction;
use App\Actions\User\Base\BaseUserAction;
use App\Http\Response\ResponseBuilder;

class DestroyBulkAction extends BaseUserAction
{
	protected string $action = 'destroyBulk';

	private int $deletedCount = 0;

	/**
	 * @param  array  $args
	 * @return $this
	 */
	public function execute(array $args = [])
	{
		[
			'ids' => $ids ,
			'mode' => $mode,
		] = $args + [
			'mode' => '',
		];

		$data = [];
		foreach ($ids as $id) {
			$action = trigger(DestroyAction::class, compact('id', 'mode'));
			$data[] = [
				'id' => $id,
				'success' => $action->success,
			];
			if ($action->success) {
				$this->deletedCount++;
			}
		}

		$this->success = $this->deletedCount > 0;
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
				$this->deletedCount > 1,
				[
					'deletedCount' => $this->deletedCount,
					'totalCount' => count($this->data),
				]
			)
			->setData($this->data)
			->setErrors()
			->setStatusAccepted();
	}
}
