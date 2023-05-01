<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PasswordResetTest extends TestCase
{
	use RefreshDatabase, WithFaker;

	public function test_if_password_reset_is_accessable()
	{
		$response = $this->get(route('password.request_show'));
		$response->assertStatus(200);
	}

	public function test_if_email_is_required()
	{
		$response = $this->post(route('password.request'), [
			'email' => '',
		]);

		$response->assertSessionHasErrors('email');
	}

	public function test_if_email_is_valid()
	{
		$response = $this->post(route('password.request'), [
			'email' => 'invalid-email',
		]);

		$response->assertSessionHasErrors('email');
	}

	public function test_if_it_sends_password_reset_email()
	{
		Notification::fake();

		$user = User::factory()->create();

		$response = $this->post(route('password.request'), [
			'email' => $user->email,
		]);

		$response->assertOk();
		$response->assertViewIs('verify.email-send');

		Notification::assertSentTo($user, ResetPassword::class);
	}

	public function test_if_password_reset_form_is_accessable()
	{
		$response = $this->get(route('password.reset_show', [
			'token' => $this->faker->uuid,
		]));

		$response->assertStatus(200);
	}

	public function test_if_password_is_required()
	{
		$response = $this->post(route('password.reset', [
			'token' => $this->faker->uuid,
		]), [
			'email'                 => $this->faker->email,
			'password'              => '',
			'password_confirmation' => '',
		]);

		$response->assertSessionHasErrors('password');
	}

	public function test_if_password_is_confirmed()
	{
		$response = $this->post(route('password.reset', [
			'token' => $this->faker->uuid,
		]), [
			'email'                 => $this->faker->email,
			'password'              => 'password',
			'password_confirmation' => 'password-confirmation',
		]);

		$response->assertSessionHasErrors('password');
	}

	public function test_if_it_resets_user_password()
	{
		$user = User::factory()->create();
		Event::fake(PasswordReset::class);

		$token = Password::createToken($user);
		$newPassword = 'new-password';

		$response = $this->post(route('password.reset', $token), [
			'email'                 => $user->email,
			'token'                 => $token,
			'password'              => $newPassword,
			'password_confirmation' => $newPassword,
		]);

		$this->assertTrue(Hash::check($newPassword, $user->fresh()->password));
		Event::assertDispatched(PasswordReset::class);
	}

	public function test_password_submit_should_send_reset_link_to_user_registered_with_provided_email()
	{
		Notification::fake(ResetPassword::class);
		$user = User::factory()->create();
		$response = $this->post(route('password.request'), ['email' => $user->email]);
		$response->assertViewIs('verify.email-send');
		Notification::assertSentTo(
			$user,
			ResetPassword::class,
			function ($notification, $channels) use ($user) {
				$mailMessage = $notification->toMail($user);
				$view = $mailMessage->viewData;
				$url = $view['url'];
				return $url === route('password.reset_show', $notification->token) . '?email=' . $user->getEmailForPasswordReset();
			}
		);
	}
}
