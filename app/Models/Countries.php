<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
	use HasFactory;

	protected $guarded = [];

	public function stats()
	{
		return $this->hasOne(CountryStat::class, 'code', 'code');
	}
}
