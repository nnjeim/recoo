<?php

namespace App\Actions\Record;

use App\Actions\Record\Base\BaseRecordAction;
use App\Http\Response\ResponseBuilder;
use App\Actions\Record\RestoreAction;

class RestoreBulkAction extends BaseRecordAction
{
	protected string $action = 'restore';

	private int $restoredCount = 0;

	/**
	 * @param  array  $args
	 * @return $this
	 */
	public function execute(array $args = []): self
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
				action: $this->action,
				attribute: $this->attribute,
				success: $this->success,
				plural: $this->restoredCount > 1,
				additionalAttributes: [
					'restoredCount' => $this->restoredCount,
					'totalCount' => count($this->data),
				]
			)
			->setErrors()
			->setStatusAccepted();
	}
}
