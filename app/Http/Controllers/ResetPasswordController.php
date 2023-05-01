<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\PasswordResetRequest;
use Illuminate\Http\RedirectResponse;

class ResetPasswordController extends Controller
{
	public function show(): View
	{
		return view('auth.forgot-password');
	}

	public function request(Request $request): RedirectResponse
	{
		$request->validate(['email' => 'required|email|exists:users,email']);
		$status = Password::sendResetLink(
			$request->only('email')
		);

		return $status === Password::RESET_LINK_SENT
		? view('verify.email-send')->with(['status' => __($status)])
		: back()->withErrors(['email' => __($status)]);
	}

	public function showResetForm(Request $request, $token = null): View
	{
		return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
	}

	public function reset(PasswordResetRequest $request): RedirectResponse
	{
		$status = Password::reset(
			$request->validated(),
			function (User $user, $password) {
				$user->forceFill([
					'password' => $password,
				])->setRememberToken(Str::random(60));
				$user->save();

				event(new PasswordReset($user));
			}
		);

		return $status === Password::PASSWORD_RESET
		? view('verify.password-updated')->with('status', __($status))
		: back()->withErrors(['email' => [__($status)]]);
	}
}
