<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Http\FormRequest;

class EmailVerificationRequest extends FormRequest
{
	protected $user;

	public function authorize()
	{
		$user = User::findOrFail($this->route('id'));

		if (!hash_equals((string) $user->getKey(), (string) $this->route('id'))) {
			return false;
		}

		if (!hash_equals(sha1($user->getEmailForVerification()), (string) $this->route('hash'))) {
			return false;
		}

		$this->user = $user;

		return true;
	}

		public function fulfill()
		{
			if (!$this->user->hasVerifiedEmail()) {
				$this->user->markEmailAsVerified();

				event(new Verified($this->user));
			}
		}

		public function rules()
		{
			return [];
		}
}
