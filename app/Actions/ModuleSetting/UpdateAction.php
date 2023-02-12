<?php

namespace App\Actions\ModuleSetting;

use App\Actions\ModuleSetting\Base\BaseModuleSettingAction;
use App\Http\Response\ResponseBuilder;
use App\Models\ModuleSetting;
use Throwable;
use Illuminate\Support\Facades\DB;

class UpdateAction extends BaseModuleSettingAction
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
			'settable_type' => $settable_type,
		] = $args;

		$moduleSettingBuilder = $this
			->setIndex('settable_type')
			->validateModel($args);

		// transaction
		DB::beginTransaction();
		try {
			$moduleSetting = tap(
				$moduleSettingBuilder->first(),
				function (ModuleSetting $moduleSetting) use ($params) {
					$moduleSetting->update([
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
		$this->data = $moduleSetting;

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
