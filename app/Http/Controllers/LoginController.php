<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
	public function showHome(): RedirectResponse
	{
		return redirect()->route('dashboard.show');
	}

	public function show(): View
	{
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

	public function logout(): RedirectResponse
	{
		Session::flush();

		Auth::logout();

		return redirect('login');
	}
}
