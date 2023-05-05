<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Auth\Events\Verified;
use App\Http\Requests\VerifyEmailRequest;

class EmailVerificationController extends Controller
{
	public function show(): View
	{
		return view('verify.email-send');
	}

	public function verify(VerifyEmailRequest $request): View
	{
		$user = User::findOrFail($request->id);

		if (!hash_equals((string) $user->getKey(), (string) $request->id) ||
			!hash_equals(sha1($user->getEmailForVerification()), (string) $request->hash)) {
			abort(403);
		}

		if (!$user->hasVerifiedEmail()) {
			$user->markEmailAsVerified();
			event(new Verified($user));
		}

		return view('verify.email-verified');
	}
}
