<?php

namespace App\Actions\Record;

use App\Actions\Record\DestroyAction;
use App\Actions\Record\Base\BaseRecordAction;
use App\Http\Response\ResponseBuilder;

class DestroyBulkAction extends BaseRecordAction
{
	protected string $action = 'destroyBulk';

	private int $deletedCount = 0;

	/**
	 * @param  array  $args
	 * @return $this
	 */
	public function execute(array $args = []): self
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
				action: $this->action,
				attribute: $this->attribute,
				success: $this->success,
				plural: $this->deletedCount > 1,
				additionalAttributes: [
					'deletedCount' => $this->deletedCount,
					'totalCount' => count($this->data),
				]
			)
			->setData($this->data)
			->setErrors()
			->setStatusAccepted();
	}
}
