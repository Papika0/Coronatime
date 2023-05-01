<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Config;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailVerifyTest extends TestCase
{
	use RefreshDatabase;

	public function test_show_method_returns_view()
	{
		$response = $this->get(route('verification.notice'));
		$response->assertViewIs('verify.email-send');
	}

	public function test_verify_method_returns_403_if_unauthorized()
	{
		$user = User::factory()->create([
			'email_verified_at' => null,
			'remember_token'    => '',
		]);
		$verificationUrl = URL::temporarySignedRoute(
			'verification.verify',
			Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
			[
				'id'   => $user->getKey(),
				'hash' => 'invalid-hash',
			]
		);

		$response = $this->get($verificationUrl);

		$response->assertStatus(403);
	}

	public function test_verify_method_returns_view_if_user_verified()
	{
		Event::fake(Verified::class);

		$user = User::factory()->create([
			'email_verified_at' => null,
			'remember_token'    => '',
		]);
		$verificationUrl = URL::temporarySignedRoute(
			'verification.verify',
			Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
			[
				'id'   => $user->getKey(),
				'hash' => sha1($user->getEmailForVerification() . $user->getRememberToken()),
			]
		);

		$response = $this->get($verificationUrl);

		$response->assertViewIs('verify.email-verified');
		$this->assertTrue($user->fresh()->hasVerifiedEmail());
		Event::assertDispatched(Verified::class);
	}
}
