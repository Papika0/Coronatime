<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
	use RefreshDatabase, WithFaker;

	public function test_register_should_be_accessible()
	{
		$response = $this->get(route('register.show'));

		$response->assertStatus(200);
	}

	public function test_register_should_give_us_errors_if_inputs_are_empty()
	{
		$response = $this->post(route('register'));

		$response->assertSessionHasErrors(['username', 'email', 'password']);
	}

	public function test_register_should_give_us_errors_if_username_is_not_provided()
	{
		$response = $this->post(route('register'), [
			'email'                 => $this->faker->unique()->safeEmail,
			'password'              => $this->faker->password,
			'password_confirmation' => $this->faker->password,
		]);

		$response->assertSessionHasErrors(['username']);
	}

	public function test_register_should_give_us_errors_if_email_is_not_provided()
	{
		$response = $this->post(route('register'), [
			'username'              => $this->faker->unique()->userName,
			'password'              => $this->faker->password,
			'password_confirmation' => $this->faker->password,
		]);

		$response->assertSessionHasErrors(['email']);
	}

	public function test_register_should_give_us_errors_if_password_is_not_provided()
	{
		$response = $this->post(route('register'), [
			'username'              => $this->faker->unique()->userName,
			'email'                 => $this->faker->unique()->safeEmail,
			'password_confirmation' => $this->faker->password,
		]);

		$response->assertSessionHasErrors(['password']);
	}

	public function test_register_should_give_us_errors_if_password_confirmation_is_not_provided()
	{
		$response = $this->post(route('register'), [
			'username' => $this->faker->unique()->userName,
			'email'    => $this->faker->unique()->safeEmail,
			'password' => $this->faker->password,
		]);

		$response->assertSessionHasErrors(['password_confirmation']);
	}

	public function test_register_should_give_us_errors_if_password_and_password_confirmation_do_not_match()
	{
		$response = $this->post(route('register'), [
			'username'              => $this->faker->unique()->userName,
			'email'                 => $this->faker->unique()->safeEmail,
			'password'              => $this->faker->password,
			'password_confirmation' => $this->faker->password,
		]);

		$response->assertSessionHasErrors(['password_confirmation']);
	}

	public function test_username_should_have_minimum_length_of_3_chars()
	{
		$response = $this->post(route('register'), [
			'username'              => 'aa',
			'email'                 => $this->faker->unique()->safeEmail,
			'password'              => $this->faker->password,
			'password_confirmation' => $this->faker->password,
		]);

		$response->assertSessionHasErrors(['username']);
	}

	public function test_password_should_have_minimum_length_of_3_chars()
	{
		$response = $this->post(route('register'), [
			'username'              => $this->faker->unique()->userName,
			'email'                 => $this->faker->unique()->safeEmail,
			'password'              => 'aa',
			'password_confirmation' => 'aa',
		]);

		$response->assertSessionHasErrors(['password']);
	}

	public function test_register_should_give_us_errors_if_email_is_already_taken()
	{
		$existingUser = UserFactory::new()->create();

		$response = $this->post(route('register'), [
			'username'              => $this->faker->unique()->userName,
			'email'                 => $existingUser->email,
			'password'              => $this->faker->password,
			'password_confirmation' => $this->faker->password,
		]);

		$response->assertSessionHasErrors(['email']);
	}

	public function test_register_should_give_us_errors_if_username_is_already_taken()
	{
		$existingUser = UserFactory::new()->create();

		$response = $this->post(route('register'), [
			'username'              => $existingUser->username,
			'email'                 => $this->faker->unique()->safeEmail,
			'password'              => $this->faker->password,
			'password_confirmation' => $this->faker->password,
		]);

		$response->assertSessionHasErrors(['username']);
	}

	public function test_register_should_redirect_on_email_verification_mail_sent_on_success_and_send_email()
	{
		Notification::fake();
		$response = $this->post(route('register'), [
			'username'              => $this->faker->unique()->userName,
			'email'                 => $email = $this->faker->unique()->safeEmail,
			'password'              => 'password',
			'password_confirmation' => 'password',
		]);
		$user = User::where('email', $email)->firstOrFail();

		$response->assertRedirect(route('verification.notice'));
		Notification::assertSentTo([$user], VerifyEmail::class);
	}

	public function test_register_should_create_user_on_success()
	{
		$response = $this->post(route('register'), [
			'username'              => $username = $this->faker->unique()->userName,
			'email'                 => $email = $this->faker->unique()->safeEmail,
			'password'              => 'password',
			'password_confirmation' => 'password',
		]);
		$user = User::where('email', $email)->firstOrFail();

		$response->assertRedirect(route('verification.notice'));
		$this->assertEquals($username, $user->username);
		$this->assertEquals($email, $user->email);
	}

	public function test_remove_unverified_users_command()
	{
		$this->artisan('users:remove-unverified')
			->assertExitCode(0);
	}
}
