<?php

namespace App\Http\Livewire\Records\Traits\Edit;

use Illuminate\Validation\Validator;

trait ValidationTrait
{
	/**
	 * @param  Validator  $validator
	 * @return void
	 */
	public function displayErrors(Validator $validator): void
	{
		if ($validator->errors()->count()) {
			foreach ($validator->errors()->messages() as $key => $message) {
				$this->addError($key, $message[0]);
			}
		}
	}

	/**
	 * @return Validator
	 */
	protected function validateRecord(): Validator
	{
		$transRequired = fn (string $label) => trans('general.errors.required', [
			'attribute' => strtolower(trans('records.entity.' . $label)),
		]);

		$transMin = fn (string $label, int $number) => trans('general.errors.min', [
			'attribute' => strtolower(trans('records.entity.' . $label)),
			'number' => $number,
		]);

		$transMax = fn (string $label, int $number) => trans('general.errors.max', [
			'attribute' => strtolower(trans('records.entity.' . $label)),
			'number' => $number,
		]);

		$rules = [
			'record.title' => 'required|max:255',
			'record.params.year' => 'required|max:4',
			'record.imdb_id' => [
				'required',
				function ($attribute, $value, $fail) {
					if (! str_starts_with($value, 'tt')) {
						$fail(trans('general.errors.imdb_id_format_error'));
					}
				},
			],
			'record.params.genre' => 'required',
			'record.params.poster' => 'required|url',
		];

		$messages = [
			'record.title.required' => $transRequired('title'),
			'record.title.max' => $transMax('title', 255),
			'record.params.year.required' => $transRequired('url'),
			'record.params.year.max' => $transMax('year', 4),
			'record.imdb_id.required' => $transRequired('imdb_id'),
			'record.params.genre.required' => $transRequired('genre'),
			'record.params.poster.required' => $transRequired('poster'),
			'record.params.poster.url' => trans('general.errors.url'),
		];

		$this->resetErrorBag();

		return \Illuminate\Support\Facades\Validator::make(['record' => $this->record], $rules, $messages);
	}
}
