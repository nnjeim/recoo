<?php

namespace App\Actions\Record;

use App\Actions\Record\Base\BaseRecordAction;
use App\Http\Response\ResponseBuilder;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;

class DestroyAction extends BaseRecordAction
{
	protected string $action = 'destroy';

	/**
	 * @param  array  $args
	 * @return $this
	 */
	public function execute(array $args = [])
	{
		$record = null;

		['id' => $id] = $args;

		if ((int) $id === 1) {
			throw new AuthorizationException();
		}

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
