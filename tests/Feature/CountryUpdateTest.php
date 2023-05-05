<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountryUpdateTest extends TestCase
{
	use RefreshDatabase;

	public function test_it_updates_countries_table_with_data_from_an_api()
	{
		Http::fake([
			'devtest.ge/countries' => Http::response([[
				'code' => 'US',
				'name' => 'United States',
			]], 200),
			'devtest.ge/get-country-statistics' => Http::response([
				'confirmed' => 1000,
				'recovered' => 500,
				'critical'  => 50,
				'deaths'    => 100,
			], 200),
		]);

		Artisan::call('countries:update');

		Http::assertSent(function ($request) {
			return $request->url() === 'https://devtest.ge/countries';
		});

		Http::assertSent(function ($request) {
			return $request->url() === 'https://devtest.ge/get-country-statistics' &&
				$request->data()['code'] === 'US';
		});

		$this->assertDatabaseHas('countries', [
			'code'      => 'US',
			'name'      => '"United States"',
			'confirmed' => 1000,
			'recovered' => 500,
			'critical'  => 50,
			'deaths'    => 100,
		]);
	}
}
