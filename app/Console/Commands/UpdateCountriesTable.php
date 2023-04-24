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

		$insertData = collect($response->json())->map(function ($country) {
			return ['code' => $country['code'],
				'name'        => json_encode($country['name']),
				'created_at'  => now(),
				'updated_at'  => now(),
			];
		})->toArray();

		DB::table('countries')->upsert($insertData, ['code'], ['name', 'created_at', 'updated_at']);

		$this->info('Countries table updated successfully.');
	}
}
