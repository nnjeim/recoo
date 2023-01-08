<?php

namespace App\Http\Livewire\Traits;

trait WithPersist
{
	/**
	 * Method to forget persisted key.
	 *
	 *
	 * @param array|string $keys
	 *
	 * @return $this
	 */
	public function forget(array|string $keys): self
	{
		if (is_array($keys)) {
			session()->forget(array_map([$this, 'getKey'], $keys));
		} else {
			session()->forget($this->getKey($keys));
		}

		return $this;
	}

	/**
	 * @param string $key
	 * @return mixed
	 */
	public function getPersisted(string $key): mixed
	{
		return session($this->getKey($key));
	}

	/**
	 * @param string $key
	 * @return string
	 */
	public function getKey(string $key): string
	{
		return static::class . '_' . $key;
	}

	/**
	 * @param string $key
	 * @param mixed $value
	 * @return $this
	 */
	public function persist(string $key, mixed $value): self
	{
		session([$this->getKey($key) => $value]);

		return $this;
	}

	/**
	 * Method to sync class property with session value and request value for specified key.
	 *
	 *
	 * @param  string  $property
	 * @param ?string  $requestKey
	 *
	 * @return $this
	 */
	public function syncKey(string $property, ?string $requestKey = null): self
	{
		// If the request key is not set, use the property name.
		if (is_null($requestKey)) {
			$requestKey = $property;
		}

		// Try getting the value from the request.
		$value = request($requestKey);

		// If the value was found in the request, save it in the session.
		if ($value !== null) {
			$this->persist($property, $value);
		}

		// If the value was found in the session, retrieve it from there and set the class property.
		$persisted = $this->getPersisted($property);

		if ($persisted !== null) {
			$this->$property = $persisted;
		}

		return $this;
	}
}
