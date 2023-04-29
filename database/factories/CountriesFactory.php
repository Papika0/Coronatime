<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Countries>
 */
class CountriesFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'name' => [
				'en' => $this->faker->country,
				'ka' => $this->faker->country,
			],
			'confirmed' => $this->faker->numberBetween(0, 100000),
			'recovered' => $this->faker->numberBetween(0, 100000),
			'deaths'    => $this->faker->numberBetween(0, 10000),
			'code'      => $this->faker->countryCode,
		];
	}
}
