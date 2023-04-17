<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
	public function show(): View
	{
		return view('auth.register');
	}

	public function register(RegisterRequest $request): RedirectResponse
	{
		$user = User::create($request->validated());

		event(new Registered($user));

		auth()->login($user);
		return redirect()->route('verification.notice');
	}
}
