<?php

namespace App\Actions\ModuleOption;

use App\Actions\ModuleOption\Base\BaseModuleOptionAction;
use App\Http\Response\ResponseBuilder;
use App\Models\ModuleOption;
use Throwable;
use Illuminate\Support\Facades\DB;

class UpdateAction extends BaseModuleOptionAction
{
	protected string $action = 'update';

	/**
	 * @param  array  $args
	 * @return $this
	 * @throws Throwable
	 */
	public function execute(array $args = []): self
	{
		[
			'params' => $params,
			'optionable_type' => $optionable_type,
		] = $args;

		$moduleOptionBuilder = $this
			->setIndex('optionable_type')
			->validateModel($args);

		// transaction
		DB::beginTransaction();
		try {
			$moduleOption = tap(
				$moduleOptionBuilder->first(),
				function (ModuleOption $moduleOption) use ($params) {
					$moduleOption->update([
						'params' => $params,
					]);
				}
			);

			DB::commit();
		} catch (Throwable $e) {
			DB::rollback();
			throw $e;
		}

		$this->success = true;
		$this->data = $moduleOption;

		// post action
		$this->postAction($args);

		return $this;
	}

	/**
	 * @return void
	 */
	private function postAction(): void
	{
		if ($this->success) {
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
			->setActionMessage($this->action, $this->attribute, $this->success, true)
			->setData($this->data)
			->setErrors()
			->setStatusOk();
	}
}
