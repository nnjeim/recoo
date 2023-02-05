<?php

namespace App\Actions\Geoip;

use App\Actions\Geoip\Transformers\LookupTransformer;

class LookupAction
{
	use LookupTransformer;
	/* ----------------------
	response format;

	'ip' => '86.120.124.17'
	'iso_code' => 'RO'
	'country' => 'Romania'
	'city' => 'Bucharest'
	'state' => 'B'
	'state_name' => 'Bucharest'
	'postal_code' => ''
	'lat' => 44.426
	'lon' => 26.1296
	'timezone' => 'Europe/Bucharest'
	'continent' => 'Unknown'
	'currency' => 'RON'
	-------------------------*/

	private ?array $args;

	public function __construct(?array $args = null)
	{
		$this->args = $args;
	}

	public function __invoke(): array
	{
		return $this->transform(
			geoip()->getLocation($this->args['ip'] ?? request()->ip())
		);
	}
}
