<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'search' => 'nullable|string',
			'sort'   => 'nullable|string',
		];
	}
}
