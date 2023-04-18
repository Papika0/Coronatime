<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'token'                 => 'required',
			'email'                 => 'required|email|exists:users,email',
			'password'              => 'required|confirmed|min:3',
			'password_confirmation' => 'required|min:3|same:password',
		];
	}
}
