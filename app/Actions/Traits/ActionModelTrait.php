<?php

namespace App\Actions\Traits;

use App\Actions\BaseAction;
use App\Exceptions\RecordNotFoundException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

trait ActionModelTrait
{
	public Builder $query;

	protected string $class;

	protected string $attribute;

	protected array $args = [];

	protected array $with = [];

	protected array $where = [];

	protected string $field = 'id';

	protected string $value = 'id';

	protected array $additionalFields = [];

	private string $withoutScopeKey = '';

	/**
	 * @param array $args
	 * @return ActionModelTrait|BaseAction
	 */
	protected function setArguments(array $args): self
	{
		$this->args = $args;

		return $this;
	}

	/**
	 * @param string $field
	 * @return ActionModelTrait|BaseAction
	 */
	protected function setField(string $field): self
	{
		$this->field = $field;

		return $this;
	}

	/**
	 * @param string $value
	 * @return ActionModelTrait|BaseAction
	 */
	protected function setValue(string $value): self
	{
		$this->value = $value;

		return $this;
	}

	protected function setIndex(string $index): self
	{
		$this->field = $this->value = $index;

		return $this;
	}

	/**
	 * @param array $additionalFields
	 * @return ActionModelTrait|BaseAction
	 */
	protected function setAdditionalFields(array $additionalFields = []): self
	{
		$this->additionalFields = $additionalFields;

		return $this;
	}

	/**
	 * @param array $where
	 * @return ActionModelTrait|BaseAction
	 */
	protected function where(array $where): self
	{
		$this->where = $where;

		return $this;
	}

	/**
	 * @param $relations
	 * @return ActionModelTrait|BaseAction
	 */
	protected function with($relations): self
	{
		$this->with = is_array($relations) ? $relations : func_get_args();

		return $this;
	}

	/**
	 * @return ActionModelTrait|BaseAction
	 */
	private function setClauses(): self
	{
		$where = [];

		if (! empty($this->args)) {
			$where[] = [$this->args['field'] ?? $this->field, '=', $this->args['value'] ?? $this->args[$this->value]];

			if (! empty($this->additionalFields)) {
				foreach ($this->additionalFields as $field) {
					$where[] = [$field, '=', $this->args[$field]];
				}
			}
		}

		$wheres = array_merge($this->where, $where);

		if ($this->withoutScopeKey) {
			$this->query->withoutGlobalScope($this->withoutScopeKey);
		}

		if (! empty($wheres)) {
			$this->query->where($wheres);
		}

		return $this;
	}

	/**
	 * @return ActionModelTrait|BaseAction
	 */
	private function newQuery(): self
	{
		[
			'showDeleted' => $showDeleted,
		] = $this->args + [
			'showDeleted' => false,
		];

		$this->query = app($this->class)->newQuery();

		if ($showDeleted) {
			$this->query->withTrashed();
		}

		return $this;
	}

	/**
	 * @return ActionModelTrait|BaseAction
	 */
	private function eagerLoad(): self
	{
		foreach ($this->with as $relation) {
			$this->query->with($relation);
		}

		return $this;
	}

	/**
	 * @return ActionModelTrait|BaseAction
	 */
	private function unsetClauses(): self
	{
		$this->args = [];
		$this->where = [];
		$this->with = [];

		return $this;
	}

	/**
	 * @return Builder
	 */
	private function formBuilder(): Builder
	{
		$this->newQuery()->eagerLoad()->setClauses();

		return $this->query;
	}

	/**
	 * @return Collection
	 */
	protected function get(): Collection
	{
		return $this->formBuilder()->get();
	}

	/**
	 * @return Model
	 */
	protected function first(): Model
	{
		return $this->formBuilder()->first();
	}

	/**
	 * @param string $key
	 * @return ActionModelTrait|BaseAction
	 */
	protected function withoutGlobalScope(string $key): self
	{
		$this->withoutScopeKey = $key;

		return $this;
	}

	/**
	 * @param array|null $args
	 * @return Builder
	 * @throws RecordNotFoundException
	 */
	protected function validateModel(?array $args = null): Builder
	{
		if ($args !== null) {
			$this->setArguments($args);
		}

		if (! $this->formBuilder()->exists()) {
			$this->modelNotFound($this->attribute);
		}

		return $this->formBuilder();
	}

	/**
	 * @param array|null $args
	 * @return Builder
	 */
	protected function formModelBuilder(?array $args = null): Builder
	{
		if ($args !== null) {
			$this->setArguments($args);
		}

		return $this->formBuilder();
	}
}
