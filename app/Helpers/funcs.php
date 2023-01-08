<?php

include 'partials/datetime.php';

if (! function_exists('trigger')) {
	/**
	 * @param  string  $className
	 * @param  null  $args
	 * @return mixed
	 */
	function trigger(string $className, $args = null): mixed
	{
		return app($className)->execute($args);
	}
}

if (! function_exists('invoke')) {
	function invoke()
	{
		$args = func_get_args();

		$className = array_shift($args);

		return (new $className(...$args))();
	}
}

if (! function_exists('objectToArray')) {
	function objectToArray($object)
	{
		if (! is_object($object) && ! is_array($object)) {
			return $object;
		}

		return array_map('objectToArray', (array) $object);
	}
}

if (! function_exists('isTrue')) {
	/**
	 * @param  $value
	 * @return bool
	 */
	function isTrue($value): bool
	{
		return in_array($value, ['true', true, 1, '1'], true);
	}
}

if (! function_exists('isFalse')) {
	/**
	 * @param  $value
	 * @return bool
	 */
	function isFalse($value): bool
	{
		return in_array($value, ['false', false, 0, '0', null, 'null'], true);
	}
}

if (! function_exists('generatePassword')) {
	/**
	 * @param  int  $length
	 * @return string
	 */
	function generatePassword(int $length = 8): string
	{
		return Str::random($length);
	}
}

if (! function_exists('array_only')) {
	/**
	 * @param  array  $stack
	 * @param  array  $keys
	 * @return array
	 */
	function array_only(array $stack, array $keys): array
	{
		return array_intersect_key(
			$stack,
			array_flip($keys)
		);
	}
}
