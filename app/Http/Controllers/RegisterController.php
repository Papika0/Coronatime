<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
	public function show(): View
	{
		return view('auth.register');
	}

	public function register(RegisterRequest $request): RedirectResponse
	{
		$user = User::create($request->validated());

		auth()->login($user);

		return redirect('/')->with('success', 'Account successfully registered.');
	}
}
