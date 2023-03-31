<?php

namespace App\Http\Livewire\Settings\Traits\Index;

use Illuminate\Validation\Validator;

trait ValidationTrait
{
	/**
	 * @return Validator
	 */
	protected function validateTenantOptions(): Validator
	{
		$transRequired = fn (string $label) => trans('settings.errors.required', [
			'attribute' => strtolower(trans('settings.general.options.' . $label)),
		]);

		$transMin = fn (string $label, int $number) => trans('settings.errors.min', [
			'attribute' => strtolower(trans('settings.general.options.' . $label)),
			'number' => $number,
		]);

		$rules = [
			'tenantOptions.name' => 'required|min:5',
			'tenantOptions.address1' => 'required',
			'tenantOptions.address2' => 'sometimes',
			'tenantOptions.phone' => 'required',
			'tenantOptions.graphics.logo.url' => 'required',
			'tenantOptions.currency.options' => 'required',
			'tenantOptions.currency.default' => 'required',
		];

		$messages = [
			'tenantOptions.name.required' => $transRequired('info.name'),
			'tenantOptions.name.min' => $transMin('info.name', 5),
			'tenantOptions.address1.required' => $transRequired('info.address1'),
			'tenantOptions.phone.required' => $transRequired('info.phone'),
			'tenantOptions.graphics.logo.url.required' => $transRequired('graphics.logo'),
			'tenantOptions.currency.options.required' => $transRequired('currency.curencies'),
			'tenantOptions.currency.default.required' => $transRequired('currency.default'),
		];

		$this->resetErrorBag();

		return \Illuminate\Support\Facades\Validator::make(['tenantOptions' => $this->tenantOptions], $rules, $messages);
	}

	/**
	 * @return Validator
	 */
	protected function validateImportOptions(): Validator
	{
		$transRequired = fn (string $label) => trans('settings.errors.required', [
			'attribute' => strtolower(trans('settings.general.options.' . $label)),
		]);

		$transMin = fn (string $label, int $number) => trans('settings.errors.min', [
			'attribute' => strtolower(trans('settings.general.options.' . $label)),
			'number' => $number,
		]);

		$rules = [
			'importOptions.import.file_extensions' => 'required',
			'importOptions.import.max_upload_file_size' => 'required',
			'importOptions.import.storage.disk' => 'required',
			'importOptions.import.storage.folder' => 'required',
		];

		$messages = [
			'importOptions.import.file_extensions.required' => $transRequired('import.file_extensions'),
			'importOptions.import.max_upload_file_size.required' => $transRequired('import.max_upload_file_size'),
			'importOptions.import.storage.disk.required' => $transRequired('import.storage.disk'),
			'importOptions.import.storage.folder.required' => $transRequired('import.storage.folder'),
		];

		$this->resetErrorBag();

		return \Illuminate\Support\Facades\Validator::make(['importOptions' => $this->importOptions], $rules, $messages);
	}

	/**
	 * @return Validator
	 */
	protected function validateExportOptions(): Validator
	{
		$transRequired = fn (string $label) => trans('settings.errors.required', [
			'attribute' => strtolower(trans('settings.general.options.' . $label)),
		]);

		$transMin = fn (string $label, int $number) => trans('settings.errors.min', [
			'attribute' => strtolower(trans('settings.general.options.' . $label)),
			'number' => $number,
		]);

		$rules = [
			'exportOptions.export.file_extension' => 'required',
		];

		$messages = [
			'exportOptions.export.file_extension.required' => $transRequired('export.file_extension'),
		];

		$this->resetErrorBag();

		return \Illuminate\Support\Facades\Validator::make(['exportOptions' => $this->exportOptions], $rules, $messages);
	}

	/**
	 * @param Validator $validator
	 * @return void
	 */
	public function displayErrors(Validator $validator)
	{
		if ($validator->errors()->count()) {
			foreach ($validator->errors()->messages() as $key => $message) {
				$this->addError($key, $message[0]);
			}
		}
	}
}
