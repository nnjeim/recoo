<?php

namespace App\Actions\Record;

use App\Actions\Record\Base\BaseRecordAction;
use App\Events\Record\RecordDestroyedEvent;
use App\Exceptions\UnprocessableException;
use App\Http\Response\ResponseBuilder;
use App\Models\Record;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;
use Throwable;

class DestroyAction extends BaseRecordAction
{
	protected string $action = 'destroy';

	/**
	 * @param array $args
	 * @return $this
	 * @throws AuthorizationException
	 * @throws Throwable
	 * @throws UnprocessableException
	 */
	public function execute(array $args = []): self
	{
		// exists
		$recordBuilder = $this->validateModel($args + ['showDeleted' => true]);

		// delete mode
		$mode = $this->getDeleteMode($args);

		// transaction
		DB::beginTransaction();
		try {
			$record = $recordBuilder->first();

			if ($mode === 'force') {
				$record->forceDelete();
			} else {
				if ($record->trashed()) {
					$this->unprocessableAction($this->action, $this->attribute);
				}

				$record->delete();
			}

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
			event(new RecordDestroyedEvent($record));
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
