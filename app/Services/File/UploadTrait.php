<?php

namespace App\Services\File;

use App\Exceptions\UnprocessableException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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

	/**
	 * @param string $extension
	 * @return int|string
	 */
	protected function getMediaType(string $extension): int|string
	{
		$extensions = config('mimetypes.aggregate_types');

		$type = 'other';

		foreach ($extensions as $k => $v) {
			if (in_array($extension, $v['extensions'])) {
				$type = $k;
				break;
			}
		}

		return $type;
	}

	/**
	 * @param string $extension
	 * @return string
	 */
	protected function generateFileName(string $extension): string
	{
		return rand(11111, 99999) . '_' . now()->format('Ymd') . '.' . $extension;
	}

	/**
	 * @param  string  $disk
	 * @param  string|null  $folder
	 * @param  string|null  $file
	 * @return string
	 */
	protected function getFileUrl(
		string $disk,
		string $folder = null,
		?string $file = null
	): string {
		$path = trim($folder, DIRECTORY_SEPARATOR);
		$path .= $file !== null ? DIRECTORY_SEPARATOR . $file : null;

		return Storage::disk($disk)->url($path);
	}

	/**
	 * @param  string  $disk
	 * @param  string|null  $folder
	 * @param  string|null  $file
	 * @return string
	 */
	protected function getFilePath(
		string $disk,
		string $folder = null,
		?string $file = null
	): string {
		$path = trim($folder, DIRECTORY_SEPARATOR);
		$path .= $file !== null ? DIRECTORY_SEPARATOR . $file : null;

		return Storage::disk($disk)->path($path);
	}

	/**
	 * @param  string  $disk
	 * @param  string  $folderName
	 * @return $this
	 */
	protected function createFolder(string $disk, string $folderName): self
	{
		if (! Storage::disk($disk)->exists($folderName)) {
			Storage::disk($disk)->makeDirectory($folderName);
		}

		return $this;
	}

	/**
	 * @param  string  $disk
	 * @param string  $filePath
	 * @return void
	 */
	protected function deleteFile(string $disk, string $filePath): void
	{
		if (Storage::disk($disk)->exists($filePath)) {
			Storage::disk($disk)->delete($filePath);
		}
	}
}
