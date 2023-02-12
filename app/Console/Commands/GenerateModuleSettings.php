<?php

namespace App\Console\Commands;

use App\Models\ModuleSetting;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class GenerateModuleSettings extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'moduleSettings:generate {--o|overwrite} {--d|delete}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate module settings';

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
		$this->getOutput()->block('Generating the module settings');

		$moduleSettings = config('moduleSettings');

		$this->getOutput()->progressStart(count($moduleSettings));

		foreach ($moduleSettings as $settable_type => $params) {
			// dotted representation of the module settings
			$dottedSettings = Arr::dot($params);
			// existing module settings
			$moduleParams = ModuleSetting::query()
				->where('settable_type', $settable_type)
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

			foreach ($dottedSettings as $k => $v) {
				// key exists
				$existingKey = Arr::get($moduleParams, $k);
				// updateOrCreate key in params
				if ($existingKey === null || $this->option('overwrite')) {

					Arr::set($moduleParams, $k, $v);
				}
			}
			// updateOrCreate the module settings
			ModuleSetting::updateOrCreate(
				[
					'settable_type' => $settable_type,
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
