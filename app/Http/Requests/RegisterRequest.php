<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'email'                 => 'required|email|unique:users,email',
			'username'              => 'required|unique:users,username|min:3',
			'password'              => 'required|min:3',
			'password_confirmation' => 'required|same:password',
		];
	}
}
