<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
	public function rules(): array
	{
		$rules = [
			'password' => ['required'],
			'remember' => ['nullable'],
		];

		if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
			$rules['email'] = ['required', 'email', 'exists:users,email', 'min:3'];
		} else {
			$rules['email'] = ['required', 'exists:users,username'];
		}

		return $rules;
	}
}
