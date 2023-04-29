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
			return [
				'code'       => $country['code'],
				'name'       => json_encode($country['name']),
				'created_at' => now(),
				'updated_at' => now(),
			];
		});

		$responses = Http::pool(function ($client) use ($insertData) {
			return collect($insertData)->map(function ($country) use ($client) {
				return $client->post('https://devtest.ge/get-country-statistics', [
					'code' => $country['code'],
				]);
			});
		});

		$stats = collect($responses)->map(function ($response, $index) use ($insertData) {
			$country = $insertData[$index];

			if ($response->ok()) {
				$stat = $response->json();

				return [
					'code'       => $country['code'],
					'name'       => $country['name'],
					'confirmed'  => $stat['confirmed'],
					'recovered'  => $stat['recovered'],
					'critical'   => $stat['critical'],
					'deaths'     => $stat['deaths'],
					'created_at' => now(),
					'updated_at' => now(),
				];
			}
		})->filter();

		DB::table('countries')->upsert($stats->all(), ['code'], ['name', 'confirmed', 'recovered', 'critical', 'deaths', 'created_at', 'updated_at']);

		$this->info('Data migrated successfully.');
	}
}
