<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
	public function show(): RedirectResponse|View
	{
		if (Auth::check()) {
			return redirect()->route('dashboard.show');
		}
		return view('auth.login');
	}

	public function login(LoginRequest $request): RedirectResponse
	{
		$credentials = $request->only(['password']);
		$username = $request->email;

		if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
			$credentials['email'] = $username;
		} else {
			$credentials['username'] = $username;
		}

		$user = User::where('email', $username)
			->orWhere('username', $username)
			->first();
		if (!$user->hasVerifiedEmail()) {
			return redirect()->route('verification.notice');
		}

		if (!Auth::attempt($credentials, $request->has('remember'))) {
			throw ValidationException::withMessages([
				'email' => __('auth.failed'),
			]);
		}

		$request->session()->regenerate();

		return redirect()->intended(route('dashboard.show'));
	}
}
