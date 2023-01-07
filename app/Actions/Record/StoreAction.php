<?php

namespace App\Actions\Record;

use App\Actions\Record\Base\BaseRecordAction;
use App\Actions\Record\Transformers\ShowTransformer;
use App\Events\Record\RecordStoredEvent;
use App\Http\Response\ResponseBuilder;
use App\Models\Record;
use Illuminate\Support\Facades\DB;
use Throwable;

class StoreAction extends BaseRecordAction
{
	use ShowTransformer;

	protected string $action = 'store';

	/**
	 * @param array $args
	 * @return $this
	 * @throws Throwable
	 */
	public function execute(array $args = []): self
	{
		// transaction
		DB::beginTransaction();
		try {
			$record = Record::create($args + ['user_id' => auth()->id()]);

			DB::commit();
		} catch (Throwable $e) {
			DB::rollback();
			throw $e;
		}

		$this->success = true;
		$this->data = $this->transform($record->refresh());

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
			event(new RecordStoredEvent($record));
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
			->setStatusCreated();
	}
}
