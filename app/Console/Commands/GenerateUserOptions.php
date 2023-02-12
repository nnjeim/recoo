<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\UserOption;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class GenerateUserOptions extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'userOptions:generate {--o|overwrite} {--d|delete}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate user options';

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
		$this->getOutput()->block('Generating user options');

		$users = User::all();

		$options = config('userOptions');

		$this->getOutput()->progressStart($users->count());

		foreach ($users as $user) {

			$userParams = $user?->options?->params ?? [];

			// drop unused keys
			if ($this->option('delete')) {
				$depth = 0;
				while ($depth <= arrayDepth($userParams) + 1) {
					$userParamsKeys = array_keys(Arr::dot($userParams));
					foreach ($userParamsKeys as $key) {
						if (! Arr::get($options, $key)) {
							Arr::forget($userParams, $key);
						}
					}
					$depth++;
				}
			}

			foreach (Arr::dot($options) as $k => $v) {
				// key exists
				$existingKey = Arr::get($userParams, $k);
				// updateOrCreate key in params
				if ($existingKey === null || $this->option('overwrite')) {

					Arr::set($userParams, $k, $v);
				}
			}
			// update user params
			UserOption::updateOrCreate(
					[
						'user_id' => $user->id,
					],
					[
						'params' => $userParams,
					]
				);

			$this->getOutput()->progressAdvance();
		}

		$this->getOutput()->progressFinish();

		$this->getOutput()->block('The end!');
	}
}
