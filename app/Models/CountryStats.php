<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CountryStats extends Model
{
	use HasFactory;

	protected $guarded = [];

	public function countryName()
	{
		return $this->belongsTo(Countries::class, 'code', 'code');
	}
}
