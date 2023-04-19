<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Http\Requests\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
	public function show(): View
	{
		return view('verify.email-send');
	}

	public function verify(EmailVerificationRequest $request): View
	{
		$request->fulfill();
		return view('verify.email-verified');
	}
}
