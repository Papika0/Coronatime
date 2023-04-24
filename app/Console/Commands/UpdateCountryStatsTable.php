<?php

namespace App\Console\Commands;

use App\Models\Countries;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UpdateCountryStatsTable extends Command
{
	protected $signature = 'country-stats:update';

	protected $description = 'Update the country_stats table with data from an API';

	public function handle()
	{
		$countries = Countries::all();

		$responses = Http::pool(function ($client) use ($countries) {
			return collect($countries)->map(function ($country) use ($client) {
				return $client->post('https://devtest.ge/get-country-statistics', [
					'code' => $country->code,
				]);
			});
		});

		$stats = collect($responses)->map(function ($response, $index) use ($countries) {
			$country = $countries[$index];

			if ($response->ok()) {
				$stat = $response->json();

				return [
					'code'      => $country->code,
					'country'   => $stat['country'],
					'confirmed' => $stat['confirmed'],
					'recovered' => $stat['recovered'],
					'critical'  => $stat['critical'],
					'deaths'    => $stat['deaths'],
				];
			} else {
				$this->error("Failed to fetch stats for {$country->name}.");
				return null;
			}
		})->filter();

		DB::table('country_stats')->upsert($stats->all(), ['code'], [
			'country',
			'confirmed',
			'recovered',
			'critical',
			'deaths',
		]);

		$this->info('Country stats updated successfully.');
	}
}
