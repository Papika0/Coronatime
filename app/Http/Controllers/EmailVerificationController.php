<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
	public function show(): View
	{
		return view('verify.email-send');
	}

	public function verify(EmailVerificationRequest $request): View
	{
		$request->fulfill();
		auth()->logout();
		return view('verify.email-verified');
	}
}
