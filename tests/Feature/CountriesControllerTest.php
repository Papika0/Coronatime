<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Countries;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountriesControllerTest extends TestCase
{
	use RefreshDatabase;

	public function test_show_method_returns_view_with_stats()
	{
		$user = User::factory()->create();
		$this->actingAs($user);

		$stats = Countries::factory()->create([
			'confirmed' => 100,
			'recovered' => 50,
			'deaths'    => 10,
		]);

		$response = $this->get(route('dashboard.show'));

		$response->assertStatus(200);
		$response->assertViewIs('dashboard.worldwide');
		$this->assertEquals($stats->confirmed, 100);
		$this->assertEquals($stats->recovered, 50);
		$this->assertEquals($stats->deaths, 10);
	}

	public function test_index_method_returns_view_with_country_stats()
	{
		$user = User::factory()->create();
		$this->actingAs($user);

		Countries::factory()->create()->count(2);

		$response = $this->get(route('countries.index'));

		$response->assertStatus(200);
		$response->assertViewIs('dashboard.countries');
		$response->assertViewHas('countryStats');
	}

	public function test_countries_model()
	{
		$country = Countries::factory()->create([
			'name' => [
				'en' => 'USA',
				'ka' => 'აშშ',
			],
			'confirmed' => 100,
		]);

		Countries::factory()->create([
			'name' => [
				'en' => 'GEO',
				'ka' => 'საქართველო',
			],
			'confirmed' => 200,
		]);

		// Test filter scope
		$searchRequest = new Request(['search' => 'USA']);
		$this->assertEquals(1, Countries::filter($searchRequest)->count());

		$sortRequest = new Request(['sort' => 'name.en_asc']);
		$this->assertEquals(2, Countries::filter($sortRequest)->first()->id);

		$sortRequest = new Request(['sort' => 'name.en_desc']);
		$this->assertEquals($country->id, Countries::filter($sortRequest)->first()->id);

		$sortRequest = new Request(['sort' => 'confirmed_asc']);
		$this->assertEquals($country->id, Countries::filter($sortRequest)->first()->id);
	}
}
