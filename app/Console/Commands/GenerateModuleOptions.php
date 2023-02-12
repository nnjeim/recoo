<?php

namespace App\Console\Commands;

use App\Models\ModuleOption;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class GenerateModuleOptions extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'moduleOptions:generate {--o|overwrite} {--d|delete}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate module options';

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
		$this->getOutput()->block('Generating the module options');

		$moduleOptions = config('moduleOptions');

		$this->getOutput()->progressStart(count($moduleOptions));

		foreach ($moduleOptions as $optionable_type => $params) {
			// dotted representation of the module options
			$dottedOptions = Arr::dot($params);
			// existing module options
			$moduleParams = ModuleOption::query()
				->where('optionable_type', $optionable_type)
				->value('params')
				?? [];

			// drop unused keys
			if ($this->option('delete')) {
				$depth = 0;
				while ($depth <= arrayDepth($moduleParams) + 1) {
					$moduleParamsKeys = array_keys(Arr::dot($moduleParams));
					foreach ($moduleParamsKeys as $key) {
						if (! Arr::get($params, $key)) {
							Arr::forget($moduleParams, $key);
						}
					}
					$depth++;
				}
			}

			foreach ($dottedOptions as $k => $v) {
				// key exists
				$existingKey = Arr::get($moduleParams, $k);
				// updateOrCreate key in params
				if ($existingKey === null || $this->option('overwrite')) {

					Arr::set($moduleParams, $k, $v);
				}
			}
			// updateOrCreate the module options
			ModuleOption::updateOrCreate(
				[
					'optionable_type' => $optionable_type,
				],
				[
					'params' => $moduleParams,
				]
			);

			$this->getOutput()->progressAdvance();
		}

		$this->getOutput()->progressFinish();

		$this->getOutput()->block('The end!');
	}
}
