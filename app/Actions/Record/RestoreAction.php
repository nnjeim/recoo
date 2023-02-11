<?php

namespace App\Actions\Record;

use App\Actions\Record\Base\BaseRecordAction;
use App\Events\Record\RecordRestoredEvent;
use App\Exceptions\UnprocessableException;
use App\Http\Response\ResponseBuilder;
use App\Models\Record;
use Illuminate\Support\Facades\DB;
use Throwable;

class RestoreAction extends BaseRecordAction
{
	protected string $action = 'restore';

	/**
	 * @param array $args
	 * @return $this
	 * @throws Throwable
	 * @throws UnprocessableException
	 */
	public function execute(array $args = []): self
	{
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
		} catch (Throwable $e) {
			DB::rollback();
			throw $e;
		}

		$this->success = true;

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
			// cache
			$this->flushModuleCache();
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
