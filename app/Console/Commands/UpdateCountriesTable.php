<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UpdateCountriesTable extends Command
{
	protected $signature = 'countries:update';

	protected $description = 'Update the countries table with data from an API';

	public function handle()
	{
		$response = Http::get('https://devtest.ge/countries');
		$countries = $response->json();

		foreach ($countries as $country) {
			DB::table('countries')
				->updateOrInsert(
					['code' => $country['code']],
					['name'       => json_encode($country['name'])],
				);
		}

		$this->info('Countries table updated successfully.');
	}
}
