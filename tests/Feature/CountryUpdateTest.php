<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountryUpdateTest extends TestCase
{
	use RefreshDatabase;

	public function test_country_update_command()
	{
		$this->artisan('countries:update')
			->expectsOutput('Data migrated successfully.')
			->assertExitCode(0);
	}
}
