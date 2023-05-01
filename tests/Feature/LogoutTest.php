<?php

namespace Tests\Feature;

use Tests\TestCase;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogoutTest extends TestCase
{
	use RefreshDatabase;

	public function test_logout_clears_session_and_logs_out_user_and_redirects_to_login()
	{
		$user = UserFactory::new()->create();
		$this->actingAs($user);

		$response = $this->get(route('logout'));

		$response->assertRedirect(route('login'));

		$this->assertGuest();
	}

	public function test_logout_requires_authentication()
	{
		$response = $this->get(route('logout'));

		$response->assertRedirect(route('login'));
	}
}
