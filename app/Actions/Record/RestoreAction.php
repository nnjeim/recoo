<?php

namespace App\Actions\Record;

use App\Actions\Record\Base\BaseRecordAction;
use App\Events\Record\RecordRestoredEvent;
use App\Http\Response\ResponseBuilder;
use App\Models\Record;
use Illuminate\Support\Facades\DB;

class RestoreAction extends BaseRecordAction
{
	protected string $action = 'restore';

	/**
	 * @param  array  $args
	 * @return $this
	 */
	public function execute(array $args = [])
	{
		$record = null;

		// exist
		$recordBuilder = $this->validateModel($args + ['showDeleted' => true]);

		// transaction
		DB::beginTransaction();
		try {
			$record = $recordBuilder->first();

			if (! $record->trashed()) {
				$this->unprocessableAction($this->action, $this->attribute);
			}

			$record->restore();

			DB::commit();
			$this->success = true;
		} catch (Exception $e) {
			DB::rollback();
			throw $e;
		}

		// post action
		$this->postAction($record);

		return $this;
	}

	/**
	 * @param Record $record
	 */
	private function postAction(Record $record): void
	{
		if ($this->success) {
			// event
			event(new RecordRestoredEvent($record));
		}
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
