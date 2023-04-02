<?php

use App\Actions\Permission\CanAction;

include 'partials/array.php';
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

if (! function_exists('can')) {
	/**
	 * @param  string  $name
	 * @return bool
	 */
	function can(string $name): bool
	{
		return trigger(CanAction::class, $name)->data;
	}
}

if (! function_exists('generateToken')) {
	/**
	 * @param  int  $length
	 * @return array|string|string[]
	 */
	function generateToken(int $length = 25): array|string
	{
		return str_replace('=', '', base64_encode(Str::random($length)));
	}
}

