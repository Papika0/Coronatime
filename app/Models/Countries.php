<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Countries extends Model
{
	use HasFactory;

	protected $guarded = [];

	public function stats()
	{
		return $this->hasOne(CountryStats::class, 'code', 'code');
	}
}
