<?php

if (! function_exists('objectToArray')) {
	function objectToArray($object)
	{
		if (! is_object($object) && ! is_array($object)) {
			return $object;
		}

		return array_map('objectToArray', (array) $object);
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

if (! function_exists('arrayDepth')) {
	/**
	 * @param  array  $array
	 * @return int
	 */
	function arrayDepth(array $array): int
	{
		$max_depth = 1;

		foreach ($array as $value) {
			if (is_array($value)) {
				$depth = arrayDepth($value) + 1;

				if ($depth > $max_depth) {
					$max_depth = $depth;
				}
			}
		}

		return $max_depth;
	}
}
