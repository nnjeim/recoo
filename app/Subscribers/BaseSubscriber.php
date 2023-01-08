<?php

namespace App\Subscribers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

abstract class BaseSubscriber
{
	protected Model $model;

	protected string $label;

	protected array $body = [];

	protected array $click_action = [];

	/**
	 * @return void
	 */
	protected function log(): void
	{
		$user = $this->getUser();
		// log
		$this
			->model
			->logs()
			->create([
				'user_id' => $user?->id,
				'data' => [
					'label' => $this->label,
					'body' => $this->body + [
							'user_name' => $user?->name,
						],
					'click_action' => $this->click_action,
				],
			]);
	}

	/**
	 * @param  Model  $model
	 * @return $this
	 */
	protected function setModel(Model $model): static
	{
		$this->model = $model;

		return $this;
	}

	/**
	 * @param  string  $label
	 * @return $this
	 */
	protected function setLabel(string $label): static
	{
		$this->label = Str::snake($label);

		return $this;
	}

	/**
	 * @param  array  $body
	 * @return $this
	 */
	protected function setBody(array $body): static
	{
		$this->body = $body;

		return $this;
	}

	/**
	 * @param  array  $click_action
	 * @return $this
	 */
	protected function setClickAction(array $click_action): static
	{
		$this->click_action = $click_action;

		return $this;
	}

	protected function getUser(): User|null
	{
		if (Auth::check()) {
			return Auth::user();
		}

		if ($this->model instanceof User) {
			return $this->model;
		}
		// return superuser
		return $this->getSuperUser();
	}

	/**
	 * @return User
	 */
	protected function getSuperUser(): User
	{
		// return superuser
		return User::whereId(1)->first();
	}
}
