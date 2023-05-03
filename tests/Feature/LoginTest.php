<?php

namespace Tests\Feature;

use Tests\TestCase;
use Database\Factories\UserFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
	use RefreshDatabase , WithFaker;

	public function test_login_should_give_us_errors_if_input_is_empty()
	{
		$response = $this->post(route('login'));

		$response->assertSessionHasErrors(['email', 'password']);
	}

	public function test_login_should_give_us_errors_if_we_wont_provide_email_input()
	{
		$response = $this->post(route('login'), [
			'email'    => '',
			'password' => $this->faker->password,
		]);

		$response->assertSessionHasErrors(['email']);
	}

	public function test_email_should_have_minimum_length_of_3_chars()
	{
		$response = $this->post(route('login'), [
			'email'    => 'ss',
			'password' => $this->faker->password,
		]);

		$response->assertSessionHasErrors(['email']);
	}

	public function test_password_should_have_minimum_length_of_3_chars()
	{
		$response = $this->post(route('login'), [
			'email'    => $this->faker->email,
			'password' => 'ss',
		]);

		$response->assertSessionHasErrors(['email']);
	}

	public function test_login_should_give_us_errors_if_we_wont_provide_password_input()
	{
		$response = $this->post(route('login'), [
			'email'    => $this->faker->email,
		]);

		$response->assertSessionHasErrors(['password']);
	}

	public function test_login_should_give_us_errors_if_email_dont_exist_in_database()
	{
		UserFactory::new()->create();

		$response = $this->post(route('login'), [
			'email'    => $this->faker->email,
			'password' => $this->faker->password,
		]);

		$response->assertSessionHasErrors(['email']);
	}

	public function test_login_should_give_us_errors_if_user_doesnt_exists_in_database()
	{
		UserFactory::new()->create();

		$response = $this->post(route('login'), [
			'email'    => $this->faker->email,
			'password' => $this->faker->password,
		]);

		$response->assertSessionHasErrors(['email']);
	}

	public function test_auth_attempt_returns_false_throws_validation_exception()
	{
		$user = UserFactory::new()->create();

		$response = $this->post('/login', [
			'email'    => $user->email,
			'password' => 'wrong_password',
		]);

		$this->assertEquals('These credentials do not match our records.', $response->exception->getMessage());
	}

	public function test_guest_user_redirected_to_login_page()
	{
		$response = $this->get(route('home.index'));

		$response->assertRedirect(route('login.show'));
	}

	public function test_authenticated_user_redirected_to_dashboard()
	{
		$user = UserFactory::new()->create();
		Auth::login($user);

		$response = $this->get(route('home.index'));

		$response->assertStatus(302);
		$response->assertRedirect(route('dashboard.show'));
	}

	public function test_show_returns_correct_view()
	{
		$response = $this->get(route('login.show'));

		$response->assertStatus(200);
		$response->assertViewIs('auth.login');
	}

	public function test_login_with_email_redirects_to_dashboard_when_successful()
	{
		$user = UserFactory::new()->create();

		$response = $this->post(route('login'), [
			'email'    => $user->email,
			'password' => 'password',
		]);

		$response->assertStatus(302);
		$response->assertRedirect(route('dashboard.show'));
	}

	public function test_login_with_username_redirects_to_dashboard_when_successful()
	{
		$user = UserFactory::new()->create([
			'email'    => $this->faker->unique()->safeEmail(),
			'username' => $this->faker->unique()->userName(),
		]);

		$response = $this->post(route('login'), [
			'email'    => $user->username,
			'password' => 'password',
		]);

		$response->assertStatus(302);
		$response->assertRedirect(route('dashboard.show'));
	}

	public function test_login_redirects_to_verification_notice_when_email_not_verified()
	{
		$user = UserFactory::new()->unverified()->create();

		$response = $this->post(route('login'), [
			'email'    => $user->email,
			'password' => 'password',
		]);

		$response->assertStatus(302);
		$response->assertRedirect(route('verification.notice'));
	}
}
