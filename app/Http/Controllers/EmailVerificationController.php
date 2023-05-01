<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;

class EmailVerificationController extends Controller
{
	public function show(): View
	{
		return view('verify.email-send');
	}

	public function verify(Request $request): View
	{
		$id = $request->route('id');
		$hash = $request->route('hash');

		$user = User::findOrFail($id);

		if (!hash_equals((string) $user->getKey(), (string) $id) ||
			!hash_equals(sha1($user->getEmailForVerification()), (string) $hash)) {
			abort(403);
		}

		if (!$user->hasVerifiedEmail()) {
			$user->markEmailAsVerified();
			event(new Verified($user));
		}

		return view('verify.email-verified');
	}
}
