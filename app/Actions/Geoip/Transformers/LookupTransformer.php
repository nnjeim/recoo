<?php

namespace App\Actions\Geoip\Transformers;

use Torann\GeoIP\Location;

trait LookupTransformer
{
	/**
	 * @param  Location  $location
	 * @return array
	 */
	protected function transform(Location $location): array
	{
		return [
			'ip' => $location->ip,
			'country_code' => $location->iso_code,
			'country_name' => $location->country,
			'city' => $location->city,
			'state' => $location->state,
			'postcode' => $location->postal_code,
			'latitude' => $location->lat,
			'longitude' => $location->lon,
			'timezone' => $location->timezone,
		];
	}
}
