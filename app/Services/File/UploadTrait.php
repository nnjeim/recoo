<?php

namespace App\Services\File;

use App\Exceptions\UnprocessableException;
use Illuminate\Http\UploadedFile;

trait UploadTrait
{
	protected array $config = [
		'allowed_extensions' => [],
	];

	/**
	 * @param string $allowedExtensions
	 * @return $this
	 */
	protected function setAllowedExtensions(string $allowedExtensions): self
	{
		$this->config['allowed_extensions'] = array_map('strtolower', explode(',', $allowedExtensions));

		return $this;
	}

	/**
	 * @param string $extension
	 * @return bool
	 */
	protected function validateMediaExtension(string $extension): bool
	{
		return in_array(strtolower($extension), $this->config['allowed_extensions']);
	}

	/**
	 * @param  UploadedFile  $file
	 * @return void
	 * @throws UnprocessableException
	 */
	protected function validateFile(UploadedFile $file): void
	{
		if (! $file->isValid()) {
			throw new UnprocessableException(
				trans('response.validations.file.invalid')
			);
		}
	}

	/**
	 * @param  string  $extension
	 * @param  string  $allowedExtensions
	 * @return void
	 * @throws UnprocessableException
	 */
	protected function validateFileType(string $extension, string $allowedExtensions): void
	{
		$this->setAllowedExtensions($allowedExtensions);

		if (! $this->validateMediaExtension($extension)) {
			throw new UnprocessableException(
				trans('response.validations.file.invalid_type')
			);
		}
	}

	/**
	 * @param  float  $originalFileSize
	 * @param  float  $max_upload_file_size
	 * @return void
	 * @throws UnprocessableException
	 */
	protected function validateFileSize(float $originalFileSize, float $max_upload_file_size): void
	{
		if ($originalFileSize > $max_upload_file_size) {
			throw new UnprocessableException(
				trans('response.validations.file.invalid_size', [
					'attribute' => $max_upload_file_size,
				])
			);
		}
	}
}
