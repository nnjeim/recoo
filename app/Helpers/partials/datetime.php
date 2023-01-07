<?php

use Carbon\Carbon;

if (! function_exists('adjustTimeZone')) {
	/**
	 * @param $carbonDate
	 * @param string $timezone
	 * @param string $standard
	 * @param string|null $timeFormat
	 * @return string|null
	 */
	function adjustTimeZone($carbonDate, string $timezone = 'UTC', string $standard = 'iso', ?string $timeFormat = null): ?string
	{
		if (! $carbonDate instanceof Carbon) {
			return null;
		}

		if ($standard === 'iso') {
			return $carbonDate
				->setTimezone($timezone)
				->isoFormat($timeFormat ?? 'LLL');
		}
		if ($standard === 'sql') {
			return $carbonDate
				->setTimezone($timezone)
				->format($timeFormat ?? 'Y-m-d H:i:s');
		}

		return null;
	}
}

if (! function_exists('adjustUserTimezone')) {
	/**
	 * @param  $dateTime
	 * @param  string  $standard
	 * @param  string|null  $timeFormat
	 * @return string|null
	 */
	function adjustUserTimezone($dateTime, string $standard = 'iso', ?string $timeFormat = null): ?string
	{
		if (! $dateTime instanceof Carbon) {
			$dateTime = Carbon::parse($dateTime);
		}

		return adjustTimeZone(
			$dateTime,
			request()->input('user_timezone') ?? config('constants.app_timezone'),
			$standard,
			$timeFormat
		);
	}
}


if (! function_exists('splitDateTime')) {
	/**
	 * @param $carbonDate
	 * @param  string  $timezone
	 * @param  string  $type
	 * @return string|null
	 */
	function splitDateTime($carbonDate, string $timezone = 'UTC', string $type = 'date'): ?string
	{
		if (! $carbonDate instanceof Carbon) {
			return null;
		}
		$split = explode(' ', adjustTimeZone($carbonDate, $timezone, 'sql', 'Y-m-d H:i'));

		return $split[['date' => 0, 'time' => 1][$type]];
	}
}

if (! function_exists('parseToUTC')) {
	/**
	 * @param $date
	 * @param $timezone
	 * @return Carbon
	 */
	function parseToUTC($date, $timezone): Carbon
	{
		return Carbon::parse($date, $timezone)->setTimezone('UTC');
	}
}
