<?php

namespace App\Actions\Record;

use App\Actions\Record\Base\BaseRecordAction;
use App\Actions\Record\Transformers\ShowTransformer;
use App\Events\Record\RecordUpdatedEvent;
use App\Http\Response\ResponseBuilder;
use App\Models\Record;
use Illuminate\Support\Facades\DB;

class UpdateAction extends BaseRecordAction
{
	use ShowTransformer;

	protected string $action = 'update';

	/**
	 * @param  array  $args
	 * @return $this
	 */
	public function execute(array $args = [])
	{
		// exists
		$recordBuilder = $this->validateModel($args);

		// transaction
		DB::beginTransaction();
		try {
			$record = tap(
				$recordBuilder->first(),
				function (Record $record) use ($args) {
					// update record
					$record->update($args);
				}
			);

			DB::commit();
			$this->success = true;
		} catch (Exception $e) {
			DB::rollback();
			throw $e;
		}

		// post action
		$this->postAction($record);

		$this->data = $this->success
			? $this->transform($record->refresh())
			: [];

		return $this;
	}

	/**
	 * @param Record $record
	 */
	private function postAction(Record $record): void
	{
		if ($this->success) {
			// event
			event(new RecordUpdatedEvent($record));
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
			->setData($this->data)
			->setErrors()
			->setStatusOk();
	}
}
